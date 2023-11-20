<?php

declare(strict_types=1);

namespace Dondake\MusicTransposition\Validators\Rules;

class ArrayValidatorRule implements RuleValidatorInterface
{
    public function apply(mixed $value): bool
    {
        return is_array($value);
    }

    public function message(): string
    {
        return 'Input value mast be array!';
    }
}