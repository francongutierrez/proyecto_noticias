<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('MiControlador', 'MiControlador::index');
$routes->resource('inicio');
$routes->resource('PublicarNoticia', ['placeholder' => '(:num)']);
$routes->resource('login', ['placeholder' => '(:num)']);
$routes->get('mis_borradores', 'mis_borradores::index');

