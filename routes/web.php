<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SkckController;
use App\Http\Controllers\SkckReportController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

// Route untuk halaman welcome
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/home', function(){
    return view('dashboard');
})->name('home');

// Authentication Routes
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// User Management (restricted to Ba Intelkam only)
Route::prefix('user')
    ->name('user.')
    ->middleware(['auth', 'role:Admin']) // Pastikan 'auth' mendahului role jika otentikasi diperlukan
    ->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::post('/', [UserController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [UserController::class, 'edit'])->name('edit');
        Route::put('/{id}', [UserController::class, 'update'])->name('update');
        Route::delete('/{id}', [UserController::class, 'destroy'])->name('destroy');
    });


// Route untuk laporan dan filter SKCK
Route::prefix('skckdetail')->name('skckdetail.')->group(function () {
    Route::get('/input', [SkckReportController::class, 'input'])->name('input');
    Route::get('/output', [SkckReportController::class, 'output'])->name('output');
    Route::get('/broken', [SkckReportController::class, 'broken'])->name('broken');
    Route::get('/report', [SkckReportController::class, 'report'])->name('report');
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

Route::get('/skck/report', [SkckReportController::class, 'report'])->name('skck.report');
Route::get('/skck/report/export', [SkckReportController::class, 'exportToExcel'])->name('skck.export');