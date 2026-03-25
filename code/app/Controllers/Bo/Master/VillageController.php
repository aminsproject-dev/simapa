<?php

namespace App\Controllers\Bo\Master;

use App\Controllers\BaseController;
use App\Models\ConfSistemModel;
use App\Models\DistrictModel;
use App\Models\VillageModel;

class VillageController extends BaseController
{
    protected $confSistemModel;
    protected $districtModel;
    protected $villageModel;
    public function __construct()
    {
        $this->confSistemModel = new ConfSistemModel();
        $this->districtModel = new DistrictModel();
        $this->villageModel = new VillageModel();
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
            'active_village' => 'active',
            'id_regency' => $id_regency,
            'dt_district' => $this->districtModel->where('id_kabupaten', $id_regency)->findAll(),
            'dt_village' => $this->villageModel->getAllVillage($id_regency),
        ];

        echo view('bo/pages/v_header', $data);
        echo view('bo/master/v_village');
        echo view('bo/pages/v_footer');
    }

    public function add()
    {
        $data = $this->request->getPost();

        if (!$this->villageModel->insert($data)) {
            return redirect()->back()->withInput()->with('error', $this->villageModel->errors());
        }

        return redirect()->to('master/village')->with('success', 'Data berhasil ditambahkan');
    }

    public function update($id)
    {
        if (empty($row_village = $this->villageModel->where('id_desa', decrypt_data($id))->first())) {
            return redirect()->back()->withInput()->with('error', 'data tidak ditemukan');
        }

        $data = $this->request->getPost();

        if (!$this->villageModel->update($row_village['id_desa'], $data)) {
            return redirect()->back()->withInput()->with('error', $this->villageModel->errors());
        }

        return redirect()->to('master/village')->with('success', 'data berhasil diubah');
    }

    public function delete($id)
    {
        if (empty($row_village = $this->villageModel->where('id_desa', decrypt_data($id))->first())) {
            return redirect()->back()->withInput()->with('error', 'data tidak ditemukan');
        }

        if (!$this->villageModel->delete($row_village['id_desa'])) {
            return redirect()->back()->withInput()->with('error', $this->villageModel->errors());
        }

        return redirect()->to('master/village')->with('success', 'data berhasil dihapus');
    }
}
