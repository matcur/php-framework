<?php

namespace Framework\Translation;

use ArrayAccess;

class Translator implements ArrayAccess
{
    public $language;

    private $translations;

    public function __construct($language)
    {
        $this->language = $language;

        $path = $_SERVER['DOCUMENT_ROOT'] . "/../translations/$language.php";
        if (!file_exists($path))
            throw new \Exception("Translation file [$path] not exists");

        $this->translations = require_once $path;
    }

    public function translate($key)
    {
        return $this->translations[$key];
    }

    public function offsetExists($offset)
    {
        return array_key_exists($offset, $this->translations);
    }

    public function offsetGet($offset)
    {
        return $this->translate($offset);
    }

    public function offsetSet($offset, $value)
    {
        $this->translations[$offset] = $value;
    }

    public function offsetUnset($offset)
    {
        unset($this->translations[$offset]);
    }
}