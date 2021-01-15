<?php
Route::group(['middleware' => 'auth', 'namespace' => 'Administrator',  'prefix' => 'administrator/user', 'as' => 'administrator.user.'], function () {

    Route::post('datatable', 'UserController@datatable')->name('datatable');
    Route::get('/', 'UserController@index')->name('index');
    Route::get('create', 'UserController@create')->name('create');
    Route::get('/{url}', 'UserController@show')->name('show');
    Route::get('/{url}/edit', 'UserController@edit')->name('edit');
    Route::post('delete', 'UserController@destroy')->name('delete');
    Route::post('/', 'UserController@store')->name('store');
    Route::patch('/{id}', 'UserController@update')->name('update');
});
