<?php

namespace App\Controllers\Bo\Master;

use App\Controllers\BaseController;
use App\Models\JenisInstansiModel;
use App\Models\NamaInstansiModel;

class NamaInstansiController extends BaseController
{
    protected $namaInstansiModel;
    protected $jenisInstansiModel;

    public function __construct()
    {
        $this->namaInstansiModel = new NamaInstansiModel();
        $this->jenisInstansiModel = new JenisInstansiModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Master Nama Instansi',
            'open_master' => 'show',
            'show_master' => 'show',
            'active_nama_instansi' => 'active',
            'dt_nama_instansi' => $this->namaInstansiModel->findAll(),
            'dt_jenis_instansi' => $this->jenisInstansiModel->findAll(),
        ];

        echo view('bo/pages/v_header', $data);
        echo view('bo/master/v_nama_instansi');
        echo view('bo/pages/v_footer');
    }

    public function add()
    {
        $data = $this->request->getPost();

        if (!$this->namaInstansiModel->insert($data)) {
            return redirect()->back()->withInput()->with('error', $this->namaInstansiModel->errors());
        }
        return redirect()->to('master/nama-instansi')->with('success', 'Data berhasil ditambahkan');
    }

    public function update($id)
    {
        if (empty($row = $this->namaInstansiModel->where('id_nama_instansi', decrypt_data($id))->first())) {
            return redirect()->back()->withInput()->with('error', 'Data tidak ditemukan');
        }

        $data = $this->request->getPost();

        if (!$this->namaInstansiModel->update($row['id_nama_instansi'], $data)) {
            return redirect()->back()->withInput()->with('error', $this->namaInstansiModel->errors());
        }
        return redirect()->to('master/nama-instansi')->with('success', 'Data berhasil diubah');
    }

    public function delete($id)
    {
        if (empty($row = $this->namaInstansiModel->where('id_nama_instansi', decrypt_data($id))->first())) {
            return redirect()->back()->withInput()->with('error', 'Data tidak ditemukan');
        }

        if (!$this->namaInstansiModel->delete($row['id_nama_instansi'])) {
            return redirect()->back()->withInput()->with('error', $this->namaInstansiModel->errors());
        }
        return redirect()->to('master/nama-instansi')->with('success', 'Data berhasil dihapus');
    }
}
