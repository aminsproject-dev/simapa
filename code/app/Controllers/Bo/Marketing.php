<?php

namespace App\Controllers\Bo;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Marketing extends BaseController
{
    public function ekatalog()
    {
        $data = [
            'title' => 'Data E-Katalog',
            'open_marketing' => 'show',
            'show_marketing' => 'show',
            'active_ekatalog' => 'active',
            'dt_ekatalog' => $this->model->getSelectedData('tb_marketing_ekatalog', ['rowstatus' => 1])->getResult(),
        ];

        echo view('bo/pages/v_header', $data);
        echo view('bo/marketing/v_ekatalog');
        echo view('bo/pages/v_footer');
    }

    public function ekatalogAdd()
    {
        $data = [
            'instansi' => $this->request->getPost('instansi'),
            'satuan_kerja' => $this->request->getPost('satuan_kerja'),
            'alamat_satuan_kerja' => strip_tags($this->request->getPost('alamat_satuan_kerja')),
            'nama_pp' => $this->request->getPost('nama_pp'),
            'jabatan_pp' => $this->request->getPost('jabatan_pp'),
            'nip_pp' => $this->request->getPost('nip_pp'),
            'email_pp' => $this->request->getPost('email_pp'),
            'no_tlp_pp' => $this->request->getPost('no_tlp_pp'),
            'nama_ppk' => $this->request->getPost('nama_ppk'),
            'jabatan_ppk' => $this->request->getPost('jabatan_ppk'),
            'nip_ppk' => $this->request->getPost('nip_ppk'),
            'email_ppk' => $this->request->getPost('email_ppk'),
            'no_tlp_ppk' => $this->request->getPost('no_tlp_ppk'),
            'aktif' => 1,
            'createdon' => date('Y-m-d'),
            'createdby' => session()->get('fullname'),
            'rowstatus' => 1,
        ];

        $this->model->insertData('tb_marketing_ekatalog', $data);

        return redirect()->to('marketing/ekatalog')->with('success', 'Data berhasil di tambah');
    }

    public function ekatalogEdit()
    {
        $id['id_marketing_ekatalog'] = $this->request->getPost('id_marketing_ekatalog');

        $data = [
            'instansi' => $this->request->getPost('instansi'),
            'satuan_kerja' => $this->request->getPost('satuan_kerja'),
            'alamat_satuan_kerja' => strip_tags($this->request->getPost('alamat_satuan_kerja')),
            'nama_pp' => $this->request->getPost('nama_pp'),
            'jabatan_pp' => $this->request->getPost('jabatan_pp'),
            'nip_pp' => $this->request->getPost('nip_pp'),
            'email_pp' => $this->request->getPost('email_pp'),
            'no_tlp_pp' => $this->request->getPost('no_tlp_pp'),
            'nama_ppk' => $this->request->getPost('nama_ppk'),
            'jabatan_ppk' => $this->request->getPost('jabatan_ppk'),
            'nip_ppk' => $this->request->getPost('nip_ppk'),
            'email_ppk' => $this->request->getPost('email_ppk'),
            'no_tlp_ppk' => $this->request->getPost('no_tlp_ppk'),
        ];

        $this->model->updateData('tb_marketing_ekatalog', $data, $id);

        return redirect()->to('marketing/ekatalog')->with('success', 'Data berhasil di ubah');
    }

    public function ekatalogDelete()
    {
        $id['id_marketing_ekatalog'] = $this->request->getUri()->getSegment(3);
        $this->model->updateData('tb_marketing_ekatalog', ['rowstatus' => 0], $id);
        return redirect()->to('marketing/ekatalog')->with('success', 'Data berhasil di hapus');
    }
}
