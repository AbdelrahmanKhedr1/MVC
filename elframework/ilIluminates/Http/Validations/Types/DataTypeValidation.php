<?php

namespace Iliuminates\Http\Validations\Types;

trait DataTypeValidation
{
    protected static function required(mixed $value)
    {
        return (is_null($value) || empty($value) || (isset($value['tmp_name']) && empty($value['tmp_name'])));
    }
    protected static function string(mixed $value)
    {
        return !is_string($value) || is_numeric($value);
    }
    protected static function integer(mixed $value)
    {
        return !filter_var((int)$value, FILTER_VALIDATE_INT) || !is_numeric($value);
    }
    protected static function numeric(mixed $value)
    {
        return !preg_match('/^[0-9]+$/',$value);
    }
    protected static function json(mixed $value)
    {
        json_decode($value);
        return !(json_last_error() === JSON_ERROR_NONE);
    }
    protected static function array(mixed $value)
    {
        return !is_array($value) || !array_filter($value);
    }
    protected static function email(mixed $value)
    {
        return !filter_var($value, FILTER_VALIDATE_EMAIL);
    }
}
