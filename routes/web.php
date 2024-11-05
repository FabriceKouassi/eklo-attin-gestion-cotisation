<?php

use App\Http\Controllers\back\DashboardController;
use App\Http\Controllers\back\AuthController;
use App\Http\Controllers\back\ClientController;
use App\Http\Controllers\back\CompanyController;
use App\Http\Controllers\back\AboutController as BackAboutController;
use App\Http\Controllers\back\ActualiteController;
use App\Http\Controllers\back\AgendaController as BackAgendaController;
use App\Http\Controllers\back\AntenneController;
use App\Http\Controllers\back\BlogController;
use App\Http\Controllers\back\ContactController as BackContactController;
use App\Http\Controllers\back\DirecteurController as BackDirecteurController;
use App\Http\Controllers\back\DocteurConseilController;
use App\Http\Controllers\back\DocumentController as BackDocumentController;
use App\Http\Controllers\back\DocumentTypeController;
use App\Http\Controllers\back\DossierMoisController;
use App\Http\Controllers\back\FaqController;
use App\Http\Controllers\back\FlashInfoController;
use App\Http\Controllers\back\HistoriqueController as BackHistoriqueController;
use App\Http\Controllers\back\LaboratoireController;
use App\Http\Controllers\back\LaboratoireTypeController;
use App\Http\Controllers\back\MediathequeController;
use App\Http\Controllers\back\MissionController as BackMissionController;
use App\Http\Controllers\back\NewsletterController;
use App\Http\Controllers\back\OrganisationController as BackOrganisationController;
use App\Http\Controllers\back\planStrategique\ActiviteController;
use App\Http\Controllers\back\planStrategique\AxeController;
use App\Http\Controllers\back\planStrategique\ObjectifController;
use App\Http\Controllers\back\PolitiqueQualiteController as BackPolitiqueQualiteController;
use App\Http\Controllers\back\PrestationController;
use App\Http\Controllers\back\PrestationTypeController;
use App\Http\Controllers\back\ReclamationController as BackReclamationController;
use App\Http\Controllers\back\ReferencementController;
use App\Http\Controllers\back\SlideController;
use App\Http\Controllers\back\TarificationController as BackTarificationController;
use App\Http\Controllers\back\UserController;
use App\Http\Controllers\back\VaccinationCalendrierController;
use App\Http\Controllers\back\VaccinDisponibleController as BackVaccinDisponibleController;
use App\Http\Controllers\back\VaccinFamilleContoller;
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

        Route::prefix('type-de-prestations')->group(function () {
            Route::controller(PrestationTypeController::class)
                ->group(function () {
                    Route::get('/', 'index')->name('prestationType.all');
                    Route::get('/new', 'showSaveForm')->name('prestationType.new');
                    Route::post('/new', 'saveForm')->name('prestationType.new');
                    Route::get('/update/{id}', 'showUpdateForm')->name('prestationType.updateForm');
                    Route::post('/update', 'updateForm')->name('prestationType.update');
                    Route::get('/delete/{id}', 'delete')->name('prestationType.delete');
                });
        });

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

        Route::prefix('reclamations')->group(function () {
            Route::controller(BackReclamationController::class)
                ->group(function () {
                    Route::get('/', 'index')->name('reclamation.all');
                    Route::get('/new', 'showSaveForm')->name('reclamation.new');
                    Route::post('/new', 'saveForm')->name('reclamation.new');
                    Route::get('/update/{id}', 'showUpdateForm')->name('reclamation.updateForm');
                    Route::post('/update', 'updateForm')->name('reclamation.update');
                    Route::get('/delete/{id}', 'delete')->name('reclamation.delete');
                    Route::delete('/many-delete', 'manyDelete')->name('reclamation.manyDelete');
                });
        });

        Route::prefix('newsletters')->group(function () {
            Route::controller(NewsletterController::class)
                ->group(function () {
                    Route::get('/', 'index')->name('newsletter.all');
                    Route::get('/new', 'showSaveForm')->name('newsletter.new');
                    Route::post('/new', 'saveForm')->name('newsletter.new');
                    Route::get('/update/{id}', 'showUpdateForm')->name('newsletter.updateForm');
                    Route::post('/update', 'updateForm')->name('newsletter.update');
                    Route::get('/delete/{id}', 'delete')->name('newsletter.delete');
                    Route::post('/delete/multiple', 'manyDelete')->name('newsletter.manyDelete');
                    Route::get('/export', 'export')->name('newsletter.export');
                    Route::delete('/many-delete', 'manyDelete')->name('newsletter.manyDelete');
                });
        });
        
        Route::prefix('documents')->group(function () {
            Route::controller(BackDocumentController::class)
                ->group(function () {
                    Route::get('/', 'index')->name('document.all');
                    Route::get('/new', 'showSaveForm')->name('document.new');
                    Route::post('/new', 'saveForm')->name('document.new');
                    Route::get('/update/{id}', 'showUpdateForm')->name('document.updateForm');
                    Route::post('/update', 'updateForm')->name('document.update');
                    Route::get('/delete/{id}', 'delete')->name('document.delete');
                });
        });

        Route::prefix('document-types')->group(function () {
            Route::controller(DocumentTypeController::class)
                ->group(function () {
                    Route::get('/', 'index')->name('documentType.all');
                    Route::get('/new', 'showSaveForm')->name('documentType.new');
                    Route::post('/new', 'saveForm')->name('documentType.new');
                    Route::get('/update/{id}', 'showUpdateForm')->name('documentType.updateForm');
                    Route::post('/update', 'updateForm')->name('documentType.update');
                    Route::get('/delete/{id}', 'delete')->name('documentType.delete');
                });
        });

        Route::prefix('referencements')->group(function () {
            Route::controller(ReferencementController::class)
                ->group(function () {
                    Route::get('/', 'index')->name('referencement.all');
                    Route::get('/new', 'showSaveForm')->name('referencement.new');
                    Route::post('/new', 'saveForm')->name('referencement.new');
                    Route::get('/update/{id}', 'showUpdateForm')->name('referencement.updateForm');
                    Route::post('/update', 'updateForm')->name('referencement.update');
                    Route::get('/delete/{id}', 'delete')->name('referencement.delete');
                });
        });

        Route::prefix('agenda')->group(function () {
            Route::controller(BackAgendaController::class)
                ->group(function () {
                    Route::get('/', 'index')->name('agenda.all');
                    Route::get('/new', 'showSaveForm')->name('agenda.new');
                    Route::post('/new', 'saveForm')->name('agenda.new');
                    Route::get('/update/{id}', 'showUpdateForm')->name('agenda.updateForm');
                    Route::post('/update', 'updateForm')->name('agenda.update');
                    Route::get('/delete/{id}', 'delete')->name('agenda.delete');
                });
        });

        Route::prefix('type-de-vaccins')->group(function () {
            Route::controller(VaccinFamilleContoller::class)
                ->group(function () {
                    Route::get('/', 'index')->name('vaccinFamille.all');
                    Route::get('/new', 'showSaveForm')->name('vaccinFamille.new');
                    Route::post('/new', 'saveForm')->name('vaccinFamille.new');
                    Route::get('/update/{id}', 'showUpdateForm')->name('vaccinFamille.updateForm');
                    Route::post('/update', 'updateForm')->name('vaccinFamille.update');
                    Route::get('/delete/{id}', 'delete')->name('vaccinFamille.delete');
                });
        });

        Route::prefix('tarifications')->group(function () {
            Route::controller(BackTarificationController::class)
                ->group(function () {
                    Route::get('/', 'index')->name('tarification.all');
                    Route::get('/new', 'showSaveForm')->name('tarification.new');
                    Route::post('/new', 'saveForm')->name('tarification.new');
                    Route::get('/update/{id}', 'showUpdateForm')->name('tarification.updateForm');
                    Route::post('/update', 'updateForm')->name('tarification.update');
                    Route::get('/delete/{id}', 'delete')->name('tarification.delete');
                });
        });

        Route::prefix('calendrier-vaccination')->group(function () {
            Route::controller(VaccinationCalendrierController::class)
                ->group(function () {
                    Route::get('/', 'index')->name('calendrier.all');
                    Route::get('/new', 'showSaveForm')->name('calendrier.new');
                    Route::post('/new', 'saveForm')->name('calendrier.new');
                    Route::get('/update/{id}', 'showUpdateForm')->name('calendrier.updateForm');
                    Route::post('/update', 'updateForm')->name('calendrier.update');
                    Route::get('/delete/{id}', 'delete')->name('calendrier.delete');
                });
        });

        Route::prefix('vaccin-disponible')->group(function () {
            Route::controller(BackVaccinDisponibleController::class)
                ->group(function () {
                    Route::get('/', 'index')->name('vaccin.all');
                    Route::get('/new', 'showSaveForm')->name('vaccin.new');
                    Route::post('/new', 'saveForm')->name('vaccin.new');
                    Route::get('/update/{id}', 'showUpdateForm')->name('vaccin.updateForm');
                    Route::post('/update', 'updateForm')->name('vaccin.update');
                    Route::get('/delete/{id}', 'delete')->name('vaccin.delete');
                });
        });

        Route::prefix('blogs')->group(function () {
            Route::controller(BlogController::class)
                ->group(function () {
                    Route::get('/', 'index')->name('blog.all');
                    Route::get('/new', 'showSaveForm')->name('blog.new');
                    Route::post('/new', 'saveForm')->name('blog.new');
                    Route::get('/update/{id}', 'showUpdateForm')->name('blog.updateForm');
                    Route::post('/update', 'updateForm')->name('blog.update');
                    Route::get('/delete/{id}', 'delete')->name('blog.delete');
                });
        });

        Route::prefix('actualites')->group(function () {
            Route::controller(ActualiteController::class)
                ->group(function () {
                    Route::get('/', 'index')->name('actualite.all');
                    Route::get('/new', 'showSaveForm')->name('actualite.new');
                    Route::post('/new', 'saveForm')->name('actualite.new');
                    Route::get('/update/{id}', 'showUpdateForm')->name('actualite.updateForm');
                    Route::post('/update', 'updateForm')->name('actualite.update');
                    Route::get('/delete/{id}', 'delete')->name('actualite.delete');
                });
        });

        Route::prefix('type-de-laboratoires')->group(function () {
            Route::controller(LaboratoireTypeController::class)
                ->group(function () {
                    Route::get('/', 'index')->name('laboratoireType.all');
                    Route::get('/new', 'showSaveForm')->name('laboratoireType.new');
                    Route::post('/new', 'saveForm')->name('laboratoireType.new');
                    Route::get('/update/{id}', 'showUpdateForm')->name('laboratoireType.updateForm');
                    Route::post('/update', 'updateForm')->name('laboratoireType.update');
                    Route::get('/delete/{id}', 'delete')->name('laboratoireType.delete');
                });
        });

        Route::prefix('laboratoires')->group(function () {
            Route::controller(LaboratoireController::class)
                ->group(function () {
                    Route::get('/', 'index')->name('laboratoire.all');
                    Route::get('/new', 'showSaveForm')->name('laboratoire.new');
                    Route::post('/new', 'saveForm')->name('laboratoire.new');
                    Route::get('/update/{id}', 'showUpdateForm')->name('laboratoire.updateForm');
                    Route::post('/update', 'updateForm')->name('laboratoire.update');
                    Route::get('/delete/{id}', 'delete')->name('laboratoire.delete');
                });
        });

        Route::prefix('faqs')->group(function () {
            Route::controller(FaqController::class)
                ->group(function () {
                    Route::get('/', 'index')->name('faq.all');
                    Route::get('/new', 'showSaveForm')->name('faq.new');
                    Route::post('/new', 'saveForm')->name('faq.new');
                    Route::get('/update/{id}', 'showUpdateForm')->name('faq.updateForm');
                    Route::post('/update', 'updateForm')->name('faq.update');
                    Route::get('/delete/{id}', 'delete')->name('faq.delete');
                });
        });

        Route::prefix('mediatheques')->group(function () {
            Route::controller(MediathequeController::class)
                ->group(function () {
                    Route::get('/', 'index')->name('mediatheque.all');
                    Route::get('/new', 'showSaveForm')->name('mediatheque.new');
                    Route::post('/new', 'saveForm')->name('mediatheque.new');
                    Route::get('/update/{id}', 'showUpdateForm')->name('mediatheque.updateForm');
                    Route::post('/update', 'updateForm')->name('mediatheque.update');
                    Route::get('/delete/{id}', 'delete')->name('mediatheque.delete');
                    Route::get('/delete/file/{id}/{key}', 'deleteFile')->name('mediatheque.delete.file');
                });
        });

        Route::prefix('antennes')->group(function () {
            Route::controller(AntenneController::class)
                ->group(function () {
                    Route::get('/', 'index')->name('antenne.all');
                    Route::get('/new', 'showSaveForm')->name('antenne.new');
                    Route::post('/new', 'saveForm')->name('antenne.new');
                    Route::get('/update/{id}', 'showUpdateForm')->name('antenne.updateForm');
                    Route::post('/update', 'updateForm')->name('antenne.update');
                    Route::get('/delete/{id}', 'delete')->name('antenne.delete');
                });
        });

        Route::prefix('flash-infos')->group(function () {
            Route::controller(FlashInfoController::class)
                ->group(function () {
                    Route::get('/', 'index')->name('flashInfo.all');
                    Route::get('/new', 'showSaveForm')->name('flashInfo.new');
                    Route::post('/new', 'saveForm')->name('flashInfo.new');
                    Route::get('/update/{id}', 'showUpdateForm')->name('flashInfo.updateForm');
                    Route::post('/update', 'updateForm')->name('flashInfo.update');
                    Route::get('/delete/{id}', 'delete')->name('flashInfo.delete');
                });
        });

        Route::prefix('prestations')->group(function () {
            Route::controller(PrestationController::class)
                ->group(function () {
                    Route::get('/', 'index')->name('prestation.all');
                    Route::get('/new', 'showSaveForm')->name('prestation.new');
                    Route::post('/new', 'saveForm')->name('prestation.new');
                    Route::get('/update/{id}', 'showUpdateForm')->name('prestation.updateForm');
                    Route::post('/update', 'updateForm')->name('prestation.update');
                    Route::get('/delete/{id}', 'delete')->name('prestation.delete');
                });
        });

        Route::prefix('dossier-du-mois')->group(function () {
            Route::controller(DossierMoisController::class)
                ->group(function () {
                    Route::get('/new', 'showForm')->name('dossier.new');
                    Route::post('/update', 'saveForm')->name('dossier.save');
                });
        });

        Route::prefix('mot-du-directeur')->group(function () {
            Route::controller(BackDirecteurController::class)
                ->group(function () {
                    Route::get('/new', 'showForm')->name('directeur.info');
                    Route::post('/update', 'saveForm')->name('directeur.save');
                });
        });

        Route::prefix('historique')->group(function () {
            Route::controller(BackHistoriqueController::class)
                ->group(function () {
                    Route::get('/new', 'showForm')->name('historique.info');
                    Route::post('/update', 'saveForm')->name('historique.save');
                });
        });

        Route::prefix('organisation')->group(function () {
            Route::controller(BackOrganisationController::class)
                ->group(function () {
                    Route::get('/new', 'showForm')->name('organisation.info');
                    Route::post('/update', 'saveForm')->name('organisation.save');
                });
        });

        Route::prefix('mission')->group(function () {
            Route::controller(BackMissionController::class)
                ->group(function () {
                    Route::get('/new', 'showForm')->name('mission.info');
                    Route::post('/update', 'saveForm')->name('mission.save');
                });
        });

        Route::prefix('politique-qualite')->group(function () {
            Route::controller(BackPolitiqueQualiteController::class)
                ->group(function () {
                    Route::get('/new', 'showForm')->name('politique.info');
                    Route::post('/update', 'saveForm')->name('politique.save');
                });
        });

        Route::prefix('docteur-conseil')->group(function () {
            Route::controller(DocteurConseilController::class)
                ->group(function () {
                    Route::get('/new', 'showForm')->name('docteur.new');
                    Route::post('/update', 'saveForm')->name('docteur.save');
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

        Route::prefix('slides')->group(function () {
            Route::controller(SlideController::class)
                ->group(function () {
                    Route::get('/', 'index')->name('slide.all');
                    Route::get('/new', 'showSaveForm')->name('slide.new');
                    Route::post('/new', 'saveForm')->name('slide.new');
                    Route::get('/update/{id}', 'showUpdateForm')->name('slide.updateForm');
                    Route::post('/update', 'updateForm')->name('slide.update');
                    Route::get('/delete/{id}', 'delete')->name('slide.delete');
                });
        });

        Route::prefix('partenaires')->group(function () {
            Route::controller(ClientController::class)
                ->group(function () {
                    Route::get('/', 'index')->name('client.all');
                    Route::get('/new', 'showSaveForm')->name('client.new');
                    Route::post('/new', 'saveForm')->name('client.new');
                    Route::get('/update/{id}', 'showUpdateForm')->name('client.updateForm');
                    Route::post('/update', 'updateForm')->name('client.update');
                    Route::get('/delete/{id}', 'delete')->name('client.delete');
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
