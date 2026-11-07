<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Career extends Model
{
    use HasFactory;

    protected $table = 'careers';

    protected $fillable = [
        'division',
        'position',
        'application_link',
        'photo',
    ];

    protected $appends = ['slug'];

    public function getSlugAttribute()
    {
        return Str::slug($this->position);
    }

    public static function storeValidationRules()
    {
        return [
            'division' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'application_link' => 'required|url|max:255',
            'photo' => 'nullable|file|mimes:jpg,jpeg,png|max:5120',
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
                'division' => 'string',
                'position' => 'string',
                'application_link' => 'string (URL)',
                'photo' => 'string (path to file)',
                'slug' => 'string (URL friendly version of position)',
            ],
            'endpoints' => [
                'get_all' => [
                    'url' => '/api/careers',
                    'method' => 'GET',
                    'payload' => null,
                    'validations' => null,
                    'query_params' => [
                        'search' => 'string (for filtering by division or position)',
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
                                    'division' => 'IT',
                                    'position' => 'Software Engineer',
                                    'application_link' => 'https://example.com/apply',
                                    'photo' => 'uploads/career/20231001_1234.jpg',
                                    'created_at' => '2023-10-01T12:34:56.000000Z',
                                    'updated_at' => '2023-10-01T12:34:56.000000Z',
                                ],
                            ],
                            'first_page_url' => 'http://localhost/api/careers?page=1',
                            'from' => 1,
                            'last_page' => 1,
                            'last_page_url' => 'http://localhost/api/careers?page=1',
                            'next_page_url' => null,
                            'path' => 'http://localhost/api/careers',
                            'per_page' => 10,
                            'prev_page_url' => null,
                            'to' => 1,
                            'total' => 1,
                        ],
                    ],
                ],
                'create' => [
                    'url' => '/api/careers',
                    'method' => 'POST',
                    'payload' => [
                        'division' => 'string',
                        'position' => 'string',
                        'application_link' => 'string (URL)',
                        'photo' => 'file',
                    ],
                    'validations' => self::storeValidationRules(),
                    'response' => [
                        'success' => true,
                        'data' => [
                            'id' => 1,
                            'division' => 'IT',
                            'position' => 'Software Engineer',
                            'application_link' => 'https://example.com/apply',
                            'photo' => 'uploads/career/20231001_1234.jpg',
                            'created_at' => '2023-10-01T12:34:56.000000Z',
                            'updated_at' => '2023-10-01T12:34:56.000000Z',
                        ],
                    ],
                ],
                'update' => [
                    'url' => '/api/careers/{id}',
                    'method' => 'PUT',
                    'payload' => [
                        'division' => 'string',
                        'position' => 'string',
                        'application_link' => 'string (URL)',
                        'photo' => 'file',
                    ],
                    'validations' => self::updateValidationRules(),
                    'response' => [
                        'success' => true,
                        'data' => [
                            'id' => 1,
                            'division' => 'IT',
                            'position' => 'Software Engineer (Updated)',
                            'application_link' => 'https://example.com/apply',
                            'photo' => 'uploads/career/20231001_1235.jpg',
                            'created_at' => '2023-10-01T12:34:56.000000Z',
                            'updated_at' => '2023-10-01T12:35:56.000000Z',
                        ],
                    ],
                ],
                'delete' => [
                    'url' => '/api/careers/{id}',
                    'method' => 'DELETE',
                    'payload' => null,
                    'validations' => null,
                    'response' => [
                        'success' => true,
                        'message' => 'Data deleted successfully',
                    ],
                ],
                'show' => [
                    'url' => '/api/careers/{slug}/{id}',
                    'method' => 'GET',
                    'payload' => null,
                    'validations' => null,
                    'response' => [
                        'success' => true,
                        'data' => [
                            'id' => 1,
                            'division' => 'IT',
                            'position' => 'Software Engineer',
                            'slug' => 'software-engineer',
                            'application_link' => 'https://example.com/apply',
                            'photo' => 'uploads/career/20231001_1234.jpg',
                            'created_at' => '2023-10-01T12:34:56.000000Z',
                            'updated_at' => '2023-10-01T12:34:56.000000Z',
                        ],
                    ],
                ],
            ],
        ];
    }
}
