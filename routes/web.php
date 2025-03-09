<?php

use App\Http\Controllers\PointsController;
use App\Http\Controllers\TableController;
use Illuminate\Support\Facades\Route;

use function Laravel\Prompts\table;

Route::get('/', [PointsController::class, 'index'])->name('map');

Route::get('/table', [TableController::class, 'index'])->name('table');

Route::post('/store-point', [PointsController::class, 'store'])->name('point.store');

Route::resource('points.store', PointsController::class);
