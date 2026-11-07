<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class FeaturedService extends Model
{
    use HasFactory;

    protected $table = 'featured_services';

    protected $fillable = [
        'name',
        'description',
        'photo',
    ];

    protected $appends = ['slug'];

    public function getSlugAttribute()
    {
        return Str::slug($this->name);
    }

    public function getSlug()
    {
        return $this->slug ?? Str::slug($this->name);
    }

    public static function storeValidationRules()
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'photo' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
        ];
    }

    public static function updateValidationRules()
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'photo' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
        ];
    }

    public static function getApiDocumentation()
    {
        return [
            'fields' => [
                'name' => 'string',
                'description' => 'string',
                'photo' => 'string (path to file)',
                'slug' => 'string (URL friendly version of name)',
            ],
            'endpoints' => [
                'get_all' => [
                    'url' => '/api/featured-services',
                    'method' => 'GET',
                    'payload' => null,
                    'validations' => null,
                    'query_params' => [
                        'search' => 'string (for filtering by name)',
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
                                    'name' => 'Service A',
                                    'slug' => 'service-a',
                                    'description' => 'Service Description A',
                                    'photo' => 'uploads/featured_service/20231001_1234.jpg',
                                    'created_at' => '2023-10-01T12:34:56.000000Z',
                                    'updated_at' => '2023-10-01T12:34:56.000000Z',
                                ],
                            ],
                            'first_page_url' => 'http://localhost/api/featured-services?page=1',
                            'from' => 1,
                            'last_page' => 1,
                            'last_page_url' => 'http://localhost/api/featured-services?page=1',
                            'next_page_url' => null,
                            'path' => 'http://localhost/api/featured-services',
                            'per_page' => 10,
                            'prev_page_url' => null,
                            'to' => 1,
                            'total' => 1,
                        ],
                    ],
                ],
                'create' => [
                    'url' => '/api/featured-services',
                    'method' => 'POST',
                    'payload' => [
                        'name' => 'string',
                        'description' => 'string',
                        'photo' => 'file',
                    ],
                    'validations' => (new self)::storeValidationRules(),
                    'response' => [
                        'success' => true,
                        'data' => [
                            'id' => 1,
                            'name' => 'Service A',
                            'description' => 'Service Description A',
                            'photo' => 'uploads/featured_service/20231001_1234.jpg',
                            'created_at' => '2023-10-01T12:34:56.000000Z',
                            'updated_at' => '2023-10-01T12:34:56.000000Z',
                        ],
                    ],
                ],
                'update' => [
                    'url' => '/api/featured-services/{id}',
                    'method' => 'PUT',
                    'payload' => [
                        'name' => 'string',
                        'description' => 'string',
                        'photo' => 'file',
                    ],
                    'validations' => (new self)::updateValidationRules(),
                    'response' => [
                        'success' => true,
                        'data' => [
                            'id' => 1,
                            'name' => 'Service A (Updated)',
                            'description' => 'Service Description A (Updated)',
                            'photo' => 'uploads/featured_service/20231001_1235.jpg',
                            'created_at' => '2023-10-01T12:34:56.000000Z',
                            'updated_at' => '2023-10-01T12:35:56.000000Z',
                        ],
                    ],
                ],
                'delete' => [
                    'url' => '/api/featured-services/{id}',
                    'method' => 'DELETE',
                    'payload' => null,
                    'validations' => null,
                    'response' => [
                        'success' => true,
                        'message' => 'Data deleted successfully',
                    ],
                ],
                'show' => [
                    'url' => '/api/featured-services/{slug}/{id}',
                    'method' => 'GET',
                    'payload' => null,
                    'validations' => null,
                    'response' => [
                        'success' => true,
                        'data' => [
                            'id' => 1,
                            'name' => 'Service A',
                            'description' => 'Service Description A',
                            'gambar' => 'uploads/service/20231001_1234.jpg',
                            'slug' => 'service-a',
                            'created_at' => '2023-10-01T12:34:56.000000Z',
                            'updated_at' => '2023-10-01T12:34:56.000000Z',
                        ],
                    ],
                ],
            ],
        ];
    }
}
