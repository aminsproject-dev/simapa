<?php

namespace App\Controllers\Bo\Master;

use App\Controllers\BaseController;
use App\Models\Bo\KategoriPekerjaanModel;

class KategoriPekerjaanController extends BaseController
{
    protected $kategoriPekerjaanModel;

    public function __construct()
    {
        $this->kategoriPekerjaanModel = new KategoriPekerjaanModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Master Kategori Pekerjaan',
            'open_master' => 'show',
            'show_master' => 'show',
            'active_kategori_pekerjaan' => 'active',
            'dt_kategori_pekerjaan' => $this->kategoriPekerjaanModel->findAll(),
        ];

        echo view('bo/pages/v_header', $data);
        echo view('bo/master/v_kategori_pekerjaan');
        echo view('bo/pages/v_footer');
    }

    public function add()
    {
        $data = $this->request->getPost();

        if (!$this->kategoriPekerjaanModel->insert($data)) {
            return redirect()->back()->withInput()->with('error', $this->kategoriPekerjaanModel->errors());
        }
        return redirect()->to('master/kategori-pekerjaan')->with('success', 'Data berhasil ditambahakan');
    }

    public function update($id)
    {
        if (empty($row = $this->kategoriPekerjaanModel->where('id_kategori_pekerjaan', decrypt_data($id))->first())) {
            return redirect()->back()->withInput()->with('error', 'Data tidak ditemukan');
        }

        $data = $this->request->getPost();

        if (!$this->kategoriPekerjaanModel->update($row['id_kategori_pekerjaan'], $data)) {
            return redirect()->back()->withInput()->with('error', $this->kategoriPekerjaanModel->errors());
        }
        return redirect()->to('master/kategori-pekerjaan')->with('success', 'Data berhasil diubah');
    }

    public function delete($id)
    {
        if (empty($row = $this->kategoriPekerjaanModel->where('id_kategori_pekerjaan', decrypt_data($id))->first())) {
            return redirect()->back()->withInput()->with('error', 'Data tidak ditemukan');
        }

        if (!$this->kategoriPekerjaanModel->delete($row['id_kategori_pekerjaan'])) {
            return redirect()->back()->withInput()->with('error', $this->kategoriPekerjaanModel->errors());
        }
        return redirect()->to('master/kategori-pekerjaan')->with('success', 'Data berhasil dihapus');
    }
}
