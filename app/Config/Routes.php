<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('MiControlador', 'MiControlador::index');
$routes->resource('inicio');
$routes->resource('publicar_noticia');
$routes->get('mis_borradores', 'mis_borradores::index');
$routes->post('publicar_noticia/procesar', 'publicar_noticia::procesar');

