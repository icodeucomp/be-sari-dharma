<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterKategori extends Model
{
    use HasFactory;

    protected $table = 'master_kategori';

    protected $fillable = [
        'name',
        'flag'
    ];

    public static function storeValidationRules()
    {
        return [
            'name' => 'required|string|max:255',
            'flag' => 'required|string|max:255'
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
                'name' => 'string',
                'page' => 'string',
                'flag' => 'string (information indicating related page, e.g. PaketKesehatan, ArtikelKesehatan, EventCommunity)'
            ],
            'endpoints' => [
                'get_all' => [
                    'url' => '/api/master-kategori',
                    'method' => 'GET',
                    'payload' => null,
                    'validations' => null,
                    'query_params' => [
                        'search' => 'string (for filtering by name)',
                        'flag' => 'string (for filtering by flag)',
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
                                    'name' => 'Kategori A',
                                    'page' => 'page_a',
                                    'flag' => 'PaketKesehatan',
                                    'created_at' => '2023-10-01T12:34:56.000000Z',
                                    'updated_at' => '2023-10-01T12:34:56.000000Z',
                                ],
                            ],
                            'first_page_url' => 'http://localhost/api/master-kategori?page=1',
                            'from' => 1,
                            'last_page' => 1,
                            'last_page_url' => 'http://localhost/api/master-kategori?page=1',
                            'next_page_url' => null,
                            'path' => 'http://localhost/api/master-kategori',
                            'per_page' => 10,
                            'prev_page_url' => null,
                            'to' => 1,
                            'total' => 1
                        ],
                    ],
                ],
                'create' => [
                    'url' => '/api/master-kategori',
                    'method' => 'POST',
                    'payload' => [
                        'name' => 'string',
                        'page' => 'string',
                        'flag' => 'string',
                    ],
                    'validations' => self::storeValidationRules(),
                    'response' => [
                        'success' => true,
                        'data' => [
                            'id' => 1,
                            'name' => 'Kategori A',
                            'page' => 'page_a',
                            'flag' => 'PaketKesehatan',
                            'created_at' => '2023-10-01T12:34:56.000000Z',
                            'updated_at' => '2023-10-01T12:34:56.000000Z',
                        ],
                    ],
                ],
                'update' => [
                    'url' => '/api/master-kategori/{id}',
                    'method' => 'PUT',
                    'payload' => [
                        'name' => 'string',
                        'page' => 'string',
                        'flag' => 'string',
                    ],
                    'validations' => self::updateValidationRules(),
                    'response' => [
                        'success' => true,
                        'data' => [
                            'id' => 1,
                            'name' => 'Kategori A (Updated)',
                            'page' => 'page_a_updated',
                            'flag' => 'ArtikelKesehatan',
                            'created_at' => '2023-10-01T12:34:56.000000Z',
                            'updated_at' => '2023-10-01T12:35:56.000000Z',
                        ],
                    ],
                ],
                'delete' => [
                    'url' => '/api/master-kategori/{id}',
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
