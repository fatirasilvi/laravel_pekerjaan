<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PekerjaanController;
use App\Http\Controllers\PerusahaanController;
use App\Http\Controllers\UserController;

// Welcome
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Auth
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route untuk Admin

Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/admin/dashboard', function () {
        return view('admin.index');
    })->name('admin.dashboard');

    Route::resource('pekerjaan', PekerjaanController::class);
    Route::resource('perusahaan', PerusahaanController::class);

    // User Management
    Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users');
    Route::post('/admin/users/{id}/role', [UserController::class, 'updateRole'])->name('admin.users.updateRole');
});


// Route untuk User

Route::middleware(['auth', 'role:user'])->group(function () {

    Route::get('/user/dashboard', function () {
        return view('user.index');
    })->name('dashboard');

    // User melihat daftar pekerjaan
    Route::get('/user/jobs', [PekerjaanController::class, 'listForUser'])->name('user.jobs');

    // User melamar pekerjaan
    Route::post('/user/jobs/{id}/apply', [PekerjaanController::class, 'apply'])->name('user.jobs.apply');

    // detail pekerjaan
    Route::get('/user/jobs/{id}', [PekerjaanController::class, 'detail'])
    ->name('user.jobs.detail');

    Route::get('/user/jobs/{id}', [PekerjaanController::class, 'showJobUser'])
        ->name('user.jobs.detail');

});

