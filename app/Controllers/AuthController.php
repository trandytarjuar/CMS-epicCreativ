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


    public function sendResetLink()
    {

        $email = $this->request->getPost('email');

        $userModel = new \App\Models\UserModel();

        $user = $userModel->where('email', $email)->first();

        if (!$user) {

            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'If the email exists, a reset link has been sent.'
            ]);
        }

        $token = bin2hex(random_bytes(32));

        $userModel->update($user['id'], [
            'reset_token' => $token,
            'reset_expired' => date('Y-m-d H:i:s', strtotime('+15 minutes'))
        ]);

        $resetLink = base_url('reset-password?token=' . $token);

        $emailService = \Config\Services::email();

        $emailService->setFrom('no-reply@epic.com', 'Epic Creative'); // WAJIB
        $emailService->setTo($email);
        $emailService->setSubject('Reset Password');

        $emailService->setMessage("
            Click link to reset password:
            <br>
            <a href='$resetLink'>$resetLink</a>
        ");

        if (!$emailService->send()) {
            dd($emailService->printDebugger(['headers']));
        }
        $emailService->send();

        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Reset link sent to your email'
        ]);
    }


    public function resetPassword()
    {

        $token = $this->request->getGet('token');

        $userModel = new \App\Models\UserModel();

        $user = $userModel->where('reset_token', $token)->first();

        if (!$user) {
            return redirect()->to('/login');
        }

        if (strtotime($user['reset_expired']) < time()) {
            return redirect()->to('/login');
        }

        return view('auth/resetPassword', [
            'token' => $token
        ]);
    }


    public function updatePassword()
    {

        $token = $this->request->getPost('token');
        $password = $this->request->getPost('password');

        $userModel = new \App\Models\UserModel();

        $user = $userModel->where('reset_token', $token)->first();

        if (!$user) {

            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid token'
            ]);
        }

        $userModel->update($user['id'], [
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'reset_token' => null,
            'reset_expired' => null
        ]);

        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Password berhasil diubah'
        ]);
    }
}
