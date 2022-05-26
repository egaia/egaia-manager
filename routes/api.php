<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChallengeController;
use App\Http\Controllers\CollectPointController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\WasteCategoryController;
use App\Http\Controllers\WasteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('auth')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::get('user', [AuthController::class, 'getByApiToken']);
    Route::get('check-password', [AuthController::class, 'checkPasswordValid'])->middleware('auth:api');
    Route::post('update', [AuthController::class, 'update'])->middleware('auth:api');
});

Route::middleware('auth:api')->group(function () {
    Route::prefix('challenges')->group(function () {
        Route::get('', [ChallengeController::class, 'all']);
        Route::get('/user', [ChallengeController::class, 'getByUser']);
        Route::post('/participate', [ChallengeController::class, 'participate']);
    });

});

Route::prefix('promotions')->group(function () {
    Route::get('', [PromotionController::class, 'all']);
    Route::get('/{id}', [PromotionController::class, 'find']);
    Route::post('', [PromotionController::class, 'store'])->middleware('auth:api');
});

Route::prefix('waste-categories')->group(function () {
    Route::get('', [WasteCategoryController::class, 'all']);
    Route::get('/{id}', [WasteCategoryController::class, 'show']);
});

Route::prefix('wastes')->group(function () {
    Route::get('', [WasteController::class, 'all']);
    Route::get('/{id}', [WasteController::class, 'show']);
});

Route::prefix('collect-points')->group(function () {
    Route::get('', [CollectPointController::class, 'getAll']);
});
