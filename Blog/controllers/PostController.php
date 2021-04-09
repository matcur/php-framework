<?php

namespace Blog\Controllers;

use Blog\Models\Post;
use Framework\ActionResults\Json;
use Framework\ActionResults\Redirect;
use Framework\ActionResults\View;
use Framework\Controller\BaseController;

class PostController extends BaseController
{
    public function actionIndex()
    {
        $posts = [
            new Post(1, 'first'),
            new Post(2, 'second'),
            new Post(3, 'third'),
        ];

        return new View('post/index.php', compact('posts'));
    }

    public function actionShow()
    {
        $post = new Post(1, 'first');

        return new View(
            'post/show.php',
            compact('post')
        );
    }
}