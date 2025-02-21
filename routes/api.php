<?php

use App\Http\Controllers\Api\Test\TestCategoryController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->middleware(middleware: ['auth:sanctum'])->group(function () {
    Route::apiResource('test-categories', TestCategoryController::class);
});
