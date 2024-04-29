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

        if (!$this->validate($validationRules)) {
            return view('login_vista', ['errors' => $this->validator->getErrors()]);
        } else {
            $username = $this->request->getPost('usuario');
            $password = $this->request->getPost('password');
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $userModel = new UsuariosModel();
            $user = $userModel->getUserByUsername($username);
            

            if (!empty($user) && $password == $user[0]['password']) {
                $userData = [
                    'user_id' => $user[0]['id'],
                    'username' => $user[0]['email'],
                ];
                print_r($user);
                $session = \Config\Services::session();
                $session->set($userData);

                return redirect()->to('inicio');
            } else {
            // Si las credenciales son incorrectas, muestra un mensaje de error y redirige de nuevo al formulario de login
            $data['error'] = 'Credenciales inválidas';
            return redirect()->to('login')->withInput()->with('error', 'Credenciales inválidas');
            }
        }
    }
}
