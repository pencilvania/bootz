<?php

/**
 *
 * PHP version 7.0
 */

/**
 * Composer
 */
require dirname(__DIR__) . '/vendor/autoload.php';


/**
 * Error and Exception handling
 */
error_reporting(E_ALL);
set_error_handler('Core\Error::errorHandler');
set_exception_handler('Core\Error::exceptionHandler');


/**
 * Routing
 */
$router = new Core\Router();

// Add the routes
$router->add('', ['controller' => 'Home', 'action' => 'index']);
$router->add('index', ['controller' => 'Home', 'action' => 'index']);
$router->add('filter', ['controller' => 'Home', 'action' => 'filterDate']);
$router->add('order', ['controller' => 'Orders', 'action' => 'index']);
$router->add('customer', ['controller' => 'Customer', 'action' => 'index']);
$router->add('customer/{controller}/{action}');
$router->add('customer/{controller}/{action}/{id:\d+}');

$router->add('{controller}/{action}');



$router->dispatch($_SERVER['QUERY_STRING']);
