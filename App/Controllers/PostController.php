<?php

namespace App\Controllers;

use App\Models\Post;
use App\Models\User;
use Framework\ActionResults\Json;
use Framework\ActionResults\Redirect;
use Framework\ActionResults\View;
use Framework\App;
use Framework\Caching\Cache;
use Framework\Controller\BaseController;
use Framework\Events\Dispatcher;
use Framework\Events\Event;
use Framework\Logging\Logger;

class PostController extends BaseController
{
    /**
     * @var Logger
     */
    private $logger;

    public function __construct(App $app)
    {
        parent::__construct($app);
        $this->logger = $app->getConfiguration()->getLogger();
    }

    public function actionIndex()
    {
        $posts = [
            new Post(1, 'first'),
            new Post(2, 'second'),
            new Post(3, 'third' . rand(1, 20)),
        ];

        $this->logger->critical('log in');

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