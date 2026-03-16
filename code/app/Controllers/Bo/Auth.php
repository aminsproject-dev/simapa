<?php

namespace App\Controllers\Bo;

use App\Controllers\BaseController;

class Auth extends BaseController
{
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

        $sql = "SELECT * FROM tb_user a INNER JOIN tb_pegawai b ON a.id_pegawai=b.id_pegawai WHERE username =" . $this->db->escape($username) . " LIMIT 1";
        $result = $this->db->query($sql);
        $row = $result->getRow();

        if ($result->getNumRows() === 1) {
            if (password_verify($password, $row->password)) {
                $session_data = [
                    'user_id' => $row->id,
                    'username' => $row->username,
                    'fullname' => $row->nama_pegawai,
                ];
                $this->set_session($session_data);

                return 'login_sukses';
            } else {
                return 'password_salah';
            }
        } else {
            return 'akun_tidak_ditemukan';
        }
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
