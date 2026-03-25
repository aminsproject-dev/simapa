<?php

namespace App\Controllers\Bo\Master;

use App\Controllers\BaseController;
use App\Models\EmploymentStatustModel;

class EmploymentStatusController extends BaseController
{
    protected $employmentStatusModel;
    public function __construct()
    {
        $this->employmentStatusModel = new EmploymentStatustModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Master Status Kepegawaian',
            'open_master' => 'show',
            'show_master' => 'show',
            'active_employment_status' => 'active',
            'dt_employment_status' => $this->employmentStatusModel->findAll(),
        ];

        echo view('bo/pages/v_header', $data);
        echo view('bo/master/v_employment_status');
        echo view('bo/pages/v_footer');
    }

    public function add()
    {
        $data = $this->request->getPost();
        $data['status'] = 'aktif';

        if (!$this->employmentStatusModel->insert($data)) {
            return redirect()->back()->withInput()->with('error', $this->employmentStatusModel->errors());
        }

        return redirect()->to('master/employment-status')->with('success', 'Data berhasil ditambahkan');
    }

    public function update($id)
    {
        if (empty($row_status = $this->employmentStatusModel->where('id_status', decrypt_data($id))->first())) {
            return redirect()->back()->withInput()->with('error', 'Data tidak ditemukan');
        }

        $data = $this->request->getPost();
        if (!$this->employmentStatusModel->update($row_status['id_status'], $data)) {
            return redirect()->back()->withInput()->with('error', $this->employmentStatusModel->errors());
        }

        return redirect()->to('master/employment-status')->with('success', 'Data berhasil diubah');
    }

    public function delete($id)
    {
        if (empty($row_status = $this->employmentStatusModel->where('id_status', decrypt_data($id))->first())) {
            return redirect()->back()->withInput()->with('error', 'Data tidak ditemukan');
        }

        if (!$this->employmentStatusModel->delete($row_status['id_status'])) {
            return redirect()->back()->withInput()->with('error', $this->employmentStatusModel->errors());
        }

        return redirect()->to('master/employment-status')->with('success', 'Data berhasil dihapus');
    }
}
