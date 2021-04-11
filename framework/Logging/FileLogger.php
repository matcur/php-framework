<?php

namespace Framework\Logging;

use Framework\FileSystem\File;
use Framework\Support\Str;

class FileLogger implements Logger
{
    /**
     * @var File
     */
    private $file;

    public function __construct(File $file)
    {
        $file->ensureExisting();
        $this->file = $file;
    }

    public function warning(string $message)
    {
        $this->write('warning', $message);
    }

    public function info(string $message)
    {
        $this->write('info', $message);
    }

    public function error(string $message)
    {
        $this->write('error', $message);
    }

    public function critical(string $message)
    {
        $this->write('critical', $message);
    }

    private function write(string $status, string $message)
    {
        $now = date('d/m/Y h:i:s a', time());

        $content = Str::merge(
            ' ',
            $now, $status, "\n".$message."\n"
        );

        $this->file->write($content);
    }
}