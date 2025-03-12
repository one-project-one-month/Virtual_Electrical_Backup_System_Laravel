<?php


use App\Http\Controllers\Api\BatteryController;
use App\Http\Middleware\MustBeAdmin;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\BatteryTypeController;
use App\Http\Controllers\Api\Brand\BrandController;
use App\Http\Controllers\Api\Test\TestCategoryController;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\GeneratorController;
use Illuminate\Container\Attributes\Auth;
// use App\Http\Controllers\Api\Test\TestCategoryController;
use App\Http\Controllers\Api\InverterType\InverterTypeController;
use App\Http\Controllers\Api\SetupController;
use App\Http\Controllers\InverterController;
use App\Http\Controllers\TestingController;


Route::post('v1/auth/admin/signin', [AuthController::class, 'signin']);

Route::prefix('v1')->middleware(['auth:sanctum'])->group(function () {
    Route::apiResource('test-categories', TestCategoryController::class);
    Route::delete('auth/admin/logout', [AuthController::class, 'logout']);

    Route::post('change/password', [AuthController::class, 'changePassword']);

    Route::prefix('admin/')->middleware(MustBeAdmin::class)->group(function () {});
    Route::apiResource('inverter-types', InverterTypeController::class);

    Route::apiResource('/generators', GeneratorController::class);


    Route::apiResource('/brand', BrandController::class);

    Route::apiResource('/battery_types', BatteryTypeController::class);
    Route::apiResource('/battery', BatteryController::class);

    Route::apiResource('/inverters', InverterController::class);

    Route::apiResource('/setups', SetupController::class);
});

Route::post('/calculate', [TestingController::class, 'calculate']);
