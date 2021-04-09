<?php

namespace App\Models;

class Post
{
    public $id;

    public $title;

    public function __construct(int $id, string $title)
    {
        $this->id = $id;
        $this->title = $title;
    }
}