<?php

Route::get('static', ['as' => 'static', 'uses' => 'StaticPageController@index']);
Route::group(['prefix' => 'static', 'as' => 'static.'], function () {
    Route::get('create', ['as' => 'create', 'uses' => 'StaticPageController@create']);
    Route::post('/', ['as' => 'store', 'uses' => 'StaticPageController@store']);
    Route::get('{id}/edit', ['as' => 'edit', 'uses' => 'StaticPageController@edit']);
    Route::put('{id}', ['as' => 'update', 'uses' => 'StaticPageController@update']);
    Route::put('{id}/active/toggle', ['as' => 'active.toggle', 'uses' => 'StaticPageController@toggleActive']);
    Route::delete('{id}', ['as' => 'delete', 'uses' => 'StaticPageController@delete']);
});