<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalDokter extends Model
{
    use HasFactory;

    protected $table = 'jadwal_dokter';

    protected $fillable = [
        'nama_dokter',
        'spesialis',
        'background_dokter',
        'jadwal_dokter',
        'edukasi_karir',
        'foto',
    ];

    protected $casts = [
        'jadwal_dokter' => 'array', // Cast JSON field to array
        'edukasi_karir' => 'array', // Cast JSON field to array
    ];

    public static function storeValidationRules()
    {
        return [
            'nama_dokter' => 'required|string|max:255',
            'spesialis' => 'required|string|max:255',
            'background_dokter' => 'nullable|string',
            'jadwal_dokter' => 'required|array',
            'jadwal_dokter.*.hari' => 'required|string|max:255',
            'jadwal_dokter.*.jam_mulai' => 'required|string|max:255',
            'jadwal_dokter.*.jam_selesai' => 'required|string|max:255',
            'edukasi_karir' => 'required|array',
            'edukasi_karir.*.judul' => 'required|string|max:255',
            'edukasi_karir.*.tahun_mulai' => 'required|integer',
            'edukasi_karir.*.tahun_selesai' => 'nullable|integer',
            'foto' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
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
                'nama_dokter' => 'string',
                'spesialis' => 'string',
                'background_dokter' => 'string',
                'jadwal_dokter' => 'array of objects (hari, jam_mulai, jam_selesai)',
                'edukasi_karir' => 'array of objects (judul, tahun_mulai, tahun_selesai)',
                'foto' => 'string (path to file)',
            ],
            'endpoints' => [
                'get_all' => [
                    'url' => '/api/jadwal-dokter',
                    'method' => 'GET',
                    'payload' => null,
                    'validations' => null,
                    'query_params' => [
                        'search' => 'string (for filtering by nama_dokter)',
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
                                    'nama_dokter' => 'Dr. John Doe',
                                    'spesialis' => 'Spesialis A',
                                    'background_dokter' => 'Background Dokter A',
                                    'jadwal_dokter' => [
                                        ['hari' => 'Senin', 'jam_mulai' => '08:00', 'jam_selesai' => '12:00'],
                                        ['hari' => 'Rabu', 'jam_mulai' => '13:00', 'jam_selesai' => '17:00'],
                                    ],
                                    'edukasi_karir' => [
                                        ['judul' => 'Pendidikan A', 'tahun_mulai' => 2010, 'tahun_selesai' => 2014],
                                        ['judul' => 'Karir B', 'tahun_mulai' => 2015, 'tahun_selesai' => null],
                                    ],
                                    'foto' => 'uploads/jadwal_dokter/20231001_1234.jpg',
                                    'created_at' => '2023-10-01T12:34:56.000000Z',
                                    'updated_at' => '2023-10-01T12:34:56.000000Z',
                                ],
                            ],
                            'first_page_url' => 'http://localhost/api/jadwal-dokter?page=1',
                            'from' => 1,
                            'last_page' => 1,
                            'last_page_url' => 'http://localhost/api/jadwal-dokter?page=1',
                            'next_page_url' => null,
                            'path' => 'http://localhost/api/jadwal-dokter',
                            'per_page' => 10,
                            'prev_page_url' => null,
                            'to' => 1,
                            'total' => 1
                        ],
                    ],
                ],
                'create' => [
                    'url' => '/api/jadwal-dokter',
                    'method' => 'POST',
                    'payload' => [
                        'nama_dokter' => 'string',
                        'spesialis' => 'string',
                        'background_dokter' => 'string',
                        'jadwal_dokter' => [
                            ['hari' => 'string', 'jam_mulai' => 'string', 'jam_selesai' => 'string'],
                        ],
                        'edukasi_karir' => [
                            ['judul' => 'string', 'tahun_mulai' => 'integer', 'tahun_selesai' => 'integer'],
                        ],
                        'foto' => 'file',
                    ],
                    'validations' => self::storeValidationRules(),
                    'response' => [
                        'success' => true,
                        'data' => [
                            'id' => 1,
                            'nama_dokter' => 'Dr. John Doe',
                            'spesialis' => 'Spesialis A',
                            'background_dokter' => 'Background Dokter A',
                            'jadwal_dokter' => [
                                ['hari' => 'Senin', 'jam_mulai' => '08:00', 'jam_selesai' => '12:00'],
                            ],
                            'edukasi_karir' => [
                                ['judul' => 'Pendidikan A', 'tahun_mulai' => 2010, 'tahun_selesai' => 2014],
                            ],
                            'foto' => 'uploads/jadwal_dokter/20231001_1234.jpg',
                            'created_at' => '2023-10-01T12:34:56.000000Z',
                            'updated_at' => '2023-10-01T12:34:56.000000Z',
                        ],
                    ],
                ],
                'update' => [
                    'url' => '/api/jadwal-dokter/{id}',
                    'method' => 'PUT',
                    'payload' => [
                        'nama_dokter' => 'string',
                        'spesialis' => 'string',
                        'background_dokter' => 'string',
                        'jadwal_dokter' => [
                            ['hari' => 'string', 'jam_mulai' => 'string', 'jam_selesai' => 'string'],
                        ],
                        'edukasi_karir' => [
                            ['judul' => 'string', 'tahun_mulai' => 'integer', 'tahun_selesai' => 'integer'],
                        ],
                        'foto' => 'file',
                    ],
                    'validations' => self::updateValidationRules(),
                    'response' => [
                        'success' => true,
                        'data' => [
                            'id' => 1,
                            'nama_dokter' => 'Dr. John Doe (Updated)',
                            'spesialis' => 'Spesialis B',
                            'background_dokter' => 'Background Dokter B',
                            'jadwal_dokter' => [
                                ['hari' => 'Selasa', 'jam_mulai' => '09:00', 'jam_selesai' => '13:00'],
                            ],
                            'edukasi_karir' => [
                                ['judul' => 'Pendidikan B', 'tahun_mulai' => 2015, 'tahun_selesai' => 2019],
                            ],
                            'foto' => 'uploads/jadwal_dokter/20231001_1235.jpg',
                            'created_at' => '2023-10-01T12:34:56.000000Z',
                            'updated_at' => '2023-10-01T12:35:56.000000Z',
                        ],
                    ],
                ],
                'delete' => [
                    'url' => '/api/jadwal-dokter/{id}',
                    'method' => 'DELETE',
                    'payload' => null,
                    'validations' => null,
                    'response' => [
                        'success' => true,
                        'message' => 'Data deleted successfully',
                    ],
                ],
            ],
        ];
    }
}
