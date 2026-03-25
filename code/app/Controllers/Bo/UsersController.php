<?php

namespace App\Controllers\Bo;

use App\Controllers\BaseController;
use App\Models\PegawaiModel;
use App\Models\UsersModel;

class UsersController extends BaseController
{
    protected $usersModel;
    protected $pegawaiModel;
    public function __construct()
    {
        $this->usersModel = new UsersModel();
        $this->pegawaiModel = new PegawaiModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Pengguna Sisuro',
            'active_users' => 'active',
            'dt_pegawai' => $this->pegawaiModel->findAll(),
            'dt_users' => $this->usersModel->getAllDataPengguna(),
        ];

        echo view('bo/pages/v_header', $data);
        echo view('bo/users/v_users');
        echo view('bo/pages/v_footer');
    }

    public function create()
    {
        $data = $this->request->getPost();
        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        $data['status_user'] = 1;

        if (!$this->usersModel->insert($data)) {
            return redirect()->back()->withInput()->with('error', $this->usersModel->errors());
        }

        return redirect()->to('users')->with('success', 'Data pengguna berhasil ditambahkan');
    }

    public function update($id)
    {
        if (empty($row_user = $this->usersModel->where('id', decrypt_data($id))->first())) {
            return redirect()->back()->withInput()->with('error', 'Data tidak ditemukan');
        }

        $data = $this->request->getPost();

        if (!empty($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        } else {
            unset($data['password']);
        }

        if (!$this->usersModel->update($row_user['id'], $data)) {
            return redirect()->back()->withInput()->with('error', $this->usersModel->errors());
        }

        return redirect()->to('users')->with('success', 'Data berhasil diubah');
    }

    public function delete($id)
    {
        if (empty($row_user = $this->usersModel->where('id', decrypt_data($id))->first())) {
            return redirect()->back()->withInput()->with('error', 'Data tidak ditemukan');
        }

        if (!$this->usersModel->update($row_user['id'], ['status_user' => 0])) {
            return redirect()->back()->withInput()->with('error', $this->usersModel->errors());
        }

        return redirect()->to('users')->with('success', 'Data berhasil dihapus');
    }
}
