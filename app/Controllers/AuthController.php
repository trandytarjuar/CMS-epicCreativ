<?php

namespace App\Controllers;

use App\Models\UserModel;

class AuthController extends BaseController
{
    public function login()
    {
        return view('auth/login');
    }

    public function loginProcess()
    {
        $maxAttempt = 5;
        $lockTime = 10;
        $userModel = new UserModel();

        $data = $this->request->getJSON(true);

        $username = $data['email'] ?? '';
        $password = $data['password'] ?? '';

        $user = $userModel->getUserByLogin($username);

        if (!$user) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'User tidak ditemukan'
            ]);
        }

        if ($user['login_attempt'] >= $maxAttempt) {

            $lastAttempt = strtotime($user['last_attempt']);
            $unlockTime = $lastAttempt + ($lockTime * 60);

            if (time() < $unlockTime) {

                $remaining = ceil(($unlockTime - time()) / 60);

                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => "Terlalu banyak percobaan login. Coba lagi {$remaining} menit."
                ]);
            }
        }

        if (!password_verify($password, $user['password'])) {

            $userModel->increaseLoginAttempt($user);

            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Password salah'
            ]);
        }
        $userModel->resetLoginAttempt($user['id']);


        session()->set([
            'user_id' => $user['id'],
            'name' => $user['name'],
            'username' => $user['username'],
            'image' => $user['image'],
            'role' => $user['role'],
            'isLoggedIn' => true,
            'login_time' => time(),
            'last_activity' => time()
        ]);

        return $this->response->setJSON([
            'status' => 'success',
            'redirect' => base_url('/')
        ]);
    }
    public function logout()
    {
        session()->destroy();

        return redirect()->to('/login');
    }

    public function forgotPassword()
    {
        return view('auth/forgotPassword');
    }
}
