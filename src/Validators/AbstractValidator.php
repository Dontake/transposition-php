<?php

declare(strict_types=1);

namespace Dondake\MusicTransposition\Validators;

use Dondake\MusicTransposition\Exceptions\Validators\ValidateException;
use Dondake\MusicTransposition\Validators\Rules\RuleValidatorInterface;

abstract class AbstractValidator
{
    /**
     * @throws ValidateException
     */
    public abstract function run(): bool;

    /**
     * @throws ValidateException
     */
    public function validate(array $input, array $paramRules): bool
    {
        foreach ($paramRules as $param => $rules) {
            if (is_string($param) && str_contains($param, '.*')) {
                $paramNames = explode('.*', $param);
                $firstParamValue = $input[$paramNames[0]];

                if (is_array($firstParamValue)) {
                    $this->validate($firstParamValue, [$rules]);
                }

                continue;
            }

            $this->applyToParam($input, is_int($param) ? null : $param, $rules);
        }

        return true;
    }

    /**
     * @param RuleValidatorInterface[] $rules
     * @throws ValidateException
     */
    protected function applyToParam(array $input, ?string $param, array $rules): void
    {
        if (!$param) {
            foreach ($input as $value) {
                if (is_array($value)) {
                    $this->applyToParam($value, $param, $rules);
                    continue;
                }

                foreach ($rules as $rule) {
                    if (!$rule->apply($value)) {
                        $this->error('Parameter ' . $param . ' - ' . $rule->message());
                    }
                }
            }

            return;
        }

        foreach ($rules as $rule) {
            if (!isset($input[$param])) {
                $this->error('Parameter ' . $param . ' is undefined.');
            }

            if (!$rule->apply($input[$param])) {
                $this->error('Parameter ' . $param . ' - ' . $rule->message());
            }
        }
    }

    /**
     * @throws ValidateException
     */
    protected function error(string $message): void
    {
        throw new ValidateException($message);
    }
}