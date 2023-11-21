<?php

declare(strict_types=1);

namespace Dondake\MusicTransposition\Console\Commands;

use Dondake\MusicTransposition\Exceptions\Console\ConsoleException;
use Dondake\MusicTransposition\Exceptions\Storage\StorageException;
use Dondake\MusicTransposition\Exceptions\Transposition\TranspositionException;
use Dondake\MusicTransposition\Exceptions\Validators\ValidateException;

abstract class AbstractConsoleCommand
{
    /**
     * @throws ValidateException
     * @throws StorageException
     * @throws TranspositionException
     * @throws ConsoleException
     */
    public abstract function run(): void;

    public function logSuccess(string $message = 'Operation success!'): void
    {
        print_r($message . "\n");
    }
}