<?php

namespace App\Http\Controllers;

use App\Models\LayananUnggulan;
use App\Models\LayananSpesialis;
use App\Models\LayananFasilitas;
use App\Models\JadwalDokter; // Tambahkan ini
use App\Models\PaketKesehatan; // Tambahkan ini
use App\Models\ArtikelKesehatan; // Tambahkan ini
use App\Models\EventCommunity; // Tambahkan ini
use App\Models\IndikatorMutu; // Tambahkan ini
use App\Models\Karir; // Tambahkan ini
use App\Models\KontenSocialMedia; // Tambahkan ini
use App\Models\SertifikasiPenghargaan; // Tambahkan ini
use App\Models\MasterKategori; // Tambahkan ini
use App\Models\MasterDokter;

class ApiDocumentationController extends Controller
{
    public function getAvailableModels()
    {
        $models = [
            'Authentication' => [
                'fields' => [
                    'name' => 'string',
                    'email' => 'string',
                    'password' => 'string',
                ],
                'endpoints' => [
                    'register' => [
                        'url' => '/api/register',
                        'method' => 'POST',
                        'payload' => [
                            'name' => 'string',
                            'email' => 'string',
                            'password' => 'string',
                            'password_confirmation' => 'string',
                        ],
                        'validations' => [
                            'name' => 'required|string|max:255',
                            'email' => 'required|string|email|max:255|unique:users',
                            'password' => 'required|string|min:8|confirmed',
                        ],
                        'response' => [
                            'success' => true,
                            'data' => [
                                'user' => [
                                    'id' => 1,
                                    'name' => 'John Doe',
                                    'email' => 'john@example.com',
                                    'created_at' => '2023-10-01T12:34:56.000000Z',
                                    'updated_at' => '2023-10-01T12:34:56.000000Z',
                                ],
                                'token' => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9...',
                            ],
                        ],
                    ],
                    'login' => [
                        'url' => '/api/login',
                        'method' => 'POST',
                        'payload' => [
                            'email' => 'string',
                            'password' => 'string',
                        ],
                        'validations' => [
                            'email' => 'required|string|email',
                            'password' => 'required|string',
                        ],
                        'response' => [
                            'success' => true,
                            'data' => [
                                'user' => [
                                    'id' => 1,
                                    'name' => 'John Doe',
                                    'email' => 'john@example.com',
                                    'created_at' => '2023-10-01T12:34:56.000000Z',
                                    'updated_at' => '2023-10-01T12:34:56.000000Z',
                                ],
                                'token' => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9...',
                            ],
                        ],
                    ],
                ],
            ],
            'LayananUnggulan' => LayananUnggulan::getApiDocumentation(),
            'LayananSpesialis' => LayananSpesialis::getApiDocumentation(),
            'LayananFasilitas' => LayananFasilitas::getApiDocumentation(),
            'JadwalDokter' => JadwalDokter::getApiDocumentation(), // Tambahkan ini
            'PaketKesehatan' => PaketKesehatan::getApiDocumentation(), // Sekarang menampilkan kategori_id
            'ArtikelKesehatan' => ArtikelKesehatan::getApiDocumentation(), // Tambahkan ini
            'EventCommunity' => EventCommunity::getApiDocumentation(), // Tambahkan ini
            'IndikatorMutu' => IndikatorMutu::getApiDocumentation(), // Tambahkan ini
            'Karir' => Karir::getApiDocumentation(), // Tambahkan ini
            'KontenSocialMedia' => KontenSocialMedia::getApiDocumentation(), // Tambahkan ini
            'SertifikasiPenghargaan' => SertifikasiPenghargaan::getApiDocumentation(), // Tambahkan ini
            'MasterKategori' => MasterKategori::getApiDocumentation(), // Tambahkan ini
            'MasterDokter' => MasterDokter::getApiDocumentation(),
        ];

        return response()->json([
            'success' => true,
            'data' => $models,
        ], 200);
    }
}
