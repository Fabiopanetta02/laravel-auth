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

Route::get('/{any?}', function () {
    return view('guest.home');
})->where("any", ".*");

Auth::routes(['register' => false]);

Route::middleware('auth')->prefix('admin')->namespace('Admin')->name('admin.')->group(function () {
    //Home
    Route::get('/', 'HomeController@index')->name('home');
    
    //Resource POST
    //Route::resource('posts', 'PostController');
});
