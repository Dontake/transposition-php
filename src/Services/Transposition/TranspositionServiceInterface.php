<?php

declare(strict_types=1);

namespace Dondake\MusicTransposition\Services\Transposition;

use Dondake\MusicTransposition\Entities\Note\NoteData;
use Dondake\MusicTransposition\Exceptions\Transposition\TranspositionException;

interface TranspositionServiceInterface
{
    /**
     * @param NoteData[] $items
     * @throws TranspositionException
     */
    public function run(array $items, int $param): array;
}