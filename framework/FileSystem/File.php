<?php


namespace Framework\FileSystem;


class File
{
    /**
     * @var string
     */
    private $path;

    public function __construct(string $path)
    {
        $this->path = $path;
    }

    public function write(string $content): File
    {
        file_put_contents($this->path, $content, FILE_APPEND);

        return $this;
    }

    public function read()
    {
        return file_get_contents($this->path);
    }

    public function flush(): File
    {
        $file = fopen($this->path, 'r+');

        fflush($file);
        fclose($file);

        return $this;
    }

    public function remove()
    {
        unlink($this->path);
    }

    public function exists()
    {
        return file_exists($this->path);
    }

    public function ensureExisting()
    {
        if (file_exists($this->path))
            return;

        file_put_contents($this->path, '');
    }
}