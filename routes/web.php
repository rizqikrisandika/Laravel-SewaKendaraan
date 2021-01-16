<?php

use Illuminate\Support\Facades\Auth;
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
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => ['auth','role:super admin|admin']], function () {

    Route::get('/dashboard', 'DashboardController@index')->name('dashboard.admin');

    Route::get('/dashboard/pengguna', 'PenggunaController@index')->name('pengguna.admin');
    Route::post('/dashboard/pengguna', 'PenggunaController@store')->name('tambahpengguna.admin');

    Route::get('dashboard/kendaraan', 'KendaraanController@index')->name('kendaraan.admin');
    Route::post('dashboard/kendaraan', 'KendaraanController@store')->name('tambahkendaraan.admin');
    Route::put('dashboard/kendaraan/{slug}', 'KendaraanController@update')->name('updatekendaraan.admin');
    Route::delete('dashboard/kendaraan/{slug}', 'KendaraanController@destroy')->name('hapuskendaraan.admin');

    Route::get('dashboard/kategori', 'KategoriController@index')->name('kategori.admin');
    Route::post('dashboard/kategori', 'KategoriController@store')->name('tambahkategori.admin');
    Route::put('dashboard/kategori/{slug}', 'KategoriController@update')->name('updatekategori.admin');
    Route::delete('dashboard/kategori/{slug}', 'KategoriController@destroy')->name('hapuskategori.admin');
});




Route::get('/home', 'HomeController@index')->name('home');
