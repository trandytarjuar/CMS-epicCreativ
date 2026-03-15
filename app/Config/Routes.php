<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Dashboard::index', ['filter' => 'auth']);
$routes->get('/user', 'UserController::index', ['filter' => 'auth']);
$routes->post('/user', 'UserController::store', ['filter' => 'auth']);
$routes->get('/login', 'AuthController::login');
$routes->post('/login', 'AuthController::loginProcess');
$routes->get('/logout', 'AuthController::logout');
