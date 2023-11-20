<?php

declare(strict_types=1);

namespace Dondake\MusicTransposition\Entities\Note;

class NoteData
{
    public function __construct(
        public int $octaveNumber,
        public int $noteNumber
    ) {}
}