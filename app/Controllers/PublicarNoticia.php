<?php

namespace App\Controllers;

use App\Models\NoticiasModel;
use App\Models\CategoriasModel;
use App\Models\CambiosModel;
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
        return view('editor/publicar_noticia_vista', $data);
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

    // Evento que publica automaticamente la noticia si esta paso 5 dias con el estado validar
    public function crearEventoPublicar($noticia_id) {
        $db = \Config\Database::connect();
        $nombreEvento = 'publicar_noticia_'.$noticia_id;
    
        $sql = "
            CREATE EVENT $nombreEvento
            ON SCHEDULE AT CURRENT_TIMESTAMP + INTERVAL 5 DAY
            DO
                UPDATE noticias
                SET estado = 'publicada', publicada_automaticamente = 1
                WHERE id = $noticia_id AND estado = 'validar';
        ";
        $query = $db->query($sql);
    
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
    

    public function procesar() {
        $rules = [
            'titulo' => 'required|min_length[3]|max_length[100]',
            'descripcion' => 'required|min_length[3]|max_length[2000]',
            'categoria' => 'required',
            'fecha' => 'required|valid_date',
            'estado' => 'required'
        ];
    
        // Mensajes de error personalizados
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
            
            $imagen = $this->request->getFile('imagen');

            // Verificar si el usuario ya tiene 3 noticias con estado "borrador"
            $usuario_id = session()->get('user_id');
            $modelo = new NoticiasModel();
            $numBorradores = $modelo->where('usuario_id', $usuario_id)
                                    ->where('estado', 'borrador')
                                    ->where('vigencia', 'activa')
                                    ->countAllResults();

            // Verificar si el usuario ya tiene 3 borradores
            if ($estado === 'borrador' && $numBorradores >= 3) {
                // Mostrar un mensaje de error
                session()->setFlashdata('validation_errors', ['estado' => 'Ya tienes 3 borradores guardados.']);
                return redirect()->to(previous_url())->withInput();
            }
    
            // Verificar si se ha proporcionado una imagen
            if ($imagen->isValid() && !$imagen->hasMoved()) {
                // Procesar la subida de la imagen
                $ruta_destino = FCPATH . 'public\uploads\\'; 
                $imagen->move($ruta_destino);
    
                $data = [
                    'titulo' => $titulo,
                    'descripcion' => $descripcion,
                    'categoria' => $categoria,
                    'fecha' => $fecha,
                    'imagen' => $ruta_destino . $imagen->getName(), 
                    'estado' => $estado,
                    'vigencia' => 'activa',
                    'recien_creada' => 1,
                    'usuario_id' => session()->get('user_id')
                ];
            } else {
                // Si no se proporciona una imagen, almacenar en la base de datos sin la imagen
                $data = [
                    'titulo' => $titulo,
                    'descripcion' => $descripcion,
                    'categoria' => $categoria,
                    'fecha' => $fecha,
                    'estado' => $estado,
                    'vigencia' => 'activa',
                    'recien_creada' => 1,
                    'usuario_id' => session()->get('user_id')
                ];
            }
    
            $modelo = new NoticiasModel();
            $modelo->save($data);
            session()->set('registro_original', $data);    
    
            // Obtener el ID de la noticia recién insertada
            $noticia_id = $modelo->getInsertID();
            $data['id'] = $noticia_id;

            // Crear el evento para publicar automaticamente
            $this->crearEventoPublicar($noticia_id);

            // Registramos el cambio en la tabla de cambios
            $cambioData = [
                'descripcion' => 'Noticia creada',
                'fecha' => date('Y-m-d'),
                'hora' => date('H:i:s'),
                'realizado_por' => session()->get('user_id'),
                'noticia_id' => $noticia_id
            ];
    
            $cambiosModel = new CambiosModel();
            $cambiosModel->save($cambioData);
    
            return view('editor/envio_exitoso', $data);
        } else {
            // Si no se cumplen las reglas de validación, mostrar errores
            session()->setFlashdata('validation_errors', $this->validator->getErrors());
            return redirect()->to(previous_url())->withInput();
        }
    }
    
    
}
