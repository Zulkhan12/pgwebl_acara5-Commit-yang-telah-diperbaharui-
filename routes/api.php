<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/points', [App\Http\Controllers\ApiController::class, 'points'])->name('api.points');
Route::get('/point/{id}', [App\Http\Controllers\ApiController::class, 'point'])->name('api.point');
Route::get('/polyline/{id}', [App\Http\Controllers\ApiController::class, 'polyline'])->name('api.polyline');
Route::get('/polygon/{id}', [App\Http\Controllers\ApiController::class, 'polygon'])->name('api.polygon');


Route::get('/polylines', [App\Http\Controllers\ApiController::class, 'polylines'])->name('api.polylines');
Route::get('/polygons', [App\Http\Controllers\ApiController::class, 'polygons'])->name('api.polygons');
