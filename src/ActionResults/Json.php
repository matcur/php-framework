<?php

namespace Framework\ActionResults;

class Json implements ActionResult
{
    private $value;

    public function __construct($value)
    {
        $this->value = $value;
    }

    public function render()
    {
        echo json_encode($this->value);
    }
}