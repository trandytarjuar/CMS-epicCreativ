<?php

namespace App\Controllers;

use App\Models\UserModel;

class UserController extends BaseController
{
    public function index()
    {
        $userModel = new UserModel();
        $data['users'] = $userModel->findAll();

        // return view('user/index');
        return view('user/index', $data);
    }

    public function store()
    {
        $userModel = new \App\Models\UserModel();

        $name = $this->request->getPost('name');
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $role = $this->request->getPost('role');

        if (!$name || !$username || !$password) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Field wajib diisi'
            ]);
        }

        $userModel->insert([
            'name' => $name,
            'username' => $username,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'role' => $role,
            'created_at' => date('Y-m-d H:i:s'),
            'created_by' => session()->get('username')
        ]);

        return $this->response->setJSON([
            'status' => 'success'
        ]);
    }
}
