<?php

use App\Http\Controllers\AdminPanelController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\AuditeController;
use App\Http\Controllers\DokumenController;
use App\Http\Controllers\LoginController;
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

Route::group(['middleware' => ['auth']], function(){
    Route::group(['middleware' => ['cekUserLogin:1']], function(){
        Route::resource('dashboard', ProjectController::class);

        //Route CRUD Post Controller
        Route::resource('/posts', PostController::class);
        Route::get('/tampilData/{id}', [PostController::class,'tampilData'])->name('tampilData');
        Route::post('/updateData/{id}', [PostController::class,'updateData'])->name('updateData');
        Route::get('/detailTugas/{id}',      [PostController::class,'detailTugas'])->name('detailTugas');

        //Route CRUD Anggota
        Route::resource('/anggotas', AnggotaController::class);
        Route::get('/tampilDataAnggota/{id}', [AnggotaController::class,'tampilDataAnggota'])->name('tampilDataAnggota');
        Route::post('/updateDataAnggota/{id}', [AnggotaController::class,'updateDataAnggota'])->name('updateDataAnggota');

        //Route CRUD Auditee
        Route::resource('/audites', AuditeController::class);
        Route::get('tampilDataAudite/{id}', [AuditeController::class,'tampilDataAudite'])->name('tampilDataAudite');
        Route::get('updateDataAudite/{id}', [AuditeController::class,'updateDataAudite'])->name('updateDataAudite');

        //Route CRUD Dokumen
        Route::resource('/dokumens', DokumenController::class);
        Route::get('/tampilDataDokumen/{id}', [DokumenController::class,'tampilDataDokumen'])->name('tampilDataDokumen');
        Route::post('/updateDataDokumen/{id}', [DokumenController::class,'updateDataDokumen'])->name('updateDataDokumen');
        Route::get('dokumen/download/{id}', [DokumenController::class,'download'])->name('download.dokumen');

        //Rute untuk Admin Panel
    Route::get('/admin/panel', [AdminPanelController::class, 'index'])->name('admin.panel');
    Route::post('/admin/panel/{userId}/save-menu-config', [AdminPanelController::class, 'saveMenuConfig'])->name('admin.saveMenuConfig');
    });

});


 //Route CRUD Post Controller
 Route::resource('/posts', PostController::class);
 Route::get('/tampilData/{id}', [PostController::class,'tampilData'])->name('tampilData');
 Route::post('/updateData/{id}', [PostController::class,'updateData'])->name('updateData');
 Route::get('/detailTugas/{id}',      [PostController::class,'detailTugas'])->name('detailTugas');

 //Route CRUD Anggota
 Route::resource('/anggotas', AnggotaController::class);
 Route::get('/tampilDataAnggota/{id}', [AnggotaController::class,'tampilDataAnggota'])->name('tampilDataAnggota');
 Route::post('/updateDataAnggota/{id}', [AnggotaController::class,'updateDataAnggota'])->name('updateDataAnggota');

 //Route CRUD Auditee
 Route::resource('/audites', AuditeController::class);
 Route::get('tampilDataAudite/{id}', [AuditeController::class,'tampilDataAudite'])->name('tampilDataAudite');
 Route::get('updateDataAudite/{id}', [AuditeController::class,'updateDataAudite'])->name('updateDataAudite');

 //Route CRUD Dokumen
 Route::resource('/dokumens', DokumenController::class);
 Route::get('/tampilDataDokumen/{id}', [DokumenController::class,'tampilDataDokumen'])->name('tampilDataDokumen');
 Route::post('/updateDataDokumen/{id}', [DokumenController::class,'updateDataDokumen'])->name('updateDataDokumen');
 Route::get('dokumen/download/{id}', [DokumenController::class,'download'])->name('download.dokumen');


//Route View
Route::get('/dashboard',               [ProjectController::class,'dashboard'])->middleware('auth');
Route::get('/',                        [ProjectController::class,'dashboard'])->middleware('auth');

//Route Search
Route::get('/reviewLaporan/search',     [ProjectController::class,'search']);
Route::get('/userAnggota/search',     [AnggotaController::class,'search']);
Route::get('/userAudite/search',        [AuditeController::class,'search']);
Route::get('/dokumen/search',           [DokumenController::class,'search']);





//template
Route::get('/welcome', function () {
    return view('welcome');
});
