<?php

namespace Iankov\ControlPanel\Controllers;

use Iankov\ControlPanel\Models\StaticPage;

class StaticPageController extends Controller
{
    public function index($route)
    {
        $page = StaticPage::where('route', $route)->where('active', 1)->firstOrFail();

        $mimetype = \GuzzleHttp\Psr7\mimetype_from_filename($page->route);
        if(!$mimetype){
            $mimetype = 'text/html'; //by default
        }

        return response($page->content)->header('Content-Type', $mimetype);
    }
}