<?php

namespace Framework\Validation\Rules;

class Required implements Rule
{
    public function check($value): bool
    {
        return !($value === "" || $value === null);
    }

    public function getMessageError(string $fieldName): string
    {
        return "[$fieldName] is required";
    }
}