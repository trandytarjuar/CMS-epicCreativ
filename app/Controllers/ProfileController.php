<?php

namespace App\Controllers;

use App\Models\UserModel;

class ProfileController extends BaseController
{

    public function index()
    {
        $userModel = new UserModel();

        $user = $userModel->find(session()->get('user_id'));

        return view('user/profile', [
            'user' => $user
        ]);
    }


    public function update()
    {
        $userModel = new UserModel();

        $id = session()->get('user_id');

        $data = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'username' => $this->request->getPost('username'),
            'updated_at' => date('Y-m-d H:i:s'),
            'updated_by' => session()->get('username')
        ];

        $image = $this->request->getFile('image');

        if ($image && $image->isValid() && !$image->hasMoved()) {
            $allowed = ['image/png','image/jpeg','image/jpg'];
            if (!in_array($image->getMimeType(), $allowed)) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'File harus berupa gambar (png, jpg, jpeg)'
                ]);
            }

            $newName = $image->getRandomName();

            $image->move(ROOTPATH.'public/image/user', $newName);

            $data['image'] = $newName;

            session()->set('image', $newName);
        }

        $userModel->update($id, $data);

        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Profile berhasil diperbarui'
        ]);
    }


    public function changePassword()
    {
        $userModel = new UserModel();

        $id = session()->get('user_id');

        $password = $this->request->getPost('password');

        $userModel->update($id, [
            'password' => password_hash($password, PASSWORD_DEFAULT)
        ]);
        session()->destroy();
        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Password berhasil diubah'
        ]);
    }
}
