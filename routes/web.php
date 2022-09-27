<?php

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


Route::group(['namespace' => 'Siswa'], function () {
    Route::get('siswa', 'SiswaController@index');
    Route::get('tambahSiswa', function(){
        return view('app.siswa.tambahSiswa');
    });
    Route::get('siswa/{id}', 'SiswaController@get');
    Route::post('siswa', 'SiswaController@store');
    Route::put('siswa/{id}', 'SiswaController@update');
    Route::delete('siswa/{nis}', 'SiswaController@destroy');

    Route::get('absensi', 'AbsensiController@index');
    Route::post('image-cropper', 'SiswaController@cropImage');
});

