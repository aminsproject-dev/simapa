<?php

namespace App\Controllers\Bo\Master;

use App\Controllers\BaseController;
use App\Models\Bo\BahasaModel;

class BahasaController extends BaseController
{
    protected $bahasaModel;

    public function __construct()
    {
        $this->bahasaModel = new BahasaModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Master Bahasa',
            'open_master' => 'show',
            'show_master' => 'show',
            'active_bahasa' => 'active',
            'dt_bahasa' => $this->bahasaModel->findAll(),
        ];

        echo view('bo/pages/v_header', $data);
        echo view('bo/master/v_bahasa');
        echo view('bo/pages/v_footer');
    }

    public function add()
    {
        $data = $this->request->getPost();

        if (!$this->bahasaModel->insert($data)) {
            return redirect()->back()->withInput()->with('error', $this->bahasaModel->errors());
        }
        return redirect()->to('master/bahasa')->with('success', 'Data berhasil ditmbahkan');
    }

    public function update($id)
    {
        if (empty($row = $this->bahasaModel->where('id_bahasa', decrypt_data($id))->first())) {
            return redirect()->back()->withInput()->with('error', 'Data tidak ditemukan');
        }

        $data = $this->request->getPost();

        if (!$this->bahasaModel->update($row['id_bahasa'], $data)) {
            return redirect()->back()->withInput()->with('error', $this->bahasaModel->errors());
        }
        return redirect()->to('master/bahasa')->with('success', 'Data berhasil diubah');
    }

    public function delete($id)
    {
        if (empty($row = $this->bahasaModel->where('id_bahasa', decrypt_data($id))->first())) {
            return redirect()->back()->withInput()->with('error', 'Data tidak ditemukan');
        }

        if (!$this->bahasaModel->delete($row['id_bahasa'])) {
            return redirect()->back()->withInput()->with('success', 'Data berhasil dihapus');
        }
    }
}
