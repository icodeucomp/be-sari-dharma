<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class SpecialistService extends Model
{
    use HasFactory;

    protected $table = 'specialist_services';

    protected $fillable = [
        'name',
        'description',
        'icon',
    ];

    protected $appends = ['slug'];

    public function getSlugAttribute()
    {
        return Str::slug($this->name);
    }

    public function doctorSchedules()
    {
        return $this->hasMany(DoctorSchedule::class, 'specialist_id');
    }

    public function doctors()
    {
        return $this->belongsToMany(Doctor::class, 'doctor_schedules', 'specialist_id', 'doctor_id')
            ->withTimestamps();
    }

    public static function storeValidationRules()
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'required|string|max:255',
            'doctor_ids' => 'nullable|array',
            'doctor_ids.*' => 'required|string',
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
                'description' => 'string',
                'icon' => 'string',
                'doctor_ids' => 'array of doctors IDs',
                'slug' => 'string (URL friendly version of name)',
            ],
            'endpoints' => [
                'get_all' => [
                    'url' => '/api/specialist-services',
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
                                    'name' => 'Specialist A',
                                    'slug' => 'specialist-a',
                                    'description' => 'Specialist Description A',
                                    'icon' => 'mdi mdi-account',
                                    'created_at' => '2023-10-01T12:34:56.000000Z',
                                    'updated_at' => '2023-10-01T12:34:56.000000Z',
                                ],
                            ],
                            'first_page_url' => 'http://localhost/api/specialist-services?page=1',
                            'from' => 1,
                            'last_page' => 1,
                            'last_page_url' => 'http://localhost/api/specialist-services?page=1',
                            'next_page_url' => null,
                            'path' => 'http://localhost/api/specialist-services',
                            'per_page' => 10,
                            'prev_page_url' => null,
                            'to' => 1,
                            'total' => 1,
                        ],
                    ],
                ],
                'create' => [
                    'url' => '/api/specialist-services',
                    'method' => 'POST',
                    'payload' => [
                        'name' => 'string',
                        'description' => 'string',
                        'icon' => 'string',
                        'doctor_ids' => [1, 2, 3],
                    ],
                    'validations' => self::storeValidationRules(),
                    'response' => [
                        'success' => true,
                        'data' => [
                            'id' => 1,
                            'name' => 'Specialist A',
                            'description' => 'Specialist Description A',
                            'icon' => 'mdi mdi-account',
                            'doctor' => [
                                [
                                    'id' => 1,
                                    'name' => 'Dr. John Doe',
                                    'doctor_background' => 'Doctor background...',
                                    'photo' => 'uploads/doctor/20231001_1234.jpg',
                                    'pivot' => [
                                        'specialist_id' => 1,
                                        'doctor_id' => 1,
                                    ],
                                ],
                            ],
                            'created_at' => '2023-10-01T12:34:56.000000Z',
                            'updated_at' => '2023-10-01T12:34:56.000000Z',
                        ],
                    ],
                ],
                'update' => [
                    'url' => '/api/specialist-services/{id}',
                    'method' => 'PUT',
                    'payload' => [
                        'name' => 'string',
                        'description' => 'string',
                        'icon' => 'string',
                        'doctor_ids' => [1, 2, 3],
                    ],
                    'validations' => self::updateValidationRules(),
                    'response' => [
                        'success' => true,
                        'data' => [
                            'id' => 1,
                            'name' => 'Specialist A (Updated)',
                            'description' => 'Specialist Description A (Updated)',
                            'icon' => 'mdi mdi-account',
                            'doctor' => [
                                [
                                    'id' => 2,
                                    'name' => 'Dr. Jane Smith',
                                    'doctor_background' => 'Doctor background...',
                                    'photo' => 'uploads/doctor/20231001_1235.jpg',
                                    'pivot' => [
                                        'specialist_id' => 1,
                                        'doctor_id' => 2,
                                    ],
                                ],
                            ],
                            'created_at' => '2023-10-01T12:34:56.000000Z',
                            'updated_at' => '2023-10-01T12:35:56.000000Z',
                        ],
                    ],
                ],
                'delete' => [
                    'url' => '/api/specialist-services/{id}',
                    'method' => 'DELETE',
                    'payload' => null,
                    'validations' => null,
                    'response' => [
                        'success' => true,
                        'message' => 'Data deleted successfully',
                    ],
                ],
                'show' => [
                    'url' => '/api/specialist-services/{slug}/{id}',
                    'method' => 'GET',
                    'payload' => null,
                    'validations' => null,
                    'response' => [
                        'success' => true,
                        'data' => [
                            'id' => 1,
                            'name' => 'Specialist A',
                            'slug' => 'specialist-a',
                            'description' => 'Specialist Description A',
                            'icon' => 'mdi mdi-account',
                            'doctor' => [
                                [
                                    'id' => 1,
                                    'name' => 'Dr. John Doe',
                                    'photo' => 'uploads/doctor/20231001_1234.jpg',
                                    'pivot' => [
                                        'specialist_id' => 1,
                                        'doctor_id' => 1,
                                    ],
                                ],
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
