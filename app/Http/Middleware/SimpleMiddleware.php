<?php

namespace App\Http\Middleware;

use Contracts\Middleware\Contract;
use Iliuminates\FrameworkSettings;

class SimpleMiddleware implements Contract
{
    public function handle($request, $next, ...$role)
    {
        FrameworkSettings::setLocale($_GET['lang']);

        // echo "<pre>";
        // var_dump($request);
        // if (2==2){
        //     header('Location: '.url('about'));
        //     exit;
        // }
        return $next($request);
    }
}
