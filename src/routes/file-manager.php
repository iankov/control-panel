<?php

Route::get('file-manager', ['as' => 'file-manager', 'uses' => 'FileManagerController@index']);
Route::get('file-manager/ckeditor', ['as' => 'file-manager.ckeditor', 'uses' => 'FileManagerController@ckeditor']);
Route::any('file-manager/connector', ['as' => 'file-manager.connector', 'uses' => 'FileManagerController@connector']);