<?php

use App\Http\Controllers\Api\AuthenticationController;
use App\Http\Controllers\ApiDocumentationController;
use App\Http\Controllers\CareerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CertificationAwardController;
use App\Http\Controllers\CommunityEventController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\DoctorScheduleController;
use App\Http\Controllers\FacilityServiceController;
use App\Http\Controllers\FeaturedServiceController;
use App\Http\Controllers\HealthArticleController;
use App\Http\Controllers\HealthPackageController;
use App\Http\Controllers\QualityIndicatorController;
use App\Http\Controllers\SocialMediaContentController;
use App\Http\Controllers\SpecialistServiceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::post('login', [AuthenticationController::class, 'login'])->middleware('throttle:10,1')->name('login');
Route::get('api-documentation/models', [ApiDocumentationController::class, 'getAvailableModels']);

Route::middleware(['encrypt.response'])->group(function () {
    Route::get('featured-services', [FeaturedServiceController::class, 'index']);

    Route::get('specialist-services', [SpecialistServiceController::class, 'index']);

    Route::get('facility-services', [FacilityServiceController::class, 'index']);

    Route::get('doctor-schedules', [DoctorScheduleController::class, 'index']);

    Route::get('health-packages', [HealthPackageController::class, 'index']);

    Route::get('health-articles', [HealthArticleController::class, 'index']);

    Route::get('community-events', [CommunityEventController::class, 'index']);

    Route::get('quality-indicators', [QualityIndicatorController::class, 'index']);

    Route::get('careers', [CareerController::class, 'index']);

    Route::get('social-media-contents', [SocialMediaContentController::class, 'index']);

    Route::get('certification-awards', [CertificationAwardController::class, 'index']);

    Route::get('categories', [CategoryController::class, 'index']);

    Route::get('doctors', [DoctorController::class, 'index']);
});

Route::middleware(['decrypt.request', 'encrypt.response'])->group(function () {
    Route::get('featured-services/{slug}/{id}', [FeaturedServiceController::class, 'show']);

    Route::get('specialist-services/{slug}/{id}', [SpecialistServiceController::class, 'show']);

    Route::get('facility-services/{slug}/{id}', [FacilityServiceController::class, 'show']);

    Route::get('doctor-schedules/{id}', [DoctorScheduleController::class, 'show']);

    Route::get('health-packages/{slug}/{id}', [HealthPackageController::class, 'show']);

    Route::get('health-articles/{slug}/{id}', [HealthArticleController::class, 'show']);

    Route::get('community-events/{slug}/{id}', [CommunityEventController::class, 'show']);

    Route::get('quality-indicators/{slug}/{id}', [QualityIndicatorController::class, 'show']);

    Route::get('careers/{slug}/{id}', [CareerController::class, 'show']);

    Route::get('social-media-contents/{id}', [SocialMediaContentController::class, 'show']);

    Route::get('certification-awards/{slug}/{id}', [CertificationAwardController::class, 'show']);

    Route::get('categories/{id}', [CategoryController::class, 'show']);

    Route::get('doctors/{id}', [DoctorController::class, 'show']);
});

Route::middleware('auth:api')->group(function () {
    Route::middleware(['recursive.decrypt', 'encrypt.response'])->group(function () {
        Route::put('social-media-contents/{type}', [SocialMediaContentController::class, 'update'])
            ->whereIn('type', ['youtube', 'instagram']);
    });

    Route::post('register', [AuthenticationController::class, 'register'])->name('register');

    Route::middleware(['encrypt.response', 'recursive.decrypt'])->group(function () {
        Route::post('featured-services', [FeaturedServiceController::class, 'store']);

        Route::post('specialist-services', [SpecialistServiceController::class, 'store']);

        Route::post('facility-services', [FacilityServiceController::class, 'store']);

        Route::post('doctor-schedules', [DoctorScheduleController::class, 'store']);

        Route::post('health-packages', [HealthPackageController::class, 'store']);

        Route::post('health-articles', [HealthArticleController::class, 'store']);

        Route::post('community-events', [CommunityEventController::class, 'store']);

        Route::post('quality-indicators', [QualityIndicatorController::class, 'store']);

        Route::post('careers', [CareerController::class, 'store']);

        Route::post('social-media-contents', [SocialMediaContentController::class, 'store']);

        Route::post('certification-awards', [CertificationAwardController::class, 'store']);

        Route::post('categories', [CategoryController::class, 'store']);

        Route::post('doctors', [DoctorController::class, 'store']);
    });

    Route::middleware(['decrypt.request', 'recursive.decrypt', 'encrypt.response'])->group(function () {
        Route::put('featured-services/{id}', [FeaturedServiceController::class, 'update']);
        Route::delete('featured-services/{id}', [FeaturedServiceController::class, 'destroy']);

        Route::put('specialist-services/{id}', [SpecialistServiceController::class, 'update']);
        Route::delete('specialist-services/{id}', [SpecialistServiceController::class, 'destroy']);

        Route::put('facility-services/{id}', [FacilityServiceController::class, 'update']);
        Route::delete('facility-services/{id}', [FacilityServiceController::class, 'destroy']);

        Route::put('doctor-schedules/{id}', [DoctorScheduleController::class, 'update']);
        Route::delete('doctor-schedules/{id}', [DoctorScheduleController::class, 'destroy']);

        Route::put('health-packages/{id}', [HealthPackageController::class, 'update']);
        Route::delete('health-packages/{id}', [HealthPackageController::class, 'destroy']);

        Route::put('health-articles/{id}', [HealthArticleController::class, 'update']);
        Route::delete('health-articles/{id}', [HealthArticleController::class, 'destroy']);

        Route::put('community-events/{id}', [CommunityEventController::class, 'update']);
        Route::delete('community-events/{id}', [CommunityEventController::class, 'destroy']);

        Route::put('quality-indicators/{id}', [QualityIndicatorController::class, 'update']);
        Route::delete('quality-indicators/{id}', [QualityIndicatorController::class, 'destroy']);

        Route::put('careers/{id}', [CareerController::class, 'update']);
        Route::delete('careers/{id}', [CareerController::class, 'destroy']);

        Route::delete('social-media-contents/{id}', [SocialMediaContentController::class, 'destroy']);

        Route::put('certification-awards/{id}', [CertificationAwardController::class, 'update']);
        Route::delete('certification-awards/{id}', [CertificationAwardController::class, 'destroy']);

        Route::put('categories/{id}', [CategoryController::class, 'update']);
        Route::delete('categories/{id}', [CategoryController::class, 'destroy']);

        Route::put('doctors/{id}', [DoctorController::class, 'update']);
        Route::delete('doctors/{id}', [DoctorController::class, 'destroy']);
    });
});
