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
    
            $modelo = new NoticiasModel();
            $registro = $modelo->where('id', $id)->first();
            session()->set('registro_original', $registro);
    
            if (is_array($registro)) { 
                // Procesar la subida de la imagen si se ha seleccionado una
                $imagen = $this->request->getFile('imagen');
                if ($imagen->isValid() && !$imagen->hasMoved()) {
                    $ruta_destino = FCPATH . 'public\uploads\\';
                    $imagen->move($ruta_destino);
                    $registro['imagen'] = $ruta_destino . $imagen->getName(); // Guardar la ruta de la imagen en el array
                }
                $registro['titulo'] = $titulo;
                $registro['descripcion'] = $descripcion;
                $registro['categoria'] = $categoria;
                $registro['fecha'] = $fecha;
                $registro['estado'] = $estado;
                $registro['usuario_id'] = session()->get('user_id');
    
                $modelo->update($id, $registro); 
    
                // Insertar cambios en la tabla 'cambios'
                $cambiosModel = new CambiosModel();
                $cambioData = [
                    'descripcion' => 'Edición',
                    'relacionado_a' => 'noticias',
                    'fecha' => date('Y-m-d'),
                    'hora' => date('H:i:s'),
                    'realizado_por' => session()->get('user_id'),
                    'noticia_id' => $id
                ];
                $cambiosModel->insert($cambioData);
    
                $data['id'] = $id;
                $data['registro'] = $registro;
    
                return view('editor/envio_exitoso', $data); 
            } else {
                // Si el registro no existe, redireccionar con un mensaje de error
                return redirect()->to(previous_url())->with('error', 'El registro no se encontró.');
            }
        } else {
            // Si no se cumplen las reglas de validación, mostrar errores
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

    public function deshacer($id) {
        // Obtener los datos del registro original desde la variable de sesión
        $registro_original = session()->get('registro_original');
    
        if ($registro_original) {
            $modelo = new NoticiasModel();
            $modelo->update($id, $registro_original);
    
            return redirect()->to('MisBorradores/edit/'.$id);
        } else {
            // Si no se encuentra el registro original en la sesión, mostrar un mensaje de error o redirigir a una página de error
            return redirect()->to(previous_url())->with('error', 'No se pudo deshacer la edición.');
        }
    }

    public function descartar($id)
    {
        // Carga el modelo de noticias
        $noticiasModel = new NoticiasModel();

        // Busca la noticia por su ID
        $noticia = $noticiasModel->find($id);

        // Verifica si la noticia existe
        if ($noticia) {
            // Cambia el estado de la noticia a "descartada"
            $noticia['estado'] = 'descartada';

            // Guarda los cambios en la base de datos
            $noticiasModel->update($id, $noticia);

            // Redirecciona a la página de Mis Borradores
            return redirect()->to(base_url('MisBorradores'));
        } else {
            // Si la noticia no existe, redirecciona a una página de error o muestra un mensaje
            return "La noticia no existe.";
        }
    }

}
