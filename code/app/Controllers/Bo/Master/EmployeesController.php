<?php

namespace App\Controllers\Bo\Master;

use App\Controllers\BaseController;
use App\Models\JabatanModel;
use App\Models\PegawaiModel;
use CodeIgniter\HTTP\ResponseInterface;

class EmployeesController extends BaseController
{
    protected $pegawaiModel;
    protected $jabatanModel;
    public function __construct()
    {
        $this->pegawaiModel = new PegawaiModel();
        $this->jabatanModel = new JabatanModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Pengguna Sisuro',
            'open_master' => 'show',
            'show_master' => 'show',
            'active_employees' => 'active',
            'dt_pegawai' => $this->pegawaiModel->getAllDataPegawai(),
            'dt_jabatan' => $this->jabatanModel->findAll(),
        ];

        echo view('bo/pages/v_header', $data);
        echo view('bo/master/employees/v_employees');
        echo view('bo/pages/v_footer');
    }

    public function add()
    {
        $data = $this->request->getPost();
        $data['alamat'] = strip_tags($data['alamat']);
        $data['aktif'] = 1;
        $data['createdon'] = date('Y-m-d');
        $data['createdby'] = session()->get('fullname');
        $data['rowstatus'] = 1;

        if (!$this->pegawaiModel->insert($data)) {
            $errors = $this->pegawaiModel->errors();
            return redirect()->back()->withInput()->with('error', reset($errors));
        }

        return redirect()->to('master/employees')->with('success', 'Data karyawan berhasil ditambah');
    }

    public function update($id)
    {
        if (empty($row_employee = $this->pegawaiModel->where('id_pegawai', decrypt_data($id))->first())) {
            return redirect()->back()->withInput()->with('error', 'Data tidak ditemukan');
        }

        $data = $this->request->getPost();

        if (!$this->pegawaiModel->update($row_employee['id_pegawai'], $data)) {
            return redirect()->back()->withInput()->with('error', $this->pegawaiModel->errors());
        }

        return redirect()->to('master/employees')->with('success', 'Data berhasil diubah');
    }

    public function delete($id)
    {
        if (empty($row_employee = $this->pegawaiModel->where('id_pegawai', decrypt_data($id))->first())) {
            return redirect()->back()->withInput()->with('error', 'Data tidak ditemukan');
        }

        if (!$this->pegawaiModel->delete($row_employee['id_pegawai'])) {
            return redirect()->back()->with('error', $this->pegawaiModel->errors());
        }

        return redirect()->to('master/employees')->with('success', 'Data berhasil dihapus');
    }
}
