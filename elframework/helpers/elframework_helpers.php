<?php

use Iliuminates\Hashes\Hash;


if (!function_exists('csrf_token')) {
    function csrf_token(): string
    {
        return \Iliuminates\Sessions\session::get('csrf_token');
    }
}

if (!function_exists('csrf_field')) {
    function csrf_field(): string
    {
        return '<input type="hidden" name="_token" value="' . csrf_token() .  '">';
    }
}

if (!function_exists('request')) {
    function request(string $name = null, mixed $default = null)
    {
        if (empty($name)) {
            return \Iliuminates\Http\Request::all();
        } else {
            return \Iliuminates\Http\Request::get($name, $default);
        }
    }
}

if (!function_exists('url')) {
    function url(string $url = ''): string
    {
        return $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . ROOT_DIR . ltrim($url, '/');
    }
}

if (!function_exists('trans')) {
    function trans(string $trans = null, array|null $attributes = []): string|object
    {
        return !empty($trans) ? \Iliuminates\Locales\Lang::get($trans, $attributes) : new \Iliuminates\Locales\Lang;
    }
}

if (!function_exists('view')) {
    function view(string $view, null|array $data = null)
    {
        return \Iliuminates\Views\View::make($view, $data);
    }
}

if (!function_exists('base_path')) {
    function base_path(string $file = null)
    {
        return ROOT_PATH . '/../' . $file;
    }
}

if (!function_exists('storage_path')) {
    function storage_path(string $path = null)
    {
        return !is_null($path) ? base_path('storage') . '/' . $path : '';
    }
}

if (!function_exists('route_path')) {
    function route_path(string $file = null)
    {
        return !is_null($file) ? config('route.path') . '/' . $file : config('route.path');
    }
}

if (!function_exists('config')) {
    function config(string $file = null)
    {
        if (!is_null($file)) {
            $seprate = explode('.', $file);
            $file = include base_path('config/' . $seprate[0] . '.php');
            return isset($file[$seprate[1]]) ? $file[$seprate[1]] : $file;
        } else {
            return $file;
        }
    }
}

if (!function_exists('public_path')) {
    function public_path(string $file = null)
    {
        return !empty($file) ? getcwd() . '/' . $file : getcwd();
    }
}

if (!function_exists('bcrypt')) {
    function bcrypt(string $str)
    {
        return Hash::make($str);
    }
}

if (!function_exists('hash_check')) {
    function hash_check(string $pass, string $hash)
    {
        return Hash::check($pass, $hash);
    }
}

if (!function_exists('encrypt')) {
    function encrypt(string $value)
    {
        return Hash::encrypt($value);
    }
}

if (!function_exists('decrypt')) {
    function decrypt(string $value)
    {
        return Hash::decrypt($value);
    }
}
