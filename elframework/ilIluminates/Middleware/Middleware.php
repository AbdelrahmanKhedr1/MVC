<?php

namespace Iliuminates\Middleware;

use App\Core;
use Iliuminates\Logs\Log;
use Iliuminates\Router\Segment;

class Middleware
{
    /**
     * @param mixed $middlewareStack
     * @param mixed $next
     * @return mixed 
     */
    public static function handelMiddleware($middlewareStack, $next)
    {
        if (!empty($middlewareStack) && is_array($middlewareStack)) {
            foreach (array_reverse($middlewareStack) as $middleware) {
                $next = function ($request) use ($middleware, $next) {
                    $role = explode(',', $middleware);
                    $middleware = array_shift($role);
                    if (!class_exists($middleware)) {
                        $middleware = self::getFromCore($middleware);
                    }
                    return (new $middleware)->handle($request, $next, ...$role);
                };
            }
        }
        return $next;
    }

    public static function getFromCore($key)
    {
        $type = Segment::get(0) == 'api' ? 'api' : 'web';
        if ($type == 'web' && isset(Core::$middlewareWebRoute[$key])) {
            return Core::$middlewareWebRoute[$key];
        } elseif ($type == 'api' && isset(Core::$middlewareApiRoute[$key])) {
            return Core::$middlewareApiRoute[$key];
        } else {
            throw new Log('This Middleware (' . $key . ') Not Found');
        }
    }
}
