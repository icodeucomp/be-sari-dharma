<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

/**
 * The doctor's photo now lives only on the doctor (Master Dokter). A schedule just points to a doctor.
 *
 * For every doctor that has a schedule photo, that photo becomes the doctor's photo
 * (the file is copied into uploads/doctor, the original is left in place), then the
 * photo column is dropped from doctor_schedules. A doctor without a schedule photo keeps
 * the photo they already have.
 */
return new class extends Migration
{
    public function up(): void
    {
        $disk = Storage::disk('public');

        // Newest schedule first, so the most recently uploaded photo wins when a doctor has several.
        $schedules = DB::table('doctor_schedules')
            ->whereNotNull('photo')
            ->where('photo', '!=', '')
            ->orderByDesc('updated_at')
            ->orderByDesc('id')
            ->get(['doctor_id', 'photo']);

        $done = [];
        foreach ($schedules as $schedule) {
            if (isset($done[$schedule->doctor_id])) {
                continue;
            }
            $done[$schedule->doctor_id] = true;

            $newPath = $schedule->photo;
            if (str_starts_with($schedule->photo, 'uploads/schedule/')) {
                $target = 'uploads/doctor/'.basename($schedule->photo);
                if ($disk->exists($schedule->photo) && ! $disk->exists($target)) {
                    $disk->copy($schedule->photo, $target);
                }
                // Only point to the new location when the file is really there.
                $newPath = $disk->exists($target) ? $target : $schedule->photo;
            }

            DB::table('doctors')->where('id', $schedule->doctor_id)->update(['photo' => $newPath]);
        }

        Schema::table('doctor_schedules', function (Blueprint $table) {
            $table->dropColumn('photo');
        });
    }

    public function down(): void
    {
        Schema::table('doctor_schedules', function (Blueprint $table) {
            $table->string('photo')->nullable()->after('education_career');
        });

        DB::table('doctor_schedules')->update([
            'photo' => DB::raw('(SELECT photo FROM doctors WHERE doctors.id = doctor_schedules.doctor_id)'),
        ]);
    }
};
