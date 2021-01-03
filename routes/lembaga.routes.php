<?php
Route::group(['middleware' => 'auth', 'namespace' => 'Administrator',  'prefix' => 'administrator/lembaga', 'as' => 'administrator.lembaga.'], function () {

    Route::post('datatable', 'LembagaController@datatable')->name('datatable');
    Route::get('/', 'LembagaController@index')->name('index');
    Route::get('create', 'LembagaController@create')->name('create');
    Route::get('/{url}', 'LembagaController@show')->name('show');
    Route::get('/{url}/edit', 'LembagaController@edit')->name('edit');
    Route::post('delete', 'LembagaController@destroy')->name('delete');
    Route::post('/', 'LembagaController@store')->name('store');
    Route::patch('/{id}', 'LembagaController@update')->name('update');
});
