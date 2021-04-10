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

    public function __construct(string $path, array $arguments = [])
    {
        $this->path = $_SERVER['DOCUMENT_ROOT'] . '/../App/views/' . $path;
        $this->arguments = $arguments;
    }

    public function execute()
    {
        if (!file_exists($this->path))
            $this->throwFileNotExistsException();

        $this->render();
    }

    private function render()
    {
        extract($this->arguments);
        require_once $this->path;
    }

    private function throwFileNotExistsException()
    {
        throw new \InvalidArgumentException(
            'File ' . $this->path . " doesn't exists in views folder"
        );
    }
}