<?php

use Framework\App;
use Framework\Routing\Router;

require_once '../vendor/autoload.php';

$router = new Router();
$app = new App($router);
$app->run();