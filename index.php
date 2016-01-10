<?php

/**
 * index.php
 *
 * Raspberry Pi - Board Details
 *
 * @author     Colin Waddell
 * @author     Iago Oliveira da Silva
 * @license    https://opensource.org/licenses/MIT  The MIT License (MIT)
 * @link       https://github.com/ColinWaddell/RPi-Board-Info
 */

 /*
  * Libraries and helper function
 */

ini_set("display_errors", 1);

// Composer Autoload
require_once 'vendor/autoload.php';

// Slim Application
$app = new \Slim\Slim();

// Slim configuration
require __DIR__ . '/conf/bootstrap.php';

// Run Slim
$app->run();