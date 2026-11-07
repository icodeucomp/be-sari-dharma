<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class QualityIndicator extends Model
{
    use HasFactory;

    protected $table = 'quality_indicators';

    protected $fillable = [
        'title',
        'pdf_file',
        'photo',
    ];

    protected $appends = ['slug'];

    public function getSlugAttribute()
    {
        return Str::slug($this->title);
    }

    public static function storeValidationRules()
    {
        return [
            'title' => 'required|string|max:255',
            'pdf_file' => 'required|file|mimes:pdf|max:5120',
            'photo' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
        ];
    }

    public static function updateValidationRules()
    {
        return [
            'title' => 'required|string|max:255',
            'pdf_file' => 'nullable|file|mimes:pdf|max:5120',
            'photo' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
        ];
    }

    public static function getApiDocumentation()
    {
        return [
            'fields' => [
                'title' => 'string',
                'pdf_file' => 'string (path to file)',
                'photo' => 'string (path to file)',
                'slug' => 'string (URL friendly version of title)',
            ],
            'endpoints' => [
                'get_all' => [
                    'url' => '/api/quality-indicators',
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
                                    'title' => 'Indicator Quality A',
                                    'pdf_file' => 'uploads/quality_indicator/20231001_1234.pdf',
                                    'photo' => 'uploads/quality_indicator/20231001_1234.jpg',
                                    'created_at' => '2023-10-01T12:34:56.000000Z',
                                    'updated_at' => '2023-10-01T12:34:56.000000Z',
                                ],
                            ],
                            'first_page_url' => 'http://localhost/api/quality-indicators?page=1',
                            'from' => 1,
                            'last_page' => 1,
                            'last_page_url' => 'http://localhost/api/quality-indicators?page=1',
                            'next_page_url' => null,
                            'path' => 'http://localhost/api/quality-indicators',
                            'per_page' => 10,
                            'prev_page_url' => null,
                            'to' => 1,
                            'total' => 1,
                        ],
                    ],
                ],
                'create' => [
                    'url' => '/api/quality-indicators',
                    'method' => 'POST',
                    'payload' => [
                        'title' => 'string',
                        'pdf_file' => 'file',
                        'photo' => 'file',
                    ],
                    'validations' => self::storeValidationRules(),
                    'response' => [
                        'success' => true,
                        'data' => [
                            'id' => 1,
                            'title' => 'Indicator Quality A',
                            'pdf_file' => 'uploads/quality_indicator/20231001_1234.pdf',
                            'photo' => 'uploads/quality_indicator/20231001_1234.jpg',
                            'created_at' => '2023-10-01T12:34:56.000000Z',
                            'updated_at' => '2023-10-01T12:34:56.000000Z',
                        ],
                    ],
                ],
                'update' => [
                    'url' => '/api/quality-indicators/{id}',
                    'method' => 'PUT',
                    'payload' => [
                        'title' => 'string',
                        'pdf_file' => 'file',
                        'photo' => 'file',
                    ],
                    'validations' => self::updateValidationRules(),
                    'response' => [
                        'success' => true,
                        'data' => [
                            'id' => 1,
                            'title' => 'Indicator Quality A (Updated)',
                            'pdf_file' => 'uploads/quality_indicator/20231001_1235.pdf',
                            'photo' => 'uploads/quality_indicator/20231001_1235.jpg',
                            'created_at' => '2023-10-01T12:34:56.000000Z',
                            'updated_at' => '2023-10-01T12:35:56.000000Z',
                        ],
                    ],
                ],
                'delete' => [
                    'url' => '/api/quality-indicators/{id}',
                    'method' => 'DELETE',
                    'payload' => null,
                    'validations' => null,
                    'response' => [
                        'success' => true,
                        'message' => 'Data deleted successfully',
                    ],
                ],
                'show' => [
                    'url' => '/api/quality-indicators/{slug}/{id}',
                    'method' => 'GET',
                    'payload' => null,
                    'validations' => null,
                    'response' => [
                        'success' => true,
                        'data' => [
                            'id' => 1,
                            'title' => 'Indicator Quality A',
                            'slug' => 'quality-indicator-a',
                            'pdf_file' => 'uploads/quality_indicator/20231001_1234.pdf',
                            'photo' => 'uploads/quality_indicator/20231001_1234.jpg',
                            'created_at' => '2023-10-01T12:34:56.000000Z',
                            'updated_at' => '2023-10-01T12:34:56.000000Z',
                        ],
                    ],
                ],
            ],
        ];
    }
}
