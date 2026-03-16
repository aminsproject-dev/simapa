<?php

namespace App\Controllers\Bo;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Master extends BaseController
{
    public function pegawai()
    {
        $data = [
            'title' => 'Data Pegawai',
            'open_master' => 'show',
            'show_master' => 'show',
            'active_pegawai' => 'active',
            'dt_pegawai' => $this->modelBo->getAllDataPegawai(),
            'dt_jabatan' => $this->model->getAllData('tb_jabatan'),
        ];

        echo view('bo/pages/v_header', $data);
        echo view('bo/master/v_pegawai');
        echo view('bo/pages/v_footer');
    }

    public function pegawaiAdd()
    {
        $data = [
            'nip' => $this->request->getPost('nip'),
            'jabatan' => $this->request->getPost('jabatan'),
            'nama_pegawai' => $this->request->getPost('nama_pegawai'),
            'email' => $this->request->getPost('email'),
            'no_hp' => $this->request->getPost('no_hp'),
            'alamat' => strip_tags($this->request->getPost('alamat')),
            'tempat_lahir' => $this->request->getPost('tempat_lahir'),
            'tanggal_lahir' => $this->request->getPost('tanggal_lahir'),
            'jenkel' => $this->request->getPost('jenkel'),
            'aktif' => 1,
            'createdon' => date('Y-m-d'),
            'createdby' => session()->get('fullname'),
            'rowstatus' => 1,
        ];

        $this->model->insertData('tb_pegawai', $data);

        return redirect()->to('master/pegawai')->with('success', 'Data berhasil di tambahkan');
    }

    public function pegawaiEdit()
    {
        $id['id_pegawai'] = $this->request->getPost('id_pegawai');

        $data = [
            'nip' => $this->request->getPost('nip'),
            'jabatan' => $this->request->getPost('jabatan'),
            'nama_pegawai' => $this->request->getPost('nama_pegawai'),
            'email' => $this->request->getPost('email'),
            'no_hp' => $this->request->getPost('no_hp'),
            'alamat' => strip_tags($this->request->getPost('alamat')),
            'tempat_lahir' => $this->request->getPost('tempat_lahir'),
            'tanggal_lahir' => $this->request->getPost('tanggal_lahir'),
            'jenkel' => $this->request->getPost('jenkel'),
        ];

        $this->model->updateData('tb_pegawai', $data, $id);

        return redirect()->to('master/pegawai')->with('success', 'Data berhasil di ubah');
    }

    public function pegawaiDelete()
    {
        $id['id_pegawai'] = $this->request->getUri()->getSegment(3);
        $this->model->updateData('tb_pegawai', ['rowstatus' => 0], $id);
        return redirect()->to('master/pegawai')->with('success', 'Data berhasil di hapus');
    }

    public function struktur()
    {
        $data = [
            'title' => 'Struktur Perusahaan',
            'open_master' => 'show',
            'show_master' => 'show',
            'active_struktur' => 'active',
            'row_direktur' => $this->modelBo->getPegawaiByPosition(1),
            'dt_pegawai' => $this->modelBo->getAllDataPegawai(),
        ];

        echo view('bo/pages/v_header', $data);
        echo view('bo/master/v_struktur');
        echo view('bo/pages/v_footer');
    }

    public function dokumen()
    {
        $data = [
            'title' => 'Dokumen Penting',
            'open_master' => 'show',
            'show_master' => 'show',
            'active_dokumen' => 'active',
            'dt_dokumen' => $this->model->getSelectedData('tb_dokumen', ['rowstatus' => 1])->getResult(),
        ];

        echo view('bo/pages/v_header', $data);
        echo view('bo/master/v_dokumen');
        echo view('bo/pages/v_footer');
    }

    public function dokumenShow()
    {
        helper("filesystem");
        $id = $this->request->getGet('id');
        $row_dokumen = $this->model->getSelectedData('tb_dokumen', ['id' => $id])->getRow();

        $path = WRITEPATH . 'files/dokumen/';
        $fullpath = $path . $row_dokumen->nama_dokumen;;
        $file = new \CodeIgniter\Files\File($fullpath, true);
        $binary = readfile($fullpath);
        return $this->response
            ->setHeader('Content-Type', $file->getMimeType())
            ->setHeader('Content-disposition', 'inline; filename="' . $file->getBasename() . '"')
            ->setStatusCode(200)
            ->setBody($binary);
    }

