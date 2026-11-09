<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorSchedule extends Model
{
    use HasFactory;

    protected $table = 'doctor_schedules';

    protected $fillable = [
        'doctor_id',
        'specialist_id',
        'doctor_background',
        'schedule',
        'education_career',
    ];

    protected $casts = [
        'schedule' => 'array',
        'education_career' => 'array',
    ];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }

    public function specialist()
    {
        return $this->belongsTo(SpecialistService::class, 'specialist_id');
    }

    public static function storeValidationRules()
    {
        return [
            'doctor_id' => 'required|integer|min:1',
            'specialist_id' => 'required|integer|min:1',
            'doctor_background' => 'nullable|string',
            'schedule' => 'required',
            'education_career' => 'required',
        ];
    }

    public function getScheduleAttribute($value)
    {
        if (is_string($value)) {
            $decoded = json_decode($value, true);

            return is_array($decoded) ? $decoded : [];
        }

        return $value ?? [];
    }

    public function getEducationCareerAttribute($value)
    {
        if (is_string($value)) {
            $decoded = json_decode($value, true);

            return is_array($decoded) ? $decoded : [];
        }

        return $value ?? [];
    }

    public function setScheduleAttribute($value)
    {
        if (is_string($value)) {
            $decoded = json_decode($value, true);
            $this->attributes['schedule'] = json_encode(is_array($decoded) ? $decoded : []);
        } else {
            $this->attributes['schedule'] = json_encode($value ?? []);
        }
    }

    public function setEducationCareerAttribute($value)
    {
        if (is_string($value)) {
            $decoded = json_decode($value, true);
            $this->attributes['education_career'] = json_encode(is_array($decoded) ? $decoded : []);
        } else {
            $this->attributes['education_career'] = json_encode($value ?? []);
        }
    }

    public static function updateValidationRules()
    {
        return self::storeValidationRules();
    }

    public static function validateRelations($data)
    {
        $errors = [];

        if (isset($data['doctor_id'])) {
            $doctorExists = Doctor::find($data['doctor_id']);
            if (! $doctorExists) {
                $errors['doctor_id'] = ['Doctor not found.'];
            }
        }

        if (isset($data['specialist_id'])) {
            $specialistExists = SpecialistService::find($data['specialist_id']);
            if (! $specialistExists) {
                $errors['specialist_id'] = ['Specialist not found.'];
            }
        }

        return $errors;
    }

    public static function getApiDocumentation()
    {
        return [
            'fields' => [
                'doctor_id' => 'integer (foreign key to doctors)',
                'specialist_id' => 'integer (foreign key to specialist_services)',
                'doctor_background' => 'string',
                'schedule' => 'array of objects (day, start_time, end_time)',
                'education_career' => 'array of objects (title, start_year, end_year)',
            ],
            'endpoints' => [
                'get_all' => [
                    'url' => '/api/doctor-schedules',
                    'method' => 'GET',
                    'payload' => null,
                    'validations' => null,
                    'query_params' => [
                        'search' => 'string (to filter by name via relation)',
                        'doctor_id' => 'string (encrypted ID to filter by doctor)',
                        'specialist_id' => 'string (encrypted ID to filter by specialist)',
                        'day' => 'string (to filter by day in schedule, e.g. Senin)',
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
                                    'doctor_id' => 1,
                                    'specialist_id' => 1,
                                    'doctor_background' => 'Doctor Background A',
                                    'schedule' => [
                                        ['day' => 'Senin', 'start_time' => '08:00', 'end_time' => '12:00'],
                                        ['day' => 'Rabu', 'start_time' => '13:00', 'end_time' => '17:00'],
                                    ],
                                    'education_career' => [
                                        ['title' => 'Pendidikan A', 'start_year' => 2010, 'end_year' => 2014],
                                        ['title' => 'Career B', 'start_year' => 2015, 'end_year' => null],
                                    ],
                                    'created_at' => '2023-10-01T12:34:56.000000Z',
                                    'updated_at' => '2023-10-01T12:34:56.000000Z',
                                ],
                            ],
                            'first_page_url' => 'http://localhost/api/doctor-schedules?page=1',
                            'from' => 1,
                            'last_page' => 1,
                            'last_page_url' => 'http://localhost/api/doctor-schedules?page=1',
                            'next_page_url' => null,
                            'path' => 'http://localhost/api/doctor-schedules',
                            'per_page' => 10,
                            'prev_page_url' => null,
                            'to' => 1,
                            'total' => 1,
                        ],
                    ],
                ],
                'create' => [
                    'url' => '/api/doctor-schedules',
                    'method' => 'POST',
                    'payload' => [
                        'doctor_id' => 'integer',
                        'specialist_id' => 'integer',
                        'doctor_background' => 'string',
                        'schedule' => [
                            ['day' => 'string', 'start_time' => 'string', 'end_time' => 'string'],
                        ],
                        'education_career' => [
                            ['title' => 'string', 'start_year' => 'integer', 'end_year' => 'integer'],
                        ],
                    ],
                    'validations' => self::storeValidationRules(),
                    'response' => [
                        'success' => true,
                        'data' => [
                            'id' => 1,
                            'doctor_id' => 1,
                            'specialist_id' => 1,
                            'doctor_background' => 'Doctor Background A',
                            'schedule' => [
                                ['day' => 'Senin', 'start_time' => '08:00', 'end_time' => '12:00'],
                            ],
                            'education_career' => [
                                ['title' => 'Pendidikan A', 'start_year' => 2010, 'end_year' => 2014],
                            ],
                            'created_at' => '2023-10-01T12:34:56.000000Z',
                            'updated_at' => '2023-10-01T12:34:56.000000Z',
                        ],
                    ],
                ],
                'update' => [
                    'url' => '/api/doctor-schedules/{id}',
                    'method' => 'PUT',
                    'payload' => [
                        'doctor_id' => 'integer',
                        'specialist_id' => 'integer',
                        'doctor_background' => 'string',
                        'schedule' => [
                            ['day' => 'string', 'start_time' => 'string', 'end_time' => 'string'],
                        ],
                        'education_career' => [
                            ['title' => 'string', 'start_year' => 'integer', 'end_year' => 'integer'],
                        ],
                    ],
                    'validations' => self::updateValidationRules(),
                    'response' => [
                        'success' => true,
                        'data' => [
                            'id' => 1,
                            'doctor_id' => 1,
                            'specialist_id' => 1,
                            'doctor_background' => 'Doctor Background B',
                            'schedule' => [
                                ['day' => 'Selasa', 'start_time' => '09:00', 'end_time' => '13:00'],
                            ],
                            'education_career' => [
                                ['title' => 'Pendidikan B', 'start_year' => 2015, 'end_year' => 2019],
                            ],
                            'created_at' => '2023-10-01T12:34:56.000000Z',
                            'updated_at' => '2023-10-01T12:35:56.000000Z',
                        ],
                    ],
                ],
                'delete' => [
                    'url' => '/api/doctor-schedules/{id}',
                    'method' => 'DELETE',
                    'payload' => null,
                    'validations' => null,
                    'response' => [
                        'success' => true,
                        'message' => 'Data deleted successfully',
                    ],
                ],
                'show' => [
                    'url' => '/api/doctor-schedules/{id}',
                    'method' => 'GET',
                    'payload' => null,
                    'validations' => null,
                    'response' => [
                        'success' => true,
                        'data' => [
                            'id' => 1,
                            'doctor_id' => 1,
                            'specialist_id' => 1,
                            'doctor_background' => 'Doctor Background A',
                            'schedule' => [
                                ['day' => 'Senin', 'start_time' => '08:00', 'end_time' => '12:00'],
                                ['day' => 'Rabu', 'start_time' => '13:00', 'end_time' => '17:00'],
                            ],
                            'education_career' => [
                                ['title' => 'Pendidikan A', 'start_year' => 2010, 'end_year' => 2014],
                                ['title' => 'Career B', 'start_year' => 2015, 'end_year' => null],
                            ],
                            'doctor' => [
                                'id' => 1,
                                'name' => 'Dr. John Doe',
                                'photo' => 'uploads/doctor/20231001_1234.jpg',
                            ],
                            'specialist' => [
                                'id' => 1,
                                'name' => 'Specialist A',
                                'description' => 'Specialist Description A',
                                'icon' => 'mdi mdi-account',
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
