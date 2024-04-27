<?php

namespace App\Controllers;

use App\Models\NoticiasModel;
use App\Models\CategoriasModel;
use CodeIgniter\HTTP\ResponseInterface;
use App\Controllers\BaseController;

class PublicarNoticia extends BaseController {
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function __construct() {
        helper('form');
    }
    public function index(): string {
        //
    }

    /**
     * Return the properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function show($id = null)
    {
        //
    }

    /**
     * Return a new resource object, with default properties.
     *
     * @return ResponseInterface
     */
    public function new()
    {
        $modelo = new CategoriasModel();
        $data['categorias'] = $modelo->getNombreCategorias();
        return view('publicar_noticia_vista', $data);
    }

    /**
     * Create a new resource object, from "posted" parameters.
     *
     * @return ResponseInterface
     */
    public function create()
    {
        $reglas = [
            'titulo' => 'required|min_length[3]|max_length[100]',
            'descripcion' => 'required|min_length[5]|max_length[2000]',
            'fecha' => 'required'
        ];

        if (!$this->validate($reglas)) {
            return redirect()->back()->withInput()->with('error', $this->validator->listErrors());
        }

        $post = $this->request->getPost(['titulo', 'descripcion', 'categoria', 'fecha']);
        $modelo = new NoticiasModel();
        $modelo->insert([
            'titulo' => $post['titulo'],
            'descripcion' => $post['descripcion'],
            'categoria' => $post['categoria'],
            'fecha' => $post['fecha']
        ]);

        return redirect()->to('inicio');
    }

    /**
     * Return the editable properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function edit($id = null)
    {
        //
    }

    /**
     * Add or update a model resource, from "posted" properties.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function update($id = null)
    {
        //
    }

    /**
     * Delete the designated resource object from the model.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function delete($id = null)
    {
        //
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
