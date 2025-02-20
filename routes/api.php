<?php

use App\Http\Controllers\Api\Test\TestCategoryController;
use App\Http\Controllers\GeneratorController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->middleware(['auth:sanctum'])->group(function () {
    Route::apiResource('test-categories', TestCategoryController::class);
    
    Route::apiResource('generator', GeneratorController::class);
});
