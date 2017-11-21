<?php

//Login and logout routes
Route::get('login', ['as' => 'login', 'uses' => 'LoginController@showLoginForm']);
Route::post('login', ['as' => 'login.post', 'uses' => 'LoginController@login']);
Route::post('logout', ['as' => 'logout', 'uses' => 'LoginController@logout']);

// Password Reset Routes...
Route::get('password/reset', ['as' => 'password.request', 'uses' => 'ForgotPasswordController@showLinkRequestForm']);
Route::post('password/email', ['as' => 'password.email', 'uses' => 'ForgotPasswordController@sendResetLinkEmail']);
Route::get('password/reset/{token}', ['as' => 'password.reset', 'uses' => 'ResetPasswordController@showResetForm']);
Route::post('password/reset', 'ResetPasswordController@reset');