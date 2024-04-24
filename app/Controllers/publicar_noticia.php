<?php

namespace App\Controllers;

class publicar_noticia extends BaseController
{
    public function __construct() {
        helper('form');
    }
    public function index(): string
    {
        return view('vista_publicar_noticia');
    }

    public function procesar()
    {
        $nombre = $this->request->getPost('nombre');
        $email = $this->request->getPost('email');
        
        $data = array(
            'nombre' => $nombre,
            'email' => $email
        );
        
        return view('envio_exitoso', $data);
    }
}
