<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\UserController;

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

Route::post('register-step-1', [UserController::class, 'registerStep1']);
Route::post('register-step-2', [UserController::class, 'registerStep2']);
Route::post('register-step-3', [UserController::class, 'registerStep3']);

Route::post('login', [UserController::class, 'login']);