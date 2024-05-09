<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UsuariosModel;
use App\Controllers\BaseController;

class Auth extends BaseController {
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function __construct() {
        helper('session'); // Cargar la biblioteca de sesiones
        helper('form');
    }

    public function index()
    {
        if (isset($session)) {
            $session->destroy();
        }
        return view('login_vista.php');
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
    
    public function login() {
        $validationRules = [
            'usuario' => 'required',
            'password' => 'required'
        ];
    
        $validationMessages = [
            'usuario' => [
                'required' => 'El campo usuario es obligatorio.'
            ],
            'password' => [
                'required' => 'El campo contraseña es obligatorio.'
            ]
        ];
    
        // Validar los datos de entrada
        if (!$this->validate($validationRules, $validationMessages)) {
            // Si no se cumplen las reglas de validación, mostrar errores
            session()->setFlashdata('errors', $this->validator->getErrors());
            // Redirigir de vuelta al formulario de inicio de sesión
            return redirect()->to(base_url('Auth'))->withInput();
        } else {
            $username = $this->request->getPost('usuario');
            $password = $this->request->getPost('password');
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
            $userModel = new UsuariosModel();
            $user = $userModel->getUserByUsername($username);
            
            if (!empty($user) && password_verify($password, $user[0]['password'])) {
                $userData = [
                    'user_id' => $user[0]['id'],
                    'username' => $user[0]['email'],
                    'tipo' => $user[0]['tipo']
                ];
                $session = \Config\Services::session();
                $session->set($userData);
    
                return redirect()->to(base_url('inicio'));
            } else {
                // Si las credenciales no son válidas, establecer el mensaje de error en flashdata
                session()->setFlashdata('errors', ['Credenciales inválidas']);
                // Redirigir de vuelta al formulario de inicio de sesión
                return redirect()->to(base_url('Auth'))->withInput();
            }
        }
    }
    


    public function registrarUsuario() {
        $reglas = [
            'email' => 'required',
            'password' => 'required',
            'imagen' => '',
        ];
    }
}
