<?php

namespace Iliuminates\Router;

class Segment
{
    public static function uri(){
        return str_replace(ROOT_DIR, '', $_SERVER['REQUEST_URI']);
    }
    /**
     * @param int $offset
     * @return string
     */
    public static function get($offset):string
    {
        $segment = explode('/', static::uri());
        return isset($segment[$offset]) ? $segment[$offset] : '';
    }

    public static function all(){
        return explode('/',static::uri());
    }
}
