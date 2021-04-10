<?php

namespace Framework\Support;

class Arr
{
    public static function hasKey(array $array, $key)
    {
        return array_key_exists($key, $array);
    }

    public static function is($value)
    {
        return is_array($value);
    }
}