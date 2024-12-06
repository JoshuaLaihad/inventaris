<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SkckController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\KesatuanController;
use App\Http\Controllers\SkckReportController;

// Route untuk halaman welcome
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Route untuk laporan dan filter SKCK
Route::prefix('skck')->name('skck.')->group(function () {
    Route::get('/input', [SkckReportController::class, 'input'])->name('input');
    Route::get('/output', [SkckReportController::class, 'output'])->name('output');
    Route::get('/broken', [SkckReportController::class, 'broken'])->name('broken');
    Route::get('/report', [SkckReportController::class, 'report'])->name('report');
});

// Route CRUD untuk Status
Route::prefix('status')->name('status.')->group(function () {
    Route::get('/', [StatusController::class, 'index'])->name('index');
    Route::get('/create', [StatusController::class, 'create'])->name('create');
    Route::post('/', [StatusController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [StatusController::class, 'edit'])->name('edit');
    Route::put('/{id}', [StatusController::class, 'update'])->name('update');
    Route::delete('/{id}', [StatusController::class, 'destroy'])->name('destroy');
});

// Route CRUD untuk Kesatuan
Route::prefix('kesatuan')->name('kesatuan.')->group(function () {
    Route::get('/', [KesatuanController::class, 'index'])->name('index');
    Route::get('/create', [KesatuanController::class, 'create'])->name('create');
    Route::post('/', [KesatuanController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [KesatuanController::class, 'edit'])->name('edit');
    Route::put('/{id}', [KesatuanController::class, 'update'])->name('update');
    Route::delete('/{id}', [KesatuanController::class, 'destroy'])->name('destroy');
});

// Route CRUD untuk SKCK
Route::prefix('skck')->name('skck.')->group(function () {
    Route::get('/', [SkckController::class, 'index'])->name('index');
    Route::get('/create', [SkckController::class, 'create'])->name('create');
    Route::post('/', [SkckController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [SkckController::class, 'edit'])->name('edit');
    Route::put('/{id}', [SkckController::class, 'update'])->name('update');
    Route::delete('/{id}', [SkckController::class, 'destroy'])->name('destroy');
});
