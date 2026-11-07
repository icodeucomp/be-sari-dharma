<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class HealthArticle extends Model
{
    use HasFactory;

    protected $table = 'health_articles';

    protected $fillable = [
        'category_id',
        'title',
        'content',
        'related_doctors',
        'photo',
    ];

    protected $casts = [
        'related_doctors' => 'array',
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
            'related_doctors' => 'nullable|array',
            'related_doctors.*' => 'string|max:255',
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
                'related_doctors' => 'array of strings',
                'photo' => 'string (path to file)',
                'slug' => 'string (URL friendly version of title)',
            ],
            'endpoints' => [
                'get_all' => [
                    'url' => '/api/health-articles',
                    'method' => 'GET',
                    'payload' => null,
                    'validations' => null,
                    'query_params' => [
                        'search' => 'string (to filter by title)',
                        'slug' => 'string (to filter by article slug)',
                        'category_id' => 'string (encrypted ID to filter by category)',
                        'related_doctors' => 'string|array (encrypted ID to filter by related doctors)',
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
                                    'title' => 'Manfaat Olahraga',
                                    'content' => 'Olahraga memiliki banyak manfaat...',
                                    'related_doctors' => ['Dr. John Doe', 'Dr. Jane Smith'],
                                    'photo' => 'uploads/health_article/20231001_1234.jpg',
                                    'created_at' => '2023-10-01T12:34:56.000000Z',
                                    'updated_at' => '2023-10-01T12:34:56.000000Z',
                                ],
                            ],
                            'first_page_url' => 'http://localhost/api/health-articles?page=1',
                            'from' => 1,
                            'last_page' => 1,
                            'last_page_url' => 'http://localhost/api/health-articles?page=1',
                            'next_page_url' => null,
                            'path' => 'http://localhost/api/health-articles',
                            'per_page' => 10,
                            'prev_page_url' => null,
                            'to' => 1,
                            'total' => 1,
                        ],
                    ],
                ],
                'create' => [
                    'url' => '/api/health-articles',
                    'method' => 'POST',
                    'payload' => [
                        'category_id' => 'integer (categories id)',
                        'title' => 'string',
                        'content' => 'string',
                        'related_doctors' => ['array of strings'],
                        'photo' => 'file',
                    ],
                    'validations' => self::storeValidationRules(),
                    'response' => [
                        'success' => true,
                        'data' => [
                            'id' => 1,
                            'category_id' => 1,
                            'title' => 'Manfaat Olahraga',
                            'content' => 'Olahraga memiliki banyak manfaat...',
                            'related_doctors' => ['Dr. John Doe', 'Dr. Jane Smith'],
                            'photo' => 'uploads/health_article/20231001_1234.jpg',
                            'created_at' => '2023-10-01T12:34:56.000000Z',
                            'updated_at' => '2023-10-01T12:34:56.000000Z',
                        ],
                    ],
                ],
                'update' => [
                    'url' => '/api/health-articles/{id}',
                    'method' => 'PUT',
                    'payload' => [
                        'category_id' => 'integer (categories id)',
                        'title' => 'string',
                        'content' => 'string',
                        'related_doctors' => ['array of strings'],
                        'photo' => 'file',
                    ],
                    'validations' => self::updateValidationRules(),
                    'response' => [
                        'success' => true,
                        'data' => [
                            'id' => 1,
                            'category_id' => 1,
                            'title' => 'Manfaat Olahraga (Updated)',
                            'content' => 'Olahraga memiliki banyak manfaat...',
                            'related_doctors' => ['Dr. John Doe', 'Dr. Jane Smith'],
                            'photo' => 'uploads/health_article/20231001_1235.jpg',
                            'created_at' => '2023-10-01T12:34:56.000000Z',
                            'updated_at' => '2023-10-01T12:35:56.000000Z',
                        ],
                    ],
                ],
                'delete' => [
                    'url' => '/api/health-articles/{id}',
                    'method' => 'DELETE',
                    'payload' => null,
                    'validations' => null,
                    'response' => [
                        'success' => true,
                        'message' => 'Data deleted successfully',
                    ],
                ],
                'show' => [
                    'url' => '/api/health-articles/{slug}/{id}',
                    'method' => 'GET',
                    'payload' => null,
                    'validations' => null,
                    'response' => [
                        'success' => true,
                        'data' => [
                            'id' => 1,
                            'category_id' => 1,
                            'title' => 'Manfaat Olahraga',
                            'slug' => 'manfaat-olahraga',
                            'content' => 'Olahraga memiliki banyak manfaat...',
                            'related_doctors' => ['Dr. John Doe', 'Dr. Jane Smith'],
                            'photo' => 'uploads/health_article/20231001_1234.jpg',
                            'category' => [
                                'id' => 1,
                                'name' => 'Category A',
                                'page' => 'page_a',
                                'flag' => 'HealthArticle',
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
