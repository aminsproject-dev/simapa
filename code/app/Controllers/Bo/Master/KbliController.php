<?php

namespace App\Controllers\Bo\Master;

use App\Controllers\BaseController;
use App\Models\KbliModel;

class KbliController extends BaseController
{
    protected $kbliModel;

    public function __construct()
    {
        $this->kbliModel = new KbliModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Master KBLI',
            'open_master' => 'show',
            'show_master' => 'show',
            'active_kbli' => 'active',
            'dt_kbli' => $this->kbliModel->findAll(),
        ];

        echo view('bo/pages/v_header', $data);
        echo view('bo/master/v_kbli');
        echo view('bo/pages/v_footer');
    }

    public function add()
    {
        $data = $this->request->getPost();

        if (!$this->kbliModel->insert($data)) {
            return redirect()->back()->withInput()->with('error', $this->kbliModel->errors());
        }
        return redirect()->to('master/kbli')->with('success', 'Data berhasil ditambahkan');
    }

    public function update($id)
    {
        if (empty($row = $this->kbliModel->where('id_kbli', decrypt_data($id))->first())) {
            return redirect()->back()->withInput()->with('error', 'Data tidak ditemukan');
        }

        $data = $this->request->getPost();

        if (!$this->kbliModel->update($row['id_kbli'], $data)) {
            return redirect()->back()->withInput()->with('error', $this->kbliModel->errors());
        }
        return redirect()->to('master/kbli')->with('success', 'Data berhasil diubah');
    }

    public function delete($id)
    {
        if (empty($row = $this->kbliModel->where('id_kbli', decrypt_data($id))->first())) {
            return redirect()->back()->withInput()->with('error', 'Data tidak ditemukan');
        }

        if (!$this->kbliModel->delete($row['id_kbli'])) {
            return redirect()->back()->withInput()->with('error', $this->kbliModel->errors());
        }
        return redirect()->to('master/kbli')->with('success', 'Data berhasil dihapus');
    }
}
