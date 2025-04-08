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

// Route yang dapat diakses tanpa autentikasi (index dan show)
Route::middleware(['encrypt.response'])->group(function () {
    // LayananUnggulan
    Route::get('layanan-unggulan', [LayananUnggulanController::class, 'index']);

    // LayananSpesialis
    Route::get('layanan-spesialis', [LayananSpesialisController::class, 'index']);

    // LayananFasilitas
    Route::get('layanan-fasilitas', [LayananFasilitasController::class, 'index']);

    // JadwalDokter
    Route::get('jadwal-dokter', [JadwalDokterController::class, 'index']);

    // PaketKesehatan
    Route::get('paket-kesehatan', [PaketKesehatanController::class, 'index']);

    // ArtikelKesehatan
    Route::get('artikel-kesehatan', [ArtikelKesehatanController::class, 'index']);

    // EventCommunity
    Route::get('event-community', [EventCommunityController::class, 'index']);

    // IndikatorMutu
    Route::get('indikator-mutu', [IndikatorMutuController::class, 'index']);

    // Karir
    Route::get('karir', [KarirController::class, 'index']);

    // KontenSocialMedia
    Route::get('konten-social-media', [KontenSocialMediaController::class, 'index']);

    // SertifikasiPenghargaan
    Route::get('sertifikasi-penghargaan', [SertifikasiPenghargaanController::class, 'index']);

    // MasterKategori
    Route::get('master-kategori', [MasterKategoriController::class, 'index']);

    // MasterDokter
    Route::get('master-dokter', [MasterDokterController::class, 'index']);
});

// Route detail (show) yang dapat diakses tanpa autentikasi
Route::middleware(['decrypt.request', 'encrypt.response'])->group(function () {
    // LayananUnggulan dengan slug
    Route::get('layanan-unggulan/{slug}/{id}', [LayananUnggulanController::class, 'show']);

    // LayananSpesialis dengan slug
    Route::get('layanan-spesialis/{slug}/{id}', [LayananSpesialisController::class, 'show']);

    // LayananFasilitas dengan slug
    Route::get('layanan-fasilitas/{slug}/{id}', [LayananFasilitasController::class, 'show']);

    // JadwalDokter
    Route::get('jadwal-dokter/{id}', [JadwalDokterController::class, 'show']);

    // PaketKesehatan dengan slug
    Route::get('paket-kesehatan/{slug}/{id}', [PaketKesehatanController::class, 'show']);

    // ArtikelKesehatan dengan slug
    Route::get('artikel-kesehatan/{slug}/{id}', [ArtikelKesehatanController::class, 'show']);

    // EventCommunity dengan slug
    Route::get('event-community/{slug}/{id}', [EventCommunityController::class, 'show']);

    // IndikatorMutu dengan slug
    Route::get('indikator-mutu/{slug}/{id}', [IndikatorMutuController::class, 'show']);

    // Karir dengan slug
    Route::get('karir/{slug}/{id}', [KarirController::class, 'show']);

    // KontenSocialMedia
    Route::get('konten-social-media/{id}', [KontenSocialMediaController::class, 'show']);

    // SertifikasiPenghargaan dengan slug
    Route::get('sertifikasi-penghargaan/{slug}/{id}', [SertifikasiPenghargaanController::class, 'show']);

    // MasterKategori
    Route::get('master-kategori/{id}', [MasterKategoriController::class, 'show']);

    // MasterDokter
    Route::get('master-dokter/{id}', [MasterDokterController::class, 'show']);
});

