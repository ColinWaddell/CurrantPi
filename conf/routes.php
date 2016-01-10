<?php

// Public Routes
$app->get('/', function () use ($app)
{
    $indexController = new \Currant\Controller\IndexController($app);
    echo $indexController->indexAction();

})->name('index')->via('GET','POST');



