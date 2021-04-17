<?php

namespace App\Controllers;

use App\Middlewares\Authorize;
use App\Middlewares\SomeShit;
use App\Models\Post;
use Framework\ActionResults\View;
use Framework\App;
use Framework\Routing\Controller;
use Framework\Logging\Logger;
use Framework\Support\Collection;

class PostController extends Controller
{
    /**
     * @var Logger
     */
    private $logger;

    /**
     * @var Post[]
     */
    private $posts;

    public function __construct(App $app)
    {
        parent::__construct($app);

        $this->logger = $this->dependencies->resolve('logger');
        $this->posts = [
            new Post(1, 'first'),
            new Post(2, 'second'),
            new Post(3, 'third'),
        ];
        $this->middlewares = new Collection([
            'index' => [new SomeShit($app)],
        ]);
    }

    public function actionIndex()
    {
        $this->logger->critical('log in');

        return new View(
            'post/index.php',
            ['posts' => $this->posts]
        );
    }

    public function actionShow($parameters)
    {
        $post = $this->posts[$parameters['id']];

        return new View(
            'post/show.php',
            compact('post')
        );
    }
}