// Route yang memerlukan autentikasi (create, update, delete)
Route::middleware('auth:api')->group(function () {
    // Middleware encrypt.response dan recursive.decrypt untuk method POST (store)
    Route::middleware(['encrypt.response', 'recursive.decrypt'])->group(function () {
        // LayananUnggulan
        Route::post('layanan-unggulan', [LayananUnggulanController::class, 'store']);

        // LayananSpesialis
        Route::post('layanan-spesialis', [LayananSpesialisController::class, 'store']);

        // LayananFasilitas
        Route::post('layanan-fasilitas', [LayananFasilitasController::class, 'store']);

        // JadwalDokter
        Route::post('jadwal-dokter', [JadwalDokterController::class, 'store']);

        // PaketKesehatan
        Route::post('paket-kesehatan', [PaketKesehatanController::class, 'store']);

        // ArtikelKesehatan
        Route::post('artikel-kesehatan', [ArtikelKesehatanController::class, 'store']);

        // EventCommunity
        Route::post('event-community', [EventCommunityController::class, 'store']);

        // IndikatorMutu
        Route::post('indikator-mutu', [IndikatorMutuController::class, 'store']);

        // Karir
        Route::post('karir', [KarirController::class, 'store']);

        // KontenSocialMedia
        Route::post('konten-social-media', [KontenSocialMediaController::class, 'store']);

        // SertifikasiPenghargaan
        Route::post('sertifikasi-penghargaan', [SertifikasiPenghargaanController::class, 'store']);

        // MasterKategori
        Route::post('master-kategori', [MasterKategoriController::class, 'store']);

        // MasterDokter
        Route::post('master-dokter', [MasterDokterController::class, 'store']);
    });

    // Middleware decrypt.request dan encrypt.response untuk method yang membutuhkan id (update, delete)
    Route::middleware(['decrypt.request', 'recursive.decrypt', 'encrypt.response'])->group(function () {
        // LayananUnggulan
        Route::put('layanan-unggulan/{id}', [LayananUnggulanController::class, 'update']);
        Route::delete('layanan-unggulan/{id}', [LayananUnggulanController::class, 'destroy']);

        // LayananSpesialis
        Route::put('layanan-spesialis/{id}', [LayananSpesialisController::class, 'update']);
        Route::delete('layanan-spesialis/{id}', [LayananSpesialisController::class, 'destroy']);

        // LayananFasilitas
        Route::put('layanan-fasilitas/{id}', [LayananFasilitasController::class, 'update']);
        Route::delete('layanan-fasilitas/{id}', [LayananFasilitasController::class, 'destroy']);

        // JadwalDokter
        Route::put('jadwal-dokter/{id}', [JadwalDokterController::class, 'update']);
        Route::delete('jadwal-dokter/{id}', [JadwalDokterController::class, 'destroy']);

        // PaketKesehatan
        Route::put('paket-kesehatan/{id}', [PaketKesehatanController::class, 'update']);
        Route::delete('paket-kesehatan/{id}', [PaketKesehatanController::class, 'destroy']);

        // ArtikelKesehatan
        Route::put('artikel-kesehatan/{id}', [ArtikelKesehatanController::class, 'update']);
        Route::delete('artikel-kesehatan/{id}', [ArtikelKesehatanController::class, 'destroy']);

        // EventCommunity
        Route::put('event-community/{id}', [EventCommunityController::class, 'update']);
        Route::delete('event-community/{id}', [EventCommunityController::class, 'destroy']);

        // IndikatorMutu
        Route::put('indikator-mutu/{id}', [IndikatorMutuController::class, 'update']);
        Route::delete('indikator-mutu/{id}', [IndikatorMutuController::class, 'destroy']);

        // Karir
        Route::put('karir/{id}', [KarirController::class, 'update']);
        Route::delete('karir/{id}', [KarirController::class, 'destroy']);

        // KontenSocialMedia
        Route::put('konten-social-media/{id}', [KontenSocialMediaController::class, 'update']);
        Route::delete('konten-social-media/{id}', [KontenSocialMediaController::class, 'destroy']);

        // SertifikasiPenghargaan
        Route::put('sertifikasi-penghargaan/{id}', [SertifikasiPenghargaanController::class, 'update']);
        Route::delete('sertifikasi-penghargaan/{id}', [SertifikasiPenghargaanController::class, 'destroy']);

        // MasterKategori
        Route::put('master-kategori/{id}', [MasterKategoriController::class, 'update']);
        Route::delete('master-kategori/{id}', [MasterKategoriController::class, 'destroy']);

        // MasterDokter
        Route::put('master-dokter/{id}', [MasterDokterController::class, 'update']);
        Route::delete('master-dokter/{id}', [MasterDokterController::class, 'destroy']);
    });
});
