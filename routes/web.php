<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\TrashController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/my-profile', [ProfileController::class, 'index'])->name('profile');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// admin

Route::get('/report-lost-item', [UserController::class, 'reportLostItem'])->name('reportLostItem');
Route::get('/report-found-item', [UserController::class, 'reportFoundItem'])->name('reportFoundItem');
Route::post('/add-item', [ItemController::class, 'store'])->name('addItem');
Route::get('/view-item-info-as-admin/{item}', [ItemController::class, 'viewItemInfoAsAdmin'])->name('viewItemInfoAsAdmin');
Route::post('/trash/restore/{id}', [TrashController::class, 'restore'])->name('trash.restore');
Route::get('/trash', [TrashController::class, 'index'])->name('trash.index');

Route::prefix('settings')->name('settings')->group(function () {
    Route::get('/trash', [SettingsController::class, 'trash'])->name('trash');
    Route::get('/notifications', [SettingsController::class, 'notifications'])->name('notifications');
    Route::get('/privacy', [SettingsController::class, 'privacy'])->name('privacy');
});

// Admin 
Route::get('/view-item-info/{item}', [ItemController::class, 'viewItemInfo'])->name('viewItemInfo');
Route::get('/view-item/{item}', [ItemController::class, 'viewItem'])->name('viewItem');
Route::delete('delete-item/{id}', [ItemController::class, 'deleteItem'])->name('deleteItem');


require __DIR__.'/auth.php';
