<?php

Route::get('settings', ['as' => 'settings', 'uses' => 'SettingController@index']);
Route::group(['prefix' => 'setting', 'as' => 'setting.'], function() {
    Route::get('create', ['as' => 'create', 'uses' => 'SettingController@create']);
    Route::post('/', ['as' => 'store', 'uses' => 'SettingController@store']);
    Route::get('{id}/edit', ['as' => 'edit', 'uses' => 'SettingController@edit']);
    Route::put('{id}', ['as' => 'update', 'uses' => 'SettingController@update']);
    Route::put('{id}/active/toggle', ['as' => 'active.toggle', 'uses' => 'SettingController@toggleActive']);
    Route::delete('{id}', ['as' => 'delete', 'uses' => 'SettingController@delete']);
});