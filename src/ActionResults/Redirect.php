<?php

namespace Framework\ActionResults;

class Redirect implements ActionResult
{
    /**
     * @var string
     */
    private $url;

    public function __construct(string $url)
    {
        $this->url = $url;
    }

    public function execute()
    {
        header('Location: ' . $this->url);
    }
}