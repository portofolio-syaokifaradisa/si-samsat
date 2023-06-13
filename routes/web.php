<?php

use App\Models\Announcement;

// Guest
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

// Controller User
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\user\PajakController;
use App\Http\Controllers\user\MutasiController;
use App\Http\Controllers\admin\ReportController;

// Controller Admin
use App\Http\Controllers\user\DuplikatController;
use App\Http\Controllers\user\BalikNamaController;
use App\Http\Controllers\user\DashboardController;
use App\Http\Controllers\admin\PajakController as AdminPajakController;
use App\Http\Controllers\admin\MutasiController as AdminMutasiController;
use App\Http\Controllers\admin\AccountController as AdminAccountController;
use App\Http\Controllers\admin\OfficerController as AdminOfficerController;
use App\Http\Controllers\admin\DuplikatController as AdminDuplikatController;

// General
use App\Http\Controllers\admin\BalikNamaController as AdminBalikNamaController;
use App\Http\Controllers\admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\admin\AnnouncementController as AdminAnnouncemenetController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $announcements = Announcement::orderBy('created_at', 'DESC')->get();
    return view('welcome', [
        'announcements' => $announcements
    ]);
})->name('landingpage');

Route::middleware('guest')->group(function(){
    Route::prefix('login')->name('login.')->group(function(){
        Route::get('/', [LoginController::class, 'index'])->name('index');
        Route::post('/verify', [LoginController::class, 'verify'])->name('verify');
    });
    Route::prefix('register')->name('register.')->group(function(){
        Route::get('/', [RegisterController::class, 'index'])->name('index');
        Route::post('/store', [RegisterController::class, 'store'])->name('store');
    });
});

Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');

Route::middleware('user')->group(function(){
    Route::get('/home',[DashboardController::class, 'index'])->name('home');
    Route::prefix('/mutasi')->name('mutasi.')->group(function(){
        Route::prefix('/{type}')->group(function(){
            Route::get('/', [MutasiController::class, 'index'])->name('index');
            Route::get('/create', [MutasiController::class, 'create'])->name('create');
            Route::post('/store', [MutasiController::class, 'store'])->name('store');
            Route::prefix('/{id}')->group(function(){
                Route::get('/edit', [MutasiController::class, 'edit'])->name('edit');
                Route::put('/update', [MutasiController::class, 'update'])->name('update');
                Route::put('/cancel', [MutasiController::class, 'cancel'])->name('cancel');
                Route::get('/print', [MutasiController::class, 'print'])->name('print');
            });
        });
    });
    Route::prefix('/baliknama')->name('baliknama.')->group(function(){
        Route::get('/', [BalikNamaController::class, 'index'])->name('index');
        Route::get('/create', [BalikNamaController::class, 'create'])->name('create');
        Route::post('/store', [BalikNamaController::class, 'store'])->name('store');
        Route::prefix('/{id}')->group(function(){
            Route::get('/edit', [BalikNamaController::class, 'edit'])->name('edit');
            Route::put('/update', [BalikNamaController::class, 'update'])->name('update');
            Route::put('/cancel', [BalikNamaController::class, 'cancel'])->name('cancel');
            Route::get('/print', [BalikNamaController::class, 'print'])->name('print');
        });
    });
    Route::prefix('/duplikat')->name('duplikat.')->group(function(){
        Route::get('/', [DuplikatController::class, 'index'])->name('index');
        Route::get('/create', [DuplikatController::class, 'create'])->name('create');
        Route::post('/store', [DuplikatController::class, 'store'])->name('store');
        Route::prefix('/{id}')->group(function(){
            Route::get('/edit', [DuplikatController::class, 'edit'])->name('edit');
            Route::put('/update', [DuplikatController::class, 'update'])->name('update');
            Route::put('/cancel', [DuplikatController::class, 'cancel'])->name('cancel');
            Route::get('/print', [DuplikatController::class, 'print'])->name('print');
        });
    });
    Route::prefix('/pajak')->name('pajak.')->group(function(){
        Route::prefix('{type}')->group(function(){
            Route::get('/', [PajakController::class, 'index'])->name('index');
            Route::get('/create', [PajakController::class, 'create'])->name('create');
            Route::post('/store', [PajakController::class, 'store'])->name('store');
            Route::prefix('{id}')->group(function(){
                Route::get('/edit', [PajakController::class, 'edit'])->name('edit');
                Route::put('/update', [PajakController::class, 'update'])->name('update');
                Route::put('/cancel', [PajakController::class, 'cancel'])->name('cancel');
                Route::get('/print', [PajakController::class, 'print'])->name('print');
            });
        });
    });
});

