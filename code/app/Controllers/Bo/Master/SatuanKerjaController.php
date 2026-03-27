<?php

namespace App\Controllers\Bo\Master;

use App\Controllers\BaseController;
use App\Models\Bo\NamaInstansiModel;
use App\Models\Bo\SatuanKerjaModel;

class SatuanKerjaController extends BaseController
{
    protected $satuanKerjaModel;
    protected $namaInstansiModel;

    public function __construct()
    {
        $this->satuanKerjaModel = new SatuanKerjaModel();
        $this->namaInstansiModel = new NamaInstansiModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Master Satuan Kerja',
            'open_master' => 'show',
            'show_master' => 'show',
            'active_satuan_kerja' => 'active',
            'dt_satuan_kerja' => $this->satuanKerjaModel->findAll(),
            'dt_nama_instansi' => $this->namaInstansiModel->findAll(),
        ];

        echo view('bo/pages/v_header', $data);
        echo view('bo/master/v_satuan_kerja');
        echo view('bo/pages/v_footer');
    }

    public function add()
    {
        $data = $this->request->getPost();

        if (!$this->satuanKerjaModel->insert($data)) {
            return redirect()->back()->withInput()->with('error', $this->satuanKerjaModel->errors());
        }
        return redirect()->to('master/satuan-kerja')->with('success', 'Databerhasil ditambahkan');
    }

    public function update($id)
    {
        if (empty($row = $this->satuanKerjaModel->where('id_satuan_kerja', decrypt_data($id))->first())) {
            return redirect()->back()->withInput()->with('error', 'Data tidak ditemukan');
        }

        $data = $this->request->getPost();

        if (!$this->satuanKerjaModel->update($row['id_satuan_kerja'], $data)) {
            return redirect()->back()->withInput()->with('error', $this->satuanKerjaModel->errors());
        }
        return redirect()->to('master/satuan-kerja')->with('success', 'Data berhasil diubah');
    }

    public function delete($id)
    {
        if (empty($row = $this->satuanKerjaModel->where('id_satuan_kerja', decrypt_data($id))->first())) {
            return redirect()->back()->withInput()->with('error', 'Data tidak ditemukan');
        }

        if (!$this->satuanKerjaModel->delete($row['id_satuan_kerja'])) {
            return redirect()->back()->withInput()->with('error', $this->satuanKerjaModel->errors());
        }
        return redirect()->to('master/satuan-kerja')->with('success', 'Data berhasil dihapus');
    }
}
