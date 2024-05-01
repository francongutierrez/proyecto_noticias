<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;

use App\Models\NoticiasModel;
use App\Models\CategoriasModel;
use App\Controllers\BaseController;

class MisBorradores extends BaseController
{
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function __construct() {
        helper('form');
    }

    public function index()
    {
        if (!session()->has('user_id')) {
            return redirect()->to(base_url('Auth'));
        }
    
        $modelo = new NoticiasModel();
        $borradores = $modelo->getBorradoresPorUsuario(session()->get('user_id'));
    
        $data['borradores'] = $borradores; // Pasar los borradores como parte de un array asociativo
    
        return view('editor/vista_mis_borradores', $data); // Pasar el array asociativo como segundo argumento
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
        //
    }

    /**
     * Create a new resource object, from "posted" parameters.
     *
     * @return ResponseInterface
     */
    public function create()
    {
        //
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
        // Verificar si el ID es válido
        if (!is_numeric($id)) {
            // Si el ID no es un número, redirigir o mostrar un mensaje de error
            return redirect()->to(base_url('MisBorradores'))->with('error', 'ID de borrador inválido');
        }

        // Cargar el modelo de categorías
        $categoriasModel = new CategoriasModel();

        // Obtener todas las categorías
        $categorias = $categoriasModel->findAll();

        // Cargar el modelo necesario para acceder a los datos del borrador
        $modelo = new NoticiasModel();

        // Obtener los datos del borrador utilizando el modelo
        $borrador = $modelo->getBorradorPorId($id);

        // Verificar si se encontró el borrador
        if (!$borrador) {
            // Si no se encontró el borrador, redirigir o mostrar un mensaje de error
            return redirect()->to(base_url('MisBorradores'))->with('error', 'Borrador no encontrado');
        }

        // Pasar los datos del borrador a la vista de edición
        $data['borrador'] = $borrador;
        $data['categorias'] = $categorias;

        // Cargar la vista de edición del borrador
        return view('editor/editar_borrador', $data);
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
}
