<?php

namespace App\Controllers\Bo\Master;

use App\Controllers\BaseController;
use App\Models\CountryModel;

class CountryController extends BaseController
{
    protected $countryModel;
    public function __construct()
    {
        $this->countryModel = new CountryModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Master Negara',
            'open_master' => 'show',
            'show_master' => 'show',
            'open_region' => 'show',
            'show_region' => 'show',
            'active_country' => 'active',
            'dt_country' => $this->countryModel->findAll(),
        ];

        echo view('bo/pages/v_header', $data);
        echo view('bo/master/v_country');
        echo view('bo/pages/v_footer');
    }

    public function add()
    {
        $data = $this->request->getPost();

        if (!$this->countryModel->insert($data)) {
            return redirect()->back()->withInput()->with('error', $this->countryModel->errors());
        }

        return redirect()->to('master/country')->with('success', 'Data berhasil ditambah');
    }

    public function update($id)
    {
        if (empty($row_negara = $this->countryModel->where('id_negara', decrypt_data($id))->first())) {
            return redirect()->back()->withInput()->with('error', 'Data tidak ditemukan');
        }

        $data = $this->request->getPost();

        if (!$this->countryModel->update($row_negara['id_negara'], $data)) {
            return redirect()->back()->withInput()->with('error', $this->countryModel->errors());
        }

        return redirect()->to('master/country')->with('success', 'Data berhasil diubah');
    }

    public function delete($id)
    {
        if (empty($row_negara = $this->countryModel->where('id_negara', decrypt_data($id))->first())) {
            return redirect()->back()->withInput()->with('error', 'Data tidak ditemukan');
        }

        if (!$this->countryModel->delete($row_negara['id_negara'])) {
            return redirect()->back()->withInput()->with('error', $this->countryModel->errors());
        }

        return redirect()->to('master/country')->with('success', 'Data berhasil dihapus');
    }
}
