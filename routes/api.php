<?php

use App\Http\Controllers\Api\Test\TestCategoryController;
use App\Http\Controllers\AuthController;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Support\Facades\Route;

Route::post('v1/auth/admin/signin', [AuthController::class, 'signin']);
Route::prefix('v1')->middleware(['auth:sanctum'])->group(function () {
    Route::apiResource('test-categories', TestCategoryController::class);
    Route::delete('auth/admin/logout', [AuthController::class, 'logout']);
});
