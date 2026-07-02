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
        'last_login',
        'reset_token',
        'reset_expired',
    ];

    public function getUserByLogin(string $username)
    {
        return $this
            ->groupStart()
            ->where('name', $username)
            ->orWhere('username', $username)
            ->groupEnd()
            ->first();
    }
    public function resetLoginAttempt(int $userId)
    {
        return $this->update($userId, [
            'login_attempt' => 0,
            'last_attempt' => null,
            'last_login' => date('Y-m-d H:i:s')
        ]);
    }
    public function increaseLoginAttempt(array $user)
    {
        return $this->update($user['id'], [
            'login_attempt' => $user['login_attempt'] + 1,
            'last_attempt' => date('Y-m-d H:i:s')
        ]);
    }
}
