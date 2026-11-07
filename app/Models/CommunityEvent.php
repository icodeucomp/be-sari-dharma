<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CommunityEvent extends Model
{
    use HasFactory;

    protected $table = 'community_events';

    protected $fillable = [
        'category_id',
        'title',
        'content',
        'photo',
    ];

    protected $appends = ['slug'];

    public function getSlugAttribute()
    {
        return Str::slug($this->title);
    }

    public function getSlug()
    {
        return $this->slug ?? Str::slug($this->title);
    }

    public static function storeValidationRules()
    {
        return [
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'photo' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
        ];
    }

    public static function updateValidationRules()
    {
        return self::storeValidationRules();
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public static function getApiDocumentation()
    {
        return [
            'fields' => [
                'category_id' => 'integer (foreign key from categories)',
                'title' => 'string',
                'content' => 'string',
                'photo' => 'string (path to file)',
                'slug' => 'string (URL friendly version of title)',
            ],
            'endpoints' => [
                'get_all' => [
                    'url' => '/api/community-events',
                    'method' => 'GET',
                    'payload' => null,
                    'validations' => null,
                    'query_params' => [
                        'search' => 'string (for filtering by title)',
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
                                    'category_id' => 1,
                                    'title' => 'Event A',
                                    'content' => 'Content Event A...',
                                    'photo' => 'uploads/community_event/20231001_1234.jpg',
                                    'created_at' => '2023-10-01T12:34:56.000000Z',
                                    'updated_at' => '2023-10-01T12:34:56.000000Z',
                                ],
                            ],
                            'first_page_url' => 'http://localhost/api/community-events?page=1',
                            'from' => 1,
                            'last_page' => 1,
                            'last_page_url' => 'http://localhost/api/community-events?page=1',
                            'next_page_url' => null,
                            'path' => 'http://localhost/api/community-events',
                            'per_page' => 10,
                            'prev_page_url' => null,
                            'to' => 1,
                            'total' => 1,
                        ],
                    ],
                ],
                'create' => [
                    'url' => '/api/community-events',
                    'method' => 'POST',
                    'payload' => [
                        'category_id' => 'integer',
                        'title' => 'string',
                        'content' => 'string',
                        'photo' => 'file',
                    ],
                    'validations' => self::storeValidationRules(),
                    'response' => [
                        'success' => true,
                        'data' => [
                            'id' => 1,
                            'category_id' => 1,
                            'title' => 'Event A',
                            'content' => 'Content Event A...',
                            'photo' => 'uploads/community_event/20231001_1234.jpg',
                            'created_at' => '2023-10-01T12:34:56.000000Z',
                            'updated_at' => '2023-10-01T12:34:56.000000Z',
                        ],
                    ],
                ],
                'update' => [
                    'url' => '/api/community-events/{id}',
                    'method' => 'PUT',
                    'payload' => [
                        'category_id' => 'integer',
                        'title' => 'string',
                        'content' => 'string',
                        'photo' => 'file',
                    ],
                    'validations' => self::updateValidationRules(),
                    'response' => [
                        'success' => true,
                        'data' => [
                            'id' => 1,
                            'category_id' => 1,
                            'title' => 'Event A (Updated)',
                            'content' => 'Content Event A (Updated)...',
                            'photo' => 'uploads/community_event/20231001_1235.jpg',
                            'created_at' => '2023-10-01T12:34:56.000000Z',
                            'updated_at' => '2023-10-01T12:35:56.000000Z',
                        ],
                    ],
                ],
                'delete' => [
                    'url' => '/api/community-events/{id}',
                    'method' => 'DELETE',
                    'payload' => null,
                    'validations' => null,
                    'response' => [
                        'success' => true,
                        'message' => 'Data deleted successfully',
                    ],
                ],
                'show' => [
                    'url' => '/api/community-events/{slug}/{id}',
                    'method' => 'GET',
                    'payload' => null,
                    'validations' => null,
                    'response' => [
                        'success' => true,
                        'data' => [
                            'id' => 1,
                            'category_id' => 1,
                            'title' => 'Event A',
                            'slug' => 'event-a',
                            'content' => 'Content Event A...',
                            'photo' => 'uploads/community_event/20231001_1234.jpg',
                            'category' => [
                                'id' => 1,
                                'name' => 'Category A',
                                'page' => 'page_a',
                                'flag' => 'CommunityEvent',
                            ],
                            'created_at' => '2023-10-01T12:34:56.000000Z',
                            'updated_at' => '2023-10-01T12:34:56.000000Z',
                        ],
                    ],
                ],
            ],
        ];
    }
}
