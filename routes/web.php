<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------|
| Web Routes                                                                |
|--------------------------------------------------------------------------|
*/

Route::get('/', function () {
    return redirect()->route('dashboard');
});

// Dashboard route
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Authentication routes
Auth::routes();

// Employee routes
Route::middleware(['auth', 'role:admin|manager'])->group(function () {
    Route::resource('employees', EmployeeController::class);
});

// Department routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('departments', DepartmentController::class);
});

// Task routes for employees and managers
Route::middleware(['auth'])->group(function () {
    // Manager routes to assign tasks
    Route::middleware(['role:manager'])->group(function () {
        Route::get('employees/{employee}/tasks', [TaskController::class, 'index'])->name('tasks.index');
        Route::get('employees/{employee}/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
        Route::post('employees/{employee}/tasks', [TaskController::class, 'store'])->name('tasks.store');
    });

    // Employee routes to manage their tasks
    Route::middleware(['role:employee'])->group(function () {
        Route::post('tasks/{task}/status/{status}', [TaskController::class, 'updateStatus'])->name('tasks.updateStatus');
    });

    // Employee show route
    Route::get('employees/{employee}', [EmployeeController::class, 'show'])->name('employees.show');
});

// User profile management
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [App\Http\Controllers\ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Home route for authenticated users
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
