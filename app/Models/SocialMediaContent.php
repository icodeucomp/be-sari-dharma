<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialMediaContent extends Model
{
    use HasFactory;

    protected $table = 'social_media_contents';

    protected $fillable = [
        'type',
        'links',
    ];

    protected $casts = [
        'links' => 'array',
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
                    'url' => '/api/social-media-contents',
                    'method' => 'GET',
                    'payload' => null,
                    'validations' => null,
                    'query_params' => [
                        'search' => 'string (to filter by type)',
                        'type' => 'string (to filter specifically by type: youtube or instagram)',
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
                                    'type' => 'youtube',
                                    'links' => ['https://youtube.com/example1', 'https://youtube.com/example2'],
                                    'created_at' => '2023-10-01T12:34:56.000000Z',
                                    'updated_at' => '2023-10-01T12:34:56.000000Z',
                                ],
                            ],
                            'first_page_url' => 'http://localhost/api/social-media-contents?page=1',
                            'from' => 1,
                            'last_page' => 1,
                            'last_page_url' => 'http://localhost/api/social-media-contents?page=1',
                            'next_page_url' => null,
                            'path' => 'http://localhost/api/social-media-contents',
                            'per_page' => 10,
                            'prev_page_url' => null,
                            'to' => 1,
                            'total' => 1,
                        ],
                    ],
                ],
                'create' => [
                    'url' => '/api/social-media-contents',
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
                    'url' => '/api/social-media-contents/{id}',
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
                    'url' => '/api/social-media-contents/{id}',
                    'method' => 'DELETE',
                    'payload' => null,
                    'validations' => null,
                    'response' => [
                        'success' => true,
                        'message' => 'Data deleted successfully',
                    ],
                ],
                'show' => [
                    'url' => '/api/social-media-contents/{id}',
                    'method' => 'GET',
                    'payload' => null,
                    'validations' => null,
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
            ],
        ];
    }
}
