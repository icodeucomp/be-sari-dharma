<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ArtikelKesehatan extends Model
{
    use HasFactory;

    protected $table = 'artikel_kesehatan';

    protected $fillable = [
        'kategori_id',
        'judul',
        'konten',
        'dokter_terkait',
        'foto',
    ];

    protected $casts = [
        'dokter_terkait' => 'array', // Cast JSON field to array
    ];

    // Mendefinisikan properti virtual yang tidak disimpan di database
    protected $appends = ['slug'];

    /**
     * Accessor untuk mendapatkan slug dari judul.
     *
     * @return string
     */
    public function getSlugAttribute()
    {
        return Str::slug($this->judul);
    }

    /**
     * Mendapatkan slug dari nama layanan.
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug ?? Str::slug($this->judul);
    }

    public static function storeValidationRules()
    {
        return [
            'kategori_id' => 'required|exists:master_kategori,id',
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'dokter_terkait' => 'nullable|array',
            'dokter_terkait.*' => 'string|max:255',
            'foto' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
        ];
    }

    public static function updateValidationRules()
    {
        return self::storeValidationRules();
    }

    public function kategori()
    {
        return $this->belongsTo(MasterKategori::class, 'kategori_id');
    }

    public static function getApiDocumentation()
    {
        return [
            'fields' => [
                'kategori_id' => 'integer (foreign key from master_kategori)',
                'judul' => 'string',
                'konten' => 'string',
                'dokter_terkait' => 'array of strings',
                'foto' => 'string (path to file)',
                'slug' => 'string (URL friendly version of judul)',
            ],
            'endpoints' => [
                'get_all' => [
                    'url' => '/api/artikel-kesehatan',
                    'method' => 'GET',
                    'payload' => null,
                    'validations' => null,
                    'query_params' => [
                        'search' => 'string (untuk filter berdasarkan judul)',
                        'slug' => 'string (untuk filter berdasarkan slug artikel)',
                        'kategori_id' => 'string (ID terenkripsi untuk filter berdasarkan kategori)',
                        'dokter_terkait' => 'string|array (ID terenkripsi untuk filter berdasarkan dokter terkait)',
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
                                    'kategori_id' => 1,
                                    'judul' => 'Manfaat Olahraga',
                                    'konten' => 'Olahraga memiliki banyak manfaat...',
                                    'dokter_terkait' => ['Dr. John Doe', 'Dr. Jane Smith'],
                                    'foto' => 'uploads/artikel_kesehatan/20231001_1234.jpg',
                                    'created_at' => '2023-10-01T12:34:56.000000Z',
                                    'updated_at' => '2023-10-01T12:34:56.000000Z',
                                ],
                            ],
                            'first_page_url' => 'http://localhost/api/artikel-kesehatan?page=1',
                            'from' => 1,
                            'last_page' => 1,
                            'last_page_url' => 'http://localhost/api/artikel-kesehatan?page=1',
                            'next_page_url' => null,
                            'path' => 'http://localhost/api/artikel-kesehatan',
                            'per_page' => 10,
                            'prev_page_url' => null,
                            'to' => 1,
                            'total' => 1
                        ]
                    ],
                ],
                'create' => [
                    'url' => '/api/artikel-kesehatan',
                    'method' => 'POST',
                    'payload' => [
                        'kategori_id' => 'integer (master_kategori id)',
                        'judul' => 'string',
                        'konten' => 'string',
                        'dokter_terkait' => ['array of strings'],
                        'foto' => 'file',
                    ],
                    'validations' => self::storeValidationRules(),
                    'response' => [
                        'success' => true,
                        'data' => [
                            'id' => 1,
                            'kategori_id' => 1,
                            'judul' => 'Manfaat Olahraga',
                            'konten' => 'Olahraga memiliki banyak manfaat...',
                            'dokter_terkait' => ['Dr. John Doe', 'Dr. Jane Smith'],
                            'foto' => 'uploads/artikel_kesehatan/20231001_1234.jpg',
                            'created_at' => '2023-10-01T12:34:56.000000Z',
                            'updated_at' => '2023-10-01T12:34:56.000000Z',
                        ],
                    ],
                ],
                'update' => [
                    'url' => '/api/artikel-kesehatan/{id}',
                    'method' => 'PUT',
                    'payload' => [
                        'kategori_id' => 'integer (master_kategori id)',
                        'judul' => 'string',
                        'konten' => 'string',
                        'dokter_terkait' => ['array of strings'],
                        'foto' => 'file',
                    ],
                    'validations' => self::updateValidationRules(),
                    'response' => [
                        'success' => true,
                        'data' => [
                            'id' => 1,
                            'kategori_id' => 1,
                            'judul' => 'Manfaat Olahraga (Updated)',
                            'konten' => 'Olahraga memiliki banyak manfaat...',
                            'dokter_terkait' => ['Dr. John Doe', 'Dr. Jane Smith'],
                            'foto' => 'uploads/artikel_kesehatan/20231001_1235.jpg',
                            'created_at' => '2023-10-01T12:34:56.000000Z',
                            'updated_at' => '2023-10-01T12:35:56.000000Z',
                        ],
                    ],
                ],
                'delete' => [
                    'url' => '/api/artikel-kesehatan/{id}',
                    'method' => 'DELETE',
                    'payload' => null,
                    'validations' => null,
                    'response' => [
                        'success' => true,
                        'message' => 'Data deleted successfully',
                    ],
                ],
                'show' => [
                    'url' => '/api/artikel-kesehatan/{slug}/{id}',
                    'method' => 'GET',
                    'payload' => null,
                    'validations' => null,
                    'response' => [
                        'success' => true,
                        'data' => [
                            'id' => 1,
                            'kategori_id' => 1,
                            'judul' => 'Manfaat Olahraga',
                            'slug' => 'manfaat-olahraga',
                            'konten' => 'Olahraga memiliki banyak manfaat...',
                            'dokter_terkait' => ['Dr. John Doe', 'Dr. Jane Smith'],
                            'foto' => 'uploads/artikel_kesehatan/20231001_1234.jpg',
                            'kategori' => [
                                'id' => 1,
                                'name' => 'Kategori A',
                                'page' => 'page_a',
                                'flag' => 'ArtikelKesehatan'
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
