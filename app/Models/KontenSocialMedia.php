<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KontenSocialMedia extends Model
{
    use HasFactory;

    protected $table = 'konten_social_media';

    protected $fillable = [
        'type',
        'links',
    ];

    protected $casts = [
        'links' => 'array', // Cast JSON field to array
    ];

    public static function storeValidationRules()
    {
        return [
            'type' => 'required|in:youtube,instagram',
            'links' => 'required|array',
            'links.*' => 'required|url|max:255',
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
                'type' => 'enum (youtube, instagram)',
                'links' => 'array of URLs',
            ],
            'endpoints' => [
                'get_all' => [
                    'url' => '/api/konten-social-media',
                    'method' => 'GET',
                    'payload' => null,
                    'validations' => null,
                    'query_params' => [
                        'search' => 'string (for filtering by type)',
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
                                    'type' => 'youtube',
                                    'links' => ['https://youtube.com/example1', 'https://youtube.com/example2'],
                                    'created_at' => '2023-10-01T12:34:56.000000Z',
                                    'updated_at' => '2023-10-01T12:34:56.000000Z',
                                ],
                            ],
                            'first_page_url' => 'http://localhost/api/konten-social-media?page=1',
                            'from' => 1,
                            'last_page' => 1,
                            'last_page_url' => 'http://localhost/api/konten-social-media?page=1',
                            'next_page_url' => null,
                            'path' => 'http://localhost/api/konten-social-media',
                            'per_page' => 10,
                            'prev_page_url' => null,
                            'to' => 1,
                            'total' => 1
                        ],
                    ],
                ],
                'create' => [
                    'url' => '/api/konten-social-media',
                    'method' => 'POST',
                    'payload' => [
                        'type' => 'enum (youtube, instagram)',
                        'links' => ['array of URLs'],
                    ],
                    'validations' => self::storeValidationRules(),
                    'response' => [
                        'success' => true,
                        'data' => [
                            'id' => 1,
                            'type' => 'youtube',
                            'links' => ['https://youtube.com/example1', 'https://youtube.com/example2'],
                            'created_at' => '2023-10-01T12:34:56.000000Z',
                            'updated_at' => '2023-10-01T12:34:56.000000Z',
                        ],
                    ],
                ],
                'update' => [
                    'url' => '/api/konten-social-media/{id}',
                    'method' => 'PUT',
                    'payload' => [
                        'type' => 'enum (youtube, instagram)',
                        'links' => ['array of URLs'],
                    ],
                    'validations' => self::updateValidationRules(),
                    'response' => [
                        'success' => true,
                        'data' => [
                            'id' => 1,
                            'type' => 'instagram',
                            'links' => ['https://instagram.com/example1', 'https://instagram.com/example2'],
                            'created_at' => '2023-10-01T12:34:56.000000Z',
                            'updated_at' => '2023-10-01T12:35:56.000000Z',
                        ],
                    ],
                ],
                'delete' => [
                    'url' => '/api/konten-social-media/{id}',
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
