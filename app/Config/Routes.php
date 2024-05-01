<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('MiControlador', 'MiControlador::index');
$routes->get('Registro/exito', 'Registro::exito');
$routes->resource('inicio');
$routes->resource('Auth');
$routes->resource('Registro');

$routes->get('MisBorradores', 'MisBorradores::index');
$routes->get('MisBorradores/edit/(:num)', 'MisBorradores::edit/$1');
$routes->get('Inicio/mis_borradores', 'Inicio::mis_borradores');
$routes->get('Inicio/logout', 'Inicio::logout');
$routes->get('PublicarNoticia/new', 'PublicarNoticia::new');
$routes->post('PublicarNoticia/procesar', 'PublicarNoticia::procesar');
$routes->post('Auth/login', 'Auth::login');
$routes->post('Registro/registrarUsuario', 'Registro::registrarUsuario');
$routes->get('mis_borradores', 'mis_borradores::index');

