<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TeacherController;


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

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::post('/register', [RegisteredUserController::class, 'store'])->name('register');

Route::get('/splash-login', function () {
    return view('splash-login');
})->name('splash-login');

Route::get('/splash-logout', function () {
    return view('splash-logout');
})->name('splash-logout');

Route::middleware('auth')->get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
    Route::get('/users/{id}/edit', [AdminController::class, 'edit'])->name('admin.users.edit');
    Route::put('/users/{id}', [AdminController::class, 'update'])->name('admin.users.update');
    Route::delete('/users/{id}', [AdminController::class, 'destroy'])->name('admin.users.destroy');

     // Show all subjects
     Route::get('/admin/subjects', [AdminController::class, 'index'])->name('admin.subjects.index');

     // Show create form
     Route::get('/admin/subjects/create', [AdminController::class, 'create'])->name('admin.subjects.create');
 
     // Store new subject
     Route::post('/admin/subjects', [AdminController::class, 'store'])->name('admin.subjects.store');
 
     // Show edit form
     Route::get('/admin/subjects/{subject}/edit', [AdminController::class, 'editsub'])->name('admin.subjects.edit');
 
     // Update subject
     Route::put('/admin/subjects/{subject}', [AdminController::class, 'updatesub'])->name('admin.subjects.update');
 
     // Delete subject
     Route::delete('/admin/subjects/{subject}', [AdminController::class, 'destroysub'])->name('admin.subjects.destroy');
 

});

Route::middleware(['auth', 'teacher'])->group(function () {
    Route::get('/teacher/dashboard', [TeacherController::class, 'viewSub'])->name('teacher.dashboard');

});


require __DIR__.'/auth.php';
