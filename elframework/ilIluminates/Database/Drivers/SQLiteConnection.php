<?php

namespace Iliuminates\Database\Drivers;

use Exception;
use Iliuminates\Database\Contracts\DatabaseConnectionInterface;
use Iliuminates\Logs\Log;
use PDO;

class SQLiteConnection implements DatabaseConnectionInterface
{
    private PDO $pdo;
    protected $path;
    public function __construct()
    {
        $config = config('database.drivers');
        $this->path = $config['sqlite']['path'];
        $dsn = "sqlite:" . $this->path;
        try {
            $this->pdo = new PDO($dsn);
            $this->pdo->setAttribute($config['mysql']['ERRMODE'], $config['mysql']['EXCEPTION']);
        } catch (Exception  $e) {
            throw new Log($e->getMessage());
        }
    }

    public function getPDO(): PDO
    {
        return $this->pdo;
    }
}
