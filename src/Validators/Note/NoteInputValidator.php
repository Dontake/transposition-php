<?php

declare(strict_types=1);

namespace Dondake\MusicTransposition\Validators\Note;

use Dondake\MusicTransposition\Validators\AbstractValidator;
use Dondake\MusicTransposition\Validators\Rules\ArrayValidatorRule;
use Dondake\MusicTransposition\Validators\Rules\IntValidatorRule;

class NoteInputValidator extends AbstractValidator
{
    public function __construct(public array $input) {}

    /** @inheritDoc */
    public function run(): bool
    {
        return $this->validate($this->input, [
            'notes' => [new ArrayValidatorRule()],
            'semitone' => [new IntValidatorRule()],
            'notes.*' => [new IntValidatorRule()],
        ]);
    }
}