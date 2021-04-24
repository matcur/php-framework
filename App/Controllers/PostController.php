<?php

namespace App\Controllers;

use App\Middlewares\SomeShit;
use Framework\ActionResults\ActionResult;
use Framework\ActionResults\Json;
use Framework\App;
use Framework\Routing\Controller;
use Framework\Support\Collection;
use Framework\Translation\Translator;

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
        $translator = new Translator($parameters['language']);

        return new Json($translator['hello']);
    }
}