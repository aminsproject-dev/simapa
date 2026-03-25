<?php

namespace App\Controllers\Bo\Master;

use App\Controllers\BaseController;
use App\Models\TypeExpertModel;

class TypeExpertController extends BaseController
{
    protected $typeExpertModel;
    public function __construct()
    {
        $this->typeExpertModel = new TypeExpertModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Master Jenis Tenaga Ahli',
            'open_master' => 'show',
            'show_master' => 'show',
            'active_type_expert' => 'active',
            'dt_type_expert' => $this->typeExpertModel->findAll(),
        ];

        echo view('bo/pages/v_header', $data);
        echo view('bo/master/v_type_expert');
        echo view('bo/pages/v_footer');
    }

    public function add()
    {
        $data = $this->request->getPost();
        $data['status'] = 'aktif';

        if (!$this->typeExpertModel->insert($data)) {
            return redirect()->back()->withInput()->with('error', $this->typeExpertModel->errors());
        }

        return redirect()->to('master/type-expert')->with('success', 'Data berhasil ditambah');
    }

    public function update($id)
    {
        if (empty($row_type = $this->typeExpertModel->where('id_jenis', decrypt_data($id))->first())) {
            return redirect()->back()->withInput()->with('error', 'Data tidak ditemukan');
        }

        $data = $this->request->getPost();

        if (!$this->typeExpertModel->update($row_type['id_jenis'], $data)) {
            return redirect()->back()->withInput()->with('error', $this->typeExpertModel->errors());
        }

        return redirect()->to('master/type-expert')->with('success', 'Data berhasil diubah');
    }

    public function delete($id)
    {
        if (empty($row_type = $this->typeExpertModel->where('id_jenis', decrypt_data($id))->first())) {
            return redirect()->back()->withInput()->with('error', 'Data tidak ditemukan');
        }

        if (!$this->typeExpertModel->delete($row_type['id_jenis'])) {
            return redirect()->back()->withInput()->with('error', $this->typeExpertModel->errors());
        }

        return redirect()->to('master/type-expert')->with('success', 'Data berhasil dihapus');
    }
}