Route::middleware('admin')->prefix('/admin')->name('admin.')->group(function(){
    Route::get('/home',[AdminDashboardController::class, 'index'])->name('home');
    Route::prefix('/mutasi')->name('mutasi.')->group(function(){
        Route::prefix('/{type}')->group(function(){
            Route::get('/', [AdminMutasiController::class, 'index'])->name('index');
            Route::post('/store', [AdminMutasiController::class, 'store'])->name('store');
            Route::get('/print', [AdminMutasiController::class, 'print'])->name('print');
            Route::prefix('/{id}')->group(function(){
                Route::get('/review', [AdminMutasiController::class, 'review'])->name('review');
                Route::put('/accept', [AdminMutasiController::class, 'accept'])->name('accept');
                Route::get('/reject', [AdminMutasiController::class, 'reject'])->name('reject');
                Route::put('/finishing', [AdminMutasiController::class, 'finishing'])->name('finishing');
            }); 
        });
    });
    Route::prefix('/baliknama')->name('baliknama.')->group(function(){
        Route::get('/', [AdminBalikNamaController::class, 'index'])->name('index');
        Route::get('/print', [AdminBalikNamaController::class, 'print'])->name('print');
        Route::post('/store', [AdminBalikNamaController::class, 'store'])->name('store');
        Route::prefix('/{id}')->group(function(){
            Route::get('/review', [AdminBalikNamaController::class, 'review'])->name('review');
            Route::put('/accept', [AdminBalikNamaController::class, 'accept'])->name('accept');
            Route::get('/reject', [AdminBalikNamaController::class, 'reject'])->name('reject');
            Route::put('/finishing', [AdminBalikNamaController::class, 'finishing'])->name('finishing');
        });
    });
    Route::prefix('/duplikat')->name('duplikat.')->group(function(){
        Route::get('/', [AdminDuplikatController::class, 'index'])->name('index');
        Route::get('/print', [AdminDuplikatController::class, 'print'])->name('print');
        Route::post('/store', [AdminDuplikatController::class, 'store'])->name('store');
        Route::prefix('/{id}')->group(function(){
            Route::get('/review', [AdminDuplikatController::class, 'review'])->name('review');
            Route::put('/accept', [AdminDuplikatController::class, 'accept'])->name('accept');
            Route::get('/reject', [AdminDuplikatController::class, 'reject'])->name('reject');
            Route::put('/finishing', [AdminDuplikatController::class, 'finishing'])->name('finishing');
        });
    });
    Route::prefix('/account')->name('account.')->group(function(){
        Route::get('/', [AdminAccountController::class, 'index'])->name('index');
        Route::get('/create', [AdminAccountController::class, 'create'])->name('create');
        Route::post('/store', [AdminAccountController::class, 'store'])->name('store');
        Route::get('/user-print', [AdminAccountController::class, 'userPrint'])->name('user-print');
        Route::get('/admin-print', [AdminAccountController::class, 'adminPrint'])->name('admin-print');
        Route::prefix('/{id}')->group(function(){
            Route::get('/edit', [AdminAccountController::class, 'edit'])->name('edit');
            Route::put('/update', [AdminAccountController::class, 'update'])->name('update');
            Route::delete('/delete', [AdminAccountController::class, 'delete'])->name('delete');
        });
    });
    Route::prefix('/announcement')->name('announcement.')->group(function(){
        Route::get('/', [AdminAnnouncemenetController::class, 'index'])->name('index');
        Route::get('/create', [AdminAnnouncemenetController::class, 'create'])->name('create');
        Route::post('/store', [AdminAnnouncemenetController::class, 'store'])->name('store');
        Route::get('/print', [AdminAnnouncemenetController::class, 'print'])->name('print');
        Route::prefix('/{id}')->group(function(){
            Route::get('/edit', [AdminAnnouncemenetController::class, 'edit'])->name('edit');
            Route::put('/update', [AdminAnnouncemenetController::class, 'update'])->name('update');
            Route::delete('/delete', [AdminAnnouncemenetController::class, 'delete'])->name('delete');
        });
    });
    Route::prefix('/officer')->name('officer.')->group(function(){
        Route::get('/', [AdminOfficerController::class, 'index'])->name('index');
        Route::get('/create', [AdminOfficerController::class, 'create'])->name('create');
        Route::post('/store', [AdminOfficerController::class, 'store'])->name('store');
        Route::get('/print', [AdminOfficerController::class, 'print'])->name('print');
        Route::prefix('/{id}')->group(function(){
            Route::get('/edit', [AdminOfficerController::class, 'edit'])->name('edit');
            Route::put('/update', [AdminOfficerController::class, 'update'])->name('update');
            Route::delete('/delete', [AdminOfficerController::class, 'delete'])->name('delete');
        });
    });
    Route::prefix('/pajak')->name('pajak.')->group(function(){
        Route::prefix('{type}')->group(function(){
            Route::get('/', [AdminPajakController::class, 'index'])->name('index');
            Route::get('/create', [AdminPajakController::class, 'create'])->name('create');
            Route::post('/store', [AdminPajakController::class, 'store'])->name('store');
            Route::get('/print', [AdminPajakController::class, 'print'])->name('print');
            Route::prefix('{id}')->group(function(){
                Route::get('/review', [AdminPajakController::class, 'review'])->name('review');
                Route::put('/accept', [AdminPajakController::class, 'accept'])->name('accept');
                Route::get('/reject', [AdminPajakController::class, 'reject'])->name('reject');
                Route::put('/finishing', [AdminPajakController::class, 'finishing'])->name('finishing');
            });
        });
    });
    Route::prefix('report')->name('report.')->group(function(){
        Route::prefix('bbn')->name('bbn.')->group(function(){
            Route::get('/', [ReportController::class, 'bbnReview'])->name('index');
            Route::get('/download', [ReportController::class, 'bbnDownload'])->name('download');
        });
        Route::prefix('duplikat')->name('duplikat.')->group(function(){
            Route::get('/', [ReportController::class, 'duplikatReview'])->name('index');
            Route::get('/download', [ReportController::class, 'duplikatDownload'])->name('download');
        });
        Route::prefix('mutasi-in')->name('mutasi-in.')->group(function(){
            Route::get('/', [ReportController::class, 'mutasiInReview'])->name('index');
            Route::get('/download', [ReportController::class, 'mutasiInDownload'])->name('download');
        });
        Route::prefix('mutasi-out')->name('mutasi-out.')->group(function(){
            Route::get('/', [ReportController::class, 'mutasiOutReview'])->name('index');
            Route::get('/download', [ReportController::class, 'mutasiOutDownload'])->name('download');
        });
        Route::prefix('mutasi-nopol')->name('mutasi-nopol.')->group(function(){
            Route::get('/', [ReportController::class, 'mutasiNopolReview'])->name('index');
            Route::get('/download', [ReportController::class, 'mutasiNopolDownload'])->name('download');
        });
        Route::prefix('pajak1')->name('pajak1.')->group(function(){
            Route::get('/', [ReportController::class, 'pajak1Review'])->name('index');
            Route::get('/download', [ReportController::class, 'pajak1Download'])->name('download');
        });
        Route::prefix('pajak5')->name('pajak5.')->group(function(){
            Route::get('/', [ReportController::class, 'pajak5Review'])->name('index');
            Route::get('/download', [ReportController::class, 'pajak5Download'])->name('download');
        });
        Route::prefix('user')->name('user.')->group(function(){
            Route::get('/', [ReportController::class, 'userReview'])->name('index');
            Route::get('/download', [ReportController::class, 'userDownload'])->name('download');
        });
        Route::prefix('officer')->name('officer.')->group(function(){
            Route::get('/', [ReportController::class, 'officerReview'])->name('index');
            Route::get('/download', [ReportController::class, 'officerDownload'])->name('download');
        });
    });
});
