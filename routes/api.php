<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DonasiController;
use App\Http\Controllers\TugasAkhirController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/request/qr-code',[DonasiController::class, 'apiStore']);
Route::get('/request/download/{id}/simulation',[TugasAkhirController::class, 'download']);

