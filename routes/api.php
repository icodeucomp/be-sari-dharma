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
use App\Http\Controllers\JobController;
use App\Http\Controllers\MasterDokterController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::post('register', [AuthenticationController::class, 'register'])->name('register');
Route::post('login', [AuthenticationController::class, 'login'])->name('login');
Route::get('api-documentation/models', [ApiDocumentationController::class, 'getAvailableModels']);

Route::middleware('auth:api')->group(function () {
    // Middleware encrypt.response untuk method GET (index) dan POST (store)
    Route::middleware(['encrypt.response'])->group(function () {
        // LayananUnggulan
        Route::get('layanan-unggulan', [LayananUnggulanController::class, 'index']);
        Route::post('layanan-unggulan', [LayananUnggulanController::class, 'store']);

        // LayananSpesialis
        Route::get('layanan-spesialis', [LayananSpesialisController::class, 'index']);
        Route::post('layanan-spesialis', [LayananSpesialisController::class, 'store']);

        // LayananFasilitas
        Route::get('layanan-fasilitas', [LayananFasilitasController::class, 'index']);
        Route::post('layanan-fasilitas', [LayananFasilitasController::class, 'store']);

        // JadwalDokter
        Route::get('jadwal-dokter', [JadwalDokterController::class, 'index']);
        Route::post('jadwal-dokter', [JadwalDokterController::class, 'store']);

        // PaketKesehatan
        Route::get('paket-kesehatan', [PaketKesehatanController::class, 'index']);
        Route::post('paket-kesehatan', [PaketKesehatanController::class, 'store']);

        // ArtikelKesehatan
        Route::get('artikel-kesehatan', [ArtikelKesehatanController::class, 'index']);
        Route::post('artikel-kesehatan', [ArtikelKesehatanController::class, 'store']);

        // EventCommunity
        Route::get('event-community', [EventCommunityController::class, 'index']);
        Route::post('event-community', [EventCommunityController::class, 'store']);

        // IndikatorMutu
        Route::get('indikator-mutu', [IndikatorMutuController::class, 'index']);
        Route::post('indikator-mutu', [IndikatorMutuController::class, 'store']);

        // Karir
        Route::get('karir', [KarirController::class, 'index']);
        Route::post('karir', [KarirController::class, 'store']);

        // KontenSocialMedia
        Route::get('konten-social-media', [KontenSocialMediaController::class, 'index']);
        Route::post('konten-social-media', [KontenSocialMediaController::class, 'store']);

        // SertifikasiPenghargaan
        Route::get('sertifikasi-penghargaan', [SertifikasiPenghargaanController::class, 'index']);
        Route::post('sertifikasi-penghargaan', [SertifikasiPenghargaanController::class, 'store']);

        // MasterKategori
        Route::get('master-kategori', [MasterKategoriController::class, 'index']);
        Route::post('master-kategori', [MasterKategoriController::class, 'store']);

        // MasterDokter
        Route::get('master-dokter', [MasterDokterController::class, 'index']);
        Route::post('master-dokter', [MasterDokterController::class, 'store']);
    });

    // Middleware decrypt.request dan encrypt.response untuk method yang membutuhkan id
    Route::middleware(['decrypt.request', 'encrypt.response'])->group(function () {
        // LayananUnggulan dengan slug
        Route::get('layanan-unggulan/{slug}/{id}', [LayananUnggulanController::class, 'show']);
        Route::put('layanan-unggulan/{id}', [LayananUnggulanController::class, 'update']);
        Route::delete('layanan-unggulan/{id}', [LayananUnggulanController::class, 'destroy']);

        // Untuk resource lain tanpa slug

        // LayananSpesialis dengan slug
        Route::get('layanan-spesialis/{slug}/{id}', [LayananSpesialisController::class, 'show']);
        Route::put('layanan-spesialis/{id}', [LayananSpesialisController::class, 'update']);
        Route::delete('layanan-spesialis/{id}', [LayananSpesialisController::class, 'destroy']);

        // LayananFasilitas dengan slug
        Route::get('layanan-fasilitas/{slug}/{id}', [LayananFasilitasController::class, 'show']);
        Route::put('layanan-fasilitas/{id}', [LayananFasilitasController::class, 'update']);
        Route::delete('layanan-fasilitas/{id}', [LayananFasilitasController::class, 'destroy']);

        // JadwalDokter dengan slug
        Route::get('jadwal-dokter/{id}', [JadwalDokterController::class, 'show']);
        Route::put('jadwal-dokter/{id}', [JadwalDokterController::class, 'update']);
        Route::delete('jadwal-dokter/{id}', [JadwalDokterController::class, 'destroy']);

        // PaketKesehatan dengan slug
        Route::get('paket-kesehatan/{slug}/{id}', [PaketKesehatanController::class, 'show']);
        Route::put('paket-kesehatan/{id}', [PaketKesehatanController::class, 'update']);
        Route::delete('paket-kesehatan/{id}', [PaketKesehatanController::class, 'destroy']);

        // ArtikelKesehatan dengan slug
        Route::get('artikel-kesehatan/{slug}/{id}', [ArtikelKesehatanController::class, 'show']);
        Route::put('artikel-kesehatan/{id}', [ArtikelKesehatanController::class, 'update']);
        Route::delete('artikel-kesehatan/{id}', [ArtikelKesehatanController::class, 'destroy']);

        // EventCommunity dengan slug
        Route::get('event-community/{slug}/{id}', [EventCommunityController::class, 'show']);
        Route::put('event-community/{id}', [EventCommunityController::class, 'update']);
        Route::delete('event-community/{id}', [EventCommunityController::class, 'destroy']);

        // IndikatorMutu dengan slug
        Route::get('indikator-mutu/{slug}/{id}', [IndikatorMutuController::class, 'show']);
        Route::put('indikator-mutu/{id}', [IndikatorMutuController::class, 'update']);
        Route::delete('indikator-mutu/{id}', [IndikatorMutuController::class, 'destroy']);

        // Karir dengan slug
        Route::get('karir/{slug}/{id}', [KarirController::class, 'show']);
        Route::put('karir/{id}', [KarirController::class, 'update']);
        Route::delete('karir/{id}', [KarirController::class, 'destroy']);

        // KontenSocialMedia
        Route::get('konten-social-media/{id}', [KontenSocialMediaController::class, 'show']);
        Route::put('konten-social-media/{id}', [KontenSocialMediaController::class, 'update']);
        Route::delete('konten-social-media/{id}', [KontenSocialMediaController::class, 'destroy']);

        // SertifikasiPenghargaan dengan slug
        Route::get('sertifikasi-penghargaan/{slug}/{id}', [SertifikasiPenghargaanController::class, 'show']);
        Route::put('sertifikasi-penghargaan/{id}', [SertifikasiPenghargaanController::class, 'update']);
        Route::delete('sertifikasi-penghargaan/{id}', [SertifikasiPenghargaanController::class, 'destroy']);

        // MasterKategori
        Route::get('master-kategori/{id}', [MasterKategoriController::class, 'show']);
        Route::put('master-kategori/{id}', [MasterKategoriController::class, 'update']);
        Route::delete('master-kategori/{id}', [MasterKategoriController::class, 'destroy']);

        // MasterDokter dengan slug
        Route::get('master-dokter/{id}', [MasterDokterController::class, 'show']);
        Route::put('master-dokter/{id}', [MasterDokterController::class, 'update']);
        Route::delete('master-dokter/{id}', [MasterDokterController::class, 'destroy']);
    });
});
