<?php

namespace App\Controllers\Bo\Master;

use App\Controllers\BaseController;
use App\Models\ConfSistemModel;
use App\Models\DistrictModel;
use App\Models\RegencyModel;

class DistrictController extends BaseController
{
    protected $confSistemModel;
    protected $regencyModel;
    protected $districtModel;
    public function __construct()
    {
        $this->confSistemModel = new ConfSistemModel();
        $this->regencyModel = new RegencyModel();
        $this->districtModel = new DistrictModel();
    }

    public function index()
    {
        $id_regency = $this->confSistemModel->where('id', 21)->first()['content'];

        $data = [
            'title' => 'Master Kecamatan',
            'open_master' => 'show',
            'show_master' => 'show',
            'open_region' => 'show',
            'show_region' => 'show',
            'active_district' => 'active',
            'id_regency' => $id_regency,
            'dt_regency' => $this->regencyModel->findAll(),
            'dt_district' => $this->districtModel->getAllDistrict($id_regency),
        ];

        echo view('bo/pages/v_header', $data);
        echo view('bo/master/v_district');
        echo view('bo/pages/v_footer');
    }

    public function add()
    {
        $data = $this->request->getPost();

        if (!$this->districtModel->insert($data)) {
            return redirect()->back()->withInput()->with('error', $this->districtModel->errors());
        }

        return redirect()->to('master/district')->with('success', 'Data berhasil di tambah');
    }

    public function update($id)
    {
        if (empty($row_district = $this->districtModel->where('id_kecamatan', decrypt_data($id))->first())) {
            return redirect()->back()->withInput()->with('error', 'Data tidak ditemukan');
        }

        $data = $this->request->getPost();

        if (!$this->districtModel->update($row_district['id_kecamatan'], $data)) {
            return redirect()->back()->withInput()->with('error', $this->districtModel->errors());
        }

        return redirect()->to('master/district')->with('success', 'Data berhasil diubah');
    }

    public function delete($id)
    {
        if (empty($row_district = $this->districtModel->where('id_kecamatan', decrypt_data($id))->first())) {
            return redirect()->back()->withInput()->with('error', 'Data tidak ditemukan');
        }

        if (!$this->districtModel->delete($row_district['id_kecamatan'])) {
            return redirect()->back()->withInput()->with('error', $this->districtModel->errors());
        }

        return redirect()->to('master/district')->with('success', 'Data berhasil dihapus');
    }
}
