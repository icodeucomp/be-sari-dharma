<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PaketKesehatan extends Model
{
    use HasFactory;

    protected $table = 'paket_kesehatan';

    protected $fillable = [
        'nama_paket',
        'kategori_id', // ganti dari 'kategori'
        'promo',
        'berlaku_sampai',
        'deskripsi',
        'foto',
    ];

    // Mendefinisikan properti virtual yang tidak disimpan di database
    protected $appends = ['slug'];

    /**
     * Accessor untuk mendapatkan slug dari nama paket.
     *
     * @return string
     */
    public function getSlugAttribute()
    {
        return Str::slug($this->nama_paket);
    }

    /**
     * Mendapatkan slug dari nama layanan.
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug ?? Str::slug($this->nama_paket);
    }

    public static function storeValidationRules()
    {
        return [
            'nama_paket' => 'required|string|max:255',
            'kategori_id' => 'required|exists:master_kategori,id',
            'promo' => 'required|boolean',
            'berlaku_sampai' => 'nullable|date',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|file|mimes:jpg,jpeg,png|max:5120', // Max 5MB
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
                'nama_paket' => 'string',
                'kategori_id' => 'integer (foreign key from master_kategori)',
                'promo' => 'boolean',
                'berlaku_sampai' => 'date',
                'deskripsi' => 'string',
                'foto' => 'string (path to file)',
                'slug' => 'string (URL friendly version of nama_paket)',
            ],
            'endpoints' => [
                'get_all' => [
                    'url' => '/api/paket-kesehatan',
                    'method' => 'GET',
                    'payload' => null,
                    'validations' => null,
                    'query_params' => [
                        'search' => 'string (untuk filter berdasarkan nama_paket)',
                        'kategori_id' => 'integer (untuk filter berdasarkan kategori)',
                        'promo' => 'boolean (0 atau 1, untuk filter berdasarkan status promo)',
                        'berlaku_start' => 'date (YYYY-MM-DD, untuk filter berdasarkan awal masa berlaku)',
                        'berlaku_end' => 'date (YYYY-MM-DD, untuk filter berdasarkan akhir masa berlaku)',
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
                                    'nama_paket' => 'Paket A',
                                    'kategori_id' => 1,
                                    'promo' => true,
                                    'berlaku_sampai' => '2023-12-31',
                                    'deskripsi' => 'Deskripsi Paket A',
                                    'foto' => 'uploads/paket_kesehatan/20231001_1234.jpg',
                                    'created_at' => '2023-10-01T12:34:56.000000Z',
                                    'updated_at' => '2023-10-01T12:34:56.000000Z',
                                ],
                            ],
                            'first_page_url' => 'http://localhost/api/paket-kesehatan?page=1',
                            'from' => 1,
                            'last_page' => 1,
                            'last_page_url' => 'http://localhost/api/paket-kesehatan?page=1',
                            'next_page_url' => null,
                            'path' => 'http://localhost/api/paket-kesehatan',
                            'per_page' => 10,
                            'prev_page_url' => null,
                            'to' => 1,
                            'total' => 1
                        ],
                    ],
                ],
                'create' => [
                    'url' => '/api/paket-kesehatan',
                    'method' => 'POST',
                    'payload' => [
                        'nama_paket' => 'string',
                        'kategori_id' => 'integer (master_kategori id)',
                        'promo' => 'boolean',
                        'berlaku_sampai' => 'date',
                        'deskripsi' => 'string',
                        'foto' => 'file',
                    ],
                    'validations' => self::storeValidationRules(),
                    'response' => [
                        'success' => true,
                        'data' => [
                            'id' => 1,
                            'nama_paket' => 'Paket A',
                            'kategori_id' => 1,
                            'promo' => true,
                            'berlaku_sampai' => '2023-12-31',
                            'deskripsi' => 'Deskripsi Paket A',
                            'foto' => 'uploads/paket_kesehatan/20231001_1234.jpg',
                            'created_at' => '2023-10-01T12:34:56.000000Z',
                            'updated_at' => '2023-10-01T12:34:56.000000Z',
                        ],
                    ],
                ],
                'update' => [
                    'url' => '/api/paket-kesehatan/{id}',
                    'method' => 'PUT',
                    'payload' => [
                        'nama_paket' => 'string',
                        'kategori_id' => 'integer (master_kategori id)',
                        'promo' => 'boolean',
                        'berlaku_sampai' => 'date',
                        'deskripsi' => 'string',
                        'foto' => 'file',
                    ],
                    'validations' => self::updateValidationRules(),
                    'response' => [
                        'success' => true,
                        'data' => [
                            'id' => 1,
                            'nama_paket' => 'Paket A (Updated)',
                            'kategori_id' => 1,
                            'promo' => false,
                            'berlaku_sampai' => '2024-01-31',
                            'deskripsi' => 'Deskripsi Paket A (Updated)',
                            'foto' => 'uploads/paket_kesehatan/20231001_1235.jpg',
                            'created_at' => '2023-10-01T12:34:56.000000Z',
                            'updated_at' => '2023-10-01T12:35:56.000000Z',
                        ],
                    ],
                ],
                'delete' => [
                    'url' => '/api/paket-kesehatan/{id}',
                    'method' => 'DELETE',
                    'payload' => null,
                    'validations' => null,
                    'response' => [
                        'success' => true,
                        'message' => 'Data deleted successfully',
                    ],
                ],
                'show' => [
                    'url' => '/api/paket-kesehatan/{slug}/{id}',
                    'method' => 'GET',
                    'payload' => null,
                    'validations' => null,
                    'response' => [
                        'success' => true,
                        'data' => [
                            'id' => 1,
                            'nama_paket' => 'Paket A',
                            'slug' => 'paket-a',
                            'kategori_id' => 1,
                            'promo' => true,
                            'berlaku_sampai' => '2023-12-31',
                            'deskripsi' => 'Deskripsi Paket A',
                            'foto' => 'uploads/paket_kesehatan/20231001_1234.jpg',
                            'kategori' => [
                                'id' => 1,
                                'name' => 'Kategori A',
                                'page' => 'page_a',
                                'flag' => 'PaketKesehatan'
                            ],
                            'created_at' => '2023-10-01T12:34:56.000000Z',
                            'updated_at' => '2023-10-01T12:34:56.000000Z',
                        ],
                    ],
                ],
            ],
        ];
    }

    // Opsional: Relasi ke MasterKategori
    public function masterKategori()
    {
        return $this->belongsTo(\App\Models\MasterKategori::class, 'kategori_id');
    }
}
