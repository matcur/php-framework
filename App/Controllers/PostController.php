<?php

namespace App\Controllers;

use App\Middlewares\SomeShit;
use App\Models\Post;
use App\Validation\PostValidation;
use Framework\ActionResults\ActionResult;
use Framework\ActionResults\Json;
use Framework\App;
use Framework\Routing\Controller;
use Framework\Support\Collection;

class PostController extends Controller
{
    public function __construct(App $app)
    {
        parent::__construct($app);

        $this->middlewares = new Collection([
            'post' => [new SomeShit($app)],
        ]);
    }

    public function actionPost($parameters): ActionResult
    {
        $post = new Post($parameters['id'], $parameters['title']);
        $validation = new PostValidation($post);
        $result = $validation->validate();
        if (!$result->success)
            return new Json($result->errors);

        return new Json("success");
    }
}