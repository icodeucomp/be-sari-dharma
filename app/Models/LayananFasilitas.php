<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LayananFasilitas extends Model
{
    use HasFactory;

    protected $table = 'layanan_fasilitas';

    protected $fillable = [
        'nama_fasilitas',
        'deskripsi_overview',
        'layanan_fasilitas',
        'foto_header',
        'foto_lainnya',
    ];

    public static function storeValidationRules()
    {
        return [
            'nama_fasilitas' => 'required|string|max:255',
            'deskripsi_overview' => 'nullable|string',
            'layanan_fasilitas' => 'nullable|string',
            'foto_header' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
            'foto_lainnya' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
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
                'nama_fasilitas' => 'string',
                'deskripsi_overview' => 'string',
                'layanan_fasilitas' => 'string',
                'foto_header' => 'string (path to file)',
                'foto_lainnya' => 'string (path to file)',
            ],
            'endpoints' => [
                'get_all' => [
                    'url' => '/api/layanan-fasilitas',
                    'method' => 'GET',
                    'payload' => null,
                    'validations' => null,
                    'query_params' => [
                        'search' => 'string (for filtering by nama_fasilitas)',
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
                                    'nama_fasilitas' => 'Fasilitas A',
                                    'deskripsi_overview' => 'Deskripsi Fasilitas A',
                                    'layanan_fasilitas' => 'Layanan Fasilitas A',
                                    'foto_header' => 'uploads/layanan_fasilitas/20231001_1234.jpg',
                                    'foto_lainnya' => 'uploads/layanan_fasilitas/20231001_1235.jpg',
                                    'created_at' => '2023-10-01T12:34:56.000000Z',
                                    'updated_at' => '2023-10-01T12:34:56.000000Z',
                                ],
                            ],
                            'first_page_url' => 'http://localhost/api/layanan-fasilitas?page=1',
                            'from' => 1,
                            'last_page' => 1,
                            'last_page_url' => 'http://localhost/api/layanan-fasilitas?page=1',
                            'next_page_url' => null,
                            'path' => 'http://localhost/api/layanan-fasilitas',
                            'per_page' => 10,
                            'prev_page_url' => null,
                            'to' => 1,
                            'total' => 1
                        ],
                    ],
                ],
                'create' => [
                    'url' => '/api/layanan-fasilitas',
                    'method' => 'POST',
                    'payload' => [
                        'nama_fasilitas' => 'string',
                        'deskripsi_overview' => 'string',
                        'layanan_fasilitas' => 'string',
                        'foto_header' => 'file',
                        'foto_lainnya' => 'file',
                    ],
                    'validations' => self::storeValidationRules(),
                    'response' => [
                        'success' => true,
                        'data' => [
                            'id' => 1,
                            'nama_fasilitas' => 'Fasilitas A',
                            'deskripsi_overview' => 'Deskripsi Fasilitas A',
                            'layanan_fasilitas' => 'Layanan Fasilitas A',
                            'foto_header' => 'uploads/layanan_fasilitas/20231001_1234.jpg',
                            'foto_lainnya' => 'uploads/layanan_fasilitas/20231001_1235.jpg',
                            'created_at' => '2023-10-01T12:34:56.000000Z',
                            'updated_at' => '2023-10-01T12:34:56.000000Z',
                        ],
                    ],
                ],
                'update' => [
                    'url' => '/api/layanan-fasilitas/{id}',
                    'method' => 'PUT',
                    'payload' => [
                        'nama_fasilitas' => 'string',
                        'deskripsi_overview' => 'string',
                        'layanan_fasilitas' => 'string',
                        'foto_header' => 'file',
                        'foto_lainnya' => 'file',
                    ],
                    'validations' => self::updateValidationRules(),
                    'response' => [
                        'success' => true,
                        'data' => [
                            'id' => 1,
                            'nama_fasilitas' => 'Fasilitas A (Updated)',
                            'deskripsi_overview' => 'Deskripsi Fasilitas A (Updated)',
                            'layanan_fasilitas' => 'Layanan Fasilitas A (Updated)',
                            'foto_header' => 'uploads/layanan_fasilitas/20231001_1236.jpg',
                            'foto_lainnya' => 'uploads/layanan_fasilitas/20231001_1237.jpg',
                            'created_at' => '2023-10-01T12:34:56.000000Z',
                            'updated_at' => '2023-10-01T12:35:56.000000Z',
                        ],
                    ],
                ],
                'delete' => [
                    'url' => '/api/layanan-fasilitas/{id}',
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
