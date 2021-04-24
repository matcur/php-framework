<?php

namespace Framework\Validation\Rules;

interface Rule
{
    /**
     * Returns true if success
     *
     * @param $value
     * @return bool
     */
    public function check($value): bool;

    public function getMessageError(string $fieldName): string;
}