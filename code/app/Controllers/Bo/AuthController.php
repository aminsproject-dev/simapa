<?php

namespace App\Controllers\Bo;

use App\Controllers\BaseController;
use App\Models\UsersModel;

class AuthController extends BaseController
{
    protected $usersModel;
    public function __construct()
    {
        $this->usersModel = new UsersModel();
    }

    public function login()
    {
        $data = [
            'title' => 'Login SISURO',
        ];

        echo view('bo/auth/v_header', $data);
        echo view('bo/auth/v_login');
        echo view('bo/auth/v_footer');
    }

    public function proseslogin()
    {
        if (!verify_turnstile($this->request)) {
            return redirect()->to('auth/loginbo')->with('error', 'Cloudflare Turnstile Invalid!')->with('errors.cf-turnstile-response', 'Cloudflare error!');
        }

        $rules = [
            'username' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Inputan tidak boleh kosong',
                ]
            ],
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Inputan tidak boleh kosong',
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            return redirect()->to('auth/loginbo')->withInput()->with('errors', $this->validator->getErrors());
        }

        $hasil = $this->cek_akun();

        switch ($hasil) {
            case 'login_sukses':
                session()->setFlashdata('success', 'Login Berhasil');
                return redirect()->to('dashboard');
                break;

            case 'password_salah':
                return redirect()->to('auth/loginbo')->withInput()->with('error', 'Login gagal, pastikan password yang anda masukan benar');
                break;

            case 'akun_belum_aktif':
                return redirect()->to('auth/loginbo')->withInput()->with('error', 'Login gagal, akun tidak aktif. Silahkan hubungi admin');
                break;

            case 'akun_tidak_ditemukan':
                return redirect()->to('auth/loginbo')->withInput()->with('error', 'Login gagal, akun tidak ditemukan. pastikan username dan password yang anda masukan benar');
                break;
        }
    }

    private function cek_akun()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $row_user = $this->usersModel->getUserByUsername($username);

        if (empty($row_user)) {
            return 'akun_tidak_ditemukan';
        }

        if (!password_verify($password, $row_user['password'])) {
            return 'password_salah';
        }

        $session_data = [
            'user_id' => $row_user['id'],
            'username' => $row_user['username'],
            'fullname' => $row_user['nama_pegawai'],
        ];
        $this->set_session($session_data);

        return 'login_sukses';
    }

    private function set_session($session_data)
    {
        $sess_data = [
            'user_id' => $session_data['user_id'],
            'username' => $session_data['username'],
            'fullname' => $session_data['fullname'],
            'isLoggedIn' => TRUE,
        ];
        session()->set($sess_data);
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('auth/loginbo')->with('success', 'Berhasil keluar sistem');
    }
}
