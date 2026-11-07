<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private const TABLES = [
        'master_kategori' => 'categories',
        'layanan_unggulan' => 'featured_services',
        'layanan_spesialis' => 'specialist_services',
        'layanan_fasilitas' => 'facility_services',
        'master_dokter' => 'doctors',
        'jadwal_dokter' => 'doctor_schedules',
        'paket_kesehatan' => 'health_packages',
        'artikel_kesehatan' => 'health_articles',
        'event_community' => 'community_events',
        'indikator_mutu' => 'quality_indicators',
        'karir' => 'careers',
        'konten_social_media' => 'social_media_contents',
        'sertifikasi_penghargaan' => 'certifications_awards',
    ];

    /** Columns per table, keyed by the OLD table name: old column => new column. */
    private const COLUMNS = [
        'layanan_unggulan' => ['nama_layanan' => 'name', 'deskripsi' => 'description', 'foto' => 'photo'],
        'layanan_spesialis' => ['nama_layanan' => 'name', 'deskripsi' => 'description'],
        'layanan_fasilitas' => [
            'nama_fasilitas' => 'name',
            'deskripsi_overview' => 'overview_description',
            'layanan_fasilitas' => 'services',
            'foto_header' => 'header_photo',
            'foto_lainnya' => 'other_photo',
        ],
        'master_dokter' => ['nama_dokter' => 'name', 'foto' => 'photo'],
        'jadwal_dokter' => [
            'dokter_id' => 'doctor_id',
            'spesialis_id' => 'specialist_id',
            'background_dokter' => 'doctor_background',
            'jadwal_dokter' => 'schedule',
            'edukasi_karir' => 'education_career',
            'foto' => 'photo',
        ],
        'paket_kesehatan' => [
            'kategori_id' => 'category_id',
            'nama_paket' => 'name',
            'berlaku_sampai' => 'valid_until',
            'deskripsi' => 'description',
            'foto' => 'photo',
        ],
        'artikel_kesehatan' => [
            'kategori_id' => 'category_id',
            'judul' => 'title',
            'konten' => 'content',
            'dokter_terkait' => 'related_doctors',
            'foto' => 'photo',
        ],
        'event_community' => [
            'kategori_id' => 'category_id',
            'judul' => 'title',
            'konten' => 'content',
            'foto' => 'photo',
        ],
        'indikator_mutu' => ['judul' => 'title', 'file_pdf' => 'pdf_file', 'foto' => 'photo'],
        'karir' => [
            'divisi' => 'division',
            'posisi' => 'position',
            'link_pendaftaran' => 'application_link',
            'foto' => 'photo',
        ],
        'sertifikasi_penghargaan' => ['judul' => 'title', 'file_pdf' => 'pdf_file', 'foto' => 'photo'],
    ];

    /** Keys stored inside the JSON columns of doctor_schedules. */
    private const SCHEDULE_KEYS = ['hari' => 'day', 'jam_mulai' => 'start_time', 'jam_selesai' => 'end_time'];
    private const EDUCATION_KEYS = ['judul' => 'title', 'tahun_mulai' => 'start_year', 'tahun_selesai' => 'end_year'];

    /** Values stored in categories.flag. */
    private const FLAGS = [
        'ArtikelKesehatan' => 'HealthArticle',
        'PaketKesehatan' => 'HealthPackage',
        'EventCommunity' => 'CommunityEvent',
    ];

    public function up(): void
    {
        foreach (self::COLUMNS as $table => $columns) {
            Schema::table($table, function (Blueprint $blueprint) use ($columns) {
                foreach ($columns as $old => $new) {
                    $blueprint->renameColumn($old, $new);
                }
            });
        }

        foreach (self::TABLES as $old => $new) {
            Schema::rename($old, $new);
        }

        $this->renameJsonKeys('doctor_schedules', 'schedule', self::SCHEDULE_KEYS);
        $this->renameJsonKeys('doctor_schedules', 'education_career', self::EDUCATION_KEYS);
        $this->renameFlags(self::FLAGS);
    }

    public function down(): void
    {
        $this->renameFlags(array_flip(self::FLAGS));
        $this->renameJsonKeys('doctor_schedules', 'education_career', array_flip(self::EDUCATION_KEYS));
        $this->renameJsonKeys('doctor_schedules', 'schedule', array_flip(self::SCHEDULE_KEYS));

        foreach (array_flip(self::TABLES) as $new => $old) {
            Schema::rename($new, $old);
        }

        foreach (self::COLUMNS as $table => $columns) {
            Schema::table($table, function (Blueprint $blueprint) use ($columns) {
                foreach ($columns as $old => $new) {
                    $blueprint->renameColumn($new, $old);
                }
            });
        }
    }

    private function renameJsonKeys(string $table, string $column, array $map): void
    {
        DB::table($table)->orderBy('id')->each(function ($row) use ($table, $column, $map) {
            $items = json_decode($row->{$column} ?? '[]', true);
            if (!is_array($items)) {
                return;
            }

            $converted = array_map(function ($item) use ($map) {
                if (!is_array($item)) {
                    return $item;
                }
                $result = [];
                foreach ($item as $key => $value) {
                    $result[$map[$key] ?? $key] = $value;
                }
                return $result;
            }, $items);

            DB::table($table)->where('id', $row->id)->update([$column => json_encode($converted)]);
        });
    }

    private function renameFlags(array $map): void
    {
        foreach ($map as $old => $new) {
            DB::table('categories')->where('flag', $old)->update(['flag' => $new]);
        }
    }
};
