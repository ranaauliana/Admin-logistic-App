<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\GoogleController;

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
    Route::get('register', 'register')->name('register')->middleware('loggedIn');
    Route::post('register', 'registerSimpan')->name('register.simpan');

    Route::get('/login', 'login')->name('login')->middleware('loggedIn');
    Route::post('login', 'loginAksi')->name('login.aksi');
    Route::get('logout', 'logout')->name('logout');
    
});

Route::get('/', function () {
    return view('welcome');
});


Route::get('dashboard', [BarangController::class, 'dashboard'])->name('dashboard')->middleware(['isLoggedIn', 'isAdmin']);



Route::get('', [BarangController::class, 'index'])->name('barang')->middleware('isLoggedIn');
Route::get('tambah',[BarangController::class, 'tambah'])->name('barang.tambah')->middleware('isLoggedIn');;
Route::post('tambah',[BarangController::class, 'simpan'])->name('barang.tambah.simpan')->middleware('isLoggedIn');;
Route::get('edit/{id}', [BarangController::class, 'edit'])->name('barang.edit')->middleware('isLoggedIn');;
Route::post('edit/{id}',[BarangController::class,'update'])->name('barang.edit.update')->middleware('isLoggedIn');;
Route::get('hapus/{id}',[BarangController::class, 'hapus'])->name('barang.hapus')->middleware('isLoggedIn');;

//login google
Route::controller(GoogleController::class)->group(function(){
    Route::get('auth/google', 'redirectGoogle')->name('auth.google');
    Route::get('auth/google/callback', 'googleCallback');
});