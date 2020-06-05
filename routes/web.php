<?php

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
    if (Auth::check()) {
        return redirect()->route('home');
    } else {
        return redirect()->route('login');
    }
});

// Auth::routes();
Route::namespace('Auth')->group(function(){
	Route::get('masuk','LoginController@showLoginForm')->name('login');
	Route::post('masuk','LoginController@login');
	Route::post('keluar','LoginController@logout')->name('logout');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function() {
    
    Route::group(['middleware' => 'role:administrator'], function() {
        // Master Data
        Route::group(['prefix' => 'master-data'], function() {
            Route::get('/{params}', 'MasterDataController@index')->name('master-data.index');
        });

        // Download Data
        Route::group(['prefix' => 'download'], function() {
            Route::get('/template/{template}', 'DownloadController@template');
        });

        // Rekon Data
        Route::group(['prefix' => 'rekon'], function() {
            Route::get('/', 'RekonController@index')->name('rekon.index');
            Route::post('/import/{params}', 'RekonController@import')->name('rekon.import');
        });

        // User
        Route::resource('user', 'UserController');
        Route::get('table/user', 'UserController@dataTable')->name('table.user');
        Route::post('generate/user', 'UserController@generate')->name('generate.user');
    });

    Route::group(['middleware' => 'role:data-informasi|bidang-mutasi'], function() {
        Route::resource('nosk', 'NomorSKController');
        Route::get('table/nosk', 'NomorSKController@dataTable')->name('table.nosk');

        Route::resource('uploadsk', 'ArsipController');
        Route::get('table/uploadsk', 'ArsipController@dataTable')->name('table.uploadsk');
    });

    Route::get('/data/pegawai', 'DataController@pegawai')->name('data.pegawai');
    Route::post('/data/jabatan', 'DataController@jabatan')->name('data.jabatan');
    Route::post('/data/unitkerja', 'DataController@unitkerja')->name('data.unitkerja');
    Route::post('/data/nomorsk', 'DataController@nomorsk')->name('data.nomorsk');

});
