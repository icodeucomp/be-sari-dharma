<?php

use App\Http\Controllers\Api\AuthenticationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LayananUnggulanController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiDocumentationController;
use App\Http\Controllers\ArtikelKesehatanController;
use App\Http\Controllers\EventCommunityController;
use App\Http\Controllers\IndikatorMutuController;
use App\Http\Controllers\JadwalDokterController;
use App\Http\Controllers\KarirController;
use App\Http\Controllers\KontenSocialMediaController;
use App\Http\Controllers\LayananSpesialisController;
use App\Http\Controllers\LayananFasilitasController;
use App\Http\Controllers\PaketKesehatanController;
use App\Http\Controllers\SertifikasiPenghargaanController;
use App\Http\Controllers\MasterKategoriController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::post('register', [AuthenticationController::class, 'register'])->name('register');
Route::post('login', [AuthenticationController::class, 'login'])->name('login');
Route::get('api-documentation/models', [ApiDocumentationController::class, 'getAvailableModels']);

Route::middleware('auth:api')->group(function () {
    Route::apiResource('layanan-unggulan', LayananUnggulanController::class);
    Route::apiResource('layanan-spesialis', LayananSpesialisController::class);
    Route::apiResource('layanan-fasilitas', LayananFasilitasController::class);
    Route::apiResource('jadwal-dokter', JadwalDokterController::class);
    Route::apiResource('paket-kesehatan', PaketKesehatanController::class); // Tambahkan ini
    Route::apiResource('artikel-kesehatan', ArtikelKesehatanController::class); // Tambahkan ini
    Route::apiResource('event-community', EventCommunityController::class); // Tambahkan ini
    Route::apiResource('indikator-mutu', IndikatorMutuController::class); // Tambahkan ini
    Route::apiResource('karir', KarirController::class); // Tambahkan ini
    Route::apiResource('konten-social-media', KontenSocialMediaController::class); // Tambahkan ini
    Route::apiResource('sertifikasi-penghargaan', SertifikasiPenghargaanController::class); // Tambahkan ini
    Route::apiResource('master-kategori', MasterKategoriController::class); // Tambahkan ini
});
