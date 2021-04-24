<?php

namespace Framework\Validation\Rules\Number;

use Framework\Validation\Rules\Rule;

class IntegerBetween implements Rule
{
    /**
     * @var int
     */
    private $min;

    /**
     * @var int
     */
    private $max;

    public function __construct(int $min, int $max)
    {
        $this->min = $min;
        $this->max = $max;
    }

    public function check($value): bool
    {
        return $this->min < $value && $this->max > $value;
    }

    public function getMessageError(string $fieldName): string
    {
        return "[$fieldName] must be between $this->min and $this->max.";
    }
}