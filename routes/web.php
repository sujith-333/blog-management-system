<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminBlogController;

// User Routes
Route::get('/', [BlogController::class, 'index']);
Route::get('/blogs', [BlogController::class, 'index']);
Route::get('/blogs/{id}', [BlogController::class, 'show']);
Route::post('/blogs/filter', [BlogController::class, 'filter']);

// Admin Auth Routes
Route::get('/admin/login', [AdminAuthController::class, 'showLogin']);
Route::post('/admin/login', [AdminAuthController::class, 'login']);
Route::post('/admin/logout', [AdminAuthController::class, 'logout']);

// Admin Protected Routes
Route::middleware('admin')->group(function () {
    Route::get('/admin/dashboard', [AdminBlogController::class, 'index']);
    Route::get('/admin/blogs/create', [AdminBlogController::class, 'create']);
    Route::post('/admin/blogs', [AdminBlogController::class, 'store']);
    Route::get('/admin/blogs/{id}/edit', [AdminBlogController::class, 'edit']);
    Route::put('/admin/blogs/{id}', [AdminBlogController::class, 'update']);
    Route::delete('/admin/blogs/{id}', [AdminBlogController::class, 'destroy']);
    Route::post('/admin/upload-image', [AdminBlogController::class, 'uploadImage']);
});