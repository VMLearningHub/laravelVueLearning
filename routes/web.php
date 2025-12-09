<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MomentController;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canRegister' => Features::enabled(Features::registration()),
    ]);
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {

    Route::prefix('users')->as('users.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/user-list', [UserController::class, 'userList'])->name('userList');
        Route::delete('/deactive/{id}', [UserController::class, 'destroy'])->name('destroy');
        Route::post('/count-user-data', [UserController::class, 'countUserData'])->name('countUserData');
        Route::post('/suspend-user', [UserController::class, 'suspendUser'])->name('suspendUser');
    });

    Route::prefix('moments')->as('moments.')->group(function () {
        Route::get('/', [MomentController::class, 'index'])->name('index');
        Route::get('/watch-list', [MomentController::class, 'watchList'])->name('watchList');
        Route::delete('/delete/{id}', [MomentController::class, 'deleteMoment'])->name('delete');

        Route::post('/update-moderation-score', [MomentController::class, 'updateModerationScore'])->name('updateModerationScore');
    });

    Route::prefix('admins')->as('admins.')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('index');
        Route::post('/', [AdminController::class, 'store'])->name('store');
        Route::get('/create', [AdminController::class, 'create'])->name('create')->middleware('permission:public-activity-create');
        Route::get('/show/{id}', [AdminController::class, 'show'])->name('show');
        Route::put('/{id}', [AdminController::class, 'update'])->name('update');
        Route::delete('/{id}', [AdminController::class, 'destroy'])->name('destroy');
        Route::delete('/deactive/{id}', [AdminController::class, 'destroy'])->name('destroy');
        Route::put('/{id}/edit', [AdminController::class, 'edit'])->name('edit');
        Route::get('/roles', [AdminController::class, 'getroles'])->name('getroles');
    });

    Route::resource('roles', RoleController::class);
});

require __DIR__.'/settings.php';
