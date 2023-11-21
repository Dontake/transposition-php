<?php

declare(strict_types=1);

namespace Dondake\MusicTransposition\Services\Transposition;

use Dondake\MusicTransposition\Enums\Note\OctaveEnum;
use Dondake\MusicTransposition\Entities\Note\NoteData;
use Dondake\MusicTransposition\Exceptions\Transposition\TranspositionException;

class NoteTranspositionService implements TranspositionServiceInterface
{
    /**
     * @inheritDoc
     */
    public function run(array $items, int $param): array
    {
        return array_map(function (NoteData $note) use ($param) {
            return $this->transpose($note, $param);
        }, $items);
    }

    /**
     * @throws TranspositionException
     */
    protected function transpose(NoteData $note, int $semitone): array
    {
        $param = $note->octaveNumber * 12 + ($note->noteNumber + $semitone);

        if ($param < 0) {
            return [(int)($param / 12 - 1), 12 - abs($param % 12)];
        }

        --$param;

        $octaveNumber = (int)($param / 12);

        if (!OctaveEnum::tryFrom($octaveNumber)) {
            throw new TranspositionException('Octave number out from available range!');
        }

        return [$octaveNumber, $param % 12 + 1];
    }
}