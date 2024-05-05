<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;
use App\Models\NoticiasModel;
use App\Controllers\BaseController;

class MisNoticias extends BaseController
{
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        $userId = session()->get('user_id');

        $modeloNoticias = new NoticiasModel();

        $paginaActual = $this->request->getVar('page_news') ?? 1;
        $porPagina = 10; // 

        $noticias = $modeloNoticias->where('usuario_id', $userId)
                                    ->orderBy('fecha', 'DESC')
                                    ->paginate($porPagina, 'news'); // 'news' es el nombre de la variable en la URL para la paginacion

        $enlacesPaginacion = $modeloNoticias->pager;

        return view('validador-editor/mis_noticias', [
            'noticias' => $noticias,
            'enlacesPaginacion' => $enlacesPaginacion
        ]);
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
        $modeloNoticias = new NoticiasModel();
        $noticia = $modeloNoticias->find($id);

        return view('validador-editor/detalles_noticia', ['noticia' => $noticia]);
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

    public function activar($id)
    {
        $modeloBorrador = new NoticiasModel();
        $modeloBorrador->update($id, ['vigencia' => 'activada']);

        // Redirecciona a la página de borradores
        return redirect()->to(base_url('MisNoticias'));
    }

    public function desactivar($id)
    {
        $modeloBorrador = new NoticiasModel();
        $modeloBorrador->update($id, ['vigencia' => 'desactivada']);

        // Redirecciona a la página de borradores
        return redirect()->to(base_url('MisNoticias'));
    }
}
