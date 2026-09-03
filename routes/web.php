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
Route::get('/sitemap.xml', [HomeController::class, 'sitemap'])->name('sitemap');
Route::get('/robots.txt', [HomeController::class, 'robots'])->name('robots');

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

    // Image Upload
    Route::post('/upload-image', [AdminController::class, 'uploadImage'])->name('admin.uploadImage');

    // Sakana AI Management
    Route::post('/api/sakana/config', [SakanaController::class, 'updateConfig'])->name('admin.sakana.config');
    Route::post('/api/sakana/test', [SakanaController::class, 'testConnection'])->name('admin.sakana.test');
});

// Image Upload API (Accessible via /api/admin/upload-image directly)
Route::post('/api/admin/upload-image', [AdminController::class, 'uploadImage'])->name('admin.uploadImage.api');

// Serve Uploaded Files with Fallback Multi-Path Resolution
Route::get('/uploads/{filename}', function ($filename) {
    $cleanFilename = basename($filename);
    
    $searchPaths = [
        public_path('uploads/' . $cleanFilename),
        base_path('public/uploads/' . $cleanFilename),
        storage_path('app/public/uploads/' . $cleanFilename),
        storage_path('app/uploads/' . $cleanFilename),
        base_path('../public_html/uploads/' . $cleanFilename),
        base_path('public_html/uploads/' . $cleanFilename),
        base_path('uploads/' . $cleanFilename),
    ];

    foreach ($searchPaths as $filePath) {
        if (file_exists($filePath) && is_file($filePath)) {
            $ext = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
            $contentTypes = [
                'jpg' => 'image/jpeg',
                'jpeg' => 'image/jpeg',
                'png' => 'image/png',
                'webp' => 'image/webp',
                'gif' => 'image/gif',
                'svg' => 'image/svg+xml',
            ];
            $contentType = $contentTypes[$ext] ?? (function_exists('mime_content_type') ? @mime_content_type($filePath) : 'image/jpeg') ?: 'image/jpeg';

            return response()->file($filePath, [
                'Content-Type' => $contentType,
                'Cache-Control' => 'public, max-age=31536000',
                'Access-Control-Allow-Origin' => '*',
            ]);
        }
    }

    abort(404, 'Image not found');
})->where('filename', '[A-Za-z0-9_\-\.]+');

// Numeric URL Redirect Handler (e.g. /1, /2, /3 -> 301 Permanent Redirect to /services/1, /services/2)
Route::get('/{id}', [HomeController::class, 'numericRedirect'])->where('id', '[0-9]+');


