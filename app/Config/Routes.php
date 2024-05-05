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
$routes->get('Validar', 'Validar::index');
$routes->get('Validar/show/(:num)', 'Validar::show/$1');
$routes->get('MisBorradores/edit/(:num)', 'MisBorradores::edit/$1');
$routes->post('MisBorradores/update/(:num)', 'MisBorradores::update/$1');
$routes->get('MisBorradores/deshacer/(:num)', 'MisBorradores::deshacer/$1');
$routes->get('MisBorradores/descartar/(:num)', 'MisBorradores::descartar/$1');
$routes->get('Inicio/logout', 'Inicio::logout');
$routes->get('PublicarNoticia/new', 'PublicarNoticia::new');
$routes->post('PublicarNoticia/procesar', 'PublicarNoticia::procesar');
$routes->post('Auth/login', 'Auth::login');
$routes->post('Registro/registrarUsuario', 'Registro::registrarUsuario');
$routes->get('Inicio/historial_de_cambios', 'Inicio::historial_de_cambios');


$routes->group('Validar', function($routes) {
    $routes->get('publicar/(:num)', 'Validar::publicar/$1');
    $routes->get('enviar-correccion/(:num)', 'Validar::enviarCorreccion/$1');
    $routes->get('rechazar/(:num)', 'Validar::rechazar/$1');
    $routes->get('deshacer/(:num)', 'Validar::deshacer/$1');
});


