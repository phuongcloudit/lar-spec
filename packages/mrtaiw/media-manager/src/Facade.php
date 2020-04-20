<?php
namespace MrTaiw\MediaManager;

use Illuminate\Support\Facades\Facade;

class MediaManagerFacade extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'mediamanager';
    }
}
