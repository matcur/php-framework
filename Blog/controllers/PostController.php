<?php

namespace Blog\Controllers;

use Blog\Models\Post;
use Framework\ActionResults\Json;
use Framework\Controller\BaseController;

class PostController extends BaseController
{
    public function actionIndex()
    {
        $posts = [
            new Post(1, "first"),
            new Post(2, "second"),
            new Post(3, "third"),
        ];

        return new Json($posts);
    }
}