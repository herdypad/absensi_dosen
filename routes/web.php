<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MenuAdminController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\DataAbsenController;
use App\Http\Controllers\MenuPegawaiController;
use App\Http\Controllers\PresensiController;

use App\Models\Presensi;

// home
Route::get('/', function () {
    $count  = DB::table('pegawais')->count();
    $presensi = Presensi::where('user_id', Auth::user()->id);
    $hadir  = Presensi::where('user_id', Auth::user()->id)->count();
    $izin   = Presensi::where('status', 2)->count();
    $telat  = Presensi::where('status', 3)->count();
    $alpa   = Presensi::where('status', 4)->count();
    $usr_id = Auth::user()->id;
    
    return view('index')->with([
        'title' => 'Sabang Digital Indonesia',
        'count' => $count,
        'hadir' => $hadir,
        'izin' => $izin,
        'telat' => $telat,
        'alpa' => $alpa,
        'usr_id' => $usr_id,
        'presensi' => $presensi,
    ]);
})->name('menu.home')->middleware('auth');

// auth
Route::get('login', [AuthController::class, 'index'])->name('auth.index');
Route::post('login', [AuthController::class, 'login'])->name('auth.login');
Route::get('daftar', [AuthController::class, 'create'])->name('auth.daftar');
Route::post('daftar', [AuthController::class, 'store'])->name('auth.store');
Route::post('logout', [AuthController::class, 'logout'])->name('auth.logout');

Route::group(['middleware' => ['admin:admin']], function(){
    
    //Route Admin
    Route::get ('admin',                    [MenuAdminController::class, 'admin'])->name('admin');
    Route::post('admin',                    [MenuAdminController::class, 'createAdmin'])->name('admin.createAdmin');
    Route::post('admin/update/{id}',        [MenuAdminController::class, 'updateAdmin'])->name('admin.updateAdmin');
    Route::get ('admin/delete/{id}',        [MenuAdminController::class, 'deleteAdmin'])->name('admin.deleteAdmin');

    //Route Pegawi
    Route::get ('pegawai',                          [MenuAdminController::class, 'pegawai'])->name('pegawai');
    Route::post('pegawai',                          [MenuAdminController::class, 'createPegawai'])->name('pegawai.createPegawai');
    Route::post('pegawai/update/{id}',              [MenuAdminController::class, 'updatePegawai'])->name('pegawai.updatePegawai');
    Route::get ('pegawai/delete/{id}',              [MenuAdminController::class, 'deletePegawai'])->name('pegawai.deletePegawai');
    Route::post ('pegawai/passwordupdate/{id}',     [MenuAdminController::class, 'updatePegawaiPassword'])->name('pegawai.updatePegawaiPassword');
    

    //Route Presensi 
    Route::get('presensiManual',            [DataAbsenController::class, 'presensiManual'])->name('presensiManual');
    Route::post('presensiManual',           [DataAbsenController::class, 'createPresensiManual'])->name('presensi.createPresensiManual');
    
    //Rote Izin
    Route::get('izinManual',                [DataAbsenController::class, 'izinManual'])->name('izinManual');
    Route::post('izinManual',               [DataAbsenController::class, 'createIzinManual'])->name('izin.createIzinManual');


    //Route Rekap Data
    Route::get('dataPresensi',                      [DataAbsenController::class, 'dataPresensi'])->name('dataPresensi');
    Route::post('editDataPresensi/update/{id}',     [DataAbsenController::class, 'editDataPresensi'])->name('presensi.editDataPresensi');
    Route::get('deleteDataPresensi/delete/{id}',    [DataAbsenController::class, 'deleteDataPresensi'])->name('presensi.deleteDataPresensi');


    Route::get('dataIzin',                      [DataAbsenController::class, 'dataIzin'])->name('dataIzin');
    Route::post('editDataIzin/update/{id}',     [DataAbsenController::class, 'editDataIzin'])->name('izin.editDataIzin');
    Route::get('deleteDataIzin/delete/{id}',    [DataAbsenController::class, 'deleteDataIzin'])->name('izin.deleteDataIzin');

    Route::get('dataTelat',                      [DataAbsenController::class, 'dataTelat'])->name('dataTelat');
    // Route::post('editDataIzin/update/{id}',     [DataAbsenController::class, 'editDataIzin'])->name('izin.editDataIzin');
    // Route::get('deleteDataIzin/delete/{id}',    [DataAbsenController::class, 'deleteDataIzin'])->name('izin.deleteDataIzin');

});

//Route MenuPegawai
Route::group(['middleware' => ['pegawai']], function () {

    //Presensi
    Route::get('presensi',             [PresensiController::class, 'presensi'])->name('pegawai.presensi');
    Route::post('masuk',             [PresensiController::class, 'masuk'])->name('presensi.masuk');
    Route::put('pulang/{presensi}',             [PresensiController::class, 'pulang'])->name('presensi.pulang');

    Route::get('/profil',               [MenuPegawaiController::class, 'index'])->name('profil.index');
    Route::post('/profil/PUpdate/{id}', [MenuPegawaiController::class, 'PUpdate'])->name('PUpdate');
    Route::post('crop',                 [MenuPegawaiController::class, 'crop'])->name('crop');
    Route::post('/profil/update-pass',   [MenuPegawaiController::class, 'updatePassword'])->name('profil.updatePassword');

    
    //Task Harian
    Route::get('task',                 [MenuPegawaiController::class, 'task'])->name('pegawai.task');
    Route::post('task',         [MenuPegawaiController::class, 'tambahTaskHarian'])->name('pegawai.tambahTaskHarian');
    Route::post('/task/update/{id}',    [MenuPegawaiController::class, 'updateTask'])->name('task.updateTask');
    Route::get('/task/delete/{id}',     [MenuPegawaiController::class, 'deleteTask'])->name('pegawai.deleteTask');
    
    
    //Task Mingguan
    Route::get('taskMingguan',          [MenuPegawaiController::class, 'task_mingguan'])->name('pegawai.task_mingguan');
    Route::post('taskMingguan',         [MenuPegawaiController::class, 'tambahTaskMingguan'])->name('pegawai.tambahTaskMingguan');
    Route::post('/taskM/update/{id}',    [MenuPegawaiController::class, 'updateTaskM'])->name('task.updateTaskM');
    Route::get('/taskM/delete/{id}',     [MenuPegawaiController::class, 'deleteTaskM'])->name('pegawai.deleteTaskM');

    //Route Rekap Data
    Route::get('dataPresensiP',                      [MenuPegawaiController::class, 'dataPresensiP'])->name('dataPresensi');
    // Route::post('editDataPresensi/update/{id}',     [MenuPegawaiController::class, 'editDataPresensi'])->name('presensi.editDataPresensi');
    // Route::get('deleteDataPresensi/delete/{id}',    [MenuPegawaiController::class, 'deleteDataPresensi'])->name('presensi.deleteDataPresensi');


    Route::get('dataIzinP',                      [MenuPegawaiController::class, 'dataIzinP'])->name('dataIzin');
    // Route::post('editDataIzin/update/{id}',     [MenuPegawaiController::class, 'editDataIzin'])->name('izin.editDataIzin');
    // Route::get('deleteDataIzin/delete/{id}',    [MenuPegawaiController::class, 'deleteDataIzin'])->name('izin.deleteDataIzin');

    Route::get('dataTelatP',                      [MenuPegawaiController::class, 'dataTelatP'])->name('dataTelat');
});




Route::get('/ip', function(){
    $location = Location::get();
    dd($location);
});

Route::resource('todo', ToDoController::class);
