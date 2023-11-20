<?php

declare(strict_types=1);

namespace Dondake\MusicTransposition\Services\Storage;

use Dondake\MusicTransposition\Exceptions\Storage\StorageException;
use Dondake\MusicTransposition\Helpers\Config;

class StorageService
{
    /**
     * @throws StorageException
     */
    public static function store(string $data, string $path): void
    {
        try {
            $newFile = fopen(Config::get('storage.path') . '/' . $path, 'x');

            fwrite($newFile, $data);

            fclose($newFile);
        } catch (\Throwable $e) {
            throw new StorageException('Unable to write file: ' . $e->getMessage());
        }
    }

    /**
     * @throws StorageException
     */
    public static function get(string $path): string
    {
        if (!file_exists($path)) {
            throw new StorageException('Input file not found for this path: ' . $path);
        }

        try {
            $file = file_get_contents($path);
        } catch (\Throwable $e) {
            throw new StorageException($e->getMessage());
        }

        if (!$file) {
            throw new StorageException('Unable to read file: ' . $path);
        }

        return $file;
    }
}