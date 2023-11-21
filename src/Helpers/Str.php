<?php

declare(strict_types=1);

namespace Dondake\MusicTransposition\Helpers;

use Dondake\MusicTransposition\Enums\Storage\FileTypeEnum;
use Dondake\MusicTransposition\Exceptions\Console\ConsoleException;

class Str
{
    /**
     * @throws ConsoleException
     */
    public static function getFromConsole(string $value): string
    {
        if (!str_contains($value, '=')) {
            throw new ConsoleException('Unavailable input format! Available is: paramName=value');
        }

        try {
            return substr(strrchr($value, '='), 1);
        } catch (\Throwable) {
            throw new ConsoleException('Reading input error!');
        }
    }

    public static function getFilename(string $prefix, FileTypeEnum $extension): string
    {
        return $prefix . '-' . md5(microtime()) . $extension->value;
    }
}