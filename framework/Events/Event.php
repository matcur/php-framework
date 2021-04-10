<?php

namespace Framework\Events;

class Event
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var mixed
     */
    private $arguments;

    public function __construct(string $name, $arguments = null)
    {
        $this->name = $name;
        $this->arguments = $arguments;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getArguments()
    {
        return $this->arguments;
    }
}