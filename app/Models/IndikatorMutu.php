<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndikatorMutu extends Model
{
    use HasFactory;

    protected $table = 'indikator_mutu';

    protected $fillable = [
        'judul',
        'file_pdf',
    ];

    // Boot method untuk mengisi slug otomatis
    protected static function boot()
    {
        parent::boot();

        static::retrieved(function ($model) {
            $model->slug = Str::slug($model->judul);
        });
    }

    /**
     * Mendapatkan slug dari nama layanan.
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug ?? Str::slug($this->judul);
    }

    public static function storeValidationRules()
    {
        return [
            'judul' => 'required|string|max:255',
            'file_pdf' => 'required|file|mimes:pdf|max:5120', // Max 5MB
        ];
    }

    public static function updateValidationRules()
    {
        return [
            'judul' => 'required|string|max:255',
            'file_pdf' => 'nullable|file|mimes:pdf|max:5120', // Max 5MB
        ];
    }

    public static function getApiDocumentation()
    {
        return [
            'fields' => [
                'judul' => 'string',
                'file_pdf' => 'string (path to file)',
                'slug' => 'string (URL friendly version of judul)',
            ],
            'endpoints' => [
                'get_all' => [
                    'url' => '/api/indikator-mutu',
                    'method' => 'GET',
                    'payload' => null,
                    'validations' => null,
                    'query_params' => [
                        'search' => 'string (for filtering by judul)',
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
                                    'judul' => 'Indikator Mutu A',
                                    'file_pdf' => 'uploads/indikator_mutu/20231001_1234.pdf',
                                    'created_at' => '2023-10-01T12:34:56.000000Z',
                                    'updated_at' => '2023-10-01T12:34:56.000000Z',
                                ],
                            ],
                            'first_page_url' => 'http://localhost/api/indikator-mutu?page=1',
                            'from' => 1,
                            'last_page' => 1,
                            'last_page_url' => 'http://localhost/api/indikator-mutu?page=1',
                            'next_page_url' => null,
                            'path' => 'http://localhost/api/indikator-mutu',
                            'per_page' => 10,
                            'prev_page_url' => null,
                            'to' => 1,
                            'total' => 1
                        ],
                    ],
                ],
                'create' => [
                    'url' => '/api/indikator-mutu',
                    'method' => 'POST',
                    'payload' => [
                        'judul' => 'string',
                        'file_pdf' => 'file',
                    ],
                    'validations' => self::storeValidationRules(),
                    'response' => [
                        'success' => true,
                        'data' => [
                            'id' => 1,
                            'judul' => 'Indikator Mutu A',
                            'file_pdf' => 'uploads/indikator_mutu/20231001_1234.pdf',
                            'created_at' => '2023-10-01T12:34:56.000000Z',
                            'updated_at' => '2023-10-01T12:34:56.000000Z',
                        ],
                    ],
                ],
                'update' => [
                    'url' => '/api/indikator-mutu/{id}',
                    'method' => 'PUT',
                    'payload' => [
                        'judul' => 'string',
                        'file_pdf' => 'file',
                    ],
                    'validations' => self::updateValidationRules(),
                    'response' => [
                        'success' => true,
                        'data' => [
                            'id' => 1,
                            'judul' => 'Indikator Mutu A (Updated)',
                            'file_pdf' => 'uploads/indikator_mutu/20231001_1235.pdf',
                            'created_at' => '2023-10-01T12:34:56.000000Z',
                            'updated_at' => '2023-10-01T12:35:56.000000Z',
                        ],
                    ],
                ],
                'delete' => [
                    'url' => '/api/indikator-mutu/{id}',
                    'method' => 'DELETE',
                    'payload' => null,
                    'validations' => null,
                    'response' => [
                        'success' => true,
                        'message' => 'Data deleted successfully',
                    ],
                ],
                'show' => [
                    'url' => '/api/indikator-mutu/{slug}/{id}',
                    'method' => 'GET',
                    'payload' => null,
                    'validations' => null,
                    'response' => [
                        'success' => true,
                        'data' => [
                            'id' => 1,
                            'judul' => 'Indikator Mutu A',
                            'slug' => 'indikator-mutu-a',
                            'file_pdf' => 'uploads/indikator_mutu/20231001_1234.pdf',
                            'created_at' => '2023-10-01T12:34:56.000000Z',
                            'updated_at' => '2023-10-01T12:34:56.000000Z',
                        ],
                    ],
                ],
            ],
        ];
    }
}
