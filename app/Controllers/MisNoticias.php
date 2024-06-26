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
        $porPagina = 10;
    
        $noticias = $modeloNoticias->where('usuario_id', $userId)
                                    ->orderBy('fecha', 'DESC')
                                    ->paginate($porPagina, 'news');
    
        $totalNoticias = $modeloNoticias->where('usuario_id', $userId)->countAllResults();
    
        $totalPaginas = ceil($totalNoticias / $porPagina);
    
        $data['noticias'] = $noticias;
        $data['totalPaginas'] = $totalPaginas;
        $data['paginaActual'] = $paginaActual;
    
        $tipoUsuario = session()->get('tipo');
        $vista = 'inicio_vista';
        switch ($tipoUsuario) {
            case 0:
                $vista = 'editor/mis_noticias';
                break;
            case 2:
                $vista = 'validador-editor/mis_noticias';
                break;
            default:
                return redirect()->to(base_url('Auth'));
        }
    
        return view($vista, $data);
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
        $modeloNoticia = new NoticiasModel();
        $modeloNoticia->update($id, ['vigencia' => 'activada']);
    
        // Redirecciona a la página de detalles de la noticia
        return redirect()->to(base_url('mis-noticias/show/' . $id));
    }
    
    public function desactivar($id)
    {
        $modeloNoticia = new NoticiasModel();
        $modeloNoticia->update($id, ['vigencia' => 'desactiva']);
    
        // Redirecciona a la página de detalles de la noticia
        return redirect()->to(base_url('mis-noticias/show/' . $id));
    }
    
}