    public function dokumenAdd()
    {
        $docupload = ['dokumen'];
        foreach ($docupload as $i) {
            $fileupload = $this->request->getFile($i);
            if (!empty($fileupload)) {
                $validationRule = [
                    $i => [
                        'rules' => [
                            'mime_in[' . $i . ',application/pdf]',
                            'ext_in[' . $i . ',pdf]',
                            'max_size[' . $i . ',10240]',
                        ],
                    ]
                ];

                if (! $this->validate($validationRule)) {
                    foreach ($this->validator->getErrors() as $e)
                        return redirect()->back()->withInput()->with('error', $e);
                }

                $fileName = $fileupload->getName();
                if ($fileupload->isValid() && ! $fileupload->hasMoved()) {

                    $filePath = WRITEPATH . 'files/dokumen';
                    if (!is_dir($filePath)) {
                        mkdir($filePath, 0777, true);
                    }

                    $fileupload->move($filePath, $fileName);

                    $docuploadfile[$i] = array(
                        'nama_dokumen' => $fileName,
                        'createdby' => session()->get('fullname'),
                        'createdon' => date('Y-m-d H:i:s'),
                        'rowstatus' => 1,
                    );
                    $this->model->insertData('tb_dokumen', $docuploadfile[$i]);
                }
            } else {
                return redirect()->to('master/pegawai')->with('error', 'File tidak ditemukan');
            }
            return redirect()->to('master/pegawai')->with('success', 'Berhasil menambahkan dokumen');
        }
    }

    public function dokumenDelete()
    {
        $id['id'] = $this->request->getUri()->getSegment(3);
        $this->model->updateData('tb_dokumen', ['rowstatus' => 0], $id);
        return redirect()->to('master/dokumen')->with('success', 'Dokumen berhasil di hapus');
    }

    public function garansi()
    {
        $data = [
            'title' => 'Sertifikat Garansi',
            'open_master' => 'show',
            'show_master' => 'show',
            'active_garansi' => 'active',
            'dt_garansi' => $this->modelBo->getSertifGaransi(),
            'dt_kategori' => $this->model->getAllData('tb_kategori_barang'),
        ];

        echo view('bo/pages/v_header', $data);
        echo view('bo/master/v_garansi');
        echo view('bo/pages/v_footer');
    }

    public function garansiAdd()
    {
        $data = [
            'kategori_barang' => $this->request->getPost('kategori_barang'),
            'nama_sertifikat' => $this->request->getPost('nama_sertifikat'),
            'isi_sertifikat' => $this->request->getPost('isi_sertifikat'),
            'aktif' => 1,
            'createdon' => date('Y-m-d'),
            'createdby' => session()->get('fullname'),
            'rowstatus' => 1,
        ];

        $this->model->insertData('tb_sertifikat_garansi', $data);

        return redirect()->to('master/garansi')->with('success', 'Garansi Berhasil di tambah');
    }

    public function garansiEdit()
    {
        $id['id_sertifikat_garansi'] = $this->request->getPost('id_sertifikat_garansi');

        $data = [
            'kategori_barang' => $this->request->getPost('kategori_barang'),
            'nama_sertifikat' => $this->request->getPost('nama_sertifikat'),
            'isi_sertifikat' => $this->request->getPost('isi_sertifikat'),
        ];

        $this->model->updateData('tb_sertifikat_garansi', $data, $id);

        return redirect()->to('master/garansi')->with('success', 'Data berhasil di ubah');
    }

    public function garansiDelete()
    {
        $id['id_sertifikat_garansi'] = $this->request->getUri()->getSegment(3);
        $this->model->updateData('tb_sertifikat_garansi', ['rowstatus' => 0], $id);
        return redirect()->to('master/garansi')->with('success', 'Data berhasil di hapus');
    }
}
