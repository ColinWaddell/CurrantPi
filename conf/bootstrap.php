<?php

/**
 * This is file will bootstrap all the required
 * tools to the Slim Framework.
 */

$app->config('DEBUG',TRUE);


// Twig Template System for all the views
require __DIR__ . '/view.php';

// All the system routes
require __DIR__ . '/routes.php';

// The sh scripts folder configuration
require __DIR__ . '/scripts.php';