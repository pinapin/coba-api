<?php

use App\Http\Controllers\MahasiswaController;
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

// Route::resource('/mahasiswa', MahasiswaController::class);
Route::prefix('mahasiswa')->group(function () {
    Route::get('/', [MahasiswaController::class, 'index']);
    Route::post('/', [MahasiswaController::class, 'store']);
    Route::get('/{id}', [MahasiswaController::class, 'show']);
    Route::post('/update/{id}', [MahasiswaController::class, 'update']);
    Route::get('/delete/{id}', [MahasiswaController::class, 'destroy']);
});
