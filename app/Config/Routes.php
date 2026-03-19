<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// auth
$routes->get('/login', 'AuthController::login');
$routes->post('/login', 'AuthController::loginProcess');

$routes->get('/logout', 'AuthController::logout');

$routes->get('/forgot-password', 'AuthController::forgotPassword');
$routes->post('/forgot-password', 'AuthController::sendResetLink');

$routes->get('/reset-password', 'AuthController::resetPassword');
$routes->post('/reset-password', 'AuthController::updatePassword');


$routes->get('/', 'Dashboard::index', ['filter' => 'auth']);
$routes->get('/user', 'UserController::index', ['filter' => 'auth']);
$routes->post('/user', 'UserController::store', ['filter' => 'auth']);
$routes->get('/user/(:num)', 'UserController::show/$1', ['filter' => 'auth']);
$routes->put('/user/(:num)', 'UserController::update/$1', ['filter' => 'auth']);
$routes->delete('/user/(:num)', 'UserController::delete/$1', ['filter' => 'auth']);
$routes->post('/user/check-username', 'UserController::checkUsername', ['filter' => 'auth']);
$routes->post('/user/check-email', 'UserController::checkEmail', ['filter' => 'auth']);
$routes->get('/profile', 'ProfileController::index', ['filter' => 'auth']);
$routes->post('/profile/update', 'ProfileController::update', ['filter' => 'auth']);
$routes->post('/profile/password', 'ProfileController::changePassword', ['filter' => 'auth']);

$routes->get('/client', 'ClientController::index', ['filter' => 'auth']);
$routes->post('/client', 'ClientController::store', ['filter' => 'auth']);
$routes->get('/client/show/(:num)', 'ClientController::show/$1', ['filter' => 'auth']);
$routes->post('/client/update/(:num)', 'ClientController::update/$1', ['filter' => 'auth']);
$routes->delete('/client/(:num)', 'ClientController::delete/$1', ['filter' => 'auth']);
// $routes->post('/forgot-password', 'AuthController::forgotPasswordProcess');
