<?php

namespace App\Http\Controllers;

use App\Models\Career;
use App\Models\Category;
use App\Models\CertificationAward;
use App\Models\CommunityEvent;
use App\Models\Doctor;
use App\Models\DoctorSchedule;
use App\Models\FacilityService;
use App\Models\FeaturedService;
use App\Models\HealthArticle;
use App\Models\HealthPackage;
use App\Models\QualityIndicator;
use App\Models\SocialMediaContent;
use App\Models\SpecialistService;

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
            'FeaturedService' => FeaturedService::getApiDocumentation(),
            'SpecialistService' => SpecialistService::getApiDocumentation(),
            'FacilityService' => FacilityService::getApiDocumentation(),
            'DoctorSchedule' => DoctorSchedule::getApiDocumentation(),
            'HealthPackage' => HealthPackage::getApiDocumentation(),
            'HealthArticle' => HealthArticle::getApiDocumentation(),
            'CommunityEvent' => CommunityEvent::getApiDocumentation(),
            'QualityIndicator' => QualityIndicator::getApiDocumentation(),
            'Career' => Career::getApiDocumentation(),
            'SocialMediaContent' => SocialMediaContent::getApiDocumentation(),
            'CertificationAward' => CertificationAward::getApiDocumentation(),
            'Category' => Category::getApiDocumentation(),
            'Doctor' => Doctor::getApiDocumentation(),
        ];

        return response()->json([
            'success' => true,
            'data' => $models,
        ], 200);
    }
}
