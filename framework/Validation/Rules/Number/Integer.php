<?php

namespace Framework\Validation\Rules\Number;

use Framework\Validation\Rules\Rule;

class Integer implements Rule
{
    public function check($value): bool
    {
        return is_int($value);
    }

    public function getMessageError(string $fieldName): string
    {
        return "[$fieldName] must be integer";
    }
}