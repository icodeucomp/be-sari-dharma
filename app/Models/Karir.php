<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karir extends Model
{
    use HasFactory;

    protected $table = 'karir';

    protected $fillable = [
        'divisi',
        'posisi',
        'link_pendaftaran',
        'foto',
    ];

    public static function storeValidationRules()
    {
        return [
            'divisi' => 'required|string|max:255',
            'posisi' => 'required|string|max:255',
            'link_pendaftaran' => 'required|url|max:255',
            'foto' => 'nullable|file|mimes:jpg,jpeg,png|max:5120', // Max 5MB
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
                'divisi' => 'string',
                'posisi' => 'string',
                'link_pendaftaran' => 'string (URL)',
                'foto' => 'string (path to file)',
            ],
            'endpoints' => [
                'get_all' => [
                    'url' => '/api/karir',
                    'method' => 'GET',
                    'payload' => null,
                    'validations' => null,
                    'query_params' => [
                        'search' => 'string (for filtering by divisi or posisi)',
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
                                    'divisi' => 'IT',
                                    'posisi' => 'Software Engineer',
                                    'link_pendaftaran' => 'https://example.com/apply',
                                    'foto' => 'uploads/karir/20231001_1234.jpg',
                                    'created_at' => '2023-10-01T12:34:56.000000Z',
                                    'updated_at' => '2023-10-01T12:34:56.000000Z',
                                ],
                            ],
                            'first_page_url' => 'http://localhost/api/karir?page=1',
                            'from' => 1,
                            'last_page' => 1,
                            'last_page_url' => 'http://localhost/api/karir?page=1',
                            'next_page_url' => null,
                            'path' => 'http://localhost/api/karir',
                            'per_page' => 10,
                            'prev_page_url' => null,
                            'to' => 1,
                            'total' => 1
                        ],
                    ],
                ],
                'create' => [
                    'url' => '/api/karir',
                    'method' => 'POST',
                    'payload' => [
                        'divisi' => 'string',
                        'posisi' => 'string',
                        'link_pendaftaran' => 'string (URL)',
                        'foto' => 'file',
                    ],
                    'validations' => self::storeValidationRules(),
                    'response' => [
                        'success' => true,
                        'data' => [
                            'id' => 1,
                            'divisi' => 'IT',
                            'posisi' => 'Software Engineer',
                            'link_pendaftaran' => 'https://example.com/apply',
                            'foto' => 'uploads/karir/20231001_1234.jpg',
                            'created_at' => '2023-10-01T12:34:56.000000Z',
                            'updated_at' => '2023-10-01T12:34:56.000000Z',
                        ],
                    ],
                ],
                'update' => [
                    'url' => '/api/karir/{id}',
                    'method' => 'PUT',
                    'payload' => [
                        'divisi' => 'string',
                        'posisi' => 'string',
                        'link_pendaftaran' => 'string (URL)',
                        'foto' => 'file',
                    ],
                    'validations' => self::updateValidationRules(),
                    'response' => [
                        'success' => true,
                        'data' => [
                            'id' => 1,
                            'divisi' => 'IT',
                            'posisi' => 'Software Engineer (Updated)',
                            'link_pendaftaran' => 'https://example.com/apply',
                            'foto' => 'uploads/karir/20231001_1235.jpg',
                            'created_at' => '2023-10-01T12:34:56.000000Z',
                            'updated_at' => '2023-10-01T12:35:56.000000Z',
                        ],
                    ],
                ],
                'delete' => [
                    'url' => '/api/karir/{id}',
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
