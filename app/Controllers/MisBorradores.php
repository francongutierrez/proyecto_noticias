<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;

use App\Models\NoticiasModel;
use App\Models\CategoriasModel;
use App\Models\CambiosModel;
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
    
        $page = $this->request->getVar('page') ?? 1; 
        $perPage = 10;
    
        $modelo = new NoticiasModel();
        $usuarioId = session()->get('user_id');
    
        $borradores = $modelo->getBorradoresPorUsuario($usuarioId, $page, $perPage);
        $totalBorradores = $modelo->countBorradoresPorUsuario($usuarioId);
    
        $data['borradores'] = $borradores;
        $data['currentPage'] = $page;
        $data['totalBorradores'] = $totalBorradores;
        $data['perPage'] = $perPage;
    
        $tipoUsuario = session()->get('tipo');
        $vista = 'vista_mis_borradores';
        switch ($tipoUsuario) {
            case 0:
                $vista = 'editor/vista_mis_borradores';
                break;
            case 2:
                $vista = 'validador-editor/vista_mis_borradores';
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
        if (!is_numeric($id)) {
            return redirect()->to(base_url('MisBorradores'))->with('error', 'ID de borrador inválido');
        }
    
        $categoriasModel = new CategoriasModel();
        $categorias = $categoriasModel->findAll();
        $modelo = new NoticiasModel();
        $borrador = $modelo->getBorradorPorId($id);
    
        if (!$borrador) {
            return redirect()->to(base_url('MisBorradores'))->with('error', 'Borrador no encontrado');
        }
    
        $imagenActual = $borrador['imagen'];
    
        $data['borrador'] = $borrador;
        $data['categorias'] = $categorias;
        $data['imagen_actual'] = $imagenActual;
    
        $tipoUsuario = session()->get('tipo');
        $vista = 'editar_borrador';
        switch ($tipoUsuario) {
            case 0:
                $vista = 'editor/editar_borrador';
                break;
            case 2:
                $vista = 'validador-editor/editar_borrador';
                break;
            default:
                return redirect()->to(base_url('Auth'));
                break;
        }
    
        return view($vista, $data);
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
        $rules = [
            'titulo' => 'required|min_length[3]|max_length[100]',
            'descripcion' => 'required|min_length[3]|max_length[2000]',
            'categoria' => 'required',
            'fecha' => 'required|valid_date',
            'estado' => 'required'
        ];
    
        $errors = [
            'titulo' => [
                'required' => 'El título es obligatorio.',
                'min_length' => 'El título debe tener al menos 3 caracteres.',
                'max_length' => 'El título no debe exceder los 100 caracteres.'
            ],
            'descripcion' => [
                'required' => 'La descripción es obligatoria.',
                'min_length' => 'La descripción debe tener al menos 3 caracteres.',
                'max_length' => 'La descripción no debe exceder los 2000 caracteres.'
            ],
            'categoria' => [
                'required' => 'La categoría es obligatoria.'
            ],
            'fecha' => [
                'required' => 'La fecha es obligatoria.',
                'valid_date' => 'La fecha no es válida.',
                'less_than' => 'La fecha debe ser menor que la fecha actual.',
                'greater_than' => 'La fecha debe ser después del año 2000.'
            ],
            'estado' => [
                'required' => 'Por favor, seleccione una opción (borrador o enviar a validar).'
            ]
        ];
    
        if ($this->validate($rules, $errors)) {
            $titulo = $this->request->getPost('titulo');
            $descripcion = $this->request->getPost('descripcion');
            $categoria = $this->request->getPost('categoria');
            $fecha = $this->request->getPost('fecha');
            $estado = $this->request->getPost('estado');
    
            $modelo = new NoticiasModel();
            $registro = $modelo->where('id', $id)->first();
            session()->set('registro_original', $registro);
    
            if (is_array($registro)) { 
                $imagen = $this->request->getFile('imagen');
                $cambios = [];
    
                if ($titulo !== $registro['titulo']) $cambios[] = 'titulo';
                if ($descripcion !== $registro['descripcion']) $cambios[] = 'descripción';
                if ($categoria !== $registro['categoria']) $cambios[] = 'categoria';
                if ($fecha !== $registro['fecha']) $cambios[] = 'fecha';
                if ($imagen->isValid() && !$imagen->hasMoved()) {
                    $ruta_destino = FCPATH . 'public\uploads\\';
                    $imagen->move($ruta_destino);
                    $registro['imagen'] = $ruta_destino . $imagen->getName(); 
                    $cambios[] = 'imagen';
                }
                if ($estado !== $registro['estado']) $cambios[] = 'estado';
    
                $registro['titulo'] = $titulo;
                $registro['descripcion'] = $descripcion;
                $registro['categoria'] = $categoria;
                $registro['fecha'] = $fecha;
                $registro['estado'] = $estado;
                $registro['recien_creada'] = 0;
                $registro['usuario_id'] = session()->get('user_id');
    
                $modelo->update($id, $registro); 
    
                $cambiosModel = new CambiosModel();
                $cambioDescripcion = 'Edición: ' . implode(', ', $cambios);
                $cambioData = [
                    'descripcion' => $cambioDescripcion,
                    'relacionado_a' => 'noticias',
                    'fecha' => date('Y-m-d'),
                    'hora' => date('H:i:s'),
                    'realizado_por' => session()->get('user_id'),
                    'noticia_id' => $id
                ];
                $cambiosModel->insert($cambioData);
    
                $data['id'] = $id;
                $data['registro'] = $registro;
    
                $tipoUsuario = session()->get('tipo');
                $vista = 'envio_exitoso';
                switch ($tipoUsuario) {
                    case 0:
                        $vista = 'editor/envio_exitoso';
                        break;
                    case 2:
                        $vista = 'validador-editor/envio_exitoso';
                        break;
                    default:
                        return redirect()->to(base_url('Auth'));
                        break;
                }
    
                return view($vista, $data);
            } else {
                return redirect()->to(previous_url())->with('error', 'El registro no se encontró.');
            }
        } else {
            session()->setFlashdata('validation_errors', $this->validator->getErrors());
            return redirect()->to(previous_url())->withInput();
        }
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

    // Funcion que borra el evento publicar_noticia si se ejecuto el boton deshacer
    public function borrarEventoPublicar($noticia_id) {
        $db = \Config\Database::connect();
        $nombreEvento = 'publicar_noticia_'.$noticia_id;
    
        $sql = "DROP EVENT IF EXISTS $nombreEvento;";
    
        $query = $db->query($sql);
    
        if ($query) {
            return true;
        } else {
            return false;
        }
    }


    public function deshacer($id) {
        $registro_original = session()->get('registro_original');
    
        if ($registro_original) {
            $modelo = new NoticiasModel();
            $modeloCambios = new CambiosModel();
            $modelo->update($id, $registro_original);

            $this->borrarEventoPublicar($id); 

            $modeloCambios->borrarUltimoCambio($id);
    
            return redirect()->to('MisBorradores/edit/'.$id);
        } else {
            return redirect()->to(previous_url())->with('error', 'No se pudo deshacer la edición.');
        }
    }

    public function checkTipoUserDescartar() {
        $tipoUsuario = session()->get('tipo');
        $vista = 'descartar_borrador';
        switch ($tipoUsuario) {
            case 0:
                $vista = 'editor/descartar_borrador';
                break;
            case 2:
                $vista = 'validador-editor/descartar_borrador';
                break;
            default:
                return redirect()->to(base_url('Auth'));
        }

        return $vista;

    }

    public function checkTipoUserDeshacerDescartar() {
        $tipoUsuario = session()->get('tipo');
        switch ($tipoUsuario) {
            case 0:
                $vista = 'editor/deshacer_descartar';
                break;
            case 2:
                $vista = 'validador-editor/deshacer_descartar';
                break;
            default:
                return redirect()->to(base_url('Auth'));
        }

        return $vista;
    }

    public function descartar($id)
    {
        $noticiasModel = new NoticiasModel();
        $cambiosModel = new CambiosModel();
    
        $noticia = $noticiasModel->find($id);
    
        if ($noticia) {
            $noticia['estado'] = 'descartada';
            $noticia['vigencia'] = 'desactivada';
            $noticiasModel->update($id, $noticia);
    
            $cambioData = [
                'descripcion' => 'Borrador descartado',
                'fecha' => date('Y-m-d'),
                'hora' => date('H:i:s'),
                'realizado_por' => session()->get('user_id'),
                'noticia_id' => $id
            ];
            $cambiosModel->insert($cambioData);
    
            $vista = $this->checkTipoUserDescartar();
    
            return view($vista, ['id' => $id]);
        } else {
            return "La noticia no existe.";
        }
    }
    
    public function deshacerDescarte($id)
    {
        $noticiasModel = new NoticiasModel();
        $cambiosModel = new CambiosModel();
    
        $noticia = $noticiasModel->find($id);
    
        if ($noticia) {
            $noticia['estado'] = 'borrador';
            $noticia['vigencia'] = 'activa';
            $noticiasModel->update($id, $noticia);
    
            $cambiosModel->where('noticia_id', $id)->where('descripcion', 'Borrador descartado')->delete();
    
            $vista = $this->checkTipoUserDeshacerDescartar();
    
            return view($vista, ['id' => $id]);
        } else {
            return "La noticia no existe.";
        }
    }
    


}
