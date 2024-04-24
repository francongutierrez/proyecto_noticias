<?php

namespace App\Controllers;

class inicio extends BaseController {

    public function __construct() {
        helper('url');
    }

    public function index() {
        return view('vista_inicio');
    }

    public function redireccionarAPublicarNoticia() {
        return view('vista_publicar_noticia');
    }
}
