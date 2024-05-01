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
            
            // Procesar la subida de la imagen
            $imagen = $this->request->getFile('imagen');
            $ruta_destino = FCPATH . 'uploads/';
            $imagen->move($ruta_destino);

            // Guardar la ruta de la imagen y los demás datos en la base de datos
            $data = [
                'titulo' => $titulo,
                'descripcion' => $descripcion,
                'categoria' => $categoria,
                'fecha' => $fecha,
                'imagen' => $ruta_destino . $imagen->getName(), // Guardar la ruta de la imagen en la base de datos
                'estado' => $estado
            ];

            $modelo = new NoticiasModel();
            $modelo->save($data);    

            return view('envio_exitoso', $data);
        } else {
            // Si no se cumplen las reglas de validación, mostrar errores
            session()->setFlashdata('validation_errors', $this->validator->getErrors());
            return redirect()->to(previous_url())->withInput();
        }
    }
}
