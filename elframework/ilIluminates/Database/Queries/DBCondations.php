<?php

namespace Iliuminates\Database\Queries;

trait DBCondations
{
    public static $condations = [];
    public static $columns = ['*'];
    public static ?int $limit = null;
    public static ?int $offset = null;

    public static function where(string $column, string $operator, $value = null): static
    {
        $my_operators = in_array($operator, ['=', 'LIKE']);
        static::$condations[] = [
            'column' => $column,
            'operator' => $my_operators ? $operator : '=',
            'value' => ! $my_operators ? $operator : $value
        ];
        return new static;
    }

    public static function limit(int $limit): static
    {
        static::$limit = $limit;
        return new static;
    }
    public static function take(int $take): static
    {
        static::$limit = $take;
        return new static;
    }

    public static function offset(int $offset): static
    {
        static::$offset = $offset;
        return new static;
    }

    public static function buildSelectQuery(array $columns = [], ?int $limit = null, ?int $offset = null): string
    {
        $table = static::getTable();
        $columns = !empty($columns) && count($columns) > 0 ? implode(',', $columns) : implode(',', static::$columns);
        $query = 'SELECT ' . $columns . ' FROM ' . $table;
        if (static::$condations) {
            $condations = array_map(fn($condation) => $condation['column'] . ' ' . $condation['operator'] . ' ?', static::$condations);
            $query .= ' WHERE ' . implode(' AND ', $condations);
        }
        static::$limit = !empty($limit) && $limit > 0 ? $limit : static::$limit;
        static::$offset = !empty($offset) && $offset > 0 ? $offset : static::$offset;
        if (!is_null(static::$limit)) {
            $query .= ' LIMIT ' . static::$limit;
        }
        if (!is_null(static::$offset)) {
            $query .= ' OFFSET ' . static::$offset;
        }
        return $query;
    }

    public static function count(): int
    {
        $query = "SELECT COUNT(*) as count FROM " . static::getTable();
        if (static::$condations) {
            $condations = array_map(fn($condation) => $condation['column'] . ' ' . $condation['operator'] . ' ?', static::$condations);
            $query .= ' WHERE ' . implode(' AND ', $condations);
        }
        $prepare = parent::$db->prepare($query);
        $prepare->execute(static::getCondationValues());
        $data = $prepare->fetch(static::getDBconf()->FETCH_MODE);
        return $data->count ?? 0;
    }

    public static function getCondationValues(): array
    {
        return array_map(fn($condation) => $condation['value'], static::$condations);
    }
}
