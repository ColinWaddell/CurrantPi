<?php

// Public Routes
$app->get('/', function () use ($app)
{
    $indexController = new \Currant\Controller\IndexController($app);
    echo $indexController->indexAction();

})->name('index')->via('GET','POST');


// Public API Routes
$app->get('/api/info/all', function () use ($app)
{
    $apiController = new \Currant\Controller\ApiController($app);
    $apiController->getAllInformation();

})->name('index')->via('GET','POST');

