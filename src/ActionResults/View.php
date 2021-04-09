<?php

namespace Framework\ActionResults;

use Framework\App;

class View implements ActionResult
{
    /**
     * @var string
     */
    private $path;

    /**
     * @var array
     */
    private $arguments;

    public function __construct(string $path, array $arguments)
    {
        $this->path = $path;
        $this->arguments = $arguments;
    }

    public function render()
    {
        $path = $_SERVER['DOCUMENT_ROOT'] . '/../Blog/views/' . $this->path;
        if (!file_exists($path))
            $this->throwFileNotExistsException();

        extract($this->arguments);
        require_once $path;
    }

    private function throwFileNotExistsException()
    {
        throw new \InvalidArgumentException(
            'File ' . $this->path . " doesn't exists in views folder"
        );
    }
}