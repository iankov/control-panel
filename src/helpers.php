<?php

/**
 * Generate the URL to a named route.
 *
 * @param  string  $name
 * @param  array   $parameters
 * @param  bool    $absolute
 * @return string
 */
function icp_route($name, $parameters = [], $absolute = true)
{
    return route(config('icp.route.prefix-name').$name, $parameters, $absolute);
}

/**
 * returns setting from database
 *
 * @param  string  $pattern
 * @return array or string
 */
if (! function_exists('setting')) {
    function setting($pattern = null, $default = '')
    {
        static $settings;
        if(!isset($settings)){
            $settings = \Iankov\ControlPanel\Models\Setting::where('active', 1)->get();
        }

        if(is_null($pattern)){
            return $settings->pluck('parsed_value', 'key')->toArray();
        }

        if(str_contains($pattern, '*')){
            return $settings->filter(function($item, $key) use ($pattern){
                return str_is($pattern, $item->key);
            })->pluck('parsed_value', 'key')->toArray();
        }

        $result = $settings->where('key', $pattern)->first();

        return $result ? $result->parsed_value : $default;
    }
}

/**
 * Assoc array to html attributes
 *
 * @param array
 * @return string
 */
if(! function_exists('html_attributes')){
    function html_attributes($assoc)
    {
        $attributes = [];
        foreach($assoc as $k => $v){
            $attributes[] = $k.'="'.e($v).'"';
        }

        return implode(' ', $attributes);
    }
}

/**
 * Laravel array dotted key style to html field name
 * Example: html_field_name('users.personal.first_name') returns users[personal][first_name]
 *
 * @param string
 * @return string
 */
if(!function_exists('html_field_name')){
    function html_field_name($name)
    {
        $segments = explode('.', $name);
        $first = array_shift($segments);

        $segments = array_map(function($item){
            return '['.$item.']';
        }, $segments);

        return $first.implode('', $segments);
    }
}