<?php

namespace App\Controllers\Bo;

use App\Controllers\BaseController;

class DashboardController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Dashboard SISURO',
            'active_dashboard' => 'active',
        ];

        echo view('bo/pages/v_header', $data);
        echo view('bo/pages/v_dashboard');
        echo view('bo/pages/v_footer');
    }
}
