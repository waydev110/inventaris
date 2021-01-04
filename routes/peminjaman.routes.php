<?php
Route::group(['middleware' => 'auth', 'namespace' => 'Administrator',  'prefix' => 'peminjaman', 'as' => 'peminjaman.'], function () {

    Route::post('datatable', 'PeminjamanController@datatable')->name('datatable');
    Route::get('/', 'PeminjamanController@index')->name('index');
    Route::get('create', 'PeminjamanController@create')->name('create');
    Route::get('/{url}', 'PeminjamanController@show')->name('show');
    Route::get('/{url}/edit', 'PeminjamanController@edit')->name('edit');
    Route::post('delete', 'PeminjamanController@destroy')->name('delete');
    Route::post('/', 'PeminjamanController@store')->name('store');
    Route::patch('/{id}', 'PeminjamanController@update')->name('update');
    Route::post('/jadwal', 'PeminjamanController@jadwal')->name('jadwal');
});
