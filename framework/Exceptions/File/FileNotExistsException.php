<?php

namespace Framework\Exceptions\File;

use Exception;
use Throwable;

class FileNotExistsException extends Exception
{
    public function __construct($filePath)
    {
        parent::__construct('File ' . $filePath . " doesn't exists in views folder");
    }
}