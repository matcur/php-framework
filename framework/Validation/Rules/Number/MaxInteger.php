<?php

namespace Framework\Validation\Rules\Number;

use Framework\Validation\Rules\Rule;

class MaxInteger implements Rule
{
    /**
     * @var int
     */
    private $max;

    public function __construct(int $max)
    {
        $this->max = $max;
    }

    public function check($value): bool
    {
        return $value < $this->max;
    }

    public function getMessageError(string $fieldName): string
    {
        return "[$fieldName] must be less than $this->max";
    }
}