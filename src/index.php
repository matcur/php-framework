<?php

use Framework\App;
use Framework\Request;
use Framework\Routing\Router;

require_once '../vendor/autoload.php';

$request = new Request();
$router = new Router($request);

$app = new App(
    $router, $request
);
$app->run();