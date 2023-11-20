<?php

declare(strict_types=1);

namespace Dondake\MusicTransposition\Helpers;

use Dondake\MusicTransposition\Entities\Config\ConfigInstance;

class Config
{
    private static ConfigInstance $configInstance;

    public static function get(string $path)
    {
        if (!isset(static::$configInstance)) {
            static::$configInstance = new ConfigInstance();
        }

        return static::$configInstance->get($path);
    }
}