<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
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







// define("PAGINATE_NUMBER", 6);
// date_default_timezone_set('Africa/Cairo');

Route::get('/clear', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    return 'cach clear success';
});


Auth::routes();


Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['guest']], function () {
    Route::get('/', function () {
        return view('auth.login');
    });
});



Route::group(
    [
        'prefix'     => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth'],
    ],
    function () {

        Route::get('/dashboard/home', 'HomeController@index')->name('dashboard.home');
        Route::get('/dashboard', 'HomeController@index')->name('dashboard.home');

        Route::prefix('dashboard')->namespace('Dashboard')->name('dashboard.')->group(function () {

            Route::resource('types', 'TypeController');
            
        });
    }
);
