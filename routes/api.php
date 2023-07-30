<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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

Route::prefix('v1/')->group(function() {
    Route::controller(AuthController::class)->prefix('auth')->name('auth')->group(function() {
        Route::post('login', 'login')->name('.login');
        Route::post('register', 'register')->name('.register');

        Route::middleware('auth:sanctum')->group(function () {
            Route::post('logout', 'logout')->name('.logout');
            Route::get('me', 'me')->name('.me');
            Route::put('{uid}/update', 'update')->name('.update');
            Route::delete('{uid}/delete', 'delete')->name('.delete');
        });
    });
});


