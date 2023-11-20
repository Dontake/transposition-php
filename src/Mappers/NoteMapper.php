<?php

declare(strict_types=1);

namespace Dondake\MusicTransposition\Mappers;

use Dondake\MusicTransposition\Entities\Note\NoteData;

class NoteMapper implements MapperInterface
{
    public static function map(array $input): array
    {
        return array_map(function (array $note) {
            return new NoteData($note[0], $note[1]);
        }, $input);
    }
}