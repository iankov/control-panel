<?php

namespace Iankov\ControlPanel\Controllers\Control;

use Barryvdh\Elfinder\Connector;
use Barryvdh\Elfinder\Session\LaravelSession;
use Iankov\ControlPanel\Controllers\Controller;
use Illuminate\Http\Request;

class FileManagerController extends Controller
{
    public function index()
    {
        $locale = str_replace("-",  "_", config('app.locale'));
        if (!file_exists(public_path("/packages/barryvdh/elfinder/js/i18n/elfinder.$locale.js"))) {
            $locale = false;
        }

        return view('icp::file-manager.index', [
            'locale' => $locale,
            'connector_url' => icp_route('file-manager.connector', ['root_index' => request()->input('root_index')])
        ]);
    }

    public function ckeditor()
    {
        $locale = str_replace("-",  "_", config('app.locale'));
        if (!file_exists(public_path("/packages/barryvdh/elfinder/js/i18n/elfinder.$locale.js"))) {
            $locale = false;
        }

        return view('icp::file-manager.ckeditor4', [
            'locale' => $locale,
            'dir' => 'packages/barryvdh/elfinder',
            'connector_url' => icp_route('file-manager.connector', ['root_index' => request()->input('root_index')])
        ]);
    }

    public function connector()
    {
        $rootIndex = request()->input('root_index');
        $roots = config('elfinder.roots', []);

        if(!empty($rootIndex)){
            $roots = [$rootIndex => array_get($roots, $rootIndex, [])];
        }

        if (app()->bound('session.store')) {
            $sessionStore = app('session.store');
            $session = new LaravelSession($sessionStore);
        } else {
            $session = null;
        }

        $rootOptions = config('elfinder.root_options', array());
        foreach ($roots as $key => $root) {
            $roots[$key] = array_merge($rootOptions, $root);
        }

        $opts = config('elfinder.options', array());
        $opts = array_merge($opts, ['roots' => $roots, 'session' => $session]);

        // run elFinder
        $connector = new Connector(new \elFinder($opts));
        $connector->run();
        return $connector->getResponse();
    }

}