<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['namespace' => 'Api'], function () {
    Route::get('siswa','SiswaController@index')->name('siswa.index');
    Route::get('siswa/{nis}','SiswaController@get')->name('siswa.get');
    Route::post('siswa ','SiswaController@store')->name('siswa.store');
    Route::put('siswa/{nis}','SiswaController@update')->name('siswa.update');
    Route::delete('siswa/{nis}','SiswaController@destroy')->name('siswa.destroy');
    
    // Route::post('siswa/send','SiswaController@send')->name('siswa.send');
    Route::get('absen','absenController@index')->name('absen.index');
    Route::get('absen/{nis}','absenController@get')->name('absen.get');
    Route::get('absen/param/{tgl}/{status}/{kelas}/{jurusan}','absenController@getByParam')->name('absen.getByParam');
    Route::post('absen ','absenController@store')->name('absen.store');
});

