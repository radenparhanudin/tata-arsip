<?php
Route::group(['prefix' => '/',  'middleware' => ['auth']], function(){
    Route::group(['middleware' => ['role:administrator']], function(){
        Route::resource('user', 'UserController');
    });

    Route::get('user/profile', 'UserController@profile')->name('user.profile');
});
