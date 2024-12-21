<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GradesController;
use App\Http\Controllers\ClassroomsController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\YourGradesController;
use App\Http\Controllers\UsersController;
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
Route::middleware(['auth', 'role:student'])->group(function () {
    Route::resource('grades', GradesController::class);
});

Route::middleware(['auth', 'role:teacher'])->group(function () {
    Route::get('/classes/{class}/subject/{subjectId}', [ClassroomsController::class, 'show'])->name('classes.show_with_subject');
    Route::resource('classes', ClassroomsController::class);
    Route::get('/classes/{class}/subject/{subjectId}/studentid/{studentId}', [YourGradesController::class, 'show'])->name('classes.show');
    Route::put('/classes/edit/{grade}', [YourGradesController::class, 'update'])->name('classes.update');
    Route::post('/classes/add/grade', [YourGradesController::class, 'store'])->name('classes.store');
    Route::delete('/classes/delete/{grade}', [YourGradesController::class, 'destroy'])->name('classes.destroy');
    
});

Route::get('/schedule', [ScheduleController::class, 'index'])->name('schedule.index');


Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/users', [UsersController::class, 'show'])->name('users.index');
    Route::delete('/users/{id}', [UsersController::class, 'destroy'])->name('users.destroy');
    Route::get('/users/{id}/edit', [UsersController::class, 'edit'])->name('users.edit');
    Route::patch('/users/{id}', [UsersController::class, 'update'])->name('users.update');
    Route::post('/users', [UsersController::class, 'store'])->name('users.store');
});

require __DIR__ . '/auth.php';
