<?php

use Illuminate\Support\Facades\Route;
use \Illuminate\Support\Facades\Auth;
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

Route::get('/', 'HomeController@index')->name('home');


Route::middleware('auth')->group(function () {
    Route::get('/settings', 'SettingsController@edit')->name('settings.edit');

    Route::patch('/settings', 'SettingsContoller@update')->name('settings.edit');

    //group routes
    Route::get('/groups/create', 'GroupController@create')
        ->name('group.create');

    Route::post('/group/', 'GroupController@store')->name('group.store');
});
