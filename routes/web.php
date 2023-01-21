<?php

use App\Http\Controllers\AnggotaKeluargaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CrudController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\RiwayatKeaktifanController;
use App\Http\Controllers\RiwayatStrukturalController;
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
Route::get('/', function () {
    return redirect(route('form.login'));
});
Route::get('/login', [AuthController::class, 'login'])->name('form.login');
Route::post('/login', [AuthController::class, 'authenicate'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/pegawai', [PegawaiController::class,'index'])->name('pegawai.index');
    Route::post('/pegawai/list', [PegawaiController::class,'list'])->name('pegawai.list');
    Route::delete('/pegawai/{id}', [PegawaiController::class,'delete'])->name('pegawai.delete');

    Route::get('/pegawai/keluarga/create/{id}', [AnggotaKeluargaController::class,'create'])->name('keluarga.create');
    Route::get('/pegawai/keluarga/show/{id}', [AnggotaKeluargaController::class,'show'])->name('keluarga.show');
    Route::post('/pegawai/keluarga/store', [AnggotaKeluargaController::class,'store'])->name('keluarga.store');
    Route::delete('/pegawai/keluarga/{id}', [AnggotaKeluargaController::class,'delete'])->name('keluarga.delete');
    Route::get('/pegawai/keluarga/{id_anggota_keluarga}/edit', [AnggotaKeluargaController::class,'edit'])->name('keluarga.edit');
    Route::put('/pegawai/keluarga/{id_anggota_keluarga}/update', [AnggotaKeluargaController::class,'update'])->name('keluarga.update');
    Route::get('/pegawai/keluarga/{id}', [AnggotaKeluargaController::class,'index'])->name('keluarga.index');
    Route::post('/pegawai/keluarga/list/{id}', [AnggotaKeluargaController::class,'list'])->name('keluarga.list');

    Route::get('/pegawai/struktural/{id}', [RiwayatStrukturalController::class,'index'])->name('struktural.index');
    Route::post('/pegawai/struktural/list/{id}', [RiwayatStrukturalController::class,'list'])->name('struktural.list');
    Route::delete('/pegawai/struktural/{id}', [RiwayatStrukturalController::class,'delete'])->name('struktural.delete');
    Route::get('/pegawai/struktural/create/{id}', [RiwayatStrukturalController::class,'create'])->name('struktural.create');
    Route::post('/pegawai/struktural/store', [RiwayatStrukturalController::class,'store'])->name('struktural.store');
    Route::get('/pegawai/struktural/{id}/edit', [RiwayatStrukturalController::class,'edit'])->name('struktural.edit');
    Route::put('/pegawai/struktural/{id}/update', [RiwayatStrukturalController::class,'update'])->name('struktural.update');
    Route::get('/pegawai/struktural/show/{id}', [RiwayatStrukturalController::class,'show'])->name('struktural.show');

    Route::get('/pegawai/keaktifan/{id}', [RiwayatKeaktifanController::class,'index'])->name('keaktifan.index');
    Route::post('/pegawai/keaktifan/list/{id}', [RiwayatKeaktifanController::class,'list'])->name('keaktifan.list');
    Route::delete('/pegawai/keaktifan/{id}', [RiwayatKeaktifanController::class,'delete'])->name('keaktifan.delete');
    Route::get('/pegawai/keaktifan/create/{id}', [RiwayatKeaktifanController::class,'create'])->name('keaktifan.create');
    Route::post('/pegawai/keaktifan/store', [RiwayatKeaktifanController::class,'store'])->name('keaktifan.store');
    Route::get('/pegawai/keaktifan/{id}/edit', [RiwayatKeaktifanController::class,'edit'])->name('keaktifan.edit');
    Route::put('/pegawai/keaktifan/{id}/update', [RiwayatKeaktifanController::class,'update'])->name('keaktifan.update');
    Route::get('/pegawai/keaktifan/show/{id}', [RiwayatKeaktifanController::class,'show'])->name('keaktifan.show');
});



// Route::get('/crud', [CrudController::class,'index'])->name('crud.list');
// Route::get('/crud/create', [CrudController::class,'create'])->name('crud.create');
// Route::post('/crud/store', [CrudController::class,'store'])->name('crud.store');
// Route::get('/crud/{id}/edit', [CrudController::class,'edit'])->name('crud.edit');
// Route::put('/crud/{mahasiswa}/update', [CrudController::class,'update'])->name('crud.update');
// Route::delete('/crud/{id}', [CrudController::class,'deleteData'])->name('crud.delete');

// Route::post('/crud/listData', [CrudController::class,'listData'])->name('crud.listData');

// Route::get('/crud2', [CrudController::class,'index'])->name('crud.list');




// Route::group(['prefix' => 'pegawai'], function () {
//     Route::get('/', [PegawaiController::class,'index'])->name('pegawai.index');
//     Route::post('/list', [PegawaiController::class,'list'])->name('pegawai.list');
//     Route::delete('/{id}', [PegawaiController::class,'delete'])->name('pegawai.delete');

//     Route::group(['prefix' => 'keluarga'], function () {
//         Route::get('/{id}', [AnggotaKeluargaController::class,'index'])->name('keluarga.index');
//         Route::post('/list/{id}', [AnggotaKeluargaController::class,'list'])->name('keluarga.list');
//     });
// });
