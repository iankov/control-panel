<?php

namespace Iankov\ControlPanel\Controllers\Control;

use Iankov\ControlPanel\Controllers\Controller;

class FileManagerController extends Controller
{
    public function index()
    {
        $locale = str_replace("-",  "_", config('app.locale'));
        if (!file_exists(public_path("/packages/barryvdh/elfinder/js/i18n/elfinder.$locale.js"))) {
            $locale = false;
        }

        return view('icp::file-manager.index', [
            'locale' => $locale
        ]);
    }

}