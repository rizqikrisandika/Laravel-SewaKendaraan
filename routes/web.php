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

Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->name('dashboard.admin');


Route::get('dashboard/kendaraan', function () {
    return view('admin.kendaraan');
})->name('kendaraan.admin');

Route::get('dashboard/kategori', function () {
    return view('admin.kategori');
})->name('kategori.admin');

Route::get('/home', 'HomeController@index')->name('home');
