<?php

// Views Base Directory
$basedir = __DIR__ . '/../views';

// Prepare the Pimple dependency injection container.
$container = $app->container;

// Add a Twig service to the container.
$container['twig'] = function() use ($app, $basedir) {

    // Setting up the Template Engine
    $loader = new Twig_Loader_Filesystem($basedir);

    $twig = new Twig_Environment($loader, array('cache'));


    // Adds the assets path to twig global (to load them in the view)
    $twig->addGlobal('assets', $app->request->getUrl() . $app->request->getRootUri() . '/assets');

    // Adds the server array to twig global
    $twig->addGlobal('server',$_SERVER);

    return $twig;
};