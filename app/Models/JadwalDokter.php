<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class JadwalDokter extends Model
{
    use HasFactory;

    protected $table = 'jadwal_dokter';

    protected $fillable = [
        'dokter_id',
        'spesialis_id',
        'background_dokter',
        'jadwal_dokter',
        'edukasi_karir',
        'foto',
    ];

    protected $casts = [
        'jadwal_dokter' => 'array',
        'edukasi_karir' => 'array',
    ];

    /**
     * Relasi ke dokter
     */
    public function dokter()
    {
        return $this->belongsTo(MasterDokter::class, 'dokter_id');
    }

    /**
     * Relasi ke spesialis
     */
    public function spesialis()
    {
        return $this->belongsTo(LayananSpesialis::class, 'spesialis_id');
    }

    public static function storeValidationRules()
    {
        return [
            'dokter_id' => 'required', // Hilangkan validasi exists
            'spesialis_id' => 'required', // Hilangkan validasi exists
            'background_dokter' => 'nullable|string',
            'jadwal_dokter' => 'required', // Ubah dari array menjadi lebih fleksibel
            'edukasi_karir' => 'required', // Ubah dari array menjadi lebih fleksibel
            'foto' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
        ];
    }

    // Custom accessor untuk memastikan jadwal_dokter selalu array
    public function getJadwalDokterAttribute($value)
    {
        if (is_string($value)) {
            $decoded = json_decode($value, true);
            return is_array($decoded) ? $decoded : [];
        }
        return $value ?? [];
    }

    // Custom accessor untuk memastikan edukasi_karir selalu array
    public function getEdukasiKarirAttribute($value)
    {
        if (is_string($value)) {
            $decoded = json_decode($value, true);
            return is_array($decoded) ? $decoded : [];
        }
        return $value ?? [];
    }

    // Custom mutator untuk menangani jadwal_dokter sebagai string atau array
    public function setJadwalDokterAttribute($value)
    {
        if (is_string($value)) {
            $decoded = json_decode($value, true);
            $this->attributes['jadwal_dokter'] = json_encode(is_array($decoded) ? $decoded : []);
        } else {
            $this->attributes['jadwal_dokter'] = json_encode($value ?? []);
        }
    }

    // Custom mutator untuk menangani edukasi_karir sebagai string atau array
    public function setEdukasiKarirAttribute($value)
    {
        if (is_string($value)) {
            $decoded = json_decode($value, true);
            $this->attributes['edukasi_karir'] = json_encode(is_array($decoded) ? $decoded : []);
        } else {
            $this->attributes['edukasi_karir'] = json_encode($value ?? []);
        }
    }

    public static function updateValidationRules()
    {
        return self::storeValidationRules();
    }

    /**
     * Validasi manual untuk memastikan dokter_id dan spesialis_id ada di database
     * 
     * @param array $data
     * @return array
     */
    public static function validateRelations($data)
    {
        $errors = [];

        if (isset($data['dokter_id'])) {
            $dokterExists = MasterDokter::find($data['dokter_id']);
            if (!$dokterExists) {
                $errors['dokter_id'] = ['Dokter tidak ditemukan.'];
            }
        }

        if (isset($data['spesialis_id'])) {
            $spesialisExists = LayananSpesialis::find($data['spesialis_id']);
            if (!$spesialisExists) {
                $errors['spesialis_id'] = ['Spesialis tidak ditemukan.'];
            }
        }

        return $errors;
    }

    public static function getApiDocumentation()
    {
        return [
            'fields' => [
                'dokter_id' => 'integer (foreign key to master_dokter)',
                'spesialis_id' => 'integer (foreign key to layanan_spesialis)',
                'background_dokter' => 'string',
                'jadwal_dokter' => 'array of objects (hari, jam_mulai, jam_selesai)',
                'edukasi_karir' => 'array of objects (judul, tahun_mulai, tahun_selesai)',
                'foto' => 'string (path to file)',
            ],
            'endpoints' => [
                'get_all' => [
                    'url' => '/api/jadwal-dokter',
                    'method' => 'GET',
                    'payload' => null,
                    'validations' => null,
                    'query_params' => [
                        'search' => 'string (untuk filter berdasarkan nama_dokter via relasi)',
                        'dokter_id' => 'string (ID terenkripsi untuk filter berdasarkan dokter)',
                        'spesialis_id' => 'string (ID terenkripsi untuk filter berdasarkan spesialis)',
                        'hari' => 'string (untuk filter berdasarkan hari pada jadwal_dokter, contoh: Senin)',
                        'per_page' => 'integer (default: 10)',
                        'page' => 'integer (default: 1)',
                    ],
                    'response' => [
                        'success' => true,
                        'data' => [
                            'current_page' => 1,
                            'data' => [
                                [
                                    'id' => 1,
                                    'dokter_id' => 1,
                                    'spesialis_id' => 1,
                                    'background_dokter' => 'Background Dokter A',
                                    'jadwal_dokter' => [
                                        ['hari' => 'Senin', 'jam_mulai' => '08:00', 'jam_selesai' => '12:00'],
                                        ['hari' => 'Rabu', 'jam_mulai' => '13:00', 'jam_selesai' => '17:00'],
                                    ],
                                    'edukasi_karir' => [
                                        ['judul' => 'Pendidikan A', 'tahun_mulai' => 2010, 'tahun_selesai' => 2014],
                                        ['judul' => 'Karir B', 'tahun_mulai' => 2015, 'tahun_selesai' => null],
                                    ],
                                    'foto' => 'uploads/jadwal_dokter/20231001_1234.jpg',
                                    'created_at' => '2023-10-01T12:34:56.000000Z',
                                    'updated_at' => '2023-10-01T12:34:56.000000Z',
                                ],
                            ],
                            'first_page_url' => 'http://localhost/api/jadwal-dokter?page=1',
                            'from' => 1,
                            'last_page' => 1,
                            'last_page_url' => 'http://localhost/api/jadwal-dokter?page=1',
                            'next_page_url' => null,
                            'path' => 'http://localhost/api/jadwal-dokter',
                            'per_page' => 10,
                            'prev_page_url' => null,
                            'to' => 1,
                            'total' => 1
                        ],
                    ],
                ],
                'create' => [
                    'url' => '/api/jadwal-dokter',
                    'method' => 'POST',
                    'payload' => [
                        'dokter_id' => 'integer',
                        'spesialis_id' => 'integer',
                        'background_dokter' => 'string',
                        'jadwal_dokter' => [
                            ['hari' => 'string', 'jam_mulai' => 'string', 'jam_selesai' => 'string'],
                        ],
                        'edukasi_karir' => [
                            ['judul' => 'string', 'tahun_mulai' => 'integer', 'tahun_selesai' => 'integer'],
                        ],
                        'foto' => 'file',
                    ],
                    'validations' => self::storeValidationRules(),
                    'response' => [
                        'success' => true,
                        'data' => [
                            'id' => 1,
                            'dokter_id' => 1,
                            'spesialis_id' => 1,
                            'background_dokter' => 'Background Dokter A',
                            'jadwal_dokter' => [
                                ['hari' => 'Senin', 'jam_mulai' => '08:00', 'jam_selesai' => '12:00'],
                            ],
                            'edukasi_karir' => [
                                ['judul' => 'Pendidikan A', 'tahun_mulai' => 2010, 'tahun_selesai' => 2014],
                            ],
                            'foto' => 'uploads/jadwal_dokter/20231001_1234.jpg',
                            'created_at' => '2023-10-01T12:34:56.000000Z',
                            'updated_at' => '2023-10-01T12:34:56.000000Z',
                        ],
                    ],
                ],
                'update' => [
                    'url' => '/api/jadwal-dokter/{id}',
                    'method' => 'PUT',
                    'payload' => [
                        'dokter_id' => 'integer',
                        'spesialis_id' => 'integer',
                        'background_dokter' => 'string',
                        'jadwal_dokter' => [
                            ['hari' => 'string', 'jam_mulai' => 'string', 'jam_selesai' => 'string'],
                        ],
                        'edukasi_karir' => [
                            ['judul' => 'string', 'tahun_mulai' => 'integer', 'tahun_selesai' => 'integer'],
                        ],
                        'foto' => 'file',
                    ],
                    'validations' => self::updateValidationRules(),
                    'response' => [
                        'success' => true,
                        'data' => [
                            'id' => 1,
                            'dokter_id' => 1,
                            'spesialis_id' => 1,
                            'background_dokter' => 'Background Dokter B',
                            'jadwal_dokter' => [
                                ['hari' => 'Selasa', 'jam_mulai' => '09:00', 'jam_selesai' => '13:00'],
                            ],
                            'edukasi_karir' => [
                                ['judul' => 'Pendidikan B', 'tahun_mulai' => 2015, 'tahun_selesai' => 2019],
                            ],
                            'foto' => 'uploads/jadwal_dokter/20231001_1235.jpg',
                            'created_at' => '2023-10-01T12:34:56.000000Z',
                            'updated_at' => '2023-10-01T12:35:56.000000Z',
                        ],
                    ],
                ],
                'delete' => [
                    'url' => '/api/jadwal-dokter/{id}',
                    'method' => 'DELETE',
                    'payload' => null,
                    'validations' => null,
                    'response' => [
                        'success' => true,
                        'message' => 'Data deleted successfully',
                    ],
                ],
                'show' => [
                    'url' => '/api/jadwal-dokter/{id}',
                    'method' => 'GET',
                    'payload' => null,
                    'validations' => null,
                    'response' => [
                        'success' => true,
                        'data' => [
                            'id' => 1,
                            'dokter_id' => 1,
                            'spesialis_id' => 1,
                            'background_dokter' => 'Background Dokter A',
                            'jadwal_dokter' => [
                                ['hari' => 'Senin', 'jam_mulai' => '08:00', 'jam_selesai' => '12:00'],
                                ['hari' => 'Rabu', 'jam_mulai' => '13:00', 'jam_selesai' => '17:00'],
                            ],
                            'edukasi_karir' => [
                                ['judul' => 'Pendidikan A', 'tahun_mulai' => 2010, 'tahun_selesai' => 2014],
                                ['judul' => 'Karir B', 'tahun_mulai' => 2015, 'tahun_selesai' => null],
                            ],
                            'foto' => 'uploads/jadwal_dokter/20231001_1234.jpg',
                            'dokter' => [
                                'id' => 1,
                                'nama_dokter' => 'Dr. John Doe',
                                'foto' => 'uploads/master_dokter/20231001_1234.jpg',
                            ],
                            'spesialis' => [
                                'id' => 1,
                                'nama_layanan' => 'Spesialis A',
                                'deskripsi' => 'Deskripsi Spesialis A',
                                'icon' => 'mdi mdi-account',
                            ],
                            'created_at' => '2023-10-01T12:34:56.000000Z',
                            'updated_at' => '2023-10-01T12:34:56.000000Z',
                        ],
                    ],
                ],
            ],
        ];
    }
}
