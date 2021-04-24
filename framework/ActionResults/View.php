<?php

namespace Framework\ActionResults;

use Framework\App;
use Framework\Exceptions\File\FileNotExistsException;

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

    public function __construct(string $path, array $arguments = [])
    {
        $this->path = $_SERVER['DOCUMENT_ROOT'] . '/../views/' . $path;
        $this->arguments = $arguments;
    }

    public function execute()
    {
        if (!file_exists($this->path))
            throw new FileNotExistsException($this->path);

        $this->render();
    }

    private function render()
    {
        extract($this->arguments);
        require_once $this->path;
    }
}