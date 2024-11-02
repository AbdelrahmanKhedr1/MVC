<?php

namespace App\Http\Middleware;

use Contracts\Middleware\Contract;

class UserMiddleware implements Contract {
    public function handle($request, $next, ...$role)
    {
    
        return $next($request);
    }
}
