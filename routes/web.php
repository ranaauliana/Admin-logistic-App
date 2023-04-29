<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
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
*/

Route::controller(AuthController::class)->group(function(){
    Route::get('register', 'register')->name('register');
    Route::post('register', 'registerSimpan')->name('register.simpan');

    Route::get('login', 'login')->name('login');
    Route::post('login', 'loginAksi')->name('login.aksi');
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('dashboard', function() {
    return view('dashboard', [ "title" => "Dashboard"]);
})->name('dashboard');

Route::middleware(['auth'])->group(function(){
    Route::get('', [BarangController::class, 'index'])->name('barang');
    Route::get('tambah',[BarangController::class, 'tambah'])->name('barang.tambah');
    Route::post('tambah',[BarangController::class, 'simpan'])->name('barang.tambah.simpan');
    Route::get('edit/{id}', [BarangController::class, 'edit'])->name('barang.edit');
    Route::post('edit/{id}',[BarangController::class,'update'])->name('barang.edit.update');
    Route::get('hapus/{id}',[BarangController::class, 'hapus'])->name('barang.hapus');
});