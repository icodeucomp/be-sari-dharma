<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CertificationAward extends Model
{
    use HasFactory;

    protected $table = 'certifications_awards';

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
                    'url' => '/api/certification-awards',
                    'method' => 'GET',
                    'payload' => null,
                    'validations' => null,
                    'query_params' => [
                        'search' => 'string (for filtering results)',
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
                                    'title' => 'Certification A',
                                    'pdf_file' => 'uploads/certification_award/20231001_1234.pdf',
                                    'photo' => 'uploads/certification_award/20231001_1234.jpg',
                                    'created_at' => '2023-10-01T12:34:56.000000Z',
                                    'updated_at' => '2023-10-01T12:34:56.000000Z',
                                ],
                            ],
                            'first_page_url' => 'http://localhost/api/certification-awards?page=1',
                            'from' => 1,
                            'last_page' => 1,
                            'last_page_url' => 'http://localhost/api/certification-awards?page=1',
                            'next_page_url' => null,
                            'path' => 'http://localhost/api/certification-awards',
                            'per_page' => 10,
                            'prev_page_url' => null,
                            'to' => 1,
                            'total' => 1,
                        ],
                    ],
                ],
                'create' => [
                    'url' => '/api/certification-awards',
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
                            'title' => 'Certification A',
                            'pdf_file' => 'uploads/certification_award/20231001_1234.pdf',
                            'photo' => 'uploads/certification_award/20231001_1234.jpg',
                            'created_at' => '2023-10-01T12:34:56.000000Z',
                            'updated_at' => '2023-10-01T12:34:56.000000Z',
                        ],
                    ],
                ],
                'update' => [
                    'url' => '/api/certification-awards/{id}',
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
                            'title' => 'Certification A (Updated)',
                            'pdf_file' => 'uploads/certification_award/20231001_1235.pdf',
                            'photo' => 'uploads/certification_award/20231001_1235.jpg',
                            'created_at' => '2023-10-01T12:34:56.000000Z',
                            'updated_at' => '2023-10-01T12:35:56.000000Z',
                        ],
                    ],
                ],
                'delete' => [
                    'url' => '/api/certification-awards/{id}',
                    'method' => 'DELETE',
                    'payload' => null,
                    'validations' => null,
                    'response' => [
                        'success' => true,
                        'message' => 'Data deleted successfully',
                    ],
                ],
                'show' => [
                    'url' => '/api/certification-awards/{slug}/{id}',
                    'method' => 'GET',
                    'payload' => null,
                    'validations' => null,
                    'response' => [
                        'success' => true,
                        'data' => [
                            'id' => 1,
                            'title' => 'Certification A',
                            'slug' => 'certification-a',
                            'pdf_file' => 'uploads/certification_award/20231001_1234.pdf',
                            'photo' => 'uploads/certification_award/20231001_1234.jpg',
                            'created_at' => '2023-10-01T12:34:56.000000Z',
                            'updated_at' => '2023-10-01T12:34:56.000000Z',
                        ],
                    ],
                ],
            ],
        ];
    }
}
