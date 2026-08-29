<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SakanaController;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/services/{id}', [HomeController::class, 'serviceDetail'])->name('services.detail');
Route::get('/stories/{id}', [HomeController::class, 'storyDetail'])->name('stories.detail');
Route::post('/contact', [HomeController::class, 'submitContact'])->name('contact.submit');

// Sakana AI API Routes (Both /api/ai/* and /api/sakana/* supported for frontend compatibility)
Route::post('/api/ai/chat', [SakanaController::class, 'chat'])->name('sakana.ai.chat');
Route::post('/api/sakana/chat', [SakanaController::class, 'chat'])->name('sakana.chat');
Route::post('/api/sakana/service-consult', [SakanaController::class, 'serviceConsult'])->name('sakana.serviceConsult');
Route::post('/api/sakana/translate-job', [SakanaController::class, 'translateJob'])->name('sakana.translateJob');
Route::get('/api/sakana/status', [SakanaController::class, 'getStatus'])->name('sakana.status');

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
    
    // Services
    Route::post('/services', [AdminController::class, 'storeService'])->name('admin.services.store');
    Route::post('/services/{id}', [AdminController::class, 'updateService'])->name('admin.services.update');
    Route::post('/services/{id}/delete', [AdminController::class, 'deleteService'])->name('admin.services.delete');
    
    // Stories
    Route::post('/stories', [AdminController::class, 'storeStory'])->name('admin.stories.store');
    Route::post('/stories/{id}', [AdminController::class, 'updateStory'])->name('admin.stories.update');
    Route::post('/stories/{id}/delete', [AdminController::class, 'deleteStory'])->name('admin.stories.delete');

    // FAQs
    Route::post('/faqs', [AdminController::class, 'storeFaq'])->name('admin.faqs.store');
    Route::post('/faqs/{id}', [AdminController::class, 'updateFaq'])->name('admin.faqs.update');
    Route::post('/faqs/{id}/delete', [AdminController::class, 'deleteFaq'])->name('admin.faqs.delete');

    // Inquiries
    Route::post('/inquiries/{id}/status', [AdminController::class, 'updateInquiryStatus'])->name('admin.inquiries.status');

    // Sakana AI Management
    Route::post('/api/sakana/config', [SakanaController::class, 'updateConfig'])->name('admin.sakana.config');
    Route::post('/api/sakana/test', [SakanaController::class, 'testConnection'])->name('admin.sakana.test');
});

