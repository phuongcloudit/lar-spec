<?php
namespace MrTaiw\MediaManager\events;

class ImageWasUploaded
{
    private $path;

    public function __construct($path)
    {
        $this->path = $path;
    }

    public function path()
    {
        return $this->path;
    }
}
