<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class HealthPackage extends Model
{
    use HasFactory;

    protected $table = 'health_packages';

    protected $fillable = [
        'name',
        'category_id',
        'promo',
        'valid_until',
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
            'category_id' => 'required|exists:categories,id',
            'promo' => 'required|boolean',
            'valid_until' => 'nullable|date',
            'description' => 'nullable|string',
            'photo' => 'nullable|file|mimes:jpg,jpeg,png|max:5120',
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
                'name' => 'string',
                'category_id' => 'integer (foreign key from categories)',
                'promo' => 'boolean',
                'valid_until' => 'date',
                'description' => 'string',
                'photo' => 'string (path to file)',
                'slug' => 'string (URL friendly version of name)',
            ],
            'endpoints' => [
                'get_all' => [
                    'url' => '/api/health-packages',
                    'method' => 'GET',
                    'payload' => null,
                    'validations' => null,
                    'query_params' => [
                        'search' => 'string (to filter by name)',
                        'category_id' => 'integer (to filter by category)',
                        'promo' => 'boolean (0 or 1, to filter by status promo)',
                        'valid_start' => 'date (YYYY-MM-DD, to filter by validity start date)',
                        'valid_end' => 'date (YYYY-MM-DD, to filter by validity end date)',
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
                                    'name' => 'Package A',
                                    'category_id' => 1,
                                    'promo' => true,
                                    'valid_until' => '2023-12-31',
                                    'description' => 'Package Description A',
                                    'photo' => 'uploads/health_package/20231001_1234.jpg',
                                    'created_at' => '2023-10-01T12:34:56.000000Z',
                                    'updated_at' => '2023-10-01T12:34:56.000000Z',
                                ],
                            ],
                            'first_page_url' => 'http://localhost/api/health-packages?page=1',
                            'from' => 1,
                            'last_page' => 1,
                            'last_page_url' => 'http://localhost/api/health-packages?page=1',
                            'next_page_url' => null,
                            'path' => 'http://localhost/api/health-packages',
                            'per_page' => 10,
                            'prev_page_url' => null,
                            'to' => 1,
                            'total' => 1,
                        ],
                    ],
                ],
                'create' => [
                    'url' => '/api/health-packages',
                    'method' => 'POST',
                    'payload' => [
                        'name' => 'string',
                        'category_id' => 'integer (categories id)',
                        'promo' => 'boolean',
                        'valid_until' => 'date',
                        'description' => 'string',
                        'photo' => 'file',
                    ],
                    'validations' => self::storeValidationRules(),
                    'response' => [
                        'success' => true,
                        'data' => [
                            'id' => 1,
                            'name' => 'Package A',
                            'category_id' => 1,
                            'promo' => true,
                            'valid_until' => '2023-12-31',
                            'description' => 'Package Description A',
                            'photo' => 'uploads/health_package/20231001_1234.jpg',
                            'created_at' => '2023-10-01T12:34:56.000000Z',
                            'updated_at' => '2023-10-01T12:34:56.000000Z',
                        ],
                    ],
                ],
                'update' => [
                    'url' => '/api/health-packages/{id}',
                    'method' => 'PUT',
                    'payload' => [
                        'name' => 'string',
                        'category_id' => 'integer (categories id)',
                        'promo' => 'boolean',
                        'valid_until' => 'date',
                        'description' => 'string',
                        'photo' => 'file',
                    ],
                    'validations' => self::updateValidationRules(),
                    'response' => [
                        'success' => true,
                        'data' => [
                            'id' => 1,
                            'name' => 'Package A (Updated)',
                            'category_id' => 1,
                            'promo' => false,
                            'valid_until' => '2024-01-31',
                            'description' => 'Package Description A (Updated)',
                            'photo' => 'uploads/health_package/20231001_1235.jpg',
                            'created_at' => '2023-10-01T12:34:56.000000Z',
                            'updated_at' => '2023-10-01T12:35:56.000000Z',
                        ],
                    ],
                ],
                'delete' => [
                    'url' => '/api/health-packages/{id}',
                    'method' => 'DELETE',
                    'payload' => null,
                    'validations' => null,
                    'response' => [
                        'success' => true,
                        'message' => 'Data deleted successfully',
                    ],
                ],
                'show' => [
                    'url' => '/api/health-packages/{slug}/{id}',
                    'method' => 'GET',
                    'payload' => null,
                    'validations' => null,
                    'response' => [
                        'success' => true,
                        'data' => [
                            'id' => 1,
                            'name' => 'Package A',
                            'slug' => 'package-a',
                            'category_id' => 1,
                            'promo' => true,
                            'valid_until' => '2023-12-31',
                            'description' => 'Package Description A',
                            'photo' => 'uploads/health_package/20231001_1234.jpg',
                            'category' => [
                                'id' => 1,
                                'name' => 'Category A',
                                'page' => 'page_a',
                                'flag' => 'HealthPackage',
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
