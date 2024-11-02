<?php

namespace Iliuminates\Database\Queries;

use Iliuminates\Database\Queries\Collection;
use Iliuminates\Pagination\Paginator;

trait DBSelector
{
    public static function find(int $id): ?static
    {
        return static::where('id', $id)->first();

        // $query = static::where('id', '=', $id)->buildSelectQuery();
        // $prepare = parent::$db->prepare($query);
        // $prepare->execute([$id]);
        // $data = $prepare->fetch(static::getDBconf()->FETCH_MODE);
        // if ($data) {
        //     static::setAttributes($data);
        //     return new static;
        // }
        // return null;
    }

    public static function first(): ?static
    {
        $query = static::buildSelectQuery();
        $prepare = parent::$db->prepare($query);
        $prepare->execute(static::getCondationValues());
        $data = $prepare->fetch(static::getDBconf()->FETCH_MODE);
        if ($data) {
            static::setAttributes($data);
            return new static;
        }
        return null;
    }

    public static function get(null|array $columns = [], ?int $limit = null, ?int $offset = null): ?Collection
    {
        $query = static::buildSelectQuery($columns, $limit, $offset);
        $prepare = parent::$db->prepare($query);
        $prepare->execute(static::getCondationValues());
        $data = $prepare->fetchAll(static::getDBconf()->FETCH_MODE);
        if ($data) {
            return new Collection($data);
        }
        return null;
    }

    public static function all(): null|array
    {
        return static::get();
    }

    public static function paginate(int $perpage = 15): ?Paginator
    {
        $page = (int) request('page', 1);
        $perpage = (int) request('per_page', $perpage);
        $offset = ($page - 1) * $perpage;
        $collection = static::get([], $perpage, $offset);
        $total = static::count();
        return new Paginator($collection, $total, $page, $perpage);
    }
}
