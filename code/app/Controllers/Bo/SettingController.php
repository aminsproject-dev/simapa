<?php

namespace App\Controllers\Bo;

use App\Controllers\BaseController;
use App\Models\ConfSistemModel;
use App\Models\MenuSuratModel;
use Endroid\QrCode\Exception\ValidationException;
use Exception;
use Ramsey\Uuid\Uuid;
use RuntimeException;
use Throwable;

class SettingController extends BaseController
{
    protected $confSistemModel;
    protected $menuSuratModel;
    public function __construct()
    {
        $this->confSistemModel = new ConfSistemModel();
        $this->menuSuratModel = new MenuSuratModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Setting Website SISURO',
            'active_setting' => 'active',
            'dt_setting' => $this->confSistemModel->findAll(),
            'dt_kode' => $this->menuSuratModel->findAll(),
        ];

        echo view('bo/pages/v_header', $data);
        echo view('bo/setting/v_setting');
        echo view('bo/pages/v_footer');
    }

    public function update($id)
    {
        $db = db_connect();

        $db->transBegin();

        try {
            if (empty($row_setting = $this->confSistemModel->where('id', (int)decrypt_data($id))->first())) {
                throw new ValidationException("Data tidak ditemukan");
            }

            $data = $this->request->getPost();

            $docupload = ['content'];
            foreach ($docupload as $i) {
                $fileupload = $this->request->getFile($i);
                if (!empty($fileupload)) {
                    $validationRule = [
                        $i => [
                            'rules' => [
                                'mime_in[' . $i . ',image/png,image/jpeg,image/jpg,image/svg]',
                                'ext_in[' . $i . ',png,jpg,jpeg,svg]',
                                'max_size[' . $i . ',2240]',
                            ],
                        ]
                    ];

                    if (! $this->validate($validationRule)) {
                        throw new ValidationException($this->validator->getError($i));
                    }

                    $fileName = Uuid::uuid4()->toString() . '.' . $fileupload->getExtension();
                    if ($fileupload->isValid() && ! $fileupload->hasMoved()) {

                        $filePath = WRITEPATH . 'files/setting/';
                        if (!is_dir($filePath)) {
                            mkdir($filePath, 0777, true);
                        }

                        $fileupload->move($filePath, $fileName);

                        $data[$i] = $fileName;
                    }
                }
            }

            if (!$this->confSistemModel->update($row_setting['id'], $data)) {
                $errors = $this->confSistemModel->errors();
                throw new RuntimeException(reset($errors));
            }

            $db->transCommit();

            return redirect()->to('setting')->with('success', 'Setting berhasil diubah');
        } catch (Throwable $e) {
            $db->transRollback();
            log_message('error', $e->getMessage() . " | " . $e->getLine());
            return redirect()->back()->withInput()->with('error', 'Error, ' . $e->getMessage());
        }
    }

    public function updateKode($id)
    {
        $db = db_connect();

        $db->transBegin();

        try {
            if (empty($row_menu = $this->menuSuratModel->where('id', decrypt_data($id))->first())) {
                throw new ValidationException("Data tidak ditemukan");
            }

            $data = $this->request->getPost();

            if (!$this->menuSuratModel->update($row_menu['id'], $data)) {
                $errors = $this->menuSuratModel->errors();
                throw new RuntimeException(reset($errors));
            }

            $db->transCommit();

            return redirect()->to('setting')->with('success', 'Setting berhasil diubah');
        } catch (Throwable $e) {
            $db->transRollback();
            log_message('error', $e->getMessage() . " | " . $e->getLine());
            return redirect()->back()->withInput()->with('error', 'Error, ' . $e->getMessage());
        }
    }
}
