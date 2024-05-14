<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// Inicio
$routes->get('inicio', 'Inicio::index');
$routes->get('inicio/show/(:num)', 'Inicio::show/$1');
$routes->get('Inicio/logout', 'Inicio::logout');
$routes->get('Inicio/historial_de_cambios', 'Inicio::historial_de_cambios');

// Auth
$routes->get('Auth', 'Auth::index');
$routes->get('Auth/login', 'Auth::login');
$routes->post('Auth/login', 'Auth::login');

// Registro
$routes->resource('Registro');
$routes->get('Registro/exito', 'Registro::exito');

// Mis borradores
$routes->get('MisBorradores', 'MisBorradores::index');
$routes->get('MisBorradores/edit/(:num)', 'MisBorradores::edit/$1');
$routes->post('MisBorradores/update/(:num)', 'MisBorradores::update/$1');
$routes->get('MisBorradores/deshacer/(:num)', 'MisBorradores::deshacer/$1');
$routes->get('MisBorradores/descartar/(:num)', 'MisBorradores::descartar/$1');
$routes->get('MisBorradores/deshacerDescarte/(:num)', 'MisBorradores::deshacerDescarte/$1');

// Publicar noticia
$routes->get('PublicarNoticia/new', 'PublicarNoticia::new');
$routes->post('PublicarNoticia/procesar', 'PublicarNoticia::procesar');
$routes->post('Registro/registrarUsuario', 'Registro::registrarUsuario');

// Mis noticias
$routes->get('mis-noticias', 'MisNoticias::index');
$routes->get('mis-noticias/show/(:num)', 'MisNoticias::show/$1');
$routes->get('mis-noticias/activar/(:num)', 'MisNoticias::activar/$1');
$routes->get('mis-noticias/desactivar/(:num)', 'MisNoticias::desactivar/$1');

// Validar
$routes->get('Validar', 'Validar::index');
$routes->get('Validar/show/(:num)', 'Validar::show/$1');
$routes->group('Validar', function($routes) {
    $routes->get('publicar/(:num)', 'Validar::publicar/$1');
    $routes->get('enviar-correccion/(:num)', 'Validar::enviarCorreccion/$1');
    $routes->get('rechazar/(:num)', 'Validar::rechazar/$1');
    $routes->get('deshacer/(:num)', 'Validar::deshacer/$1');
});

// Publicadas automaticamente
$routes->get('publicadas-automaticamente', 'PublicadasAutomaticamente::index');
$routes->get('publicadas-automaticamente/show/(:num)', 'PublicadasAutomaticamente::show/$1');
$routes->get('publicadas-automaticamente/despublicar/(:num)', 'PublicadasAutomaticamente::despublicar/$1');
$routes->get('publicadas-automaticamente/deshacer/(:num)', 'PublicadasAutomaticamente::deshacer/$1');

