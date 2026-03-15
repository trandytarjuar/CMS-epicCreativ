<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $idleTimeout = 7200; // 2 jam
        $maxSession = 86400; // 1 hari

        if (time() - session()->get('last_activity') > $idleTimeout) {
            session()->destroy();
            return redirect()->to('/login');
        }

        if (time() - session()->get('login_time') > $maxSession) {
            session()->destroy();
            return redirect()->to('/login');
        }

        session()->set('last_activity', time());
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // tidak dipakai
    }
}
