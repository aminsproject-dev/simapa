<?php

namespace App\Controllers\Bo;

use App\Controllers\BaseController;
use App\Models\PegawaiModel;

class StructureController extends BaseController
{
    protected $employeesModel;
    public function __construct()
    {
        $this->employeesModel = new PegawaiModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Struktur Perusahaan',
            'active_structure' => 'active',
            'row_direktur' => $this->employeesModel->getSelectedEmployeeByPosition(1),
            'dt_employees' => $this->employeesModel->getAllDataPegawai(),
        ];

        echo view('bo/pages/v_header', $data);
        echo view('bo/structure/v_index');
        echo view('bo/pages/v_footer');
    }
}
