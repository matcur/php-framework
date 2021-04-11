<?php

namespace Framework\FileSystem;

class TodayFile extends File
{
    public function __construct(string $folder)
    {
        $today = date('d-m-y');

        parent::__construct($folder . "/${today}.txt");
    }
}