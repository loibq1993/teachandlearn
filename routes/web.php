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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => ''], function () {
    Route::get('/', 'WordFrequencyController@index')->name('wordFrequency.index');
    Route::post('/frequency/submitInput' ,'WordFrequencyController@submitInput')->name('wordFrequency.submitInput');
    Route::post('/frequency/import', 'WordFrequencyController@import')->name('wordFrequency.import');
    Route::post('/frequency/export', 'WordFrequencyController@export')->name('wordFrequency.export');
});
