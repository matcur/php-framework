<?php

namespace Framework\Caching;

interface Cache
{
    public function store(string $key, $value);

    public function get(string $key);

    public function forget(string $key);

    public function has(string $key): bool;

    public function remember(string $key, callable $callback);
}