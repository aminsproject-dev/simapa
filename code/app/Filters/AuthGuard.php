<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthGuard implements FilterInterface
{

    public function before(RequestInterface $request, $arguments = null)
    {
        if (!session()->get('isLoggedIn')) {
            session()->setFlashdata('error', 'Anda belum login, silahkan login terlebih dahulu');
            return redirect()->to('/auth/loginbo');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) {}
}
