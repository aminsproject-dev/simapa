<?php

namespace App\Controllers\Bo\Master;

use App\Controllers\BaseController;
use App\Models\Bo\JenisInstansiModel;

class JenisInstansiController extends BaseController
{
    protected $jenisInstansiModel;

    public function __construct()
    {
        $this->jenisInstansiModel = new JenisInstansiModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Master Jenis Instansi',
            'open_master' => 'show',
            'show_master' => 'show',
            'active_jenis_instansi' => 'active',
            'dt_jensi_instansi' => $this->jenisInstansiModel->findAll(),
        ];

        echo view('bo/pages/v_header', $data);
        echo view('bo/master/v_jenis_instansi');
        echo view('bo/pages/v_footer');
    }

    public function add()
    {
        $data = $this->request->getPost();

        if (!$this->jenisInstansiModel->insert($data)) {
            return redirect()->back()->withInput()->with('error', $this->jenisInstansiModel->errors());
        }
        return redirect()->to('master/jenis-instansi')->with('success', 'Data berhasil ditambahkan');
    }

    public function update($id)
    {
        if (empty($row = $this->jenisInstansiModel->where('id_jenis_instansi', decrypt_data($id))->first())) {
            return redirect()->back()->withInput()->with('error', 'Data tidak ditemukan');
        }

        $data = $this->request->getPost();

        if (!$this->jenisInstansiModel->update($row['id_jenis_instansi'], $data)) {
            return redirect()->back()->withInput()->with('error', $this->jenisInstansiModel->errors());
        }
        return redirect()->to('master/jenis-instansi')->with('success', 'Data berhasil diubah');
    }

    public function delete($id)
    {
        if (empty($row = $this->jenisInstansiModel->where('id_jenis_instansi', decrypt_data($id))->first())) {
            return redirect()->back()->withInput()->with('error', 'Data tidak ditemukan');
        }

        if (!$this->jenisInstansiModel->delete($row['id_jenis_instansi'])) {
            return redirect()->back()->withInput()->with('error', $this->jenisInstansiModel->errors());
        }
        return redirect()->to('master/jenis-instansi')->with('success', 'Data berhasil dihapus');
    }
}
