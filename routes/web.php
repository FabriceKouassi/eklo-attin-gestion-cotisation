<?php

use App\Http\Controllers\back\DashboardController;
use App\Http\Controllers\back\AuthController;
use App\Http\Controllers\back\CompanyController;
use App\Http\Controllers\back\AboutController as BackAboutController;
use App\Http\Controllers\back\ContactController as BackContactController;
use App\Http\Controllers\back\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/;

Route::prefix('/')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('/', [AuthController::class, 'showLoginForm'])->name('login.form');
        Route::post('/', [AuthController::class, 'loginUser'])->name('login.form');
        Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
        Route::post('/register', [AuthController::class, 'registerUser'])->name('register.form');
        Route::get('/reset-password', [AuthController::class, 'resetPasswordShowForm'])->name('resetPassword.form');
        Route::post('/reset-password' , [AuthController::class, 'resetPassword'])->name('resetPassword');
        Route::get('/reset-verification' , [AuthController::class, 'resetVerificationForm'])->name('resetVerification.form');
        Route::post('/reset-verification' , [AuthController::class, 'resetVerification'])->name('reset.verification');
        Route::get('/change-password/{email}' , [AuthController::class, 'changePasswordForm'])->name('update.passwordForm');
        Route::post('/change-password' , [AuthController::class, 'changePassword'])->name('update.password');
    });

    Route::middleware('auth')->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

        Route::prefix('contacts')->group(function () {
            Route::controller(BackContactController::class)
                ->group(function () {
                    Route::get('/', 'index')->name('contact.all');
                    Route::get('/new', 'showSaveForm')->name('contact.new');
                    Route::post('/new', 'saveForm')->name('contact.new');
                    Route::get('/update/{id}', 'showUpdateForm')->name('contact.updateForm');
                    Route::post('/update', 'updateForm')->name('contact.update');
                    Route::get('/delete/{id}', 'delete')->name('contact.delete');
                    Route::delete('/many-delete', 'manyDelete')->name('contact.manyDelete');
                });
        });

        Route::prefix('company')->group(function () {
            Route::controller(CompanyController::class)
                ->group(function () {
                    Route::get('/new', 'showForm')->name('company.new');
                    Route::post('/update', 'saveForm')->name('company.save');
                });
        });

        Route::prefix('about')->group(function () {
            Route::controller(BackAboutController::class)
                ->group(function () {
                    Route::get('/new', 'showForm')->name('about.new');
                    Route::post('/update', 'saveForm')->name('about.save');
                });
        });

        Route::prefix('users')->group(function () {
            Route::controller(UserController::class)
                ->group(function () {
                    Route::get('/', 'index')->name('user.all');
                    Route::get('/new', 'showSaveForm')->name('user.new');
                    Route::post('/new', 'saveForm')->name('user.new');
                    Route::get('/update/{id}', 'showUpdateForm')->name('user.updateForm');
                    Route::post('/update', 'updateForm')->name('user.update');
                    Route::get('/delete/{id}', 'delete')->name('user.delete');
                });
        });
    });
});
