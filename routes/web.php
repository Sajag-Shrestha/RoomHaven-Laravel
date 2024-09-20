<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


// Routes for login and register

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::get('/profile', [UserController::class, 'profile'])->name('profile')->middleware('auth');



// Frontend Routes 

Route::group([], function () {
    Route::get('/', function () {
        return view('frontend.index');
    })->name('index');

    Route::get('/rooms', function () {
        return view('frontend.rooms');
    })->name('rooms');

    Route::get('/about', function () {
        return view('frontend.about');
    })->name('about');

    Route::get('/contact', function () {
        return view('frontend.contact');
    })->name('contact');

    Route::get('/booknow', function () {
        return view('frontend.booknow');
    })->name('booknow');
});

// Backend Routes 

// Admin routes

Route::middleware(['auth',  'CheckRole:Admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/users/create', [UserController::class, 'create'])->name('users.create');
    Route::get('/admin/users/index', [UserController::class, 'index'])->name('users.index');
    Route::post('/admin/users/index', [UserController::class, 'store'])->name('users.store');
    Route::get('/admin/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/admin/users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/admin/users/{id}', [UserController::class, 'delete'])->name('users.delete');
    // Route::get('/admin/settings', [AdminController::class, 'settings'])->name('admin.settings');
    // Add more admin routes here
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


// Auth Routes

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
