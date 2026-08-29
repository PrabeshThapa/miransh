<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Admin Authentication Routes
Route::get('/admin/login', [AdminController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
Route::get('/admin/logout', [AdminController::class, 'logout']);

// Admin Management Dashboard Routes
Route::prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::post('/company', [AdminController::class, 'updateCompany'])->name('admin.company.update');
    Route::post('/about', [AdminController::class, 'updateAbout'])->name('admin.about.update');
    Route::post('/services', [AdminController::class, 'storeService'])->name('admin.services.store');
    Route::post('/services/{id}', [AdminController::class, 'updateService'])->name('admin.services.update');
    Route::post('/services/{id}/delete', [AdminController::class, 'deleteService'])->name('admin.services.delete');
});

