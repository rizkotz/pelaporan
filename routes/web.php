<?php

use App\Http\Controllers\AdminPanelController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\AuditeController;
use App\Http\Controllers\DokumenController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PengumpulanController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;

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

//Route Login
//Route::get('login',     [LoginController::class, 'index'])->name('login');
Route::controller(LoginController::class)->group(function(){
    Route::get('login','index')->name('login');
    Route::post('login/proses','proses');
    Route::get('logout','logout');
});

// Route::group(['middleware' => ['auth']], function(){
//     Route::group(['middleware' => ['cekUserLogin:1']], function(){
//         Route::resource('dashboard', ProjectController::class);

//         //Route CRUD Post Controller
//         Route::resource('/posts', PostController::class);
//         Route::get('/tampilData/{id}', [PostController::class,'tampilData'])->name('tampilData');
//         Route::post('/updateData/{id}', [PostController::class,'updateData'])->name('updateData');
//         Route::get('/detailTugas/{id}',      [PostController::class,'detailTugas'])->name('detailTugas');

//         //Route CRUD Anggota
//         Route::resource('/anggotas', AnggotaController::class);
//         Route::get('/tampilDataAnggota/{id}', [AnggotaController::class,'tampilDataAnggota'])->name('tampilDataAnggota');
//         Route::post('/updateDataAnggota/{id}', [AnggotaController::class,'updateDataAnggota'])->name('updateDataAnggota');

//         //Route CRUD Auditee
//         Route::resource('/audites', AuditeController::class);
//         Route::get('tampilDataAudite/{id}', [AuditeController::class,'tampilDataAudite'])->name('tampilDataAudite');
//         Route::get('updateDataAudite/{id}', [AuditeController::class,'updateDataAudite'])->name('updateDataAudite');

//         //Route CRUD Dokumen
//         Route::resource('/dokumens', DokumenController::class);
//         Route::get('/tampilDataDokumen/{id}', [DokumenController::class,'tampilDataDokumen'])->name('tampilDataDokumen');
//         Route::post('/updateDataDokumen/{id}', [DokumenController::class,'updateDataDokumen'])->name('updateDataDokumen');
//         Route::get('dokumen/download/{id}', [DokumenController::class,'download'])->name('download.dokumen');

//         //Rute untuk Admin Panel
//     Route::get('/admin/panel', [AdminPanelController::class, 'index'])->name('admin.panel');
//     Route::post('/admin/panel/{userId}/save-menu-config', [AdminPanelController::class, 'saveMenuConfig'])->name('admin.saveMenuConfig');
//     });

// });

//Route Admin Menu Setting
Route::resource('/admin/panel', MenuController::class)->middleware(['auth','cekUserLogin']);

 //Route CRUD Post Controller
 Route::resource('/posts', PostController::class)->middleware('auth');
 Route::get('/tampilData/{id}', [PostController::class,'tampilData'])->name('tampilData')
        ->middleware('auth');
 Route::post('/updateData/{id}', [PostController::class,'updateData'])->name('updateData')
        ->middleware('auth');
 Route::get('/detailTugas/{id}',      [PostController::class,'detailTugas'])->name('detailTugas')
        ->middleware('auth');
 Route::post('/detailTugas/{id}/submit', [PostController::class,'submit'])->middleware('auth');
 Route::get('/reviewLaporan/print',   [PostController::class,'print'])->middleware('auth');
 Route::get('/detailTugas/print/{id}',   [PostController::class,'print_id'])->middleware('auth');
 Route::get('/reviewLaporan/printpdf',   [PostController::class,'printpdf'])->middleware('auth');

 //Route CRUD Anggota
 Route::resource('/anggotas', AnggotaController::class)->middleware('auth');
 Route::get('/tampilDataAnggota/{id}', [AnggotaController::class,'tampilDataAnggota'])->name('tampilDataAnggota')
        ->middleware('auth');
 Route::post('/updateDataAnggota/{id}', [AnggotaController::class,'updateDataAnggota'])->name('updateDataAnggota')
        ->middleware('auth');

 //Route CRUD Auditee
 Route::resource('/audites', AuditeController::class)->middleware('auth');
 Route::get('tampilDataAudite/{id}', [AuditeController::class,'tampilDataAudite'])->name('tampilDataAudite')
        ->middleware('auth');
 Route::get('updateDataAudite/{id}', [AuditeController::class,'updateDataAudite'])->name('updateDataAudite')
        ->middleware('auth');

 //Route CRUD User
 Route::resource('/users', UserController::class)->middleware('auth');
 Route::get('/tampilDataUser/{id}', [UserController::class,'tampilDataAnggota'])->name('tampilDataUser')
        ->middleware('auth');
 Route::post('/updateDataUser/{id}', [UserController::class,'updateDataAnggota'])->name('updateDataUser')
        ->middleware('auth');

 //Route CRUD Dokumen
 Route::resource('/dokumens', DokumenController::class)->middleware('auth');
 Route::get('/tampilDataDokumen/{id}', [DokumenController::class,'tampilDataDokumen'])->name('tampilDataDokumen')
        ->middleware('auth');
 Route::post('/updateDataDokumen/{id}', [DokumenController::class,'updateDataDokumen'])->name('updateDataDokumen')
        ->middleware('auth');
 Route::get('dokumen/download/{id}', [DokumenController::class,'download'])->name('download.dokumen')
        ->middleware('auth');

//Route View
Route::get('/dashboard',               [ProjectController::class,'dashboard'])->middleware('auth');
Route::get('/',                        [ProjectController::class,'dashboard'])->middleware('auth');

//Route Search
Route::get('/reviewLaporan/search',     [ProjectController::class,'search'])->middleware('auth');
Route::get('/userAnggota/search',     [AnggotaController::class,'search'])->middleware('auth');
Route::get('/userView/search',     [UserController::class,'search'])->middleware('auth');
Route::get('/userAudite/search',        [AuditeController::class,'search'])->middleware('auth');
Route::get('/dokumen/search',           [DokumenController::class,'search'])->middleware('auth');

//Route Verifikasi Email
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

//Route Email Verification Handler
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/dashboard');
})->middleware(['auth', 'signed'])->name('verification.verify');

//Route setelah verif
Route::get('/dashboard', function () {
    // Only verified users may access this route...
})->middleware(['auth', 'verified']);



//template
Route::get('/welcome', function () {
    return view('welcome');
});
