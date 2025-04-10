<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\MediaCardController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Task API routes
Route::get('/tasks', [TaskController::class, 'index']);
Route::post('/tasks', [TaskController::class, 'store']);
Route::get('/tasks/{task}', [TaskController::class, 'show']);
Route::put('/tasks/{task}', [TaskController::class, 'update']);
Route::delete('/tasks/{task}', [TaskController::class, 'destroy']);

// Media Card API routes
Route::get('/media_cards', [MediaCardController::class, 'index']);
Route::post('/media_cards', [MediaCardController::class, 'store']);
Route::get('/media_cards/{media_card}', [MediaCardController::class, 'show']);
Route::put('/media_cards/{media_card}', [MediaCardController::class, 'update']);
Route::delete('/media_cards/{media_card}', [MediaCardController::class, 'destroy']);
