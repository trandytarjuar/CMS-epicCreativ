<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';

    protected $primaryKey = 'id';

    protected $allowedFields = [
        'name',
        'email',
        'username',
        'image',
        'password',
        'role',
        'login_attempt',
        'last_attempt',
        'last_login'
    ];

    public function getUserByLogin($username)
    {
        return $this
            ->groupStart()
            ->where('name', $username)
            ->orWhere('username', $username)
            ->groupEnd()
            ->first();
    }
    public function resetLoginAttempt($userId)
    {
        return $this->update($userId, [
            'login_attempt' => 0,
            'last_attempt' => null,
            'last_login' => date('Y-m-d H:i:s')
        ]);
    }
    public function increaseLoginAttempt($user)
    {
        return $this->update($user['id'], [
            'login_attempt' => $user['login_attempt'] + 1,
            'last_attempt' => date('Y-m-d H:i:s')
        ]);
    }
}
