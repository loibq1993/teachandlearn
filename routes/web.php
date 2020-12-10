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

Route::group(['prefix' => ''], function () {
    Route::get('/', function() {
        return view('welcome');
    })->name('home');
    Route::get('/frequency', 'WordFrequencyController@index')->name('wordFrequency.index');
    Route::post('/frequency/submitInput' ,'WordFrequencyController@submitInput')
        ->name('wordFrequency.submitInput');
    Route::post('/frequency/import', 'WordFrequencyController@import')->name('wordFrequency.import');
    Route::post('/frequency/export', 'WordFrequencyController@export')->name('wordFrequency.export');

    Route::get('/flash-card', 'FlashCardController@index')->name('flashCard.index');
    Route::post('/flash-card/import', 'FlashCardController@import')->name('flashCard.import');
    Route::post('/flash-card/export/pdf', 'FlashCardController@export')->name('flashCard.export.pdf');

    Route::get('/convert-multiple-choice', 'ConvertMultipleChoiceController@index')
        ->name('convertMultipleChoice.index');
    Route::post('/convert-multiple-choice/import', 'ConvertMultipleChoiceController@import')
        ->name('convertMultipleChoice.import');
    Route::post('/convert-multiple-choice/export', 'ConvertMultipleChoiceController@export')
        ->name('convertMultipleChoice.export');

});
