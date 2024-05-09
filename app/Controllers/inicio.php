<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Pager\Pager;
use CodeIgniter\Pager\SimpleLinks;
use App\Models\NoticiasModel;
use App\Models\CambiosModel;
use Config\Services;
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
        $pager = \Config\Services::pager();
    
        $page = $this->request->getVar('page') ?? 1; 
        $perPage = 10; 
    
        $noticias = $modelo->getNoticias($page, $perPage);
    
        $data['noticias'] = $noticias;
        $data['pager'] = $pager;
    
        $tipoUsuario = session()->get('tipo');
        $vista = 'inicio_vista';
        // Utilizar un switch para definir la vista según el tipo de usuario
        switch ($tipoUsuario) {
            case 0:
                $vista = 'editor/inicio_vista';
                break;
            case 1:
                $vista = 'validador/inicio_validador';
                break;
            case 2:
                $vista = 'validador-editor/inicio_vista';
                break;
            default:
                return redirect()->to(base_url('Auth'));
                break;
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
    public function show($id)
    {
        $model = new NoticiasModel(); 
        $noticia = $model->obtenerNoticiaConDetalles($id);

        $data['noticia'] = $noticia;
        
        $tipoUsuario = session()->get('tipo');
        $vista = 'detalles_noticia_inicio';
        // Utilizar un switch para definir la vista según el tipo de usuario
        if ($noticia) {
            switch ($tipoUsuario) {
                case 0:
                    $vista = 'editor/detalles_noticia_inicio';
                    break;
                case 1:
                    $vista = 'validador/detalles_noticia_inicio';
                    break;
                case 2:
                    $vista = 'validador-editor/detalles_noticia_inicio';
                    break;
                default:
                    return redirect()->to(base_url('Auth'));
                    break;
            }

            return view($vista, $data);
        } else {
            return "Noticia no encontrada";
        }
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
        session()->destroy();

        return redirect()->to(base_url('Auth'));
    }
    
    public function historial_de_cambios()
    {
        $cambiosModel = new CambiosModel();

        $pager = \Config\Services::pager(); 
    
        $page = $this->request->getVar('page') ?? 1; 
        $perPage = 10; 
    
        $cambios = $cambiosModel->obtenerCambiosConNoticiasYUsuarios($page, $perPage);
    
        $data['cambios'] = $cambios;
        $data['pager'] = $pager;
    
        $tipoUsuario = session()->get('tipo');
        $vista = 'historial_de_cambios';
        switch ($tipoUsuario) {
            case 0:
                $vista = 'editor/historial_de_cambios';
                break;
            case 1:
                $vista = 'validador/historial_de_cambios';
                break;
            case 2:
                $vista = 'validador-editor/historial_de_cambios';
                break;
            default:
                return redirect()->to(base_url('Auth'));
                break;
        }


        return view($vista, $data);
    }
}
