<?php

namespace App\Controllers;

use App\Models\NoticiasModel;
use App\Models\CategoriasModel;
class publicar_noticia extends BaseController
{
    public function __construct() {
        helper('form');
    }
    public function index(): string {
        $modelo = new CategoriasModel();
        $data['categorias'] = $modelo->getNombreCategorias();
        return view('publicar_noticia_vista', $data);
    }


    public function procesar()
    {
        $titulo = $this->request->getPost('titulo');
        $descripcion = $this->request->getPost('descripcion');
        $categoria = $this->request->getPost('categoria');
        $fecha = $this->request->getPost('fecha');
        
        $data = [
            'titulo' => $titulo,
            'descripcion' => $descripcion,
            'categoria' => $categoria,
            'fecha' => $fecha
        ];

        $modelo = new NoticiasModel();
        $modelo->save($data);    

        return view('envio_exitoso', $data);
    }
}
