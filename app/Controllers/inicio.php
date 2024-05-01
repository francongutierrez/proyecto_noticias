<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;
use App\Models\NoticiasModel;
use App\Controllers\BaseController;

class Inicio extends BaseController {
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */

    public function __construct() {
        helper('url');
    }

    public function index()
    {
        if (!session()->has('user_id')) {
            return redirect()->to(base_url('Auth'));
        }

        $modelo = new NoticiasModel();
        $pager = \Config\Services::pager(); // Crear una instancia de Pager
    
        $page = $this->request->getVar('page') ?? 1; // Obtener el número de la página desde la URL
        $perPage = 10; // Definir cuántas noticias quieres mostrar por página
    
        $noticias = $modelo->getNoticias($page, $perPage);
    
        $data['noticias'] = $noticias;
        $data['pager'] = $pager;
    
        return view('inicio_vista', $data);
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

    public function logout()
    {
        // Eliminar todas las variables de sesión
        session()->destroy();

        // Redireccionar al usuario a la página de inicio o a cualquier otra página que desees después de cerrar sesión
        return redirect()->to(base_url('Auth'));
    }


    public function mis_borradores() {
        if (!session()->has('user_id')) {
            return redirect()->to(base_url('Auth'));
        }

        $modelo = new NoticiasModel();
        $modelo->getBorradoresPorUsuario(session()->get('user_id'));

        return view('vista_mis_borradores');


    }
}
