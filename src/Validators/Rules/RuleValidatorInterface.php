<?php

namespace Dondake\MusicTransposition\Validators\Rules;

interface RuleValidatorInterface
{
    public function apply(mixed $value): bool;

    public function message(): string;
}