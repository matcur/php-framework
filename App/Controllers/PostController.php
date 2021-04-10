<?php

namespace App\Controllers;

use App\Models\Post;
use Framework\ActionResults\Json;
use Framework\ActionResults\Redirect;
use Framework\ActionResults\View;
use Framework\Caching\Cache;
use Framework\Controller\BaseController;

class PostController extends BaseController
{
    /**
     * @var Cache
     */
    private $cache;

    public function __construct()
    {
        $this->cache = new Cache();
    }

    public function actionIndex()
    {
        $posts = $this->cache->remember('posts', function () {
            return [
                new Post(1, 'first'),
                new Post(2, 'second'),
                new Post(3, 'third' . rand(1, 20)),
            ];
        });

        return new View(
            'post/index.php',
            compact('posts')
        );
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