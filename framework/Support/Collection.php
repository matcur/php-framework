<?php

namespace Framework\Support;

class Collection implements \ArrayAccess
{
    private $items = [];

    public function __construct($value = [])
    {
        if (Arr::is($value)) {
            $this->items = $value;
        } else {
            $this->items[] = $value;
        }
    }

    public function push($value)
    {
        $this->items[] = $value;
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
        foreach ($this->items as $item)
            $callback($item);
    }

    public function get($key)
    {
        return new Collection($this->items[$key]);
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