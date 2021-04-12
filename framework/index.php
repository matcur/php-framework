<?php

use Framework\App;
use Framework\DependencyContainer;
use Framework\Request\InputBag;
use Framework\Request\Request;
use Framework\Routing\Router;

require_once '../vendor/autoload.php';

$request = new Request(
    new InputBag($_GET),
    new InputBag($_POST),
    new InputBag($_SERVER)
);
$router = new Router($request);

$app = new App(
    $router, $request
);
$app->run();