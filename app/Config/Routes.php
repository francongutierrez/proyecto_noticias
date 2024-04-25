<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('MiControlador', 'MiControlador::index');
$routes->get('inicio', 'inicio::index');
$routes->get('publicar_noticia', 'publicar_noticia::index');
$routes->get('mis_borradores', 'mis_borradores::index');
$routes->post('publicar_noticia/procesar', 'publicar_noticia::procesar');

