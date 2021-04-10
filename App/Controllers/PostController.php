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

class PostController extends BaseController
{
    /**
     * @var Cache
     */
    private $cache;

    /**
     * @var Dispatcher
     */
    private $eventDispatcher;

    public function __construct(App $app)
    {
        parent::__construct($app);
        $this->cache = new Cache();
        $this->eventDispatcher = $app->getEventDispatcher();
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
        $this->eventDispatcher->fire(
            new Event('user-in', new User('Jon'))
        );

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