<?php

declare(strict_types=1);

namespace Dondake\MusicTransposition\Services\Transposition;

interface TranspositionServiceInterface
{
    public function run(array $items, int $param): array;
}