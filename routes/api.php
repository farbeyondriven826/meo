<?php

use App\Http\Controllers\api\{
    ApplicationController,
    BuildingPermitFormController,
    BusinessPermitFormController,
    MainController,
    RequirementController
};
use Illuminate\Support\Facades\Route;

Route::post('/register', [MainController::class, 'register']);
Route::post('/login', [MainController::class, 'login']);
Route::prefix('businesspermit')->group(function () {
    Route::get('/', [BusinessPermitFormController::class, 'index']);
    Route::get('/{businessPermitForm}', [BusinessPermitFormController::class, 'show']);
    Route::post('/', [BusinessPermitFormController::class, 'store']);
    Route::post('/changeStatus', [BusinessPermitFormController::class, 'changeStatus']);
});
Route::prefix('buildingpermit')->group(function () {
    Route::get('/', [BuildingPermitFormController::class, 'index']);
    Route::get('/{buildingPermitForm}', [BuildingPermitFormController::class, 'show']);
    Route::post('/', [BuildingPermitFormController::class, 'store']);
    Route::post('/changeStatus', [BuildingPermitFormController::class, 'changeStatus']);
});

Route::middleware('auth:api')->group(function () {
    Route::prefix('application')->group(function () {
        Route::get('/', [ApplicationController::class, 'index']);
        Route::get('/{application}', [ApplicationController::class, 'show']);
        Route::post('/', [ApplicationController::class, 'store']);
        Route::post('/changeStatus', [ApplicationController::class, 'changeStatus']);
    });

    Route::prefix('requirement')->group(function () {
        Route::get('/', [RequirementController::class, 'getClientApplicationRequirementData']);
    });
});
