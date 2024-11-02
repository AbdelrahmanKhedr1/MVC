<?php

namespace Iliuminates\Middleware;

use Iliuminates\Http\Request;
use Iliuminates\Logs\Log;
use Iliuminates\Sessions\session;

class CSRFToken
{
    public function __construct()
    {
        if (
            strtoupper($_SERVER['REQUEST_METHOD']) == 'POST' &&
            (empty(Request::get('_token')) || Request::get('_token') !== session::get('csrf_token'))
        ) {
            throw new Log('CSRF Token is invalid');
        }
    }

    public static function generateCSRFToken(): string
    {

        return bin2hex(random_bytes(32));
    }
}
