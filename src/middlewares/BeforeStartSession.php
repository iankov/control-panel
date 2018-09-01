<?php

namespace Iankov\ControlPanel\Middlewares;

use Closure;

class BeforeStartSession
{
    /**
     * Replace standard session config with icp
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $sessionConfig = config()->get('icp.session', []);

        foreach($sessionConfig as $key => $value){
            config()->set('session.'.$key, $value);
        }

        return $next($request);
    }
}
