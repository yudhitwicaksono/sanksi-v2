<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Login::index');
$routes->get('login', 'Login::index');
$routes->get('login/index', 'Login::index');
$routes->post('login/validasiLogin', 'Login::validasiLogin');
$routes->get('login/logout', 'Login::logout');

