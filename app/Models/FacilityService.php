<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class FacilityService extends Model
{
    use HasFactory;

    protected $table = 'facility_services';

    protected $fillable = [
        'name',
        'overview_description',
        'services',
        'header_photo',
        'other_photo',
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
            'overview_description' => 'nullable|string',
            'services' => 'nullable|string',
            'header_photo' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
            'other_photo' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
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
                'overview_description' => 'string',
                'services' => 'string',
                'header_photo' => 'string (path to file)',
                'other_photo' => 'string (path to file)',
                'slug' => 'string (URL friendly version of name)',
            ],
            'endpoints' => [
                'get_all' => [
                    'url' => '/api/facility-services',
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
                                    'name' => 'Facility A',
                                    'overview_description' => 'Facility Description A',
                                    'services' => 'Facility Service A',
                                    'header_photo' => 'uploads/services/20231001_1234.jpg',
                                    'other_photo' => 'uploads/services/20231001_1235.jpg',
                                    'created_at' => '2023-10-01T12:34:56.000000Z',
                                    'updated_at' => '2023-10-01T12:34:56.000000Z',
                                ],
                            ],
                            'first_page_url' => 'http://localhost/api/facility-services?page=1',
                            'from' => 1,
                            'last_page' => 1,
                            'last_page_url' => 'http://localhost/api/facility-services?page=1',
                            'next_page_url' => null,
                            'path' => 'http://localhost/api/facility-services',
                            'per_page' => 10,
                            'prev_page_url' => null,
                            'to' => 1,
                            'total' => 1,
                        ],
                    ],
                ],
                'create' => [
                    'url' => '/api/facility-services',
                    'method' => 'POST',
                    'payload' => [
                        'name' => 'string',
                        'overview_description' => 'string',
                        'services' => 'string',
                        'header_photo' => 'file',
                        'other_photo' => 'file',
                    ],
                    'validations' => self::storeValidationRules(),
                    'response' => [
                        'success' => true,
                        'data' => [
                            'id' => 1,
                            'name' => 'Facility A',
                            'overview_description' => 'Facility Description A',
                            'services' => 'Facility Service A',
                            'header_photo' => 'uploads/services/20231001_1234.jpg',
                            'other_photo' => 'uploads/services/20231001_1235.jpg',
                            'created_at' => '2023-10-01T12:34:56.000000Z',
                            'updated_at' => '2023-10-01T12:34:56.000000Z',
                        ],
                    ],
                ],
                'update' => [
                    'url' => '/api/facility-services/{id}',
                    'method' => 'PUT',
                    'payload' => [
                        'name' => 'string',
                        'overview_description' => 'string',
                        'services' => 'string',
                        'header_photo' => 'file',
                        'other_photo' => 'file',
                    ],
                    'validations' => self::updateValidationRules(),
                    'response' => [
                        'success' => true,
                        'data' => [
                            'id' => 1,
                            'name' => 'Facility A (Updated)',
                            'overview_description' => 'Facility Description A (Updated)',
                            'services' => 'Facility Service A (Updated)',
                            'header_photo' => 'uploads/services/20231001_1236.jpg',
                            'other_photo' => 'uploads/services/20231001_1237.jpg',
                            'created_at' => '2023-10-01T12:34:56.000000Z',
                            'updated_at' => '2023-10-01T12:35:56.000000Z',
                        ],
                    ],
                ],
                'delete' => [
                    'url' => '/api/facility-services/{id}',
                    'method' => 'DELETE',
                    'payload' => null,
                    'validations' => null,
                    'response' => [
                        'success' => true,
                        'message' => 'Data deleted successfully',
                    ],
                ],
                'show' => [
                    'url' => '/api/facility-services/{slug}/{id}',
                    'method' => 'GET',
                    'payload' => null,
                    'validations' => null,
                    'response' => [
                        'success' => true,
                        'data' => [
                            'id' => 1,
                            'name' => 'Facility A',
                            'slug' => 'facility-a',
                            'overview_description' => 'Facility Description A',
                            'services' => 'Facility Service A',
                            'header_photo' => 'uploads/services/20231001_1234.jpg',
                            'other_photo' => 'uploads/services/20231001_1235.jpg',
                            'created_at' => '2023-10-01T12:34:56.000000Z',
                            'updated_at' => '2023-10-01T12:34:56.000000Z',
                        ],
                    ],
                ],
            ],
        ];
    }
}
