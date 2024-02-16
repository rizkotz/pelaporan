<?php

use App\Http\Controllers\AdminPanelController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\AuditeController;
use App\Http\Controllers\DokumenController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\PostController;
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
Route::resource('/admin/panel', MenuController::class);

 //Route CRUD Post Controller
 Route::resource('/posts', PostController::class)->middleware(['auth','cekUserLogin']);
 Route::get('/tampilData/{id}', [PostController::class,'tampilData'])->name('tampilData')
        ->middleware(['auth','cekUserLogin']);
 Route::post('/updateData/{id}', [PostController::class,'updateData'])->name('updateData')
        ->middleware(['auth','cekUserLogin']);
 Route::get('/detailTugas/{id}',      [PostController::class,'detailTugas'])->name('detailTugas')
        ->middleware(['auth','cekUserLogin']);

 //Route CRUD Anggota
 Route::resource('/anggotas', AnggotaController::class)->middleware(['auth','cekUserLogin']);
 Route::get('/tampilDataAnggota/{id}', [AnggotaController::class,'tampilDataAnggota'])->name('tampilDataAnggota')
        ->middleware(['auth','cekUserLogin']);
 Route::post('/updateDataAnggota/{id}', [AnggotaController::class,'updateDataAnggota'])->name('updateDataAnggota')
        ->middleware(['auth','cekUserLogin']);

 //Route CRUD Auditee
 Route::resource('/audites', AuditeController::class)->middleware(['auth','cekUserLogin']);
 Route::get('tampilDataAudite/{id}', [AuditeController::class,'tampilDataAudite'])->name('tampilDataAudite')
        ->middleware(['auth','cekUserLogin']);
 Route::get('updateDataAudite/{id}', [AuditeController::class,'updateDataAudite'])->name('updateDataAudite')
        ->middleware(['auth','cekUserLogin']);

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
Route::get('/userAudite/search',        [AuditeController::class,'search'])->middleware('auth');
Route::get('/dokumen/search',           [DokumenController::class,'search'])->middleware('auth');





//template
Route::get('/welcome', function () {
    return view('welcome');
});
