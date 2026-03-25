<?php

namespace App\Controllers\Bo\Master;

use App\Controllers\BaseController;
use App\Models\ProvinceModel;
use App\Models\RegencyModel;

class RegencyController extends BaseController
{
    protected $provinceModel;
    protected $regencyModel;
    public function __construct()
    {
        $this->provinceModel = new ProvinceModel();
        $this->regencyModel = new RegencyModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Master Kota/Kabupaten',
            'open_master' => 'show',
            'show_master' => 'show',
            'open_region' => 'show',
            'show_region' => 'show',
            'active_regency' => 'active',
            'dt_province' => $this->provinceModel->findAll(),
            'dt_regency' => $this->regencyModel->getAllRegency(),
        ];

        echo view('bo/pages/v_header', $data);
        echo view('bo/master/v_regency');
        echo view('bo/pages/v_footer');
    }

    public function add()
    {
        $data = $this->request->getPost();

        if (!$this->regencyModel->insert($data)) {
            return redirect()->back()->withInput()->with('error', $this->regencyModel->errors());
        }

        return redirect()->to('master/regency')->with('success', 'Data berhasil ditambah');
    }

    public function update($id)
    {
        if (empty($row_regency = $this->regencyModel->where('id_kabupaten', decrypt_data($id))->first())) {
            return redirect()->back()->withInput()->with('error', 'Data tidak ditemukan');
        }

        $data = $this->request->getPost();

        if (!$this->regencyModel->update($row_regency['id_kabupaten'], $data)) {
            return redirect()->back()->withInput()->with('error', $this->regencyModel->errors());
        }

        return redirect()->to('master/regency')->with('success', 'Data berhasil diubah');
    }

    public function delete($id)
    {
        if (empty($row_regency = $this->regencyModel->where('id_kabupaten', decrypt_data($id))->first())) {
            return redirect()->back()->withInput()->with('error', 'Data tidak ditemukan');
        }

        if (!$this->regencyModel->delete($row_regency['id_kabupaten'])) {
            return redirect()->back()->withInput()->with('error', $this->regencyModel->errors());
        }

        return redirect()->to('master/regency')->with('success', 'Data berhasil dihapus');
    }
}
