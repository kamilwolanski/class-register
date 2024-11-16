<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GradesController;
use App\Http\Controllers\ClassroomsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:teacher'])->group(function () {
    Route::get('/classes/{class}/subject/{subjectId}', [ClassroomsController::class, 'show'])->name('classes.show_with_subject');
    Route::resource('classes', ClassroomsController::class);
    
});

Route::middleware(['auth', 'role:student'])->group(function () {
    Route::resource('grades', GradesController::class);
});


require __DIR__ . '/auth.php';
