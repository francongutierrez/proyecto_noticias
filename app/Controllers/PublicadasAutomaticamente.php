<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;
use App\Models\NoticiasModel;
use App\Models\CambiosModel;
use App\Controllers\BaseController;


class PublicadasAutomaticamente extends BaseController
{
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */

    public function __construct() {
        helper('date_helper');
    }


    public function checkTipoUsuario($vista) {
        $tipoUsuario = session()->get('tipo');
        switch ($tipoUsuario) {
            case 1:
                return 'validador/' . $vista;
            case 2:
                return 'validador-editor/' . $vista;
            default:
                return redirect()->to(base_url('Auth'));
        }
    }
    
    public function checkTipoUsuarioShow() {
        return $this->checkTipoUsuario('detalles_publicada_automaticamente');
    }
    
    public function checkTipoUsuarioDespublicar() {
        return $this->checkTipoUsuario('despublicacion');
    }
    
    public function checkTipoUsuarioDeshacerDespublicacion() {
        return $this->checkTipoUsuario('deshacer_despublicacion');
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
    
        $noticias = $modelo->getNoticiasPublicadasAutomaticamente($page, $perPage);

        $data['noticias'] = $noticias;
        $data['pager'] = $pager;

        $vista = $this->checkTipoUsuario('publicadas_automaticamente');

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
        $model = new NoticiasModel(); 
        $noticia = $model->obtenerNoticiaConDetalles($id);

        $data['noticia'] = $noticia;

        $vista = $this->checkTipoUsuarioShow();

        return view($vista, $data);

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

    protected function registrarCambio($noticiaId, $descripcion)
    {
        // Crea un nuevo registro de cambio en la tabla cambios
        $cambiosModel = new CambiosModel();
        $cambioData = [
            'descripcion' => $descripcion,
            'fecha' => date('Y-m-d'),
            'hora' => date('H:i:s', now()),
            'realizado_por' => session()->get('user_id'), // Suponiendo que tienes una función para obtener el ID del usuario actual
            'noticia_id' => $noticiaId
        ];
        $cambiosModel->insert($cambioData);
    }

    public function despublicar($id) {
        $noticiaModel = new NoticiasModel();
        $noticia = $noticiaModel->find($id);

        if ($noticia !== null) {
            $noticia['estado'] = 'borrador';
            $noticiaModel->save($noticia);
            $this->registrarCambio($id, 'Noticia despublicada');
            $vista = $this->checkTipoUsuarioDespublicar();
            return view($vista, ['id' => $id]);
        } else {
            return redirect()->to('error')->with('error', 'La noticia no fue encontrada.');
        }
    }

    public function deshacer($id) {
        $noticiaModel = new NoticiasModel();
        $noticia = $noticiaModel->find($id);
    
        if ($noticia !== null) {
            $noticia['estado'] = 'publicada';
            $noticiaModel->save($noticia);
            $this->registrarCambio($id, 'Despublicación deshecha');
            $vista = $this->checkTipoUsuarioDeshacerDespublicacion();
            return view($vista);
        } else {
            return redirect()->to('error')->with('error', 'La noticia no fue encontrada.');
        }
    }
    
    
}
