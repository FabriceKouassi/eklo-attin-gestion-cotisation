<?php

use App\Http\Controllers\back\DashboardController;
use App\Http\Controllers\back\AuthController;
use App\Http\Controllers\back\CompanyController;
use App\Http\Controllers\back\AboutController as BackAboutController;
use App\Http\Controllers\back\ContactController as BackContactController;
use App\Http\Controllers\back\CotisationExceptionnelleController;
use App\Http\Controllers\back\CotisationMensuelleController;
use App\Http\Controllers\back\DemandeController;
use App\Http\Controllers\back\FonctionController;
use App\Http\Controllers\back\MotifController;
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

        Route::prefix('fonctions')->group(function () {
            Route::controller(FonctionController::class)
                ->group(function () {
                    Route::get('/', 'index')->name('fonction.all');
                    Route::get('/new', 'showSaveForm')->name('fonction.new');
                    Route::post('/new', 'saveForm')->name('fonction.new');
                    Route::get('/update/{id}', 'showUpdateForm')->name('fonction.updateForm');
                    Route::post('/update', 'updateForm')->name('fonction.update');
                    Route::get('/delete/{id}', 'delete')->name('fonction.delete');
                });
        });

        Route::prefix('motifs')->group(function () {
            Route::controller(MotifController::class)
                ->group(function () {
                    Route::get('/', 'index')->name('motif.all');
                    Route::get('/new', 'showSaveForm')->name('motif.new');
                    Route::post('/new', 'saveForm')->name('motif.new');
                    Route::get('/update/{id}', 'showUpdateForm')->name('motif.updateForm');
                    Route::post('/update', 'updateForm')->name('motif.update');
                    Route::get('/delete/{id}', 'delete')->name('motif.delete');
                });
        });

        Route::prefix('demandes')->group(function () {
            Route::controller(DemandeController::class)
                ->group(function () {
                    Route::get('/', 'index')->name('demande.all');
                    Route::get('/new', 'showSaveForm')->name('demande.new');
                    Route::post('/new', 'saveForm')->name('demande.new');
                    Route::get('/update/{id}', 'showUpdateForm')->name('demande.updateForm');
                    Route::post('/update', 'updateForm')->name('demande.update');
                    Route::get('/delete/{id}', 'delete')->name('demande.delete');
                });
        });

        Route::prefix('cotisations-exceptionnelles')->group(function () {
            Route::controller(CotisationExceptionnelleController::class)
                ->group(function () {
                    Route::get('/', 'index')->name('cotisationExceptionnelle.all');
                    Route::get('/new', 'showSaveForm')->name('cotisationExceptionnelle.new');
                    Route::post('/new', 'saveForm')->name('cotisationExceptionnelle.new');
                    Route::get('/update/{id}', 'showUpdateForm')->name('cotisationExceptionnelle.updateForm');
                    Route::post('/update', 'updateForm')->name('cotisationExceptionnelle.update');
                    Route::get('/delete/{id}', 'delete')->name('cotisationExceptionnelle.delete');
                });
        });

        Route::prefix('cotisations-mensuelle')->group(function () {
            Route::controller(CotisationMensuelleController::class)
                ->group(function () {
                    Route::get('/periode-non-paye/{userId}', 'getNonPaidPeriodsFromRegistration')->name('cotisationMensuelle.periode_non_paye');
                    Route::get('/', 'index')->name('cotisationMensuelle.all');
                    Route::get('/new', 'showSaveForm')->name('cotisationMensuelle.new');
                    Route::post('/new', 'saveForm')->name('cotisationMensuelle.new');
                    Route::get('/update/{id}', 'showUpdateForm')->name('cotisationMensuelle.updateForm');
                    Route::post('/update', 'updateForm')->name('cotisationMensuelle.update');
                    Route::get('/delete/{id}', 'delete')->name('cotisationMensuelle.delete');
                });
        });

    });
});
