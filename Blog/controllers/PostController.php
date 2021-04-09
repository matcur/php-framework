<?php

namespace Blog\Controllers;

use Framework\Controller\BaseController;

class PostController extends BaseController
{
    public function actionIndex()
    {
        return 'this is the posts';
    }
}