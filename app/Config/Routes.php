<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('MiControlador', 'MiControlador::index');
$routes->resource('inicio');
$routes->resource('PublicarNoticia', ['placeholder' => '(:num)']);
$routes->resource('Auth');
$routes->resource('Registro');
$routes->post('Auth/login', 'Auth::login');
$routes->get('mis_borradores', 'mis_borradores::index');

