<?php

use App\Http\Controllers\Api\ApiPresensiController;
use App\Http\Controllers\Api\FileStorageController;
use App\Http\Controllers\Api\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('login', [LoginController::class, 'apiLogin']);
Route::get('file/{FILE}', [FileStorageController::class, 'DownloadFile']);

Route::post('absen/masuk', [ApiPresensiController::class, 'absenMasuk']);
Route::post('absen/masuk', [ApiPresensiController::class, 'absenMasuk']);
Route::post('absen/data', [ApiPresensiController::class, 'dataAbsen']);
