<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/users', [App\Http\Controllers\ApiController::class, 'users']);


Route::get('/token_error', function () {
    return response()->json(['error' => 'Token Invalido'], 401);
})->name('token_error');


// Route::get('/users', [App\Http\Controllers\ApiController::class, 'users']);

Route::post('/login', [App\Http\Controllers\ApiController::class, 'login']);

Route::post('/register', [App\Http\Controllers\ApiController::class, 'register']);