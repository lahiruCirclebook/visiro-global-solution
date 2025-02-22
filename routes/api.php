<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\StudentApiController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CourseApiController;


/*
|----------------------------------------------------------------------
| API Routes
|----------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Public routes for authentication
Route::post('/login', [AuthController::class, 'login']); // Login route
Route::post('/register', [AuthController::class, 'register']); // Register route

// Protected routes requiring authentication (Sanctum)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']); // Logout route

    // API Routes for Student
    Route::apiResource('students', StudentApiController::class);
    Route::get('/students/search', [StudentApiController::class, 'search']);

    Route::post('/courses', [CourseApiController::class, 'store']);
    Route::delete('/courses/{id}', [CourseApiController::class, 'destroy']);
});
