<?php

namespace App\Controllers\Bo\Master;

use App\Controllers\BaseController;
use App\Models\GuaranteeModel;
use App\Models\ItemCategoryModel;

class GuaranteeController extends BaseController
{
    protected $guaranteeModel;
    protected $itemCategoryModel;
    public function __construct()
    {
        $this->guaranteeModel = new GuaranteeModel();
        $this->itemCategoryModel = new ItemCategoryModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Sertifikat Garansi',
            'open_master' => 'show',
            'show_master' => 'show',
            'active_guarantee' => 'active',
            'dt_guarantee' => $this->guaranteeModel->getSertifGaransi(),
            'dt_category' => $this->itemCategoryModel->findAll(),
        ];

        echo view('bo/pages/v_header', $data);
        echo view('bo/master/v_guarantee');
        echo view('bo/pages/v_footer');
    }

    public function add()
    {
        $data = $this->request->getPost();
        $data['aktif'] = 1;
        $data['createdon'] = date('Y-m-d');
        $data['createdby'] = session()->get('fullname');
        $data['rowstatus'] = 1;

        if (!$this->guaranteeModel->insert($data)) {
            return redirect()->back()->withInput()->with('error', 'Error, ' . $this->guaranteeModel->errors());
        }

        return redirect()->to('master/guarantee')->with('success', 'Data berhasil ditambahkan');
    }

    public function update($id)
    {
        if (empty($row_guarantee = $this->guaranteeModel->where('id_sertifikat_garansi', decrypt_data($id))->first())) {
            return redirect()->back()->withInput()->with('error', 'Data tidak ditemukan');
        }

        $data = $this->request->getPost();

        if (!$this->guaranteeModel->update($row_guarantee['id_sertifikat_garansi'], $data)) {
            return redirect()->back()->withInput()->with('error', 'Error, ' . $this->guaranteeModel->errors());
        }

        return redirect()->to('master/guarantee')->with('success', 'Data berhasil diubah');
    }

    public function delete($id)
    {
        if (empty($row_guarantee = $this->guaranteeModel->where('id_sertifikat_garansi', decrypt_data($id))->first())) {
            return redirect()->back()->withInput()->with('error', 'Data tidak ditemukan');
        }

        if (!$this->guaranteeModel->delete($row_guarantee['id_sertifikat_garansi'])) {
            return redirect()->back()->withInput()->with('error', 'Error, ' . $this->guaranteeModel->errors());
        }

        return redirect()->to('master/guarantee')->with('success', 'Data berhasil dihapus');
    }
}
