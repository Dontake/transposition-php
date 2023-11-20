<?php

declare(strict_types=1);

namespace Dondake\MusicTransposition\Console\Commands;

use Dondake\MusicTransposition\Exceptions\Console\ConsoleException;

abstract class AbstractConsoleCommand
{
    /** @throws ConsoleException */
    public abstract function run(): void;

    public function logSuccess(string $message = 'Operation success!'): void
    {
        print_r($message . "\n");
    }
}