<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UsuariosModel;
use App\Controllers\BaseController;

class Registro extends BaseController {
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        return view('registro_vista');
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

    // En el controlador
    public function registrarUsuario() {
        $validation = \Config\Services::validation(); // Obtener el servicio de validación

        // Definir reglas de validación
        $reglas = [
            'email' => 'required|valid_email|is_unique[usuarios.email]',
            'password' => 'required|min_length[8]|max_length[50]',
        ];

        // Establecer mensajes de error personalizados (opcional)
        $validation->setRules($reglas, [
            'email' => [
                'required' => 'El correo electrónico es obligatorio.',
                'valid_email' => 'El correo electrónico debe ser válido.',
                'is_unique' => 'Este correo electrónico ya ha sido registrado.'
            ],
            'password' => [
                'required' => 'La contraseña es obligatoria.',
                'min_length' => 'La contraseña debe tener al menos 8 caracteres.',
                'max_length' => 'La contraseña no puede tener más de 50 caracteres.'
            ]
        ]);

        // Verificar si los datos de entrada pasan la validación
        if (!$validation->withRequest($this->request)->run()) {
            // Si no pasan la validación, mostrar errores de validación
            return redirect()->to(base_url('Registro'))->withInput()->with('errors', $validation->getErrors());
        } else {
            // Si pasan la validación, insertar el usuario en la base de datos
            $email = $this->request->getPost('email');
            $password = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);

            // Insertar usuario en la base de datos utilizando el modelo
            $usuarioModel = new UsuariosModel();
            $usuarioModel->insertarUsuario($email, $password);

            // Redireccionar a una página de éxito o realizar otras operaciones
            return redirect()->to(base_url('Registro/exito'));
        }
    }

    public function exito()
    {
        return view('exito/exito_registro_vista');
    }

    


}
