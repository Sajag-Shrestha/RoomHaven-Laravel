<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\BookingController;
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
    Route::get('/', [
        RoomController::class,
        'indexRooms'
    ])->name('index');

    Route::get('/rooms', [
        RoomController::class,
        'showRooms'
    ])->name('rooms');

    Route::get('/about', function () {
        return view('frontend.about');
    })->name('about');

    Route::get('/contact', function () {
        return view('frontend.contact');
    })->name('contact');

    Route::get('/booking', [BookingController::class, 'bookingCreate'])->name('bookingCreate');

    Route::post('/booking', [BookingController::class, 'bookingStore'])->name('bookingStore');
});

// Backend Routes 

// Admin routes

Route::middleware(['auth', 'CheckRole:Admin'])->group(function () {

    // User Routes 
    Route::get('admin/users/index', [UserController::class, 'index'])->name('users.index');
    Route::get('admin/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('admin/users/index', [UserController::class, 'store'])->name('users.store');
    Route::get('admin/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('admin/users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('admin/users/{id}', [UserController::class, 'delete'])->name('users.delete');

    // Media Routes 
    Route::get('admin/media/create', [MediaController::class, 'create'])->name('media.create');
    Route::get('admin/media/index', [MediaController::class, 'index'])->name('media.index');
    Route::post('admin/media/index', [MediaController::class, 'store'])->name('media.store');
    Route::delete('admin/media/{id}', [MediaController::class, 'delete'])->name('media.delete');

    // Room Routes 
    Route::get('admin/rooms/create', [RoomController::class, 'create'])->name('rooms.create');
    Route::delete('admin/rooms/{id}', [RoomController::class, 'delete'])->name('rooms.delete');
});


// Admin & Manager Route
Route::middleware(['auth',  'CheckRole:Admin,Manager'])->group(function () {

    // Dashboard Route
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');


    // Room Routes 
    Route::get('/rooms/index', [RoomController::class, 'index'])->name('rooms.index');
    Route::post('/rooms/index', [RoomController::class, 'store'])->name('rooms.store');
    Route::get('/rooms/{id}/edit', [RoomController::class, 'edit'])->name('rooms.edit');
    Route::put('/rooms/{id}', [RoomController::class, 'update'])->name('rooms.update');
    Route::post('/rooms/{id}/update-status', [RoomController::class, 'updateStatus'])->name('rooms.updateStatus');

    // Booking Routes 
    Route::get('/booking/create', [BookingController::class, 'create'])->name('booking.create');
    Route::get('/booking/index', [BookingController::class, 'index'])->name('booking.index');
    Route::post('/booking/index', [BookingController::class, 'store'])->name('booking.store');
    Route::get('/booking/{id}/edit', [BookingController::class, 'edit'])->name('booking.edit');
    Route::put('/booking/{id}', [BookingController::class, 'update'])->name('booking.update');
    Route::patch('/booking/{id}/update-status', [BookingController::class, 'updateStatus'])->name('booking.updateStatus');
    Route::delete('/booking/{id}', [BookingController::class, 'delete'])->name('booking.delete');
});



// Auth Routes

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
