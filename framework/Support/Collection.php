<?php

namespace Framework\Support;

use ArrayAccess;

class Collection implements ArrayAccess
{
    private $items;

    public function __construct($value = [])
    {
        if (Arr::is($value))
            $this->items = $value;
        else if ($value instanceof Collection)
            $this->items = $value->toArray();
        else
            $this->items = [$value];
    }

    public function push($value, $key = null)
    {
        if (is_null($key))
            $this->items[] = $value;
        else
            $this->items[$key] = $value;
    }

    public function put($key, $value)
    {
        $this->items[$key] = $value;
    }

    public function remove($key)
    {
        unset($this->items[$key]);
    }

    public function foreach(callable $callback)
    {
        foreach (Arr::keys($this->items) as $key)
            $callback($this->items[$key], $key);
    }

    public function hasKey($key)
    {
        return Arr::hasKey($this->items, $key);
    }

    public function get($key)
    {
        return $this->items[$key];
    }

    public function count()
    {
        return count($this->items);
    }

    public function toArray()
    {
        return Arr::is($this->items)? $this->items: [$this->items];
    }

    public function offsetExists($offset)
    {
        return array_key_exists($offset, $this->items);
    }

    public function offsetGet($offset)
    {
        return $this->items[$offset];
    }

    public function offsetSet($offset, $value)
    {
        $this->put($offset, $value);
    }

    public function offsetUnset($offset)
    {
        $this->remove($offset);
    }
}