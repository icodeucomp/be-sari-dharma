<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LayananUnggulan extends Model
{
    use HasFactory;

    protected $table = 'layanan_unggulan';

    protected $fillable = [
        'nama_layanan',
        'deskripsi',
        'foto',
    ];

    static function storeValidationRules()
    {
        return [
            'nama_layanan' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
        ];
    }
    static function updateValidationRules()
    {
        return [
            'nama_layanan' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
        ];
    }

    public static function getApiDocumentation()
    {
        return [
            'fields' => [
                'nama_layanan' => 'string',
                'deskripsi' => 'string',
                'foto' => 'string (path to file)',
            ],
            'endpoints' => [
                'get_all' => [
                    'url' => '/api/layanan-unggulan',
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
                                    'nama_layanan' => 'Layanan A',
                                    'deskripsi' => 'Deskripsi Layanan A',
                                    'foto' => 'uploads/layanan_unggulan/20231001_1234.jpg',
                                    'created_at' => '2023-10-01T12:34:56.000000Z',
                                    'updated_at' => '2023-10-01T12:34:56.000000Z',
                                ],
                            ],
                            'first_page_url' => 'http://localhost/api/layanan-unggulan?page=1',
                            'from' => 1,
                            'last_page' => 1,
                            'last_page_url' => 'http://localhost/api/layanan-unggulan?page=1',
                            'next_page_url' => null,
                            'path' => 'http://localhost/api/layanan-unggulan',
                            'per_page' => 10,
                            'prev_page_url' => null,
                            'to' => 1,
                            'total' => 1
                        ],
                    ],
                ],
                'create' => [
                    'url' => '/api/layanan-unggulan',
                    'method' => 'POST',
                    'payload' => [
                        'nama_layanan' => 'string',
                        'deskripsi' => 'string',
                        'foto' => 'file',
                    ],
                    'validations' => (new self())::storeValidationRules(),
                    'response' => [
                        'success' => true,
                        'data' => [
                            'id' => 1,
                            'nama_layanan' => 'Layanan A',
                            'deskripsi' => 'Deskripsi Layanan A',
                            'foto' => 'uploads/layanan_unggulan/20231001_1234.jpg',
                            'created_at' => '2023-10-01T12:34:56.000000Z',
                            'updated_at' => '2023-10-01T12:34:56.000000Z',
                        ],
                    ],
                ],
                'update' => [
                    'url' => '/api/layanan-unggulan/{id}',
                    'method' => 'PUT',
                    'payload' => [
                        'nama_layanan' => 'string',
                        'deskripsi' => 'string',
                        'foto' => 'file',
                    ],
                    'validations' => (new self())::updateValidationRules(),
                    'response' => [
                        'success' => true,
                        'data' => [
                            'id' => 1,
                            'nama_layanan' => 'Layanan A (Updated)',
                            'deskripsi' => 'Deskripsi Layanan A (Updated)',
                            'foto' => 'uploads/layanan_unggulan/20231001_1235.jpg',
                            'created_at' => '2023-10-01T12:34:56.000000Z',
                            'updated_at' => '2023-10-01T12:35:56.000000Z',
                        ],
                    ],
                ],
                'delete' => [
                    'url' => '/api/layanan-unggulan/{id}',
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
