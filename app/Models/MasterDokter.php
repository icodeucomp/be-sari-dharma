<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class MasterDokter extends Model
{
    use HasFactory;

    protected $table = 'master_dokter';

    protected $fillable = [
        'nama_dokter',
        'foto',
    ];

    // Mendefinisikan properti virtual yang tidak disimpan di database
    protected $appends = ['slug'];

    /**
     * Accessor untuk mendapatkan slug dari nama dokter.
     *
     * @return string
     */
    public function getSlugAttribute()
    {
        return Str::slug($this->nama_dokter);
    }

    /**
     * Relasi ke spesialis melalui tabel pivot
     */
    public function spesialis()
    {
        return $this->belongsToMany(LayananSpesialis::class, 'jadwal_dokter', 'dokter_id', 'spesialis_id')
            ->withTimestamps();
    }

    /**
     * Relasi ke jadwal dokter
     */
    public function jadwalDokter()
    {
        return $this->hasMany(JadwalDokter::class, 'dokter_id');
    }

    public static function storeValidationRules()
    {
        return [
            'nama_dokter' => 'required|string|max:255',
            'foto' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
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
                'nama_dokter' => 'string',
                'foto' => 'string (path to file)',
            ],
            'endpoints' => [
                'get_all' => [
                    'url' => '/api/master-dokter',
                    'method' => 'GET',
                    'payload' => null,
                    'validations' => null,
                    'query_params' => [
                        'search' => 'string (for filtering by nama_dokter)',
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
                                    'nama_dokter' => 'Dr. John Doe',
                                    'foto' => 'uploads/master_dokter/20231001_1234.jpg',
                                    'created_at' => '2023-10-01T12:34:56.000000Z',
                                    'updated_at' => '2023-10-01T12:34:56.000000Z',
                                ],
                            ],
                            'first_page_url' => 'http://localhost/api/master-dokter?page=1',
                            'from' => 1,
                            'last_page' => 1,
                            'last_page_url' => 'http://localhost/api/master-dokter?page=1',
                            'next_page_url' => null,
                            'path' => 'http://localhost/api/master-dokter',
                            'per_page' => 10,
                            'prev_page_url' => null,
                            'to' => 1,
                            'total' => 1
                        ],
                    ],
                ],
                'create' => [
                    'url' => '/api/master-dokter',
                    'method' => 'POST',
                    'payload' => [
                        'nama_dokter' => 'string',
                        'foto' => 'file',
                    ],
                    'validations' => self::storeValidationRules(),
                    'response' => [
                        'success' => true,
                        'data' => [
                            'id' => 1,
                            'nama_dokter' => 'Dr. John Doe',
                            'foto' => 'uploads/master_dokter/20231001_1234.jpg',
                            'created_at' => '2023-10-01T12:34:56.000000Z',
                            'updated_at' => '2023-10-01T12:34:56.000000Z',
                        ],
                    ],
                ],
                'update' => [
                    'url' => '/api/master-dokter/{id}',
                    'method' => 'PUT',
                    'payload' => [
                        'nama_dokter' => 'string',
                        'foto' => 'file',
                    ],
                    'validations' => self::updateValidationRules(),
                    'response' => [
                        'success' => true,
                        'data' => [
                            'id' => 1,
                            'nama_dokter' => 'Dr. John Doe (Updated)',
                            'foto' => 'uploads/master_dokter/20231001_1235.jpg',
                            'created_at' => '2023-10-01T12:34:56.000000Z',
                            'updated_at' => '2023-10-01T12:35:56.000000Z',
                        ],
                    ],
                ],
                'delete' => [
                    'url' => '/api/master-dokter/{id}',
                    'method' => 'DELETE',
                    'payload' => null,
                    'validations' => null,
                    'response' => [
                        'success' => true,
                        'message' => 'Data deleted successfully',
                    ],
                ],
                'show' => [
                    'url' => '/api/master-dokter/{id}',
                    'method' => 'GET',
                    'payload' => null,
                    'validations' => null,
                    'response' => [
                        'success' => true,
                        'data' => [
                            'id' => 1,
                            'nama_dokter' => 'Dr. John Doe',
                            'foto' => 'uploads/master_dokter/20231001_1234.jpg',
                            'created_at' => '2023-10-01T12:34:56.000000Z',
                            'updated_at' => '2023-10-01T12:34:56.000000Z',
                        ],
                    ],
                ],
            ],
        ];
    }
}
