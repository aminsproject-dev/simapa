<?php

namespace App\Controllers\Bo;

use App\Controllers\BaseController;

class Dashboard extends BaseController
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

    public function showLogoApp()
    {
        $setting = $this->model->getSetting(5);

        helper("filesystem");

        $path = WRITEPATH . 'files/';
        $fullpath = $path . $setting->content;
        $file = new \CodeIgniter\Files\File($fullpath, true);
        $binary = readfile($fullpath);
        return $this->response
            ->setHeader('Content-Type', $file->getMimeType())
            ->setHeader('Content-disposition', 'inline; filename="' . $file->getBasename() . '"')
            ->setStatusCode(200)
            ->setBody($binary);
    }

    public function setting()
    {
        $data = [
            'title' => 'Setting Website SISURO',
            'active_setting' => 'active',
            'dt_setting' => $this->model->getAllData('conf_sistem'),
            'dt_profile' => $this->model->getSelectedData('conf_sistem', ['jenis' => 1])->getResult(),
            'dt_kop' => $this->model->getSelectedData('conf_sistem', ['jenis' => 3])->getResult(),
            'dt_config' => $this->model->getSelectedData('conf_sistem', ['jenis' => 2])->getResult(),
            'dt_kode' => $this->model->getSelectedData('tb_menu_surat', [])->getResult(),
        ];

        echo view('bo/pages/v_header', $data);
        echo view('bo/pages/v_setting');
        echo view('bo/pages/v_footer');
    }

    public function prosesSettingKode()
    {
        $kode_id = $this->request->getPost('kode_id');

        $data = [
            'kode' => $this->request->getPost('kode'),
            'jenis' => $this->request->getPost('jenis'),
        ];

        $this->model->updateData('tb_menu_surat', $data, ['id' => $kode_id]);

        return redirect()->to('setting')->with('success', 'Data berhasil di ubah');
    }

    public function prosesSetting()
    {
        $setting_id = $this->request->getPost('setting_id');
        $setting_gambar = $this->request->getPost('setting_gambar');

        if ($setting_gambar == 1) {
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
                        return redirect()->back()->withInput()->with('error', $this->validator->getErrors());
                    }

                    $fileName = $this->uuid->v4() . '.' . $fileupload->getExtension();
                    if ($fileupload->isValid() && ! $fileupload->hasMoved()) {

                        $filePath = WRITEPATH . 'files/';
                        if (!is_dir($filePath)) {
                            mkdir($filePath, 0777, true);
                        }

                        $fileupload->move($filePath, $fileName);

                        $docuploadfile[$i] = array(
                            $i => $fileName,
                        );
                        $this->model->updateData('conf_sistem', $docuploadfile[$i], ['id' => $setting_id]);
                    }
                } else {
                    // No file was uploaded
                }
            }
        } else {
            $data = [
                'content' => $this->request->getPost('content'),
            ];
            $this->model->updateData('conf_sistem', $data, ['id' => $setting_id]);
        }

        return redirect()->to('setting')->with('success', 'Data berhasil di ubah');
    }

    public function pengguna()
    {
        $data = [
            'title' => 'Pengguna Sisuro',
            'active_pengguna' => 'active',
            'dt_pegawai' => $this->modelBo->getAllDataPegawai(),
            'dt_pengguna' => $this->modelBo->getAllDataPengguna(),
        ];

        echo view('bo/pages/v_header', $data);
        echo view('bo/pages/v_pengguna');
        echo view('bo/pages/v_footer');
    }

    public function penggunaAdd()
    {
        $data = [
            'id_pegawai' => $this->request->getPost('id_pegawai'),
            'username' => $this->request->getPost('username'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
            'status_user' => 1,
            'role' => $this->request->getPost('role'),
        ];

        $this->model->insertData('tb_user', $data);

        return redirect()->to('setting/pengguna')->with('success', 'Data berhasil di tambah');
    }

    public function penggunaEdit()
    {
        $id['id'] = $this->request->getPost('user_id');

        $password = $this->request->getPost('password');

        if ($password !== null && $password !== '') {
            $data = [
                'id_pegawai' => $this->request->getPost('id_pegawai'),
                'username' => $this->request->getPost('username'),
                'password' => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
                'role' => $this->request->getPost('role'),
            ];
        } else {
            $data = [
                'id_pegawai' => $this->request->getPost('id_pegawai'),
                'username' => $this->request->getPost('username'),
                'role' => $this->request->getPost('role'),
            ];
        }

        $this->model->updateData('tb_user', $data, $id);

        return redirect()->to('setting/pengguna')->with('success', 'Data berhasi di ubah');
    }

    public function penggunaDelete()
    {
        $id['id'] = $this->request->getUri()->getSegment(3);
        $this->model->updateData('tb_user', ['status_user' => 0], $id);
        return redirect()->to('setting/pengguna')->with('success', 'Data berhasil di hapus');
    }
}
