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
        $email = $this->request->getPost('email');
        $role = $this->request->getPost('role');

        if (!$name || !$username || !$password) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Field wajib diisi'
            ]);
        }

        if ($userModel->where('username', $username)->first()) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Username sudah digunakan'
            ]);
        }

        // cek email
        if ($userModel->where('email', $email)->first()) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Email sudah digunakan'
            ]);
        }

        $userModel->insert([
            'name' => $name,
            'username' => $username,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'role' => $role,
            'created_at' => date('Y-m-d H:i:s'),
            'created_by' => session()->get('username')
        ]);

        return $this->response->setJSON([
            'status' => 'success'
        ]);
    }

    public function checkUsername()
    {
        $userModel = new \App\Models\UserModel();

        $data = $this->request->getJSON(true);

        $exists = $userModel
            ->where('username', $data['username'])
            ->first();

        return $this->response->setJSON([
            'exists' => $exists ? true : false
        ]);
    }

    public function checkEmail()
    {
        $userModel = new \App\Models\UserModel();

        $data = $this->request->getJSON(true);

        $exists = $userModel
            ->where('email', $data['email'])
            ->first();

        return $this->response->setJSON([
            'exists' => $exists ? true : false
        ]);
    }
}
