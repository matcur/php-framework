<?php

namespace Framework\Validation\Rules\Number;

use Framework\Validation\Rules\Rule;

class MinInteger implements Rule
{
    /**
     * @var int
     */
    private $min;

    public function __construct(int $min)
    {
        $this->min = $min;
    }

    public function check($value): bool
    {
        return $this->min < $value;
    }

    public function getMessageError(string $fieldName): string
    {
        return "[$fieldName] must be more than $this->min";
    }
}