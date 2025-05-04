<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class LayananSpesialis extends Model
{
    use HasFactory;

    protected $table = 'layanan_spesialis';

    protected $fillable = [
        'nama_layanan',
        'deskripsi',
        'icon',
    ];

    // Mendefinisikan properti virtual yang tidak disimpan di database
    protected $appends = ['slug'];

    /**
     * Accessor untuk mendapatkan slug dari nama layanan.
     *
     * @return string
     */
    public function getSlugAttribute()
    {
        return Str::slug($this->nama_layanan);
    }

    /**
     * Relasi ke jadwal dokter
     */
    public function jadwalDokter()
    {
        return $this->hasMany(JadwalDokter::class, 'spesialis_id');
    }

    /**
     * Relasi ke dokter melalui jadwal dokter
     */
    public function dokter()
    {
        return $this->belongsToMany(MasterDokter::class, 'jadwal_dokter', 'spesialis_id', 'dokter_id')
            ->withTimestamps();
    }

    public static function storeValidationRules()
    {
        return [
            'nama_layanan' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'icon' => 'required|string|max:255',
            'dokter_ids' => 'nullable|array',
            'dokter_ids.*' => 'required|string', // Ubah menjadi string karena ID terenkripsi
        ];
    }

    public static function updateValidationRules()
    {
        return self::storeValidationRules();
    }

    public static function getApiDocumentation()
    {
        return [
            'fields' => [
                'nama_layanan' => 'string',
                'deskripsi' => 'string',
                'icon' => 'string',
                'dokter_ids' => 'array of master_dokter IDs',
                'slug' => 'string (URL friendly version of nama_layanan)',
            ],
            'endpoints' => [
                'get_all' => [
                    'url' => '/api/layanan-spesialis',
                    'method' => 'GET',
                    'payload' => null,
                    'validations' => null,
                    'query_params' => [
                        'search' => 'string (for filtering by nama_layanan)',
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
                                    'nama_layanan' => 'Spesialis A',
                                    'slug' => 'spesialis-a',
                                    'deskripsi' => 'Deskripsi Spesialis A',
                                    'icon' => 'mdi mdi-account',
                                    'created_at' => '2023-10-01T12:34:56.000000Z',
                                    'updated_at' => '2023-10-01T12:34:56.000000Z',
                                ],
                            ],
                            'first_page_url' => 'http://localhost/api/layanan-spesialis?page=1',
                            'from' => 1,
                            'last_page' => 1,
                            'last_page_url' => 'http://localhost/api/layanan-spesialis?page=1',
                            'next_page_url' => null,
                            'path' => 'http://localhost/api/layanan-spesialis',
                            'per_page' => 10,
                            'prev_page_url' => null,
                            'to' => 1,
                            'total' => 1
                        ],
                    ],
                ],
                'create' => [
                    'url' => '/api/layanan-spesialis',
                    'method' => 'POST',
                    'payload' => [
                        'nama_layanan' => 'string',
                        'deskripsi' => 'string',
                        'icon' => 'string',
                        'dokter_ids' => [1, 2, 3], // Array of master_dokter IDs
                    ],
                    'validations' => self::storeValidationRules(),
                    'response' => [
                        'success' => true,
                        'data' => [
                            'id' => 1,
                            'nama_layanan' => 'Spesialis A',
                            'deskripsi' => 'Deskripsi Spesialis A',
                            'icon' => 'mdi mdi-account',
                            'dokter' => [
                                [
                                    'id' => 1,
                                    'nama_dokter' => 'Dr. John Doe',
                                    'background_dokter' => 'Latar belakang dokter...',
                                    'foto' => 'uploads/master_dokter/20231001_1234.jpg',
                                    'pivot' => [
                                        'spesialis_id' => 1,
                                        'dokter_id' => 1
                                    ]
                                ]
                            ],
                            'created_at' => '2023-10-01T12:34:56.000000Z',
                            'updated_at' => '2023-10-01T12:34:56.000000Z',
                        ],
                    ],
                ],
                'update' => [
                    'url' => '/api/layanan-spesialis/{id}',
                    'method' => 'PUT',
                    'payload' => [
                        'nama_layanan' => 'string',
                        'deskripsi' => 'string',
                        'icon' => 'string',
                        'dokter_ids' => [1, 2, 3], // Array of master_dokter IDs
                    ],
                    'validations' => self::updateValidationRules(),
                    'response' => [
                        'success' => true,
                        'data' => [
                            'id' => 1,
                            'nama_layanan' => 'Spesialis A (Updated)',
                            'deskripsi' => 'Deskripsi Spesialis A (Updated)',
                            'icon' => 'mdi mdi-account',
                            'dokter' => [
                                [
                                    'id' => 2,
                                    'nama_dokter' => 'Dr. Jane Smith',
                                    'background_dokter' => 'Latar belakang dokter...',
                                    'foto' => 'uploads/master_dokter/20231001_1235.jpg',
                                    'pivot' => [
                                        'spesialis_id' => 1,
                                        'dokter_id' => 2
                                    ]
                                ]
                            ],
                            'created_at' => '2023-10-01T12:34:56.000000Z',
                            'updated_at' => '2023-10-01T12:35:56.000000Z',
                        ],
                    ],
                ],
                'delete' => [
                    'url' => '/api/layanan-spesialis/{id}',
                    'method' => 'DELETE',
                    'payload' => null,
                    'validations' => null,
                    'response' => [
                        'success' => true,
                        'message' => 'Data deleted successfully',
                    ],
                ],
                'show' => [
                    'url' => '/api/layanan-spesialis/{slug}/{id}',
                    'method' => 'GET',
                    'payload' => null,
                    'validations' => null,
                    'response' => [
                        'success' => true,
                        'data' => [
                            'id' => 1,
                            'nama_layanan' => 'Spesialis A',
                            'slug' => 'spesialis-a',
                            'deskripsi' => 'Deskripsi Spesialis A',
                            'icon' => 'mdi mdi-account',
                            'dokter' => [
                                [
                                    'id' => 1,
                                    'nama_dokter' => 'Dr. John Doe',
                                    'foto' => 'uploads/master_dokter/20231001_1234.jpg',
                                    'pivot' => [
                                        'spesialis_id' => 1,
                                        'dokter_id' => 1
                                    ]
                                ]
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
