<?php

namespace Iliuminates\Database\Contracts;

interface DatabaseConnectionInterface
{
    public function getPDO(): \PDO;
}
