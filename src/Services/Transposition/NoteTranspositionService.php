<?php

declare(strict_types=1);

namespace Dondake\MusicTransposition\Services\Transposition;

use Dondake\MusicTransposition\Entities\Note\NoteData;

class NoteTranspositionService implements TranspositionServiceInterface
{
    /**
     * @param NoteData[] $items
     */
    public function run(array $items, int $param): array
    {
        return array_map(function (NoteData $note) use ($param) {
            return $this->transpose($note, $param);
        }, $items);
    }

    protected function transpose(NoteData $note, int $semitone): array
    {
        $param = $note->octaveNumber * 12 + ($note->noteNumber + $semitone);

        return [floor($param / 12), $param % 12];
    }
}