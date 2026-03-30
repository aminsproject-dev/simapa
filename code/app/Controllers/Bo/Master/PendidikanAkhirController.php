<?php

namespace App\Controllers\Bo\Master;

use App\Controllers\BaseController;
use App\Models\PendidikanAkhirModel;

class PendidikanAkhirController extends BaseController
{
    protected $pendidikanAkhirModel;

    public function __construct()
    {
        $this->pendidikanAkhirModel = new PendidikanAkhirModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Master Pendidikan Akhir',
            'open_master' => 'show',
            'show_master' => 'show',
            'active_pendidikan_akhir' => 'show',
            'dt_pendidikan_akhir' => $this->pendidikanAkhirModel->findAll(),
        ];

        echo view('bo/pages/v_header', $data);
        echo view('bo/master/v_pendidikan_akhir');
        echo view('bo/pages/v_footer');
    }

    public function add()
    {
        $data = $this->request->getPost();

        if (!$this->pendidikanAkhirModel->insert($data)) {
            return redirect()->back()->withInput()->with('error', $this->pendidikanAkhirModel->errors());
        }
        return redirect()->to('master/pendidikan-akhir')->with('success', 'Data berhasil ditambahkan');
    }

    public function update($id)
    {
        if (empty($row = $this->pendidikanAkhirModel->where('id_pendidikan_akhir', decrypt_data($id))->first())) {
            return redirect()->back()->withInput()->with('error', 'Data tidak ditemukan');
        }

        $data = $this->request->getPost();

        if (!$this->pendidikanAkhirModel->update($row['id_pendidikan_akhir'], $data)) {
            return redirect()->back()->withInput()->with('error', $this->pendidikanAkhirModel->errors());
        }
        return redirect()->to('master/pendidikan-akhir')->with('success', 'Data berhasil diubah');
    }

    public function delete($id)
    {
        if (empty($row = $this->pendidikanAkhirModel->where('id_pendidikan_akhir', decrypt_data($id))->first())) {
            return redirect()->back()->withInput()->with('error', 'Data tidak ditemukan');
        }

        if (!$this->pendidikanAkhirModel->delete($row['id_pendidikan_akhir'])) {
            return redirect()->back()->withInput()->with('error', $this->pendidikanAkhirModel->errors());
        }
        return redirect()->to('master/pendidikan-akhir')->with('success', 'Data berhasil dihapus');
    }
}
