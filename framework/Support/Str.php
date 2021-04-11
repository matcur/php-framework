<?php

namespace Framework\Support;

class Str
{
    public static function merge(string $splitter, ...$args)
    {
        return implode($splitter, $args);
    }
}