<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

/**
 * Also maps the old career category flag to CareerClinic.
 *
 * Old rows store file paths under Indonesian folder names (uploads/jadwal_dokter/...).
 * The app now stores new uploads under English folders, so rewrite the old prefixes.
 * Only values that still start with the old prefix are changed, so running it twice is harmless.
 * The files themselves are moved with deploy/bin/import-legacy-uploads.sh.
 */
return new class extends Migration
{
    /** table => [column => [old prefix, new prefix]] */
    private const PATHS = [
        'featured_services' => ['photo' => ['uploads/layanan_unggulan/', 'uploads/featured_service/']],
        'doctors' => ['photo' => ['uploads/master_dokter/', 'uploads/doctor/']],
        'doctor_schedules' => ['photo' => ['uploads/jadwal_dokter/', 'uploads/schedule/']],
        'facility_services' => [
            'header_photo' => ['uploads/layanan_fasilitas/', 'uploads/services/'],
            'other_photo' => ['uploads/layanan_fasilitas/', 'uploads/services/'],
        ],
        'health_packages' => ['photo' => ['uploads/paket_kesehatan/', 'uploads/health_package/']],
        'health_articles' => ['photo' => ['uploads/artikel_kesehatan/', 'uploads/health_article/']],
        'community_events' => ['photo' => ['uploads/event_community/', 'uploads/community_event/']],
        'careers' => ['photo' => ['uploads/karir/', 'uploads/career/']],
        'certifications_awards' => [
            'pdf_file' => ['uploads/sertifikasi_penghargaan/', 'uploads/certification_award/'],
            'photo' => ['uploads/sertifikasi_penghargaan/foto/', 'uploads/certification_award/photo/'],
        ],
        'quality_indicators' => [
            'pdf_file' => ['uploads/indikator_mutu/', 'uploads/quality_indicator/'],
            'photo' => ['uploads/indikator_mutu/foto/', 'uploads/quality_indicator/photo/'],
        ],
    ];

    public function up(): void
    {
        $this->rewrite(fn (array $prefixes) => $prefixes);

        // The earlier rename missed this category flag; the dashboard now uses CareerClinic.
        DB::table('categories')->where('flag', 'KarirKlinik')->update(['flag' => 'CareerClinic']);
    }

    public function down(): void
    {
        DB::table('categories')->where('flag', 'CareerClinic')->update(['flag' => 'KarirKlinik']);

        $this->rewrite(fn (array $prefixes) => array_reverse($prefixes));
    }

    private function rewrite(callable $direction): void
    {
        foreach (self::PATHS as $table => $columns) {
            foreach ($columns as $column => $prefixes) {
                [$from, $to] = $direction($prefixes);

                DB::table($table)
                    ->whereRaw("LEFT(`{$column}`, ?) = ?", [strlen($from), $from])
                    ->update([$column => DB::raw('CONCAT('.DB::getPdo()->quote($to).', SUBSTRING(`'.$column.'`, '.(strlen($from) + 1).'))')]);
            }
        }
    }
};
