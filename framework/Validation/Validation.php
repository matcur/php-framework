<?php

namespace Framework\Validation;

use Framework\Validation\Rules\Rule;

abstract class Validation
{
    protected $model;

    public function validate(): Result
    {
        $this->prepare();

        $result = new Result();
        foreach ($this->getRules() as $field => $rules)
            $this->validateField($field, $rules, $result);

        return $result;
    }

    protected abstract function prepare(): void;

    /**
     * @return array<string, Rule[]>
     */
    protected abstract function getRules(): array;

    private function validateField(string $field, array $rules, Result $result): void
    {
        /** @var Rule $rule */
        foreach ($rules as $rule)
        {
            if (!$rule->check($this->model->{$field})) {
                $result->success = false;
                $result->errors[] = $rule->getMessageError($field);
            }
        }
    }
}