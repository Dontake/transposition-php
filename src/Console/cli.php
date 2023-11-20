#!/usr/bin/php
<?php

declare(strict_types=1);

use Dondake\MusicTransposition\Console\Commands\SemitoneTranspositionCommandAbstract;
use Dondake\MusicTransposition\Enums\Console\CommandNameEnum;
use Dondake\MusicTransposition\Services\Transposition\NoteTranspositionService;

require __DIR__ . '/../../vendor/autoload.php';

try {
    $command = match ($argv[1]) {
        CommandNameEnum::SemitoneTransposition->value
        => new SemitoneTranspositionCommandAbstract($argv[2], $argv[3], new NoteTranspositionService())
    };

    $command->run();
} catch (Throwable $e) {
    print_r($e->getMessage() . "\n");
}