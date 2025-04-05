<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LayananSpesialis extends Model
{
    use HasFactory;

    protected $table = 'layanan_spesialis';

    protected $fillable = [
        'nama_layanan',
        'deskripsi',
        'icon',
        'dokter',
    ];

    protected $casts = [
        'dokter' => 'array', // Cast JSON field to array
    ];

    public static function storeValidationRules()
    {
        return [
            'nama_layanan' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'icon' => 'required|string|max:255',
            'dokter' => 'required|array',
            'dokter.*' => 'string|max:255',
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
                'dokter' => 'array of strings',
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
                        'page' => 'integer (default: 1)', // added query param for page
                    ],
                    'response' => [
                        'success' => true,
                        'data' => [
                            'current_page' => 1,
                            'data' => [
                                [
                                    'id' => 1,
                                    'nama_layanan' => 'Spesialis A',
                                    'deskripsi' => 'Deskripsi Spesialis A',
                                    'icon' => 'mdi mdi-account',
                                    'dokter' => ['Dokter A', 'Dokter B'],
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
                        'dokter' => ['array of strings'],
                    ],
                    'validations' => self::storeValidationRules(),
                    'response' => [
                        'success' => true,
                        'data' => [
                            'id' => 1,
                            'nama_layanan' => 'Spesialis A',
                            'deskripsi' => 'Deskripsi Spesialis A',
                            'icon' => 'mdi mdi-account',
                            'dokter' => ['Dokter A', 'Dokter B'],
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
                        'dokter' => ['array of strings'],
                    ],
                    'validations' => self::updateValidationRules(),
                    'response' => [
                        'success' => true,
                        'data' => [
                            'id' => 1,
                            'nama_layanan' => 'Spesialis A (Updated)',
                            'deskripsi' => 'Deskripsi Spesialis A (Updated)',
                            'icon' => 'mdi mdi-account',
                            'dokter' => ['Dokter C', 'Dokter D'],
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
            ],
        ];
    }
}
