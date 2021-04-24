<?php

namespace App\Validation;

use App\Models\Post;
use Framework\Support\Collection;
use Framework\Validation\Rules\Number\IntegerBetween;
use Framework\Validation\Rules\Required;
use Framework\Validation\Validation;

class PostValidation extends Validation
{
    public function __construct(Post $model)
    {
        $this->model = $model;
    }

    protected function prepare(): void {}

    protected function getRules(): array
    {
        return [
            'title' => [new Required()],
            'id' => [new Required(), new IntegerBetween(0, 10)],
        ];
    }
}