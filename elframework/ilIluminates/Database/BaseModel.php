<?php

namespace Iliuminates\Database;

use Iliuminates\Database\Contracts\DatabaseConnectionInterface;

use PDO;

abstract class BaseModel
{

    
    protected static PDO $db;
    protected $table;
    protected static $attributes = [];

    public function __construct(DatabaseConnectionInterface $connect)
    {
        self::$db = $connect->getPDO();
    }

    public static function getDBconf():object{
        $driver = config('database.driver');
        return (object) config('database.drivers')[$driver];
    }

    public static function setAttributes($attributes){
        self::$attributes = $attributes;
    }

    public function __get($name)
    {
        return self::$attributes[$name] ?? null;
    }

    public function __set(string $name, $value)
    {
        self::$attributes[$name] = $value;
    }
}
