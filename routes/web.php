<?php

use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PostController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\UserController;
use Spatie\Activitylog\Models\Activity;

Route::middleware(['auth'])->group(function() {
    Route::controller(PostController::class)->group(function() {
        Route::get('posts/create', 'create')->name('posts.create');
        Route::post('posts', 'store')->name('posts.store');
        Route::delete('posts/{post}', 'destroy')->name('posts.destroy');
        Route::get('posts/{post:slug}/edit', 'edit')->name('posts.edit');
        Route::patch('posts/{post}', 'update')->name('posts.update');
    });
    Route::post('/logout', [SessionController::class, 'destroy'])->name('session.destroy');
    Route::post('/comments', [CommentController::class, 'store']);

    Route::controller(UserController::class)->group(function() {
        Route::get('users/{user:username}', 'show')->name('users.show');
        Route::get('users/{user:username}/edit', 'edit')->name('users.edit');
        Route::patch('users/{user}/update-picture', 'updatePicture')->name('users.update-picture');
        Route::patch('users/{user}/update-password', 'updatePassword')->name('users.update-password');
        Route::patch('users/{user}/update-email', 'updateEmail')->name('users.update-email');
        Route::patch('users/{user}/update-name', 'updateName')->name('users.update-name');
        Route::patch('users/{user}/update-username', 'updateUsername')->name('users.update-username');
    });
});

Route::controller(PostController::class)->group(function() {
    Route::get('/', 'index')->name('home');
    Route::get('posts/{post}', 'show')->name('posts.show');
});

Route::controller(ContactController::class)->group(function() {
    Route::get('/contact', 'create')->name('contact.create');
    Route::post('/contact', 'store')->name('contact.store');
    Route::post('/newsletter', function() {
        request()->validate([
            'subEmail' => ['email', 'required']
        ]);
        return back()->with('success', 'Successfully subscribed!');
    });
});

Route::middleware(['guest'])->group(function() {
    Route::controller(RegistrationController::class)->group(function() {
        Route::get('/register', 'create')->name('registration.create');
        Route::post('/register', 'store')->name('registration.store');
    });

    Route::controller(SessionController::class)->group(function() {
        Route::get('/login', 'create')->name('session.create');
        Route::post('/login', 'store')->name('session.store');
    });
});

Route::middleware(['can:admin'])->group(function() {
    Route::get('/admin', [DashboardController::class, 'index'])->name('admin.home');

    Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users');
    Route::get('/admin/categories', [CategoryController::class, 'index'])->name('admin.categories');
    Route::get('/admin/reports', [ReportController::class, 'index'])->name('admin.reports');
    Route::get('/admin/activity', fn() => view('admin.logs.index', [ 'activities' => Activity::latest()->get() ]))->name('admin.activity');
});