<?php

namespace Framework\Caching;

use Framework\FileSystem\File;

class Cache
{
    public function getFolder(): string
    {
        return $_SERVER['DOCUMENT_ROOT'] . '/../private/cache/';
    }

    public function store(string $key, $value)
    {
        $file = $this->makeFile($key);

        $file->ensureExisting();
        $file->flush()
             ->write(json_encode($value));
    }

    public function get(string $key)
    {
        $content = $this->makeFile($key)
                        ->read();

        return json_decode($content);
    }

    public function forget(string $key)
    {
        $this->makeFile($key)->remove();
    }

    public function has(string $key): bool
    {
        return $this->makeFile($key)->exists();
    }

    public function remember(string $key, callable $callback)
    {
        if ($this->has($key))
            return $this->get($key);

        $value = $callback();
        $this->store($key, $value);

        return $value;
    }

    private function makeFile(string $key): File
    {
        return new File($this->getFolder() . $key . '.txt');
    }
}