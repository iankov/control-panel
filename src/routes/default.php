<?php

Route::get('/', ['as' => 'index', 'uses' => function () {
    return redirect(config('icp.panel-default-url'));
}]);