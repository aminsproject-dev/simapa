<?php

namespace App\Controllers\Bo\Marketing;

use App\Controllers\BaseController;
use App\Models\MarketingEkatalogModel;

class EkatalogController extends BaseController
{
    protected $marketingEkatalogModel;
    public function __construct()
    {
        $this->marketingEkatalogModel = new MarketingEkatalogModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Data E-Katalog',
            'open_marketing' => 'show',
            'show_marketing' => 'show',
            'active_ekatalog' => 'active',
            'dt_ekatalog' => $this->marketingEkatalogModel->findAll(),
        ];

        echo view('bo/pages/v_header', $data);
        echo view('bo/marketing/v_ekatalog');
        echo view('bo/pages/v_footer');
    }

    public function add()
    {
        $data = $this->request->getPost();
        $data['alamat_satuan_kerja'] = strip_tags($data['alamat_satuan_kerja']);
        $data['aktif'] = 1;
        $data['createdon'] = date('Y-m-d');
        $data['createdby'] = session()->get('fullname');
        $data['rowstatus'] = 1;

        if (!$this->marketingEkatalogModel->insert($data)) {
            return redirect()->back()->withInput()->with('error', $this->marketingEkatalogModel->errors());
        }

        return redirect()->to('marketing/ekatalog')->with('success', 'Data berhasil ditambah');
    }

    public function update($id)
    {
        if (empty($row_ekatalog = $this->marketingEkatalogModel->where('id_marketing_ekatalog', decrypt_data($id))->first())) {
            return redirect()->back()->withInput()->with('error', 'Data tidak ditemukan');
        }

        $data = $this->request->getPost();
        $data['alamat_satuan_kerja'] = strip_tags($data['alamat_satuan_kerja']);

        if (!$this->marketingEkatalogModel->update($row_ekatalog['id_marketing_ekatalog'], $data)) {
            return redirect()->back()->withInput()->with('error', $this->marketingEkatalogModel->errors());
        }

        return redirect()->to('marketing/ekatalog')->with('success', 'Data berhasil diubah');
    }

    public function delete($id)
    {
        if (empty($row_ekatalog = $this->marketingEkatalogModel->where('id_marketing_ekatalog', decrypt_data($id))->first())) {
            return redirect()->back()->withInput()->with('error', 'Data tidak ditemukan');
        }

        if (!$this->marketingEkatalogModel->delete($row_ekatalog['id_marketing_ekatalog'])) {
            return redirect()->back()->withInput()->with('error', $this->marketingEkatalogModel->errors());
        }

        return redirect()->to('marketing/ekatalog')->with('success', 'Data berhasil dihapus');
    }
}
