<?php
Route::group(['middleware' => 'auth', 'namespace' => 'Administrator',  'prefix' => 'administrator/barang', 'as' => 'administrator.barang.'], function () {

    Route::group(['prefix' => 'kategori', 'as' => 'kategori'], function () {
        Route::post('datatable', 'KategoriBarangController@datatable')->name('datatable');
        Route::get('/', 'KategoriBarangController@index')->name('index');
        Route::get('create', 'KategoriBarangController@create')->name('create');
        Route::get('/{url}/edit', 'KategoriBarangController@edit')->name('edit');
        Route::post('delete', 'KategoriBarangController@destroy')->name('delete');
        Route::post('/', 'KategoriBarangController@store')->name('store');
        Route::patch('/{id}', 'KategoriBarangController@update')->name('update');
    });

    Route::post('datatable', 'BarangController@datatable')->name('datatable');
    Route::get('/', 'BarangController@index')->name('index');
    Route::get('create', 'BarangController@create')->name('create');
    Route::get('/{url}', 'BarangController@show')->name('show');
    Route::get('/{url}/edit', 'BarangController@edit')->name('edit');
    Route::post('delete', 'BarangController@destroy')->name('delete');
    Route::post('/', 'BarangController@store')->name('store');
    Route::patch('/{id}', 'BarangController@update')->name('update');
});
