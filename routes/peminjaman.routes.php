<?php

Route::group(['middleware' => 'auth', 'namespace' => 'Administrator',  'prefix' => 'administrator/peminjaman', 'as' => 'administrator.peminjaman.'], function () {

    Route::post('datatable', 'PeminjamanController@datatable')->name('datatable');
    Route::post('datatableRiwayat', 'PeminjamanController@datatableRiwayat')->name('datatable-riwayat');
    Route::get('/', 'PeminjamanController@index')->name('index');
    Route::get('/riwayat', 'PeminjamanController@riwayat')->name('riwayat');
    Route::get('/{url}', 'PeminjamanController@show')->name('show');
    Route::patch('/{id}', 'PeminjamanController@approval')->name('approval');
});

Route::group(['middleware' => 'auth', 'namespace' => 'Administrator',  'prefix' => 'peminjaman', 'as' => 'peminjaman.'], function () {

    Route::post('datatable', 'PeminjamanController@datatable')->name('datatable');
    Route::get('/riwayat', 'PeminjamanController@riwayat')->name('riwayat');
    Route::get('/', 'PeminjamanController@index')->name('index');
    Route::get('create', 'PeminjamanController@create')->name('create');
    Route::get('/{url}', 'PeminjamanController@show')->name('show');
    Route::get('/{url}/edit', 'PeminjamanController@edit')->name('edit');
    Route::post('delete', 'PeminjamanController@destroy')->name('delete');
    Route::post('/', 'PeminjamanController@store')->name('store');
    Route::patch('/{id}', 'PeminjamanController@update')->name('update');
    Route::post('/jadwal', 'PeminjamanController@jadwal')->name('jadwal');
});

Route::group(['middleware' => 'auth', 'namespace' => 'Administrator',  'prefix' => 'laporan', 'as' => 'laporan.'], function () {

    Route::get('/', 'PeminjamanController@formLaporan');
    Route::get('/{tahun}/{bulan}', 'PeminjamanController@laporan');
});
