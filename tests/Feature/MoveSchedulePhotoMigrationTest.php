<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class MoveSchedulePhotoMigrationTest extends TestCase
{
    // This test changes the schema, so it runs on its own fresh database instead of inside a transaction.
    use DatabaseMigrations;

    private function specialist(string $name): int
    {
        return DB::table('specialist_services')->insertGetId(['name' => $name, 'icon' => 'mdi', 'created_at' => now(), 'updated_at' => now()]);
    }

    private function doctor(string $name, ?string $photo): int
    {
        return DB::table('doctors')->insertGetId(['name' => $name, 'photo' => $photo, 'created_at' => now(), 'updated_at' => now()]);
    }

    private function schedule(int $doctor, ?string $photo): void
    {
        DB::table('doctor_schedules')->insert([
            'doctor_id' => $doctor,
            'specialist_id' => $this->specialist('Specialist '.$doctor),
            'schedule' => '[]',
            'education_career' => '[]',
            'photo' => $photo,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function test_schedule_photos_move_to_the_doctor_and_the_column_is_dropped(): void
    {
        Storage::fake('public');
        $disk = Storage::disk('public');

        // Go back to the old schema, where schedules carried their own photo.
        Artisan::call('migrate:rollback', ['--step' => 1, '--force' => true]);
        $this->assertTrue(Schema::hasColumn('doctor_schedules', 'photo'));

        $withSchedulePhoto = $this->doctor('A', 'uploads/doctor/old-placeholder.png');
        $withOwnPhoto = $this->doctor('B', 'uploads/doctor/b.jpg');
        $withMissingFile = $this->doctor('C', null);

        $disk->put('uploads/schedule/a-schedule.jpg', 'a');
        $disk->put('uploads/doctor/b.jpg', 'b');

        $this->schedule($withSchedulePhoto, 'uploads/schedule/a-schedule.jpg');
        $this->schedule($withMissingFile, 'uploads/schedule/gone.jpg');
        // Doctor B's schedule has no photo, so B keeps the photo they already have.
        $this->schedule($withOwnPhoto, null);

        Artisan::call('migrate', ['--force' => true]);

        $this->assertFalse(Schema::hasColumn('doctor_schedules', 'photo'));

        // The schedule photo became the doctor's photo; the file was copied and the original stays.
        $this->assertSame('uploads/doctor/a-schedule.jpg', DB::table('doctors')->where('id', $withSchedulePhoto)->value('photo'));
        $disk->assertExists('uploads/doctor/a-schedule.jpg');
        $disk->assertExists('uploads/schedule/a-schedule.jpg');

        // No schedule photo: the doctor's own photo is untouched.
        $this->assertSame('uploads/doctor/b.jpg', DB::table('doctors')->where('id', $withOwnPhoto)->value('photo'));

        // A schedule photo whose file is missing keeps its path, so nothing is lost silently.
        $this->assertSame('uploads/schedule/gone.jpg', DB::table('doctors')->where('id', $withMissingFile)->value('photo'));

        // It can be undone: each schedule gets its doctor's photo back.
        Artisan::call('migrate:rollback', ['--step' => 1, '--force' => true]);
        $this->assertTrue(Schema::hasColumn('doctor_schedules', 'photo'));
        $this->assertSame('uploads/doctor/a-schedule.jpg', DB::table('doctor_schedules')->where('doctor_id', $withSchedulePhoto)->value('photo'));
    }
}
