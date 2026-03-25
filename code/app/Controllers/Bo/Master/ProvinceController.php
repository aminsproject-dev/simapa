<?php

namespace App\Controllers\Bo\Master;

use App\Controllers\BaseController;
use App\Models\ProvinceModel;

class ProvinceController extends BaseController
{
    protected $provinceModel;
    public function __construct()
    {
        $this->provinceModel = new ProvinceModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Master Provinsi',
            'open_master' => 'show',
            'show_master' => 'show',
            'open_region' => 'show',
            'show_region' => 'show',
            'active_province' => 'active',
            'dt_province' => $this->provinceModel->findAll(),
        ];

        echo view('bo/pages/v_header', $data);
        echo view('bo/master/v_province');
        echo view('bo/pages/v_footer');
    }

    public function add()
    {
        $data = $this->request->getPost();

        if (!$this->provinceModel->insert($data)) {
            return redirect()->back()->withInput()->with('error', $this->provinceModel->errors());
        }

        return redirect()->to('master/province')->with('success', 'Data berhasil ditambahkan');
    }

    public function update($id)
    {
        if (empty($row_province = $this->provinceModel->where('id', decrypt_data($id))->first())) {
            return redirect()->back()->withInput()->with('error', 'Data tidak ditemukan');
        }

        $data = $this->request->getPost();

        if (!$this->provinceModel->update($row_province['id'], $data)) {
            return redirect()->back()->withInput()->with('error', $this->provinceModel->errors());
        }

        return redirect()->to('master/province')->with('success', 'Data berhasil diubah');
    }

    public function delete($id)
    {
        if (empty($row_province = $this->provinceModel->where('id', decrypt_data($id))->first())) {
            return redirect()->back()->withInput()->with('error', 'Data tidak ditemukan');
        }

        if (!$this->provinceModel->delete($row_province['id'])) {
            return redirect()->back()->withInput()->with('error', $this->provinceModel->errors());
        }

        return redirect()->to('master/province')->with('success', 'Data berhasil dihapus');
    }
}
