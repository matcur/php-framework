<?php

namespace App\Controllers;

use App\Models\Post;
use App\Models\User;
use Framework\ActionResults\Json;
use Framework\ActionResults\Redirect;
use Framework\ActionResults\View;
use Framework\App;
use Framework\Caching\Cache;
use Framework\Routing\Controller;
use Framework\Events\Dispatcher;
use Framework\Events\Event;
use Framework\Logging\Logger;

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