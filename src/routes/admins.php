<?php

Route::get('/admins', ['as' => 'admins', 'uses' => 'AdminController@index']);
Route::group(['prefix' => '/admin', 'as' => 'admin.'], function() {
    Route::get('create', ['as' => 'create', 'uses' => 'AdminController@create']);
    Route::post('/', ['as' => 'store', 'uses' => 'AdminController@store']);
    Route::get('{id}/edit', ['as' => 'edit', 'uses' => 'AdminController@edit']);
    Route::put('{id}', ['as' => 'update', 'uses' => 'AdminController@update']);
    Route::delete('{id}', ['as' => 'delete', 'uses' => 'AdminController@delete']);
});