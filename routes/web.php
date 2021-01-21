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

    Route::get('/dashboard/profil', 'AdminController@profil')->name('profil.admin');
    Route::put('/dashboard/profil/ubah', 'AdminController@updateProfil')->name('ubahprofil.admin');
    Route::put('/dashboard/profil/password', 'AdminController@ubahPassword')->name('ubahpassword.admin');

    Route::get('/dashboard/pengguna', 'PenggunaController@index')->name('pengguna.admin');
    Route::post('/dashboard/pengguna', 'PenggunaController@store')->name('tambahpengguna.admin');
    Route::put('/dashboard/pengguna/{id}', 'PenggunaController@update')->name('ubahpengguna.admin');
    Route::delete('/dashboard/pengguna/{id}', 'PenggunaController@destory')->name('hapuspengguna.admin');

    Route::get('dashboard/kendaraan', 'KendaraanController@index')->name('kendaraan.admin');
    Route::post('dashboard/kendaraan', 'KendaraanController@store')->name('tambahkendaraan.admin');
    Route::put('dashboard/kendaraan/{slug}', 'KendaraanController@update')->name('updatekendaraan.admin');
    Route::delete('dashboard/kendaraan/{slug}', 'KendaraanController@destroy')->name('hapuskendaraan.admin');
    Route::get('dashboard/kendaraan/semua', 'KendaraanController@cetak')->name('cetakkendaraan.admin');

    Route::get('dashboard/kategori', 'KategoriController@index')->name('kategori.admin');
    Route::post('dashboard/kategori', 'KategoriController@store')->name('tambahkategori.admin');
    Route::put('dashboard/kategori/{slug}', 'KategoriController@update')->name('updatekategori.admin');
    Route::delete('dashboard/kategori/{slug}', 'KategoriController@destroy')->name('hapuskategori.admin');

    Route::get('dashboard/laporan/kendaraan', 'LaporanController@index_kendaraan')->name('laporankendaraan.admin');
    Route::post('dashboard/laporan/kendaraan/tanggal', 'LaporanController@laporan_tanggal_kendaraan')->name('tgl_laporankendaraan.admin');
    Route::get('dashboard/laporan/kendaraan/harian', 'LaporanController@laporan_harian_kendaraan')->name('hr_laporankendaraan.admin');
    Route::get('dashboard/laporan/kendaraan/mingguan', 'LaporanController@laporan_mingguan_kendaraan')->name('mg_laporankendaraan.admin');
    Route::get('dashboard/laporan/kendaraan/bulanan', 'LaporanController@laporan_bulanan_kendaraan')->name('bl_laporankendaraan.admin');
    Route::get('dashboard/laporan/kendaraan/tahunan', 'LaporanController@laporan_tahunan_kendaraan')->name('th_laporankendaraan.admin');
});

Route::group(['middleware' => ['auth','role:super admin']], function () {
    Route::get('/dashboard/admin', 'AdminController@index')->name('admin.admin');
    Route::post('/dashboard/admin', 'AdminController@store')->name('tambahadmin.admin');
    Route::delete('/dashboard/admin/{id}', 'AdminController@destory')->name('hapusadmin.admin');
});



Route::get('/home', 'HomeController@index')->name('home');
