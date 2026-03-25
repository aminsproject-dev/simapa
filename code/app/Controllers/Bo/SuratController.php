<?php

namespace App\Controllers\Bo;

use App\Controllers\BaseController;
use App\Models\JabatanModel;
use App\Models\MenuSuratModel;
use App\Models\SuratModel;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Spipu\Html2Pdf\Html2Pdf;

class SuratController extends BaseController
{
    protected $menuSuratModel;
    protected $suratModel;
    protected $jabatanModel;
    public function __construct()
    {
        $this->menuSuratModel = new MenuSuratModel();
        $this->suratModel = new SuratModel();
        $this->jabatanModel = new JabatanModel();
    }

    public function surat()
    {
        $data = [
            'title' => 'Surat Sisuro',
            'active_surat' => 'active',
            'dt_menuSurat' => $this->menuSuratModel->where('kode is not null')->findAll(),
        ];

        echo view('bo/pages/v_header', $data);
        echo view('bo/surat/v_surat');
        echo view('bo/pages/v_footer');
    }

    public function menuSurat()
    {
        $menuSurat = $this->menuSuratModel->where('kode is not null')->findAll();

        $page = $this->request->getGet('page');
        $jns = decrypt_data($this->request->getGet('jns'));
        $action = decrypt_data($this->request->getGet('action'));

        foreach ($menuSurat as $row) {
            $curMenu = explode('=', $row['url']);
            if ($page == $curMenu[1]) {
                return $this->$page($page, $jns, $action, $row);
            }
        }
    }

    private function cetak_rekening_perbankan($page, $jns, $action, $menu)
    {
        switch ($action) {
            case 'view':
                $dt_surat = $this->suratModel->getAllSurat($jns);

                $data = [
                    'title' => (!empty($menu)) ? $menu['nama_menu'] : 'Surat Sisuro',
                    'active_surat' => 'active',
                    'dt_surat' => $dt_surat,
                    'dt_arsip' => $this->suratModel->getAllSuratArsip($jns),
                    'nomor_surat' => $this->menuSuratModel->kodeSurat() . '/' . $this->suratModel->lastNumber($jns) . '/SRT/' . $jns . '/APTI/' . $this->getRomawi(DATE('m')) . '/' . date('Y'),
                    'qrgen' => $this->randomString(5),
                    'dt_jabatan' => $this->jabatanModel->findAll(),
                    'page' => $page,
                    'jns' => $jns,
                ];

                $this->renderView($data, $page);
                break;
            case 'add':
                $isi = [
                    'nama_bank' => $this->request->getPost('nama_bank'),
                    'qrgen' => $this->request->getPost('qrgen'),
                    'alamat_bank' => strip_tags($this->request->getPost('alamat_bank')),
                    'nama_rekening' => $this->request->getPost('nama_rekening'),
                    'nomor_rekening' => $this->request->getPost('nomor_rekening'),
                    'noted' => strip_tags($this->request->getPost('noted')),
                    'mulai_cetak' => $this->request->getPost('mulai_cetak'),
                    'akhir_cetak' => $this->request->getPost('akhir_cetak'),
                ];

                $isiSurat = json_encode($isi);
                $xttd = json_encode($this->chooseTtd($this->request->getPost('mengetahui')));

                $data = $this->request->getPost();
                $data['jenis_surat'] = $jns;
                $data['no_surat'] = $data['nomor_surat'];
                $data['nama_surat'] = $menu['nama_menu'];
                $data['tanggal'] = date('Y-m-d');
                $data['isi_surat'] = $this->gantikutip($isiSurat);
                $data['tanda_tangan'] = $xttd;
                $data['createdon'] = date('Y-m-d H:i:s');
                $data['createdby'] = session()->get('fullname');
                $data['rowstatus'] = 1;

                $this->generateQrcode($data['qrgen']);
                if (!$this->suratModel->insert($data)) {
                    return redirect()->back()->withInput()->with('error', $this->suratModel->errors());
                }

                return redirect()->to('surat/menu-surat?page=' . $page . '&jns=' . encrypt_data($jns) . '&action=' . encrypt_data('view'))->with('success', 'Data berhasil di tambah');
                break;
            case 'edit':
                $id['id_surat'] = $this->request->getPost('id_surat');
                $id_surat = $this->request->getPost('id_surat');

                $isi = [
                    'nama_bank' => $this->request->getPost('nama_bank'),
                    'qrgen' => $this->request->getPost('qrgen'),
                    'alamat_bank' => strip_tags($this->request->getPost('alamat_bank')),
                    'nama_rekening' => $this->request->getPost('nama_rekening'),
                    'nomor_rekening' => $this->request->getPost('nomor_rekening'),
                    'noted' => strip_tags($this->request->getPost('noted')),
                    'mulai_cetak' => $this->request->getPost('mulai_cetak'),
                    'akhir_cetak' => $this->request->getPost('akhir_cetak'),
                ];

                $isiSurat = json_encode($isi);
                $xttd = json_encode($this->chooseTtd($this->request->getPost('mengetahui')));

                $updateData = [
                    'jenis_surat' => $jns,
                    'no_surat' => $this->request->getPost('nomor_surat'),
                    'nama_surat' => $menu['nama_menu'],
                    'tanggal' => date('Y-m-d'),
                    'qrgen' => $this->request->getPost('qrgen'),
                    'isi_surat' => $this->gantikutip($isiSurat),
                    'tanda_tangan' => $xttd,
                ];

                $this->model->updateData('tb_surat', $updateData, $id);
                return redirect()->to('surat/menuSurat?page=' . $page . '&jns=' . encrypt_data($jns) . '&action=' . encrypt_data('view'))->with('success', 'Data berhasil di edit');
                break;
            case 'cetakSurat':
                $id['id_surat'] = $this->request->getGet('idx');

                $row_surat = $this->model->getSelectedData('tb_surat', $id)->getRowArray();

                $viewFile = $page;
                $outFileName = $jns . '_' . $row_surat['qrgen'] . '_' . date('d-m-Y') . '.pdf';

                $configLayout = [
                    'title' => 'Cetak Surat',
                    'orientation' => 'P',
                    'format' => 'A4',
                    'lang' => 'en',
                    'unicode' => false,
                    'encoding' => 'ISO-8859-15',
                    'margin' => [10, 6, 9, 0],
                    'output' => 'I',
                ];

                $this->renderPdf($id, $viewFile, $outFileName, $configLayout);

                break;
            case 'cetakAmplop':
                $id['id_surat'] = $this->request->getGet('idx');

                $viewFile = $page . '_amplop';
                $outFileName = $jns . '_AMPLOP_' . date('d-m-Y') . '.pdf';

                $configLayout = [
                    'title' => 'Cetak Amplop',
                    'orientation' => 'L',
                    'format' => 'C65',
                    'lang' => 'en',
                    'unicode' => false,
                    'encoding' => 'ISO-8859-15',
                    'margin' => [5, 5, 5, 5],
                    'output' => 'I',
                ];

                $this->renderPdf($id, $viewFile, $outFileName, $configLayout);

                break;
            case 'uploadScan':
                $id_surat = $this->request->getPost('id_surat');
                $id['id_surat'] = $this->request->getPost('id_surat');

                $row_surat = $this->model->getSelectedData('tb_surat', $id)->getRowArray();

                $docupload = ['file_scan'];

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

                        if (!$this->validate($validationRule)) {
                            return redirect()->back()->withInput()->with('error', $this->validator->getErrors());
                        }

                        if ($fileupload->isValid() && !$fileupload->hasMoved()) {

                            $filePath = WRITEPATH . 'files/scanpdf/';
                            if (!is_dir($filePath)) {
                                mkdir($filePath, 0777, TRUE);
                            }

                            if ($row_surat['file_scan'] !== null) {
                                unlink($filePath . $jns . '-' . $id_surat . '.' . $fileupload->getExtension());
                            }

                            $fileName = $jns . '-' . $id_surat . '.' . $fileupload->getExtension();
                            $fileupload->move($filePath, $fileName);

                            $docuploadfile[$i] = array(
                                $i => $fileupload->getName(),
                            );
                            $this->model->updateData('tb_surat', $docuploadfile[$i], $id);
                        }
                    }
                }

                return redirect()->to('surat/menuSurat?page=' . $page . '&jns=' . encrypt_data($jns) . '&action=' . encrypt_data('view'))->with('success', 'File berhasil di upload');

                break;
        }
    }

    private function pernyataan_rekening_bank($page, $jns, $action, $menu)
    {
        switch ($action) {
            case 'view':

                $dt_surat = $this->model->getSelectedData('tb_surat', ['jenis_surat' => $jns, 'rowstatus' => 1, 'arsip' => null])->getResultArray();

                $data = [
                    'title' => (!empty($menu)) ? $menu['nama_menu'] : 'Surat Sisuro',
                    'active_surat' => 'active',
                    'dt_surat' => $dt_surat,
                    'dt_arsip' => $this->model->getSelectedData('tb_surat', ['jenis_surat' => $jns, 'rowstatus' => 2, 'arsip' => null])->getResultArray(),
                    'nomor_surat' => $this->modelBo->kodeSurat() . '/' . $this->modelBo->lastNumber($jns) . '/SRT/' . $jns . '/APTI/' . $this->getRomawi(DATE('m')) . '/' . date('Y'),
                    'qrgen' => $this->randomString(5),
                    'dt_jabatan' => $this->model->getAllData('tb_jabatan'),
                    'page' => $page,
                    'jns' => $jns,
                ];

                $this->renderView($data, $page);

                break;

            case 'add':

                $isi = [
                    'nama_bank' => $this->request->getPost('nama_bank'),
                    'qrgen' => $this->request->getPost('qrgen'),
                    'nama_perusahaan' => $this->request->getPost('nama_perusahaan'),
                    'nama_rekening' => $this->request->getPost('nama_rekening'),
                    'nomor_rekening' => $this->request->getPost('nomor_rekening'),
                ];

                $isiSurat = json_encode($isi);
                $xttd = json_encode($this->chooseTtd($this->request->getPost('mengetahui')));

                $insertData = [
                    'jenis_surat' => $jns,
                    'no_surat' => $this->request->getPost('nomor_surat'),
                    'nama_surat' => $menu['nama_menu'],
                    'tanggal' => date('Y-m-d'),
                    'qrgen' => $this->request->getPost('qrgen'),
                    'isi_surat' => $this->gantikutip($isiSurat),
                    'tanda_tangan' => $xttd,
                    'createdon' => date('Y-m-d H:i:s'),
                    'createdby' => session()->get('fullname'),
                    'rowstatus' => 1,
                ];

                $this->generateQrcode($this->request->getPost('qrgen'));
                $this->model->insertData('tb_surat', $insertData);

                return redirect()->to('surat/menuSurat?page=' . $page . '&jns=' . encrypt_data($jns) . '&action=' . encrypt_data('view'))->with('success', 'Data berhasil di tambah');

                break;

            case 'edit':
                $id['id_surat'] = $this->request->getPost('id_surat');
                $id_surat = $this->request->getPost('id_surat');

                $isi = [
                    'nama_bank' => $this->request->getPost('nama_bank'),
                    'qrgen' => $this->request->getPost('qrgen'),
                    'nama_perusahaan' => $this->request->getPost('nama_perusahaan'),
                    'nama_rekening' => $this->request->getPost('nama_rekening'),
                    'nomor_rekening' => $this->request->getPost('nomor_rekening'),
                ];

                $isiSurat = json_encode($isi);
                $xttd = json_encode($this->chooseTtd($this->request->getPost('mengetahui')));

                $updateData = [
                    'jenis_surat' => $jns,
                    'no_surat' => $this->request->getPost('nomor_surat'),
                    'nama_surat' => $menu['nama_menu'],
                    'tanggal' => date('Y-m-d'),
                    'qrgen' => $this->request->getPost('qrgen'),
                    'isi_surat' => $this->gantikutip($isiSurat),
                    'tanda_tangan' => $xttd,
                ];

                $this->model->updateData('tb_surat', $updateData, $id);
                return redirect()->to('surat/menuSurat?page=' . $page . '&jns=' . encrypt_data($jns) . '&action=' . encrypt_data('view'))->with('success', 'Data berhasil di edit');
                break;

            case 'cetakSurat':

                $id['id_surat'] = $this->request->getGet('idx');

                $row_surat = $this->model->getSelectedData('tb_surat', $id)->getRowArray();

                $viewFile = $page;
                $outFileName = $jns . '_' . $row_surat['qrgen'] . '_' . date('d-m-Y') . '.pdf';

                $configLayout = [
                    'title' => 'Cetak Surat',
                    'orientation' => 'P',
                    'format' => 'A4',
                    'lang' => 'en',
                    'unicode' => false,
                    'encoding' => 'ISO-8859-15',
                    'margin' => [10, 6, 9, 0],
                    'output' => 'I',
                ];

                $this->renderPdf($id, $viewFile, $outFileName, $configLayout);

                break;

            case 'uploadScan':
                $id_surat = $this->request->getPost('id_surat');
                $id['id_surat'] = $this->request->getPost('id_surat');

                $docupload = ['file_scan'];
                $filePath = WRITEPATH . 'files/scanpdf/';
                $fileName = $jns . '-' . $id_surat . '.pdf';

                return $this->uploadScanSurat($id, $docupload, $filePath, $fileName, $page, $jns);

                break;
        }
    }

    private function nasabah_aktif_perbankan($page, $jns, $action, $menu)
    {
        switch ($action) {
            case 'view':
                $dt_surat = $this->model->getSelectedData('tb_surat', ['jenis_surat' => $jns, 'rowstatus' => 1, 'arsip' => null])->getResultArray();

                $data = [
                    'title' => (!empty($menu)) ? $menu['nama_menu'] : 'Surat Sisuro',
                    'active_surat' => 'active',
                    'dt_surat' => $dt_surat,
                    'dt_arsip' => $this->model->getSelectedData('tb_surat', ['jenis_surat' => $jns, 'rowstatus' => 2, 'arsip' => null])->getResultArray(),
                    'nomor_surat' => $this->modelBo->kodeSurat() . '/' . $this->modelBo->lastNumber($jns) . '/SRT/' . $jns . '/APTI/' . $this->getRomawi(DATE('m')) . '/' . date('Y'),
                    'qrgen' => $this->randomString(5),
                    'dt_jabatan' => $this->model->getAllData('tb_jabatan'),
                    'page' => $page,
                    'jns' => $jns,
                ];

                $this->renderView($data, $page);

                break;
            case 'add':

                $isi = [
                    'nama_bank' => $this->request->getPost('nama_bank'),
                    'qrgen' => $this->request->getPost('qrgen'),
                    'alamat_bank' => strip_tags($this->request->getPost('alamat_bank')),
                    'nama_rekening' => $this->request->getPost('nama_rekening'),
                    'nomor_rekening' => $this->request->getPost('nomor_rekening'),
                    'noted' => strip_tags($this->request->getPost('noted')),
                ];

                $isiSurat = json_encode($isi);
                $xttd = json_encode($this->chooseTtd($this->request->getPost('mengetahui')));

                $insertData = [
                    'jenis_surat' => $jns,
                    'no_surat' => $this->request->getPost('nomor_surat'),
                    'nama_surat' => $menu['nama_menu'],
                    'tanggal' => date('Y-m-d'),
                    'qrgen' => $this->request->getPost('qrgen'),
                    'isi_surat' => $this->gantikutip($isiSurat),
                    'tanda_tangan' => $xttd,
                    'createdon' => date('Y-m-d H:i:s'),
                    'createdby' => session()->get('fullname'),
                    'rowstatus' => 1,
                ];

                $this->generateQrcode($this->request->getPost('qrgen'));
                $this->model->insertData('tb_surat', $insertData);

                return redirect()->to('surat/menuSurat?page=' . $page . '&jns=' . encrypt_data($jns) . '&action=' . encrypt_data('view'))->with('success', 'Data berhasil di tambah');

                break;

            case 'edit':

                $id['id_surat'] = $this->request->getPost('id_surat');
                $id_surat = $this->request->getPost('id_surat');

                $isi = [
                    'nama_bank' => $this->request->getPost('nama_bank'),
                    'qrgen' => $this->request->getPost('qrgen'),
                    'alamat_bank' => strip_tags($this->request->getPost('alamat_bank')),
                    'nama_rekening' => $this->request->getPost('nama_rekening'),
                    'nomor_rekening' => $this->request->getPost('nomor_rekening'),
                    'noted' => strip_tags($this->request->getPost('noted')),
                ];

                $isiSurat = json_encode($isi);
                $xttd = json_encode($this->chooseTtd($this->request->getPost('mengetahui')));

                $updateData = [
                    'jenis_surat' => $jns,
                    'no_surat' => $this->request->getPost('nomor_surat'),
                    'nama_surat' => $menu['nama_menu'],
                    'tanggal' => date('Y-m-d'),
                    'qrgen' => $this->request->getPost('qrgen'),
                    'isi_surat' => $this->gantikutip($isiSurat),
                    'tanda_tangan' => $xttd,
                ];

                $this->model->updateData('tb_surat', $updateData, $id);
                return redirect()->to('surat/menuSurat?page=' . $page . '&jns=' . encrypt_data($jns) . '&action=' . encrypt_data('view'))->with('success', 'Data berhasil di edit');

                break;

            case 'cetakSurat':
                $id['id_surat'] = $this->request->getGet('idx');

                $row_surat = $this->model->getSelectedData('tb_surat', $id)->getRowArray();

                $viewFile = $page;
                $outFileName = $jns . '_' . $row_surat['qrgen'] . '_' . date('d-m-Y') . '.pdf';

                $configLayout = [
                    'title' => 'Cetak Surat',
                    'orientation' => 'P',
                    'format' => 'A4',
                    'lang' => 'en',
                    'unicode' => false,
                    'encoding' => 'ISO-8859-15',
                    'margin' => [10, 6, 9, 0],
                    'output' => 'I',
                ];

                $this->renderPdf($id, $viewFile, $outFileName, $configLayout);

                break;

            case 'cetakAmplop':
                $id['id_surat'] = $this->request->getGet('idx');

                $viewFile = $page . '_amplop';
                $outFileName = $jns . '_AMPLOP_' . date('d-m-Y') . '.pdf';

                $configLayout = [
                    'title' => 'Cetak Amplop',
                    'orientation' => 'L',
                    'format' => 'C65',
                    'lang' => 'en',
                    'unicode' => false,
                    'encoding' => 'ISO-8859-15',
                    'margin' => [5, 5, 5, 5],
                    'output' => 'I',
                ];

                $this->renderPdf($id, $viewFile, $outFileName, $configLayout);

                break;

            case 'uploadScan':
                $id_surat = $this->request->getPost('id_surat');
                $id['id_surat'] = $this->request->getPost('id_surat');

                $docupload = ['file_scan'];
                $filePath = WRITEPATH . 'files/scanpdf/';
                $fileName = $jns . '-' . $id_surat . '.pdf';

                return $this->uploadScanSurat($id, $docupload, $filePath, $fileName, $page, $jns);
                break;
        }
    }

    private function pembuatan_buku_cek($page, $jns, $action, $menu)
    {
        switch ($action) {
            case 'view':
                $dt_surat = $this->model->getSelectedData('tb_surat', ['jenis_surat' => $jns, 'rowstatus' => 1, 'arsip' => null])->getResultArray();

                $data = [
                    'title' => (!empty($menu)) ? $menu['nama_menu'] : 'Surat Sisuro',
                    'active_surat' => 'active',
                    'dt_surat' => $dt_surat,
                    'dt_arsip' => $this->model->getSelectedData('tb_surat', ['jenis_surat' => $jns, 'rowstatus' => 2, 'arsip' => null])->getResultArray(),
                    'nomor_surat' => $this->modelBo->kodeSurat() . '/' . $this->modelBo->lastNumber($jns) . '/SRT/' . $jns . '/APTI/' . $this->getRomawi(DATE('m')) . '/' . date('Y'),
                    'qrgen' => $this->randomString(5),
                    'dt_jabatan' => $this->model->getAllData('tb_jabatan'),
                    'page' => $page,
                    'jns' => $jns,
                ];

                $this->renderView($data, $page);

                break;
            case 'add':

                $isi = [
                    'nama_bank' => $this->request->getPost('nama_bank'),
                    'qrgen' => $this->request->getPost('qrgen'),
                    'alamat_bank' => strip_tags($this->request->getPost('alamat_bank')),
                    'nama_rekening' => $this->request->getPost('nama_rekening'),
                    'nomor_rekening' => $this->request->getPost('nomor_rekening'),
                    'noted' => strip_tags($this->request->getPost('noted')),
                    'jumlah_cek' => $this->request->getPost('jumlah_cek'),
                ];

                $isiSurat = json_encode($isi);
                $xttd = json_encode($this->chooseTtd($this->request->getPost('mengetahui')));

                $insertData = [
                    'jenis_surat' => $jns,
                    'no_surat' => $this->request->getPost('nomor_surat'),
                    'nama_surat' => $menu['nama_menu'],
                    'tanggal' => date('Y-m-d'),
                    'qrgen' => $this->request->getPost('qrgen'),
                    'isi_surat' => $this->gantikutip($isiSurat),
                    'tanda_tangan' => $xttd,
                    'createdon' => date('Y-m-d H:i:s'),
                    'createdby' => session()->get('fullname'),
                    'rowstatus' => 1,
                ];

                $this->generateQrcode($this->request->getPost('qrgen'));
                $this->model->insertData('tb_surat', $insertData);

                return redirect()->to('surat/menuSurat?page=' . $page . '&jns=' . encrypt_data($jns) . '&action=' . encrypt_data('view'))->with('success', 'Data berhasil di tambah');

                break;
            case 'edit':
                $id['id_surat'] = $this->request->getPost('id_surat');
                $id_surat = $this->request->getPost('id_surat');

                $isi = [
                    'nama_bank' => $this->request->getPost('nama_bank'),
                    'qrgen' => $this->request->getPost('qrgen'),
                    'alamat_bank' => strip_tags($this->request->getPost('alamat_bank')),
                    'nama_rekening' => $this->request->getPost('nama_rekening'),
                    'nomor_rekening' => $this->request->getPost('nomor_rekening'),
                    'noted' => strip_tags($this->request->getPost('noted')),
                    'jumlah_cek' => $this->request->getPost('jumlah_cek'),
                ];

                $isiSurat = json_encode($isi);
                $xttd = json_encode($this->chooseTtd($this->request->getPost('mengetahui')));

                $updateData = [
                    'jenis_surat' => $jns,
                    'no_surat' => $this->request->getPost('nomor_surat'),
                    'nama_surat' => $menu['nama_menu'],
                    'tanggal' => date('Y-m-d'),
                    'qrgen' => $this->request->getPost('qrgen'),
                    'isi_surat' => $this->gantikutip($isiSurat),
                    'tanda_tangan' => $xttd,
                ];

                $this->model->updateData('tb_surat', $updateData, $id);
                return redirect()->to('surat/menuSurat?page=' . $page . '&jns=' . encrypt_data($jns) . '&action=' . encrypt_data('view'))->with('success', 'Data berhasil di edit');

                break;
            case 'cetakSurat':

                $id['id_surat'] = $this->request->getGet('idx');

                $row_surat = $this->model->getSelectedData('tb_surat', $id)->getRowArray();

                $viewFile = $page;
                $outFileName = $jns . '_' . $row_surat['qrgen'] . '_' . date('d-m-Y') . '.pdf';

                $configLayout = [
                    'title' => 'Cetak Surat',
                    'orientation' => 'P',
                    'format' => 'Folio',
                    'lang' => 'en',
                    'unicode' => false,
                    'encoding' => 'ISO-8859-15',
                    'margin' => [15, 8, 12, 7],
                    'output' => 'I',
                ];

                $this->renderPdf($id, $viewFile, $outFileName, $configLayout);

                break;
            case 'uploadScan':

                $id_surat = $this->request->getPost('id_surat');
                $id['id_surat'] = $this->request->getPost('id_surat');

                $docupload = ['file_scan'];
                $filePath = WRITEPATH . 'files/scanpdf/';
                $fileName = $jns . '-' . $id_surat . '.pdf';

                return $this->uploadScanSurat($id, $docupload, $filePath, $fileName, $page, $jns);

                break;
        }
    }

    private function refrensi_perbankan($page, $jns, $action, $menu)
    {
        switch ($action) {
            case 'view':
                $dt_surat = $this->model->getSelectedData('tb_surat', ['jenis_surat' => $jns, 'rowstatus' => 1, 'arsip' => null])->getResultArray();

                $data = [
                    'title' => (!empty($menu)) ? $menu['nama_menu'] : 'Surat Sisuro',
                    'active_surat' => 'active',
                    'dt_surat' => $dt_surat,
                    'dt_arsip' => $this->model->getSelectedData('tb_surat', ['jenis_surat' => $jns, 'rowstatus' => 2, 'arsip' => null])->getResultArray(),
                    'nomor_surat' => $this->modelBo->kodeSurat() . '/' . $this->modelBo->lastNumber($jns) . '/SRT/' . $jns . '/APTI/' . $this->getRomawi(DATE('m')) . '/' . date('Y'),
                    'qrgen' => $this->randomString(5),
                    'dt_jabatan' => $this->model->getAllData('tb_jabatan'),
                    'page' => $page,
                    'jns' => $jns,
                ];

                $this->renderView($data, $page);

                break;
            case 'add':

                $isi = [
                    'nama_bank' => $this->request->getPost('nama_bank'),
                    'qrgen' => $this->request->getPost('qrgen'),
                    'alamat_bank' => strip_tags($this->request->getPost('alamat_bank')),
                    'nama_rekening' => $this->request->getPost('nama_rekening'),
                    'nomor_rekening' => $this->request->getPost('nomor_rekening'),
                    'nama_pekerjaan' => $this->request->getPost('nama_pekerjaan'),
                    'lokasi_pekerjaan' => strip_tags($this->request->getPost('lokasi_pekerjaan')),
                    'noted' => strip_tags($this->request->getPost('noted')),
                ];

                $isiSurat = json_encode($isi);
                $xttd = json_encode($this->chooseTtd($this->request->getPost('mengetahui')));

                $insertData = [
                    'jenis_surat' => $jns,
                    'no_surat' => $this->request->getPost('nomor_surat'),
                    'nama_surat' => $menu['nama_menu'],
                    'tanggal' => date('Y-m-d'),
                    'qrgen' => $this->request->getPost('qrgen'),
                    'isi_surat' => $this->gantikutip($isiSurat),
                    'tanda_tangan' => $xttd,
                    'createdon' => date('Y-m-d H:i:s'),
                    'createdby' => session()->get('fullname'),
                    'rowstatus' => 1,
                ];

                $this->generateQrcode($this->request->getPost('qrgen'));
                $this->model->insertData('tb_surat', $insertData);

                return redirect()->to('surat/menuSurat?page=' . $page . '&jns=' . encrypt_data($jns) . '&action=' . encrypt_data('view'))->with('success', 'Data berhasil di tambah');

                break;
            case 'edit':

                $id['id_surat'] = $this->request->getPost('id_surat');
                $id_surat = $this->request->getPost('id_surat');

                $isi = [
                    'nama_bank' => $this->request->getPost('nama_bank'),
                    'qrgen' => $this->request->getPost('qrgen'),
                    'alamat_bank' => strip_tags($this->request->getPost('alamat_bank')),
                    'nama_rekening' => $this->request->getPost('nama_rekening'),
                    'nomor_rekening' => $this->request->getPost('nomor_rekening'),
                    'nama_pekerjaan' => $this->request->getPost('nama_pekerjaan'),
                    'lokasi_pekerjaan' => strip_tags($this->request->getPost('lokasi_pekerjaan')),
                    'noted' => strip_tags($this->request->getPost('noted')),
                ];

                $isiSurat = json_encode($isi);
                $xttd = json_encode($this->chooseTtd($this->request->getPost('mengetahui')));

                $updateData = [
                    'jenis_surat' => $jns,
                    'no_surat' => $this->request->getPost('nomor_surat'),
                    'nama_surat' => $menu['nama_menu'],
                    'tanggal' => date('Y-m-d'),
                    'qrgen' => $this->request->getPost('qrgen'),
                    'isi_surat' => $this->gantikutip($isiSurat),
                    'tanda_tangan' => $xttd,
                ];

                $this->model->updateData('tb_surat', $updateData, $id);
                return redirect()->to('surat/menuSurat?page=' . $page . '&jns=' . encrypt_data($jns) . '&action=' . encrypt_data('view'))->with('success', 'Data berhasil di edit');

                break;
            case 'cetakSurat':
                $id['id_surat'] = $this->request->getGet('idx');

                $row_surat = $this->model->getSelectedData('tb_surat', $id)->getRowArray();

                $viewFile = $page;
                $outFileName = $jns . '_' . $row_surat['qrgen'] . '_' . date('d-m-Y') . '.pdf';

                $configLayout = [
                    'title' => 'Cetak Surat',
                    'orientation' => 'P',
                    'format' => 'Folio',
                    'lang' => 'en',
                    'unicode' => false,
                    'encoding' => 'ISO-8859-15',
                    'margin' => [15, 8, 12, 7],
                    'output' => 'I',
                ];

                $this->renderPdf($id, $viewFile, $outFileName, $configLayout);

                break;
            case 'uploadScan':

                $id_surat = $this->request->getPost('id_surat');
                $id['id_surat'] = $this->request->getPost('id_surat');

                $docupload = ['file_scan'];
                $filePath = WRITEPATH . 'files/scanpdf/';
                $fileName = $jns . '-' . $id_surat . '.pdf';

                return $this->uploadScanSurat($id, $docupload, $filePath, $fileName, $page, $jns);

                break;
        }
    }

    private function permintaan_barang($page, $jns, $action, $menu)
    {
        switch ($action) {
            case 'view':

                $dt_surat = $this->model->getSelectedData('tb_surat', ['jenis_surat' => $jns, 'rowstatus' => 1, 'arsip' => null])->getResultArray();

                $data = [
                    'title' => (!empty($menu)) ? $menu['nama_menu'] : 'Surat Sisuro',
                    'active_surat' => 'active',
                    'dt_surat' => $dt_surat,
                    'dt_arsip' => $this->model->getSelectedData('tb_surat', ['jenis_surat' => $jns, 'rowstatus' => 2, 'arsip' => null])->getResultArray(),
                    'nomor_surat' => $this->modelBo->kodeSurat() . '/' . $this->modelBo->lastNumber($jns) . '/SRT/' . $jns . '/APTI/' . $this->getRomawi(DATE('m')) . '/' . date('Y'),
                    'qrgen' => $this->randomString(5),
                    'dt_jabatan' => $this->model->getAllData('tb_jabatan'),
                    'page' => $page,
                    'jns' => $jns,
                    'dt_kabupaten' => $this->model->getAllData('tb_kabupaten'),
                    'dt_bank' => $this->model->getAllData('tb_bank'),
                    'dt_satuan' => $this->model->getAllData('tb_satuan'),
                ];

                $this->renderView($data, $page);

                break;
            case 'add':
                $barang = [];
                foreach ($this->request->getPost('no') as $key => $val) {
                    $barang[$key] = [
                        'no' => $val,
                        'nama_barang' => $this->request->getPost('nama_barang')[$key],
                        'jumlah' => $this->request->getPost('jumlah')[$key],
                        'satuan' => $this->request->getPost('satuan')[$key],
                        'harga' => $this->request->getPost('harga')[$key],
                    ];
                }

                $isi = [
                    'nama_vendor' => $this->request->getPost('nama_vendor'),
                    'qrgen' => $this->request->getPost('qrgen'),
                    'img_ttd' => $this->request->getPost('img_ttd'),
                    'alamat_vendor' => strip_tags($this->request->getPost('alamat_vendor')),
                    'kota_vendor' => $this->request->getPost('kota_vendor'),
                    'bank_vendor' => $this->request->getPost('bank_vendor'),
                    'nama_rekening_vendor' => $this->request->getPost('nama_rekening_vendor'),
                    'rekening_vendor' => $this->request->getPost('rekening_vendor'),
                    'tanggal_pengiriman' => $this->request->getPost('tanggal_pengiriman'),
                    'alamat_pengiriman' => strip_tags($this->request->getPost('alamat_pengiriman')),
                    'nama_npwp' => $this->request->getPost('nama_npwp'),
                    'npwp' => $this->request->getPost('npwp'),
                    'down_payment' => $this->request->getPost('down_payment'),
                    'noted' => strip_tags($this->request->getPost('noted')),
                    'barang' => $barang,
                ];

                $isiSurat = json_encode($isi);
                $xttd = json_encode($this->chooseTtd($this->request->getPost('mengetahui')));

                $insertData = [
                    'jenis_surat' => $jns,
                    'no_surat' => $this->request->getPost('nomor_surat'),
                    'nama_surat' => $menu['nama_menu'],
                    'tanggal' => date('Y-m-d'),
                    'qrgen' => $this->request->getPost('qrgen'),
                    'isi_surat' => $this->gantikutip($isiSurat),
                    'tanda_tangan' => $xttd,
                    'createdon' => date('Y-m-d H:i:s'),
                    'createdby' => session()->get('fullname'),
                    'rowstatus' => 1,
                ];

                $this->generateQrcode($this->request->getPost('qrgen'));
                $this->model->insertData('tb_surat', $insertData);

                return redirect()->to('surat/menuSurat?page=' . $page . '&jns=' . encrypt_data($jns) . '&action=' . encrypt_data('view'))->with('success', 'Data berhasil di tambah');

                break;

            case 'edit':

                $id['id_surat'] = $this->request->getPost('id_surat');
                $id_surat = $this->request->getPost('id_surat');

                $barang = [];
                foreach ($this->request->getPost('no') as $key => $val) {
                    if ($val == '') {
                        continue;
                    }
                    $barang[$key] = [
                        'no' => $val,
                        'nama_barang' => $this->request->getPost('nama_barang')[$key],
                        'jumlah' => $this->request->getPost('jumlah')[$key],
                        'satuan' => $this->request->getPost('satuan')[$key],
                        'harga' => $this->request->getPost('harga')[$key],
                    ];
                }

                $isi = [
                    'nama_vendor' => $this->request->getPost('nama_vendor'),
                    'qrgen' => $this->request->getPost('qrgen'),
                    'img_ttd' => $this->request->getPost('img_ttd'),
                    'alamat_vendor' => strip_tags($this->request->getPost('alamat_vendor')),
                    'kota_vendor' => $this->request->getPost('kota_vendor'),
                    'bank_vendor' => $this->request->getPost('bank_vendor'),
                    'nama_rekening_vendor' => $this->request->getPost('nama_rekening_vendor'),
                    'rekening_vendor' => $this->request->getPost('rekening_vendor'),
                    'tanggal_pengiriman' => $this->request->getPost('tanggal_pengiriman'),
                    'alamat_pengiriman' => strip_tags($this->request->getPost('alamat_pengiriman')),
                    'nama_npwp' => $this->request->getPost('nama_npwp'),
                    'npwp' => $this->request->getPost('npwp'),
                    'down_payment' => $this->request->getPost('down_payment'),
                    'noted' => strip_tags($this->request->getPost('noted')),
                    'barang' => $barang,
                ];

                $isiSurat = json_encode($isi);
                $xttd = json_encode($this->chooseTtd($this->request->getPost('mengetahui')));

                $updateData = [
                    'jenis_surat' => $jns,
                    'no_surat' => $this->request->getPost('nomor_surat'),
                    'nama_surat' => $menu['nama_menu'],
                    'tanggal' => date('Y-m-d'),
                    'qrgen' => $this->request->getPost('qrgen'),
                    'isi_surat' => $this->gantikutip($isiSurat),
                    'tanda_tangan' => $xttd,
                ];

                $this->model->updateData('tb_surat', $updateData, $id);
                return redirect()->to('surat/menuSurat?page=' . $page . '&jns=' . encrypt_data($jns) . '&action=' . encrypt_data('view'))->with('success', 'Data berhasil di edit');

                break;

            case 'cetakSurat':

                $id['id_surat'] = $this->request->getGet('idx');

                $row_surat = $this->model->getSelectedData('tb_surat', $id)->getRowArray();

                $viewFile = $page;
                $outFileName = $jns . '_' . $row_surat['qrgen'] . '_' . date('d-m-Y') . '.pdf';

                $configLayout = [
                    'title' => 'Cetak Surat',
                    'orientation' => 'P',
                    'format' => 'Folio',
                    'lang' => 'en',
                    'unicode' => false,
                    'encoding' => 'ISO-8859-15',
                    'margin' => [15, 6, 12, 7],
                    'output' => 'I',
                ];

                $this->renderPdf($id, $viewFile, $outFileName, $configLayout);

                break;
            case 'uploadScan':

                $id_surat = $this->request->getPost('id_surat');
                $id['id_surat'] = $this->request->getPost('id_surat');

                $docupload = ['file_scan'];
                $filePath = WRITEPATH . 'files/scanpdf/';
                $fileName = $jns . '-' . $id_surat . '.pdf';

                return $this->uploadScanSurat($id, $docupload, $filePath, $fileName, $page, $jns);

                break;
        }
    }

    private function ekatalog($page, $jns, $action, $menu)
    {
        switch ($action) {
            case 'view':

                $dt_surat = $this->model->getSelectedData('tb_surat', ['jenis_surat' => $jns, 'rowstatus' => 1, 'arsip' => null])->getResultArray();

                $data = [
                    'title' => (!empty($menu)) ? $menu['nama_menu'] : 'Surat Sisuro',
                    'active_surat' => 'active',
                    'dt_surat' => $dt_surat,
                    'dt_arsip' => $this->model->getSelectedData('tb_surat', ['jenis_surat' => $jns, 'rowstatus' => 2, 'arsip' => null])->getResultArray(),
                    'qrgen' => $this->randomString(5),
                    'dt_jabatan' => $this->model->getAllData('tb_jabatan'),
                    'page' => $page,
                    'jns' => $jns,
                    'nomor_surat' => $this->modelBo->kodeSurat() . '/' . $this->modelBo->lastNumber($jns) . '/SRT/' . $jns . '/APTI/' . date('d') . '/' . $this->getRomawi(DATE('m')) . '/' . date('Y'),
                    'sphp' => $this->modelBo->kodeSurat() . '/' . $this->modelBo->lastNumberCustom($jns, 8) . '/SRT/SPHP/APTI/',
                    'sg' => $this->modelBo->kodeSurat() . '/' . $this->modelBo->lastNumberCustom($jns, 9) . '/SRT/SG/APTI/',
                    'sppp' => $this->modelBo->kodeSurat() . '/' . $this->modelBo->lastNumberCustom($jns, 10) . '/SRT/SPPP/APTI/',
                    'spp' => $this->modelBo->kodeSurat() . '/' . $this->modelBo->lastNumberCustom($jns, 11) . '/SRT/SPP/APTI/',
                    'inv' => $this->modelBo->kodeSurat() . '/' . $this->modelBo->lastNumberCustom($jns, 12) . '/SRT/INV/APTI/',
                    'kwn' => $this->modelBo->kodeSurat() . '/' . $this->modelBo->lastNumberCustom($jns, 13) . '/SRT/KWN/APTI/',
                    'dt_provinsi' => $this->model->getAllData('tb_provinsi'),
                    'dt_kabupaten' => $this->model->getAllData('tb_kabupaten'),
                    'dt_sertifikat' => $this->model->getAllData('tb_sertifikat_garansi'),
                    'dt_satuan' => $this->model->getAllData('tb_satuan'),
                ];

                $this->renderView($data, $page);

                break;
            case 'add':

                $isi = [
                    'sphp' => $this->request->getPost('sphp'),
                    'tgl_sphp' => $this->request->getPost('tgl_sphp'),
                    'sg' => $this->request->getPost('sg'),
                    'tgl_sg' => $this->request->getPost('tgl_sg'),
                    'sppp' => $this->request->getPost('sppp'),
                    'tgl_sppp' => $this->request->getPost('tgl_sppp'),
                    'spp' => $this->request->getPost('spp'),
                    'tgl_spp' => $this->request->getPost('tgl_spp'),
                    'inv' => $this->request->getPost('inv'),
                    'tgl_inv' => $this->request->getPost('tgl_inv'),
                    'kwn' => $this->request->getPost('kwn'),
                    'tgl_kwn' => $this->request->getPost('tgl_kwn'),
                    'qrgen' => $this->request->getPost('qrgen'),
                    'img_ttd' => $this->request->getPost('img_ttd'),
                    'id_paket' => $this->request->getPost('id_paket'),
                    'jenis_paket' => $this->request->getPost('jenis_paket'),
                    'id_rup' => $this->request->getPost('id_rup'),
                    'nama_paket_pekerjaan' => $this->request->getPost('nama_paket_pekerjaan'),
                    'tanggal_paket_dibuat' => $this->request->getPost('tanggal_paket_dibuat'),
                    'instansi' => $this->request->getPost('instansi'),
                    'satuan_kerja' => $this->request->getPost('satuan_kerja'),
                    'alamat_satuan_kerja' => strip_tags($this->request->getPost('alamat_satuan_kerja')),
                    'alamat_pengiriman' => strip_tags($this->request->getPost('alamat_pengiriman')),
                    'npwp_satuan_kerja' => $this->request->getPost('npwp_satuan_kerja'),
                    'nama_provinsi' => $this->request->getPost('nama_provinsi'),
                    'nama_kabupaten' => $this->request->getPost('nama_kabupaten'),
                    'tahun_anggaran' => $this->request->getPost('tahun_anggaran'),
                    'nama_pp' => $this->request->getPost('nama_pp'),
                    'nip_pp' => $this->request->getPost('nip_pp'),
                    'no_tlp_pp' => $this->request->getPost('no_tlp_pp'),
                    'email_pp' => $this->request->getPost('email_pp'),
                    'nama_ppk' => $this->request->getPost('nama_ppk'),
                    'nip_ppk' => $this->request->getPost('nip_ppk'),
                    'no_tlp_ppk' => $this->request->getPost('no_tlp_ppk'),
                    'email_ppk' => $this->request->getPost('email_ppk'),
                    'sumber_anggaran' => $this->request->getPost('sumber_anggaran'),
                    'kode_anggaran' => $this->request->getPost('kode_anggaran'),
                    'no_spk' => $this->request->getPost('no_spk'),
                    'tanggal_mulai_spk' => $this->request->getPost('tanggal_mulai_spk'),
                    'tanggal_selesai_spk' => $this->request->getPost('tanggal_selesai_spk'),
                    'vendor_pengiriman' => $this->request->getPost('vendor_pengiriman'),
                    'no_transaksi' => $this->request->getPost('no_transaksi'),
                    'no_resi' => $this->request->getPost('no_resi'),
                    'tanggal_pengiriman' => $this->request->getPost('tanggal_pengiriman'),
                    'noted' => strip_tags($this->request->getPost('noted')),
                    'no_1' => $this->request->getPost('no_1'),
                    'nama_barang_1' => $this->request->getPost('nama_barang_1'),
                    'jumlah_1' => $this->request->getPost('jumlah_1'),
                    'satuan_1' => $this->request->getPost('satuan_1'),
                    'harga_1' => $this->request->getPost('harga_1'),
                    'total_harga_1' => $this->request->getPost('total_harga_1'),
                    'no_2' => $this->request->getPost('no_2'),
                    'nama_barang_2' => $this->request->getPost('nama_barang_2'),
                    'jumlah_2' => $this->request->getPost('jumlah_2'),
                    'satuan_2' => $this->request->getPost('satuan_2'),
                    'harga_2' => $this->request->getPost('harga_2'),
                    'total_harga_2' => $this->request->getPost('total_harga_2'),
                    'no_3' => $this->request->getPost('no_3'),
                    'nama_barang_3' => $this->request->getPost('nama_barang_3'),
                    'jumlah_3' => $this->request->getPost('jumlah_3'),
                    'satuan_3' => $this->request->getPost('satuan_3'),
                    'harga_3' => $this->request->getPost('harga_3'),
                    'total_harga_3' => $this->request->getPost('total_harga_3'),
                    'no_4' => $this->request->getPost('no_4'),
                    'nama_barang_4' => $this->request->getPost('nama_barang_4'),
                    'jumlah_4' => $this->request->getPost('jumlah_4'),
                    'satuan_4' => $this->request->getPost('satuan_4'),
                    'harga_4' => $this->request->getPost('harga_4'),
                    'total_harga_4' => $this->request->getPost('total_harga_4'),
                    'no_5' => $this->request->getPost('no_5'),
                    'nama_barang_5' => $this->request->getPost('nama_barang_5'),
                    'jumlah_5' => $this->request->getPost('jumlah_5'),
                    'satuan_5' => $this->request->getPost('satuan_5'),
                    'harga_5' => $this->request->getPost('harga_5'),
                    'total_harga_5' => $this->request->getPost('total_harga_5'),
                    'no_6' => $this->request->getPost('no_6'),
                    'nama_barang_6' => $this->request->getPost('nama_barang_6'),
                    'jumlah_6' => $this->request->getPost('jumlah_6'),
                    'satuan_6' => $this->request->getPost('satuan_6'),
                    'harga_6' => $this->request->getPost('harga_6'),
                    'total_harga_6' => $this->request->getPost('total_harga_6'),
                    'no_7' => $this->request->getPost('no_7'),
                    'nama_barang_7' => $this->request->getPost('nama_barang_7'),
                    'jumlah_7' => $this->request->getPost('jumlah_7'),
                    'satuan_7' => $this->request->getPost('satuan_7'),
                    'harga_7' => $this->request->getPost('harga_7'),
                    'total_harga_7' => $this->request->getPost('total_harga_7'),
                    'total_all' => $this->request->getPost('total_all'),
                ];

                $isiSurat = json_encode($isi);
                $xttd = json_encode($this->chooseTtd($this->request->getPost('mengetahui')));

                $insertData = [
                    'jenis_surat' => $jns,
                    'no_surat' => $this->request->getPost('nomor_surat'),
                    'nama_surat' => $menu['nama_menu'],
                    'tanggal' => date('Y-m-d'),
                    'qrgen' => $this->request->getPost('qrgen'),
                    'isi_surat' => $this->gantikutip($isiSurat),
                    'tanda_tangan' => $xttd,
                    'kategori_barang' => $this->request->getPost('kategori_barang'),
                    'createdon' => date('Y-m-d H:i:s'),
                    'createdby' => session()->get('fullname'),
                    'rowstatus' => 1,
                ];

                $this->generateQrcode($this->request->getPost('qrgen'));
                $this->model->insertData('tb_surat', $insertData);

                return redirect()->to('surat/menuSurat?page=' . $page . '&jns=' . encrypt_data($jns) . '&action=' . encrypt_data('view'))->with('success', 'Data berhasil di tambah');

                break;

            case 'edit':

                $id['id_surat'] = $this->request->getPost('id_surat');
                $id_surat = $this->request->getPost('id_surat');

                $isi = [
                    'sphp' => $this->request->getPost('sphp'),
                    'tgl_sphp' => $this->request->getPost('tgl_sphp'),
                    'sg' => $this->request->getPost('sg'),
                    'tgl_sg' => $this->request->getPost('tgl_sg'),
                    'sppp' => $this->request->getPost('sppp'),
                    'tgl_sppp' => $this->request->getPost('tgl_sppp'),
                    'spp' => $this->request->getPost('spp'),
                    'tgl_spp' => $this->request->getPost('tgl_spp'),
                    'inv' => $this->request->getPost('inv'),
                    'tgl_inv' => $this->request->getPost('tgl_inv'),
                    'kwn' => $this->request->getPost('kwn'),
                    'tgl_kwn' => $this->request->getPost('tgl_kwn'),
                    'qrgen' => $this->request->getPost('qrgen'),
                    'img_ttd' => $this->request->getPost('img_ttd'),
                    'id_paket' => $this->request->getPost('id_paket'),
                    'jenis_paket' => $this->request->getPost('jenis_paket'),
                    'id_rup' => $this->request->getPost('id_rup'),
                    'nama_paket_pekerjaan' => $this->request->getPost('nama_paket_pekerjaan'),
                    'tanggal_paket_dibuat' => $this->request->getPost('tanggal_paket_dibuat'),
                    'instansi' => $this->request->getPost('instansi'),
                    'satuan_kerja' => $this->request->getPost('satuan_kerja'),
                    'alamat_satuan_kerja' => strip_tags($this->request->getPost('alamat_satuan_kerja')),
                    'alamat_pengiriman' => strip_tags($this->request->getPost('alamat_pengiriman')),
                    'npwp_satuan_kerja' => $this->request->getPost('npwp_satuan_kerja'),
                    'nama_provinsi' => $this->request->getPost('nama_provinsi'),
                    'nama_kabupaten' => $this->request->getPost('nama_kabupaten'),
                    'tahun_anggaran' => $this->request->getPost('tahun_anggaran'),
                    'nama_pp' => $this->request->getPost('nama_pp'),
                    'nip_pp' => $this->request->getPost('nip_pp'),
                    'no_tlp_pp' => $this->request->getPost('no_tlp_pp'),
                    'email_pp' => $this->request->getPost('email_pp'),
                    'nama_ppk' => $this->request->getPost('nama_ppk'),
                    'nip_ppk' => $this->request->getPost('nip_ppk'),
                    'no_tlp_ppk' => $this->request->getPost('no_tlp_ppk'),
                    'email_ppk' => $this->request->getPost('email_ppk'),
                    'sumber_anggaran' => $this->request->getPost('sumber_anggaran'),
                    'kode_anggaran' => $this->request->getPost('kode_anggaran'),
                    'no_spk' => $this->request->getPost('no_spk'),
                    'tanggal_mulai_spk' => $this->request->getPost('tanggal_mulai_spk'),
                    'tanggal_selesai_spk' => $this->request->getPost('tanggal_selesai_spk'),
                    'vendor_pengiriman' => $this->request->getPost('vendor_pengiriman'),
                    'no_transaksi' => $this->request->getPost('no_transaksi'),
                    'no_resi' => $this->request->getPost('no_resi'),
                    'tanggal_pengiriman' => $this->request->getPost('tanggal_pengiriman'),
                    'noted' => strip_tags($this->request->getPost('noted')),
                    'no_1' => $this->request->getPost('no_1'),
                    'nama_barang_1' => $this->request->getPost('nama_barang_1'),
                    'jumlah_1' => $this->request->getPost('jumlah_1'),
                    'satuan_1' => $this->request->getPost('satuan_1'),
                    'harga_1' => $this->request->getPost('harga_1'),
                    'total_harga_1' => $this->request->getPost('total_harga_1'),
                    'no_2' => $this->request->getPost('no_2'),
                    'nama_barang_2' => $this->request->getPost('nama_barang_2'),
                    'jumlah_2' => $this->request->getPost('jumlah_2'),
                    'satuan_2' => $this->request->getPost('satuan_2'),
                    'harga_2' => $this->request->getPost('harga_2'),
                    'total_harga_2' => $this->request->getPost('total_harga_2'),
                    'no_3' => $this->request->getPost('no_3'),
                    'nama_barang_3' => $this->request->getPost('nama_barang_3'),
                    'jumlah_3' => $this->request->getPost('jumlah_3'),
                    'satuan_3' => $this->request->getPost('satuan_3'),
                    'harga_3' => $this->request->getPost('harga_3'),
                    'total_harga_3' => $this->request->getPost('total_harga_3'),
                    'no_4' => $this->request->getPost('no_4'),
                    'nama_barang_4' => $this->request->getPost('nama_barang_4'),
                    'jumlah_4' => $this->request->getPost('jumlah_4'),
                    'satuan_4' => $this->request->getPost('satuan_4'),
                    'harga_4' => $this->request->getPost('harga_4'),
                    'total_harga_4' => $this->request->getPost('total_harga_4'),
                    'no_5' => $this->request->getPost('no_5'),
                    'nama_barang_5' => $this->request->getPost('nama_barang_5'),
                    'jumlah_5' => $this->request->getPost('jumlah_5'),
                    'satuan_5' => $this->request->getPost('satuan_5'),
                    'harga_5' => $this->request->getPost('harga_5'),
                    'total_harga_5' => $this->request->getPost('total_harga_5'),
                    'no_6' => $this->request->getPost('no_6'),
                    'nama_barang_6' => $this->request->getPost('nama_barang_6'),
                    'jumlah_6' => $this->request->getPost('jumlah_6'),
                    'satuan_6' => $this->request->getPost('satuan_6'),
                    'harga_6' => $this->request->getPost('harga_6'),
                    'total_harga_6' => $this->request->getPost('total_harga_6'),
                    'no_7' => $this->request->getPost('no_7'),
                    'nama_barang_7' => $this->request->getPost('nama_barang_7'),
                    'jumlah_7' => $this->request->getPost('jumlah_7'),
                    'satuan_7' => $this->request->getPost('satuan_7'),
                    'harga_7' => $this->request->getPost('harga_7'),
                    'total_harga_7' => $this->request->getPost('total_harga_7'),
                    'total_all' => $this->request->getPost('total_all'),
                ];

                $isiSurat = json_encode($isi);
                $xttd = json_encode($this->chooseTtd($this->request->getPost('mengetahui')));

                $updateData = [
                    'jenis_surat' => $jns,
                    'no_surat' => $this->request->getPost('nomor_surat'),
                    'nama_surat' => $menu['nama_menu'],
                    'tanggal' => date('Y-m-d'),
                    'qrgen' => $this->request->getPost('qrgen'),
                    'isi_surat' => $this->gantikutip($isiSurat),
                    'tanda_tangan' => $xttd,
                    'kategori_barang' => $this->request->getPost('kategori_barang'),
                ];

                $this->model->updateData('tb_surat', $updateData, $id);
                return redirect()->to('surat/menuSurat?page=' . $page . '&jns=' . encrypt_data($jns) . '&action=' . encrypt_data('view'))->with('success', 'Data berhasil di edit');

                break;
            case 'cetakSurat':

                $id['id_surat'] = $this->request->getGet('idx');

                $row_surat = $this->model->getSelectedData('tb_surat', $id)->getRowArray();
                $row_isiSurat = json_decode($row_surat['isi_surat']);

                $viewFile = $page;
                $outFileName = 'DOKUMEN EKATALOG_' . $row_isiSurat->id_paket . '_' . date('d-m-Y') . '.pdf';

                $customData = [
                    'dt_garansi' => $this->model->getAllData('tb_sertifikat_garansi'),
                ];

                $configLayout = [
                    'title' => 'Cetak Surat',
                    'orientation' => 'P',
                    'format' => 'Folio',
                    'lang' => 'en',
                    'unicode' => false,
                    'encoding' => 'ISO-8859-15',
                    'margin' => [12, 6, 11, 7],
                    'output' => 'I',
                ];

                $this->renderPdf($id, $viewFile, $outFileName, $configLayout, $customData);

                break;

            case 'cetakAmplop':

                $id['id_surat'] = $this->request->getGet('idx');
                $row_surat = $this->model->getSelectedData('tb_surat', $id)->getRowArray();
                $row_isiSurat = json_decode($row_surat['isi_surat']);

                $viewFile = $page . '_amplop';
                $outFileName = 'CETAK SAMPUL EKATALOG_' . $row_isiSurat->id_paket . date('d-m-Y') . '.pdf';

                $configLayout = [
                    'title' => 'Cetak Sampul',
                    'orientation' => 'P',
                    'format' => 'A6',
                    'lang' => 'en',
                    'unicode' => false,
                    'encoding' => 'ISO-8859-15',
                    'margin' => [8, 8, 17, 5],
                    'output' => 'I',
                ];

                $this->renderPdf($id, $viewFile, $outFileName, $configLayout);

                break;

            case 'uploadScan':

                $id_surat = $this->request->getPost('id_surat');
                $id['id_surat'] = $this->request->getPost('id_surat');

                $docupload = ['file_scan'];
                $filePath = WRITEPATH . 'files/scanpdf/';
                $fileName = $jns . '-' . $id_surat . '.pdf';

                return $this->uploadScanSurat($id, $docupload, $filePath, $fileName, $page, $jns);

                break;
        }
    }

    private function penawaran_pekerjaan($page, $jns, $action, $menu)
    {
        switch ($action) {
            case 'view':

                $dt_surat = $this->model->getSelectedData('tb_surat', ['jenis_surat' => $jns, 'rowstatus' => 1, 'arsip' => null])->getResultArray();

                $data = [
                    'title' => (!empty($menu)) ? $menu['nama_menu'] : 'Surat Sisuro',
                    'active_surat' => 'active',
                    'dt_surat' => $dt_surat,
                    'dt_arsip' => $this->model->getSelectedData('tb_surat', ['jenis_surat' => $jns, 'rowstatus' => 2, 'arsip' => null])->getResultArray(),
                    'qrgen' => $this->randomString(5),
                    'dt_jabatan' => $this->model->getAllData('tb_jabatan'),
                    'page' => $page,
                    'jns' => $jns,
                    'nomor_surat' => $this->modelBo->kodeSurat() . '/' . $this->modelBo->lastNumberCustom($jns, 2) . '/SRT/' . $jns . '/APTI/' . date('d') . '/' . $this->getRomawi(DATE('m')) . '/' . date('Y'),
                    'srphp' => 173.2 . '/' . $this->modelBo->lastNumberCustom($jns, 3) . '/SRT/SRPHP/APTI/' . $this->getRomawi(DATE('m')) . '/' . date('Y'),
                    'tb_satuan' => $this->model->getAllData('tb_satuan'),
                ];

                $this->renderView($data, $page);

                break;
            case 'add':

                $isi = [
                    'nama_client' => $this->request->getPost('nama_client'),
                    'srphp' => $this->request->getPost('srphp'),
                    'qrgen' => $this->request->getPost('qrgen'),
                    'img_ttd' => $this->request->getPost('img_ttd'),
                    'tahun_anggaran' => $this->request->getPost('tahun_anggaran'),
                    'kota_client' => $this->request->getPost('kota_client'),
                    'nama_pekerjaan' => $this->request->getPost('nama_pekerjaan'),
                    'hari_pekerjaan' => $this->request->getPost('hari_pekerjaan'),
                    'noted' => strip_tags($this->request->getPost('noted')),
                    'no_1' => $this->request->getPost('no_1'),
                    'nama_barang_1' => $this->request->getPost('nama_barang_1'),
                    'jumlah_1' => $this->request->getPost('jumlah_1'),
                    'satuan_1' => $this->request->getPost('satuan_1'),
                    'harga_1' => $this->request->getPost('harga_1'),
                    'total_harga_1' => $this->request->getPost('total_harga_1'),
                    'no_2' => $this->request->getPost('no_2'),
                    'nama_barang_2' => $this->request->getPost('nama_barang_2'),
                    'jumlah_2' => $this->request->getPost('jumlah_2'),
                    'satuan_2' => $this->request->getPost('satuan_2'),
                    'harga_2' => $this->request->getPost('harga_2'),
                    'total_harga_2' => $this->request->getPost('total_harga_2'),
                    'no_3' => $this->request->getPost('no_3'),
                    'nama_barang_3' => $this->request->getPost('nama_barang_3'),
                    'jumlah_3' => $this->request->getPost('jumlah_3'),
                    'satuan_3' => $this->request->getPost('satuan_3'),
                    'harga_3' => $this->request->getPost('harga_3'),
                    'total_harga_3' => $this->request->getPost('total_harga_3'),
                    'no_4' => $this->request->getPost('no_4'),
                    'nama_barang_4' => $this->request->getPost('nama_barang_4'),
                    'jumlah_4' => $this->request->getPost('jumlah_4'),
                    'satuan_4' => $this->request->getPost('satuan_4'),
                    'harga_4' => $this->request->getPost('harga_4'),
                    'total_harga_4' => $this->request->getPost('total_harga_4'),
                    'no_5' => $this->request->getPost('no_5'),
                    'nama_barang_5' => $this->request->getPost('nama_barang_5'),
                    'jumlah_5' => $this->request->getPost('jumlah_5'),
                    'satuan_5' => $this->request->getPost('satuan_5'),
                    'harga_5' => $this->request->getPost('harga_5'),
                    'total_harga_5' => $this->request->getPost('total_harga_5'),
                    'no_6' => $this->request->getPost('no_6'),
                    'nama_barang_6' => $this->request->getPost('nama_barang_6'),
                    'jumlah_6' => $this->request->getPost('jumlah_6'),
                    'satuan_6' => $this->request->getPost('satuan_6'),
                    'harga_6' => $this->request->getPost('harga_6'),
                    'total_harga_6' => $this->request->getPost('total_harga_6'),
                    'no_7' => $this->request->getPost('no_7'),
                    'nama_barang_7' => $this->request->getPost('nama_barang_7'),
                    'jumlah_7' => $this->request->getPost('jumlah_7'),
                    'satuan_7' => $this->request->getPost('satuan_7'),
                    'harga_7' => $this->request->getPost('harga_7'),
                    'total_harga_7' => $this->request->getPost('total_harga_7'),
                    'no_8' => $this->request->getPost('no_8'),
                    'nama_barang_8' => $this->request->getPost('nama_barang_8'),
                    'jumlah_8' => $this->request->getPost('jumlah_8'),
                    'satuan_8' => $this->request->getPost('satuan_8'),
                    'harga_8' => $this->request->getPost('harga_8'),
                    'total_harga_8' => $this->request->getPost('total_harga_8'),
                    'no_9' => $this->request->getPost('no_9'),
                    'nama_barang_9' => $this->request->getPost('nama_barang_9'),
                    'jumlah_9' => $this->request->getPost('jumlah_9'),
                    'satuan_9' => $this->request->getPost('satuan_9'),
                    'harga_9' => $this->request->getPost('harga_9'),
                    'total_harga_9' => $this->request->getPost('total_harga_9'),
                    'no_10' => $this->request->getPost('no_10'),
                    'nama_barang_10' => $this->request->getPost('nama_barang_10'),
                    'jumlah_10' => $this->request->getPost('jumlah_10'),
                    'satuan_10' => $this->request->getPost('satuan_10'),
                    'harga_10' => $this->request->getPost('harga_10'),
                    'total_harga_10' => $this->request->getPost('total_harga_10'),
                    'hpp1' => $this->request->getPost('hpp1'),
                    'hpp2' => $this->request->getPost('hpp2'),
                    'hpp3' => $this->request->getPost('hpp3'),
                    'hpp4' => $this->request->getPost('hpp4'),
                    'hpp5' => $this->request->getPost('hpp5'),
                    'hpp6' => $this->request->getPost('hpp6'),
                    'hpp7' => $this->request->getPost('hpp7'),
                    'hpp8' => $this->request->getPost('hpp8'),
                    'hpp9' => $this->request->getPost('hpp9'),
                    'hpp10' => $this->request->getPost('hpp10'),
                    'total_all' => $this->request->getPost('total_all'),
                ];

                $isiSurat = json_encode($isi);
                $xttd = json_encode($this->chooseTtd($this->request->getPost('mengetahui')));

                $insertData = [
                    'jenis_surat' => $jns,
                    'no_surat' => $this->request->getPost('nomor_surat'),
                    'nama_surat' => $menu['nama_menu'],
                    'tanggal' => date('Y-m-d'),
                    'qrgen' => $this->request->getPost('qrgen'),
                    'isi_surat' => $this->gantikutip($isiSurat),
                    'tanda_tangan' => $xttd,
                    'createdon' => date('Y-m-d H:i:s'),
                    'createdby' => session()->get('fullname'),
                    'rowstatus' => 1,
                ];

                $this->generateQrcode($this->request->getPost('qrgen'));
                $this->model->insertData('tb_surat', $insertData);

                return redirect()->to('surat/menuSurat?page=' . $page . '&jns=' . encrypt_data($jns) . '&action=' . encrypt_data('view'))->with('success', 'Data berhasil di tambah');

                break;

            case 'edit':

                $id['id_surat'] = $this->request->getPost('id_surat');
                $id_surat = $this->request->getPost('id_surat');

                $isi = [
                    'nama_client' => $this->request->getPost('nama_client'),
                    'srphp' => $this->request->getPost('srphp'),
                    'qrgen' => $this->request->getPost('qrgen'),
                    'img_ttd' => $this->request->getPost('img_ttd'),
                    'tahun_anggaran' => $this->request->getPost('tahun_anggaran'),
                    'kota_client' => $this->request->getPost('kota_client'),
                    'nama_pekerjaan' => $this->request->getPost('nama_pekerjaan'),
                    'hari_pekerjaan' => $this->request->getPost('hari_pekerjaan'),
                    'noted' => strip_tags($this->request->getPost('noted')),
                    'no_1' => $this->request->getPost('no_1'),
                    'nama_barang_1' => $this->request->getPost('nama_barang_1'),
                    'jumlah_1' => $this->request->getPost('jumlah_1'),
                    'satuan_1' => $this->request->getPost('satuan_1'),
                    'harga_1' => $this->request->getPost('harga_1'),
                    'total_harga_1' => $this->request->getPost('total_harga_1'),
                    'no_2' => $this->request->getPost('no_2'),
                    'nama_barang_2' => $this->request->getPost('nama_barang_2'),
                    'jumlah_2' => $this->request->getPost('jumlah_2'),
                    'satuan_2' => $this->request->getPost('satuan_2'),
                    'harga_2' => $this->request->getPost('harga_2'),
                    'total_harga_2' => $this->request->getPost('total_harga_2'),
                    'no_3' => $this->request->getPost('no_3'),
                    'nama_barang_3' => $this->request->getPost('nama_barang_3'),
                    'jumlah_3' => $this->request->getPost('jumlah_3'),
                    'satuan_3' => $this->request->getPost('satuan_3'),
                    'harga_3' => $this->request->getPost('harga_3'),
                    'total_harga_3' => $this->request->getPost('total_harga_3'),
                    'no_4' => $this->request->getPost('no_4'),
                    'nama_barang_4' => $this->request->getPost('nama_barang_4'),
                    'jumlah_4' => $this->request->getPost('jumlah_4'),
                    'satuan_4' => $this->request->getPost('satuan_4'),
                    'harga_4' => $this->request->getPost('harga_4'),
                    'total_harga_4' => $this->request->getPost('total_harga_4'),
                    'no_5' => $this->request->getPost('no_5'),
                    'nama_barang_5' => $this->request->getPost('nama_barang_5'),
                    'jumlah_5' => $this->request->getPost('jumlah_5'),
                    'satuan_5' => $this->request->getPost('satuan_5'),
                    'harga_5' => $this->request->getPost('harga_5'),
                    'total_harga_5' => $this->request->getPost('total_harga_5'),
                    'no_6' => $this->request->getPost('no_6'),
                    'nama_barang_6' => $this->request->getPost('nama_barang_6'),
                    'jumlah_6' => $this->request->getPost('jumlah_6'),
                    'satuan_6' => $this->request->getPost('satuan_6'),
                    'harga_6' => $this->request->getPost('harga_6'),
                    'total_harga_6' => $this->request->getPost('total_harga_6'),
                    'no_7' => $this->request->getPost('no_7'),
                    'nama_barang_7' => $this->request->getPost('nama_barang_7'),
                    'jumlah_7' => $this->request->getPost('jumlah_7'),
                    'satuan_7' => $this->request->getPost('satuan_7'),
                    'harga_7' => $this->request->getPost('harga_7'),
                    'total_harga_7' => $this->request->getPost('total_harga_7'),
                    'no_8' => $this->request->getPost('no_8'),
                    'nama_barang_8' => $this->request->getPost('nama_barang_8'),
                    'jumlah_8' => $this->request->getPost('jumlah_8'),
                    'satuan_8' => $this->request->getPost('satuan_8'),
                    'harga_8' => $this->request->getPost('harga_8'),
                    'total_harga_8' => $this->request->getPost('total_harga_8'),
                    'no_9' => $this->request->getPost('no_9'),
                    'nama_barang_9' => $this->request->getPost('nama_barang_9'),
                    'jumlah_9' => $this->request->getPost('jumlah_9'),
                    'satuan_9' => $this->request->getPost('satuan_9'),
                    'harga_9' => $this->request->getPost('harga_9'),
                    'total_harga_9' => $this->request->getPost('total_harga_9'),
                    'no_10' => $this->request->getPost('no_10'),
                    'nama_barang_10' => $this->request->getPost('nama_barang_10'),
                    'jumlah_10' => $this->request->getPost('jumlah_10'),
                    'satuan_10' => $this->request->getPost('satuan_10'),
                    'harga_10' => $this->request->getPost('harga_10'),
                    'total_harga_10' => $this->request->getPost('total_harga_10'),
                    'hpp1' => $this->request->getPost('hpp1'),
                    'hpp2' => $this->request->getPost('hpp2'),
                    'hpp3' => $this->request->getPost('hpp3'),
                    'hpp4' => $this->request->getPost('hpp4'),
                    'hpp5' => $this->request->getPost('hpp5'),
                    'hpp6' => $this->request->getPost('hpp6'),
                    'hpp7' => $this->request->getPost('hpp7'),
                    'hpp8' => $this->request->getPost('hpp8'),
                    'hpp9' => $this->request->getPost('hpp9'),
                    'hpp10' => $this->request->getPost('hpp10'),
                    'total_all' => $this->request->getPost('total_all'),
                ];

                $isiSurat = json_encode($isi);
                $xttd = json_encode($this->chooseTtd($this->request->getPost('mengetahui')));

                $updateData = [
                    'jenis_surat' => $jns,
                    'no_surat' => $this->request->getPost('nomor_surat'),
                    'nama_surat' => $menu['nama_menu'],
                    'tanggal' => date('Y-m-d'),
                    'qrgen' => $this->request->getPost('qrgen'),
                    'isi_surat' => $this->gantikutip($isiSurat),
                    'tanda_tangan' => $xttd,
                    'kategori_barang' => $this->request->getPost('kategori_barang'),
                ];

                $this->model->updateData('tb_surat', $updateData, $id);
                return redirect()->to('surat/menuSurat?page=' . $page . '&jns=' . encrypt_data($jns) . '&action=' . encrypt_data('view'))->with('success', 'Data berhasil di edit');

                break;

            case 'cetakSurat':

                $id['id_surat'] = $this->request->getGet('idx');

                $row_surat = $this->model->getSelectedData('tb_surat', $id)->getRowArray();
                $row_isiSurat = json_decode($row_surat['isi_surat']);

                $viewFile = $page;
                $outFileName = 'SPP_' . $row_surat['qrgen'] . '_' . date('d-m-Y') . '.pdf';

                $configLayout = [
                    'title' => 'Cetak Surat',
                    'orientation' => 'P',
                    'format' => 'A4',
                    'lang' => 'en',
                    'unicode' => false,
                    'encoding' => 'ISO-8859-15',
                    'margin' => [10, 6, 9, 0],
                    'output' => 'I',
                ];

                $this->renderPdf($id, $viewFile, $outFileName, $configLayout);

                break;

            case 'uploadScan':

                $id_surat = $this->request->getPost('id_surat');
                $id['id_surat'] = $this->request->getPost('id_surat');

                $docupload = ['file_scan'];
                $filePath = WRITEPATH . 'files/scanpdf/';
                $fileName = $jns . '-' . $id_surat . '.pdf';

                return $this->uploadScanSurat($id, $docupload, $filePath, $fileName, $page, $jns);

                break;
        }
    }

    private function invoice_swasta($page, $jns, $action, $menu)
    {
        switch ($action) {
            case 'view':

                $dt_surat = $this->model->getSelectedData('tb_surat', ['jenis_surat' => $jns, 'rowstatus' => 1, 'arsip' => null])->getResultArray();

                $data = [
                    'title' => (!empty($menu)) ? $menu['nama_menu'] : 'Surat Sisuro',
                    'active_surat' => 'active',
                    'dt_surat' => $dt_surat,
                    'dt_arsip' => $this->model->getSelectedData('tb_surat', ['jenis_surat' => $jns, 'rowstatus' => 2, 'arsip' => null])->getResultArray(),
                    'qrgen' => $this->randomString(5),
                    'dt_jabatan' => $this->model->getAllData('tb_jabatan'),
                    'page' => $page,
                    'jns' => $jns,
                    'nomor_surat' => $this->modelBo->kodeSurat() . '/' . $this->modelBo->lastNumberCustom($jns, 1) . '/SRT/' . $jns . '/APTI/' . date('d') . '/' . $this->getRomawi(DATE('m')) . '/' . date('Y'),
                    'dt_satuan' => $this->model->getAllData('tb_satuan'),
                ];

                $this->renderView($data, $page);

                break;
            case 'add':

                $isi = [
                    "nama_client" => $this->request->getPost('nama_client'),
                    "qrgen" => $this->request->getPost('qrgen'),
                    "img_ttd" => $this->request->getPost('img_ttd'),
                    "alamat_client" => $this->request->getPost('alamat_client'),
                    "kota_client" => $this->request->getPost('kota_client'),
                    "email" => $this->request->getPost('email'),
                    "no_tlp" => $this->request->getPost('no_tlp'),
                    "noted" => strip_tags($this->request->getPost('noted')),
                    "no_1" => $this->request->getPost('no_1'),
                    "nama_barang_1" => $this->request->getPost('nama_barang_1'),
                    "jumlah_1" => $this->request->getPost('jumlah_1'),
                    "satuan_1" => $this->request->getPost('satuan_1'),
                    "harga_1" => $this->request->getPost('harga_1'),
                    "total_harga_1" => $this->request->getPost('total_harga_1'),
                    "no_2" => $this->request->getPost('no_2'),
                    "nama_barang_2" => $this->request->getPost('nama_barang_2'),
                    "jumlah_2" => $this->request->getPost('jumlah_2'),
                    "satuan_2" => $this->request->getPost('satuan_2'),
                    "harga_2" => $this->request->getPost('harga_2'),
                    "total_harga_2" => $this->request->getPost('total_harga_2'),
                    "no_3" => $this->request->getPost('no_3'),
                    "nama_barang_3" => $this->request->getPost('nama_barang_3'),
                    "jumlah_3" => $this->request->getPost('jumlah_3'),
                    "satuan_3" => $this->request->getPost('satuan_3'),
                    "harga_3" => $this->request->getPost('harga_3'),
                    "total_harga_3" => $this->request->getPost('total_harga_3'),
                    "no_4" => $this->request->getPost('no_4'),
                    "nama_barang_4" => $this->request->getPost('nama_barang_4'),
                    "jumlah_4" => $this->request->getPost('jumlah_4'),
                    "satuan_4" => $this->request->getPost('satuan_4'),
                    "harga_4" => $this->request->getPost('harga_4'),
                    "total_harga_4" => $this->request->getPost('total_harga_4'),
                    "no_5" => $this->request->getPost('no_5'),
                    "nama_barang_5" => $this->request->getPost('nama_barang_5'),
                    "jumlah_5" => $this->request->getPost('jumlah_5'),
                    "satuan_5" => $this->request->getPost('satuan_5'),
                    "harga_5" => $this->request->getPost('harga_5'),
                    "total_harga_5" => $this->request->getPost('total_harga_5'),
                    "no_6" => $this->request->getPost('no_6'),
                    "nama_barang_6" => $this->request->getPost('nama_barang_6'),
                    "jumlah_6" => $this->request->getPost('jumlah_6'),
                    "satuan_6" => $this->request->getPost('satuan_6'),
                    "harga_6" => $this->request->getPost('harga_6'),
                    "total_harga_6" => $this->request->getPost('total_harga_6'),
                    "no_7" => $this->request->getPost('no_7'),
                    "nama_barang_7" => $this->request->getPost('nama_barang_7'),
                    "jumlah_7" => $this->request->getPost('jumlah_7'),
                    "satuan_7" => $this->request->getPost('satuan_7'),
                    "harga_7" => $this->request->getPost('harga_7'),
                    "total_harga_7" => $this->request->getPost('total_harga_7'),
                    "no_8" => $this->request->getPost('no_8'),
                    "nama_barang_8" => $this->request->getPost('nama_barang_8'),
                    "jumlah_8" => $this->request->getPost('jumlah_8'),
                    "satuan_8" => $this->request->getPost('satuan_8'),
                    "harga_8" => $this->request->getPost('harga_8'),
                    "total_harga_8" => $this->request->getPost('total_harga_8'),
                    "no_9" => $this->request->getPost('no_9'),
                    "nama_barang_9" => $this->request->getPost('nama_barang_9'),
                    "jumlah_9" => $this->request->getPost('jumlah_9'),
                    "satuan_9" => $this->request->getPost('satuan_9'),
                    "harga_9" => $this->request->getPost('harga_9'),
                    "total_harga_9" => $this->request->getPost('total_harga_9'),
                    "no_10" => $this->request->getPost('no_10'),
                    "nama_barang_10" => $this->request->getPost('nama_barang_10'),
                    "jumlah_10" => $this->request->getPost('jumlah_10'),
                    "satuan_10" => $this->request->getPost('satuan_10'),
                    "harga_10" => $this->request->getPost('harga_10'),
                    "total_harga_10" => $this->request->getPost('total_harga_10'),
                    "total_sementara" => $this->request->getPost('total_sementara'),
                    "persen_diskon" => $this->request->getPost('persen_diskon'),
                    "diskon" => $this->request->getPost('diskon'),
                    "persen_uang_muka" => $this->request->getPost('persen_uang_muka'),
                    "uang_muka" => $this->request->getPost('uang_muka'),
                    "total_all" => $this->request->getPost('total_all')
                ];

                $isiSurat = json_encode($isi);
                $xttd = json_encode($this->chooseTtd($this->request->getPost('mengetahui')));

                $insertData = [
                    'jenis_surat' => $jns,
                    'no_surat' => $this->request->getPost('nomor_surat'),
                    'nama_surat' => $menu['nama_menu'],
                    'tanggal' => date('Y-m-d'),
                    'qrgen' => $this->request->getPost('qrgen'),
                    'isi_surat' => $this->gantikutip($isiSurat),
                    'tanda_tangan' => $xttd,
                    'createdon' => date('Y-m-d H:i:s'),
                    'createdby' => session()->get('fullname'),
                    'rowstatus' => 1,
                ];

                $this->generateQrcode($this->request->getPost('qrgen'));
                $this->model->insertData('tb_surat', $insertData);

                return redirect()->to('surat/menuSurat?page=' . $page . '&jns=' . encrypt_data($jns) . '&action=' . encrypt_data('view'))->with('success', 'Data berhasil di tambah');

                break;
            case 'edit':

                $id['id_surat'] = $this->request->getPost('id_surat');
                $id_surat = $this->request->getPost('id_surat');

                $isi = [
                    "nama_client" => $this->request->getPost('nama_client'),
                    "qrgen" => $this->request->getPost('qrgen'),
                    "img_ttd" => $this->request->getPost('img_ttd'),
                    "alamat_client" => $this->request->getPost('alamat_client'),
                    "kota_client" => $this->request->getPost('kota_client'),
                    "email" => $this->request->getPost('email'),
                    "no_tlp" => $this->request->getPost('no_tlp'),
                    "noted" => strip_tags($this->request->getPost('noted')),
                    "no_1" => $this->request->getPost('no_1'),
                    "nama_barang_1" => $this->request->getPost('nama_barang_1'),
                    "jumlah_1" => $this->request->getPost('jumlah_1'),
                    "satuan_1" => $this->request->getPost('satuan_1'),
                    "harga_1" => $this->request->getPost('harga_1'),
                    "total_harga_1" => $this->request->getPost('total_harga_1'),
                    "no_2" => $this->request->getPost('no_2'),
                    "nama_barang_2" => $this->request->getPost('nama_barang_2'),
                    "jumlah_2" => $this->request->getPost('jumlah_2'),
                    "satuan_2" => $this->request->getPost('satuan_2'),
                    "harga_2" => $this->request->getPost('harga_2'),
                    "total_harga_2" => $this->request->getPost('total_harga_2'),
                    "no_3" => $this->request->getPost('no_3'),
                    "nama_barang_3" => $this->request->getPost('nama_barang_3'),
                    "jumlah_3" => $this->request->getPost('jumlah_3'),
                    "satuan_3" => $this->request->getPost('satuan_3'),
                    "harga_3" => $this->request->getPost('harga_3'),
                    "total_harga_3" => $this->request->getPost('total_harga_3'),
                    "no_4" => $this->request->getPost('no_4'),
                    "nama_barang_4" => $this->request->getPost('nama_barang_4'),
                    "jumlah_4" => $this->request->getPost('jumlah_4'),
                    "satuan_4" => $this->request->getPost('satuan_4'),
                    "harga_4" => $this->request->getPost('harga_4'),
                    "total_harga_4" => $this->request->getPost('total_harga_4'),
                    "no_5" => $this->request->getPost('no_5'),
                    "nama_barang_5" => $this->request->getPost('nama_barang_5'),
                    "jumlah_5" => $this->request->getPost('jumlah_5'),
                    "satuan_5" => $this->request->getPost('satuan_5'),
                    "harga_5" => $this->request->getPost('harga_5'),
                    "total_harga_5" => $this->request->getPost('total_harga_5'),
                    "no_6" => $this->request->getPost('no_6'),
                    "nama_barang_6" => $this->request->getPost('nama_barang_6'),
                    "jumlah_6" => $this->request->getPost('jumlah_6'),
                    "satuan_6" => $this->request->getPost('satuan_6'),
                    "harga_6" => $this->request->getPost('harga_6'),
                    "total_harga_6" => $this->request->getPost('total_harga_6'),
                    "no_7" => $this->request->getPost('no_7'),
                    "nama_barang_7" => $this->request->getPost('nama_barang_7'),
                    "jumlah_7" => $this->request->getPost('jumlah_7'),
                    "satuan_7" => $this->request->getPost('satuan_7'),
                    "harga_7" => $this->request->getPost('harga_7'),
                    "total_harga_7" => $this->request->getPost('total_harga_7'),
                    "no_8" => $this->request->getPost('no_8'),
                    "nama_barang_8" => $this->request->getPost('nama_barang_8'),
                    "jumlah_8" => $this->request->getPost('jumlah_8'),
                    "satuan_8" => $this->request->getPost('satuan_8'),
                    "harga_8" => $this->request->getPost('harga_8'),
                    "total_harga_8" => $this->request->getPost('total_harga_8'),
                    "no_9" => $this->request->getPost('no_9'),
                    "nama_barang_9" => $this->request->getPost('nama_barang_9'),
                    "jumlah_9" => $this->request->getPost('jumlah_9'),
                    "satuan_9" => $this->request->getPost('satuan_9'),
                    "harga_9" => $this->request->getPost('harga_9'),
                    "total_harga_9" => $this->request->getPost('total_harga_9'),
                    "no_10" => $this->request->getPost('no_10'),
                    "nama_barang_10" => $this->request->getPost('nama_barang_10'),
                    "jumlah_10" => $this->request->getPost('jumlah_10'),
                    "satuan_10" => $this->request->getPost('satuan_10'),
                    "harga_10" => $this->request->getPost('harga_10'),
                    "total_harga_10" => $this->request->getPost('total_harga_10'),
                    "total_sementara" => $this->request->getPost('total_sementara'),
                    "persen_diskon" => $this->request->getPost('persen_diskon'),
                    "diskon" => $this->request->getPost('diskon'),
                    "persen_uang_muka" => $this->request->getPost('persen_uang_muka'),
                    "uang_muka" => $this->request->getPost('uang_muka'),
                    "total_all" => $this->request->getPost('total_all')
                ];

                $isiSurat = json_encode($isi);
                $xttd = json_encode($this->chooseTtd($this->request->getPost('mengetahui')));

                $updateData = [
                    'jenis_surat' => $jns,
                    'no_surat' => $this->request->getPost('nomor_surat'),
                    'nama_surat' => $menu['nama_menu'],
                    'tanggal' => date('Y-m-d'),
                    'qrgen' => $this->request->getPost('qrgen'),
                    'isi_surat' => $this->gantikutip($isiSurat),
                    'tanda_tangan' => $xttd,
                    'kategori_barang' => $this->request->getPost('kategori_barang'),
                ];

                $this->model->updateData('tb_surat', $updateData, $id);
                return redirect()->to('surat/menuSurat?page=' . $page . '&jns=' . encrypt_data($jns) . '&action=' . encrypt_data('view'))->with('success', 'Data berhasil di edit');

                break;
            case 'cetakSurat':

                $id['id_surat'] = $this->request->getGet('idx');

                $row_surat = $this->model->getSelectedData('tb_surat', $id)->getRowArray();
                $row_isiSurat = json_decode($row_surat['isi_surat']);

                $viewFile = $page;
                $outFileName = 'INVS_' . $row_surat['qrgen'] . '_' . date('d-m-Y') . '.pdf';

                $configLayout = [
                    'title' => 'Cetak Surat',
                    'orientation' => 'P',
                    'format' => 'Folio',
                    'lang' => 'en',
                    'unicode' => false,
                    'encoding' => 'ISO-8859-15',
                    'margin' => [10, 6, 9, 7],
                    'output' => 'I',
                ];

                $this->renderPdf($id, $viewFile, $outFileName, $configLayout);

                break;
            case 'uploadScan':

                $id_surat = $this->request->getPost('id_surat');
                $id['id_surat'] = $this->request->getPost('id_surat');

                $docupload = ['file_scan'];
                $filePath = WRITEPATH . 'files/scanpdf/';
                $fileName = $jns . '-' . $id_surat . '.pdf';

                return $this->uploadScanSurat($id, $docupload, $filePath, $fileName, $page, $jns);

                break;
        }
    }

    public function pelaksanaan_magang($page, $jns, $action, $menu)
    {
        switch ($action) {
            case 'view':

                $dt_surat = $this->model->getSelectedData('tb_surat', ['jenis_surat' => $jns, 'rowstatus' => 1, 'arsip' => null])->getResultArray();

                $data = [
                    'title' => (!empty($menu)) ? $menu['nama_menu'] : 'Surat Sisuro',
                    'active_surat' => 'active',
                    'dt_surat' => $dt_surat,
                    'dt_arsip' => $this->model->getSelectedData('tb_surat', ['jenis_surat' => $jns, 'rowstatus' => 2, 'arsip' => null])->getResultArray(),
                    'qrgen' => $this->randomString(5),
                    'dt_jabatan' => $this->model->getAllData('tb_jabatan'),
                    'page' => $page,
                    'jns' => $jns,
                    'nomor_surat' => $this->modelBo->kodeSurat() . '/' . $this->modelBo->lastNumberCustom($jns, 1) . '/SRT/' . $jns . '/APTI/' . $this->getRomawi(DATE('m')) . '/' . date('Y'),
                ];

                $this->renderView($data, $page);

                break;
            case 'add':

                $isi = [
                    "qrgen" => $this->request->getPost('qrgen'),
                    "img_ttd" => $this->request->getPost('img_ttd'),
                    "nama_kampus" => $this->request->getPost('nama_kampus'),
                    "alamat_kampus" => $this->request->getPost('alamat_kampus'),
                    "jumlah_siswa" => $this->request->getPost('jumlah_siswa'),
                    "nomor_surat_balas" => $this->request->getPost('nomor_surat_balas'),
                    "mulai_masuk" => $this->request->getPost('mulai_masuk'),
                    "akhir_masuk" => $this->request->getPost('akhir_masuk'),
                    "jurusan" => $this->request->getPost('jurusan'),
                    "nama_pj" => $this->request->getPost('nama_pj'),
                    "noted" => strip_tags($this->request->getPost('noted')),
                    "no_1" => $this->request->getPost('no_1'),
                    "nama_1" => $this->request->getPost('nama_1'),
                    "nis_1" => $this->request->getPost('nis_1'),
                    "no_2" => $this->request->getPost('no_2'),
                    "nama_2" => $this->request->getPost('nama_2'),
                    "nis_2" => $this->request->getPost('nis_2'),
                    "no_3" => $this->request->getPost('no_3'),
                    "nama_3" => $this->request->getPost('nama_3'),
                    "nis_3" => $this->request->getPost('nis_3'),
                    "no_4" => $this->request->getPost('no_4'),
                    "nama_4" => $this->request->getPost('nama_4'),
                    "nis_4" => $this->request->getPost('nis_4'),
                    "no_5" => $this->request->getPost('no_5'),
                    "nama_5" => $this->request->getPost('nama_5'),
                    "nis_5" => $this->request->getPost('nis_5'),
                    "no_6" => $this->request->getPost('no_6'),
                    "nama_6" => $this->request->getPost('nama_6'),
                    "nis_6" => $this->request->getPost('nis_6'),
                    "no_7" => $this->request->getPost('no_7'),
                    "nama_7" => $this->request->getPost('nama_7'),
                    "nis_7" => $this->request->getPost('nis_7'),
                ];

                $isiSurat = json_encode($isi);
                $xttd = json_encode($this->chooseTtd($this->request->getPost('mengetahui')));

                $insertData = [
                    'jenis_surat' => $jns,
                    'no_surat' => $this->request->getPost('nomor_surat'),
                    'nama_surat' => $menu['nama_menu'],
                    'tanggal' => date('Y-m-d'),
                    'qrgen' => $this->request->getPost('qrgen'),
                    'isi_surat' => $this->gantikutip($isiSurat),
                    'tanda_tangan' => $xttd,
                    'createdon' => date('Y-m-d H:i:s'),
                    'createdby' => session()->get('fullname'),
                    'rowstatus' => 1,
                ];

                $this->generateQrcode($this->request->getPost('qrgen'));
                $this->model->insertData('tb_surat', $insertData);

                return redirect()->to('surat/menuSurat?page=' . $page . '&jns=' . encrypt_data($jns) . '&action=' . encrypt_data('view'))->with('success', 'Data berhasil di tambah');

                break;
            case 'edit':

                $id['id_surat'] = $this->request->getPost('id_surat');
                $id_surat = $this->request->getPost('id_surat');

                $isi = [
                    "qrgen" => $this->request->getPost('qrgen'),
                    "img_ttd" => $this->request->getPost('img_ttd'),
                    "nama_kampus" => $this->request->getPost('nama_kampus'),
                    "alamat_kampus" => $this->request->getPost('alamat_kampus'),
                    "jumlah_siswa" => $this->request->getPost('jumlah_siswa'),
                    "nomor_surat_balas" => $this->request->getPost('nomor_surat_balas'),
                    "mulai_masuk" => $this->request->getPost('mulai_masuk'),
                    "akhir_masuk" => $this->request->getPost('akhir_masuk'),
                    "jurusan" => $this->request->getPost('jurusan'),
                    "nama_pj" => $this->request->getPost('nama_pj'),
                    "noted" => strip_tags($this->request->getPost('noted')),
                    "no_1" => $this->request->getPost('no_1'),
                    "nama_1" => $this->request->getPost('nama_1'),
                    "nis_1" => $this->request->getPost('nis_1'),
                    "no_2" => $this->request->getPost('no_2'),
                    "nama_2" => $this->request->getPost('nama_2'),
                    "nis_2" => $this->request->getPost('nis_2'),
                    "no_3" => $this->request->getPost('no_3'),
                    "nama_3" => $this->request->getPost('nama_3'),
                    "nis_3" => $this->request->getPost('nis_3'),
                    "no_4" => $this->request->getPost('no_4'),
                    "nama_4" => $this->request->getPost('nama_4'),
                    "nis_4" => $this->request->getPost('nis_4'),
                    "no_5" => $this->request->getPost('no_5'),
                    "nama_5" => $this->request->getPost('nama_5'),
                    "nis_5" => $this->request->getPost('nis_5'),
                    "no_6" => $this->request->getPost('no_6'),
                    "nama_6" => $this->request->getPost('nama_6'),
                    "nis_6" => $this->request->getPost('nis_6'),
                    "no_7" => $this->request->getPost('no_7'),
                    "nama_7" => $this->request->getPost('nama_7'),
                    "nis_7" => $this->request->getPost('nis_7'),
                ];

                $isiSurat = json_encode($isi);
                $xttd = json_encode($this->chooseTtd($this->request->getPost('mengetahui')));

                $updateData = [
                    'jenis_surat' => $jns,
                    'no_surat' => $this->request->getPost('nomor_surat'),
                    'nama_surat' => $menu['nama_menu'],
                    'tanggal' => date('Y-m-d'),
                    'qrgen' => $this->request->getPost('qrgen'),
                    'isi_surat' => $this->gantikutip($isiSurat),
                    'tanda_tangan' => $xttd,
                    'kategori_barang' => $this->request->getPost('kategori_barang'),
                ];

                $this->model->updateData('tb_surat', $updateData, $id);
                return redirect()->to('surat/menuSurat?page=' . $page . '&jns=' . encrypt_data($jns) . '&action=' . encrypt_data('view'))->with('success', 'Data berhasil di edit');

                break;
            case 'cetakSurat':

                $id['id_surat'] = $this->request->getGet('idx');

                $row_surat = $this->model->getSelectedData('tb_surat', $id)->getRowArray();
                $row_isiSurat = json_decode($row_surat['isi_surat']);

                $viewFile = $page;
                $outFileName = 'SPM_' . $row_surat['qrgen'] . '_' . date('d-m-Y') . '.pdf';

                $configLayout = [
                    'title' => 'Cetak Surat',
                    'orientation' => 'P',
                    'format' => 'A4',
                    'lang' => 'en',
                    'unicode' => false,
                    'encoding' => 'ISO-8859-15',
                    'margin' => [10, 6, 9, 0],
                    'output' => 'I',
                ];

                $this->renderPdf($id, $viewFile, $outFileName, $configLayout);

                break;
            case 'uploadScan':

                $id_surat = $this->request->getPost('id_surat');
                $id['id_surat'] = $this->request->getPost('id_surat');

                $docupload = ['file_scan'];
                $filePath = WRITEPATH . 'files/scanpdf/';
                $fileName = $jns . '-' . $id_surat . '.pdf';

                return $this->uploadScanSurat($id, $docupload, $filePath, $fileName, $page, $jns);

                break;
        }
    }

    private function keterangan_magang($page, $jns, $action, $menu)
    {
        switch ($action) {

            case 'view':

                $dt_surat = $this->model->getSelectedData('tb_surat', ['jenis_surat' => $jns, 'rowstatus' => 1, 'arsip' => null])->getResultArray();

                $data = [
                    'title' => (!empty($menu)) ? $menu['nama_menu'] : 'Surat Sisuro',
                    'active_surat' => 'active',
                    'dt_surat' => $dt_surat,
                    'dt_arsip' => $this->model->getSelectedData('tb_surat', ['jenis_surat' => $jns, 'rowstatus' => 2, 'arsip' => null])->getResultArray(),
                    'qrgen' => $this->randomString(5),
                    'dt_jabatan' => $this->model->getAllData('tb_jabatan'),
                    'page' => $page,
                    'jns' => $jns,
                    'nomor_surat' => $this->modelBo->kodeSurat() . '/' . $this->modelBo->lastNumberCustom($jns, 1) . '/SRT/' . $jns . '/APTI/' . $this->getRomawi(DATE('m')) . '/' . date('Y'),
                ];

                $this->renderView($data, $page);

                break;

            case 'add':

                $isi = [
                    "qrgen" => $this->request->getPost('qrgen'),
                    "img_ttd" => $this->request->getPost('img_ttd'),
                    "nama_siswa" => $this->request->getPost('nama_siswa'),
                    "asal_sekolah" => $this->request->getPost('asal_sekolah'),
                    "prodi" => $this->request->getPost('prodi'),
                    "nim" => $this->request->getPost('nim'),
                    "nilai" => $this->request->getPost('nilai'),
                    "tanggal_mulai" => $this->request->getPost('tanggal_mulai'),
                    "tanggal_selesai" => $this->request->getPost('tanggal_selesai'),
                ];

                $isiSurat = json_encode($isi);
                $xttd = json_encode($this->chooseTtd($this->request->getPost('mengetahui')));

                $insertData = [
                    'jenis_surat' => $jns,
                    'no_surat' => $this->request->getPost('nomor_surat'),
                    'nama_surat' => $menu['nama_menu'],
                    'tanggal' => date('Y-m-d'),
                    'qrgen' => $this->request->getPost('qrgen'),
                    'isi_surat' => $this->gantikutip($isiSurat),
                    'tanda_tangan' => $xttd,
                    'createdon' => date('Y-m-d H:i:s'),
                    'createdby' => session()->get('fullname'),
                    'rowstatus' => 1,
                ];

                $this->generateQrcode($this->request->getPost('qrgen'));
                $this->model->insertData('tb_surat', $insertData);

                return redirect()->to('surat/menuSurat?page=' . $page . '&jns=' . encrypt_data($jns) . '&action=' . encrypt_data('view'))->with('success', 'Data berhasil di tambah');

                break;
            case 'edit':

                $id['id_surat'] = $this->request->getPost('id_surat');
                $id_surat = $this->request->getPost('id_surat');

                $isi = [
                    "qrgen" => $this->request->getPost('qrgen'),
                    "img_ttd" => $this->request->getPost('img_ttd'),
                    "nama_siswa" => $this->request->getPost('nama_siswa'),
                    "asal_sekolah" => $this->request->getPost('asal_sekolah'),
                    "prodi" => $this->request->getPost('prodi'),
                    "nim" => $this->request->getPost('nim'),
                    "nilai" => $this->request->getPost('nilai'),
                    "tanggal_mulai" => $this->request->getPost('tanggal_mulai'),
                    "tanggal_selesai" => $this->request->getPost('tanggal_selesai'),
                ];

                $isiSurat = json_encode($isi);
                $xttd = json_encode($this->chooseTtd($this->request->getPost('mengetahui')));

                $updateData = [
                    'jenis_surat' => $jns,
                    'no_surat' => $this->request->getPost('nomor_surat'),
                    'nama_surat' => $menu['nama_menu'],
                    'tanggal' => date('Y-m-d'),
                    'qrgen' => $this->request->getPost('qrgen'),
                    'isi_surat' => $this->gantikutip($isiSurat),
                    'tanda_tangan' => $xttd,
                    'kategori_barang' => $this->request->getPost('kategori_barang'),
                ];

                $this->model->updateData('tb_surat', $updateData, $id);
                return redirect()->to('surat/menuSurat?page=' . $page . '&jns=' . encrypt_data($jns) . '&action=' . encrypt_data('view'))->with('success', 'Data berhasil di edit');

                break;
            case 'cetakSurat':

                $id['id_surat'] = $this->request->getGet('idx');

                $row_surat = $this->model->getSelectedData('tb_surat', $id)->getRowArray();
                $row_isiSurat = json_decode($row_surat['isi_surat']);

                $viewFile = $page;
                $outFileName = 'SK_MG_' . $row_surat['qrgen'] . '_' . date('d-m-Y') . '.pdf';

                $configLayout = [
                    'title' => 'Cetak Surat',
                    'orientation' => 'P',
                    'format' => 'A4',
                    'lang' => 'en',
                    'unicode' => false,
                    'encoding' => 'ISO-8859-15',
                    'margin' => [10, 6, 9, 0],
                    'output' => 'I',
                ];

                $this->renderPdf($id, $viewFile, $outFileName, $configLayout);

                break;

            case 'cetakSertifikat':

                $id['id_surat'] = $this->request->getGet('idx');

                $row_surat = $this->model->getSelectedData('tb_surat', $id)->getRowArray();

                $viewFile = $page . '_sertifikat';
                $outFileName = 'SK_MG_SERTIFIKAT_' . date('d-m-Y') . '_' . $row_surat['qrgen'] . '.pdf';

                $configLayout = [
                    'title' => 'Cetak Sertifikat',
                    'orientation' => 'L',
                    'format' => 'Folio',
                    'lang' => 'en',
                    'unicode' => false,
                    'encoding' => 'ISO-8859-15',
                    'margin' => [0, 0, 0, 0],
                    'output' => 'I',
                ];

                $this->renderPdf($id, $viewFile, $outFileName, $configLayout);

                break;

            case 'uploadScan':

                $id_surat = $this->request->getPost('id_surat');
                $id['id_surat'] = $this->request->getPost('id_surat');

                $docupload = ['file_scan'];
                $filePath = WRITEPATH . 'files/scanpdf/';
                $fileName = $jns . '-' . $id_surat . '.pdf';

                return $this->uploadScanSurat($id, $docupload, $filePath, $fileName, $page, $jns);

                break;
        }
    }

    private function surat_tugas($page, $jns, $action, $menu)
    {
        switch ($action) {
            case 'view':

                $dt_surat = $this->model->getSelectedData('tb_surat', ['jenis_surat' => $jns, 'rowstatus' => 1, 'arsip' => null])->getResultArray();

                $data = [
                    'title' => (!empty($menu)) ? $menu['nama_menu'] : 'Surat Sisuro',
                    'active_surat' => 'active',
                    'dt_surat' => $dt_surat,
                    'dt_arsip' => $this->model->getSelectedData('tb_surat', ['jenis_surat' => $jns, 'rowstatus' => 2, 'arsip' => null])->getResultArray(),
                    'qrgen' => $this->randomString(5),
                    'dt_jabatan' => $this->model->getAllData('tb_jabatan'),
                    'page' => $page,
                    'jns' => $jns,
                    'nomor_surat' => $this->modelBo->kodeSurat() . '/' . $this->modelBo->lastNumberCustom($jns, 1) . '/SRT/' . $jns . '/APTI/' . $this->getRomawi(DATE('m')) . '/' . date('Y'),
                ];

                $this->renderView($data, $page);

                break;

            case 'add':

                $isi = [
                    "qrgen" => $this->request->getPost('qrgen'),
                    "img_ttd" => $this->request->getPost('img_ttd'),
                    "kegiatan" => $this->request->getPost('kegiatan'),
                    "keterangan" => $this->request->getPost('keterangan'),
                    "lokasi_kegiatan" => $this->request->getPost('lokasi_kegiatan'),
                    "tanggal_mulai" => $this->request->getPost('tanggal_mulai'),
                    "tanggal_selesai" => $this->request->getPost('tanggal_selesai'),
                    "no_1" => $this->request->getPost('no_1'),
                    "nama_1" => $this->request->getPost('nama_1'),
                    "jabatan_1" => $this->request->getPost('jabatan_1'),
                    "nip_1" => $this->request->getPost('nip_1'),
                    "no_2" => $this->request->getPost('no_2'),
                    "nama_2" => $this->request->getPost('nama_2'),
                    "jabatan_2" => $this->request->getPost('jabatan_2'),
                    "nip_2" => $this->request->getPost('nip_2'),
                    "no_3" => $this->request->getPost('no_3'),
                    "nama_3" => $this->request->getPost('nama_3'),
                    "jabatan_3" => $this->request->getPost('jabatan_3'),
                    "nip_3" => $this->request->getPost('nip_3'),
                    "no_4" => $this->request->getPost('no_4'),
                    "nama_4" => $this->request->getPost('nama_4'),
                    "jabatan_4" => $this->request->getPost('jabatan_4'),
                    "nip_4" => $this->request->getPost('nip_4'),
                    "no_5" => $this->request->getPost('no_5'),
                    "nama_5" => $this->request->getPost('nama_5'),
                    "jabatan_5" => $this->request->getPost('jabatan_5'),
                    "nip_5" => $this->request->getPost('nip_5'),
                    "no_6" => $this->request->getPost('no_6'),
                    "nama_6" => $this->request->getPost('nama_6'),
                    "jabatan_6" => $this->request->getPost('jabatan_6'),
                    "nip_6" => $this->request->getPost('nip_6'),
                    "no_7" => $this->request->getPost('no_7'),
                    "nama_7" => $this->request->getPost('nama_7'),
                    "jabatan_7" => $this->request->getPost('jabatan_7'),
                    "nip_7" => $this->request->getPost('nip_7'),
                ];

                $isiSurat = json_encode($isi);
                $xttd = json_encode($this->chooseTtd($this->request->getPost('mengetahui')));

                $insertData = [
                    'jenis_surat' => $jns,
                    'no_surat' => $this->request->getPost('nomor_surat'),
                    'nama_surat' => $menu['nama_menu'],
                    'tanggal' => date('Y-m-d'),
                    'qrgen' => $this->request->getPost('qrgen'),
                    'isi_surat' => $this->gantikutip($isiSurat),
                    'tanda_tangan' => $xttd,
                    'createdon' => date('Y-m-d H:i:s'),
                    'createdby' => session()->get('fullname'),
                    'rowstatus' => 1,
                ];

                $this->generateQrcode($this->request->getPost('qrgen'));
                $this->model->insertData('tb_surat', $insertData);

                return redirect()->to('surat/menuSurat?page=' . $page . '&jns=' . encrypt_data($jns) . '&action=' . encrypt_data('view'))->with('success', 'Data berhasil di tambah');

                break;

            case 'edit':

                $id['id_surat'] = $this->request->getPost('id_surat');
                $id_surat = $this->request->getPost('id_surat');

                $isi = [
                    "qrgen" => $this->request->getPost('qrgen'),
                    "img_ttd" => $this->request->getPost('img_ttd'),
                    "kegiatan" => $this->request->getPost('kegiatan'),
                    "keterangan" => $this->request->getPost('keterangan'),
                    "lokasi_kegiatan" => $this->request->getPost('lokasi_kegiatan'),
                    "tanggal_mulai" => $this->request->getPost('tanggal_mulai'),
                    "tanggal_selesai" => $this->request->getPost('tanggal_selesai'),
                    "no_1" => $this->request->getPost('no_1'),
                    "nama_1" => $this->request->getPost('nama_1'),
                    "jabatan_1" => $this->request->getPost('jabatan_1'),
                    "nip_1" => $this->request->getPost('nip_1'),
                    "no_2" => $this->request->getPost('no_2'),
                    "nama_2" => $this->request->getPost('nama_2'),
                    "jabatan_2" => $this->request->getPost('jabatan_2'),
                    "nip_2" => $this->request->getPost('nip_2'),
                    "no_3" => $this->request->getPost('no_3'),
                    "nama_3" => $this->request->getPost('nama_3'),
                    "jabatan_3" => $this->request->getPost('jabatan_3'),
                    "nip_3" => $this->request->getPost('nip_3'),
                    "no_4" => $this->request->getPost('no_4'),
                    "nama_4" => $this->request->getPost('nama_4'),
                    "jabatan_4" => $this->request->getPost('jabatan_4'),
                    "nip_4" => $this->request->getPost('nip_4'),
                    "no_5" => $this->request->getPost('no_5'),
                    "nama_5" => $this->request->getPost('nama_5'),
                    "jabatan_5" => $this->request->getPost('jabatan_5'),
                    "nip_5" => $this->request->getPost('nip_5'),
                    "no_6" => $this->request->getPost('no_6'),
                    "nama_6" => $this->request->getPost('nama_6'),
                    "jabatan_6" => $this->request->getPost('jabatan_6'),
                    "nip_6" => $this->request->getPost('nip_6'),
                    "no_7" => $this->request->getPost('no_7'),
                    "nama_7" => $this->request->getPost('nama_7'),
                    "jabatan_7" => $this->request->getPost('jabatan_7'),
                    "nip_7" => $this->request->getPost('nip_7'),
                ];

                $isiSurat = json_encode($isi);
                $xttd = json_encode($this->chooseTtd($this->request->getPost('mengetahui')));

                $updateData = [
                    'jenis_surat' => $jns,
                    'no_surat' => $this->request->getPost('nomor_surat'),
                    'nama_surat' => $menu['nama_menu'],
                    'tanggal' => date('Y-m-d'),
                    'qrgen' => $this->request->getPost('qrgen'),
                    'isi_surat' => $this->gantikutip($isiSurat),
                    'tanda_tangan' => $xttd,
                    'kategori_barang' => $this->request->getPost('kategori_barang'),
                ];

                $this->model->updateData('tb_surat', $updateData, $id);
                return redirect()->to('surat/menuSurat?page=' . $page . '&jns=' . encrypt_data($jns) . '&action=' . encrypt_data('view'))->with('success', 'Data berhasil di edit');

                break;

            case 'cetakSurat':

                $id['id_surat'] = $this->request->getGet('idx');

                $row_surat = $this->model->getSelectedData('tb_surat', $id)->getRowArray();
                $row_isiSurat = json_decode($row_surat['isi_surat']);

                $viewFile = $page;
                $outFileName = 'SURAT TUGAS_' . $row_surat['qrgen'] . '_' . date('d-m-Y') . '.pdf';

                $configLayout = [
                    'title' => 'Cetak Surat',
                    'orientation' => 'P',
                    'format' => 'F4',
                    'lang' => 'en',
                    'unicode' => false,
                    'encoding' => 'ISO-8859-15',
                    'margin' => [0, 8, 23, 0],
                    'output' => 'I',
                ];

                $this->renderPdf($id, $viewFile, $outFileName, $configLayout);

                break;

            case 'uploadScan':

                $id_surat = $this->request->getPost('id_surat');
                $id['id_surat'] = $this->request->getPost('id_surat');

                $docupload = ['file_scan'];
                $filePath = WRITEPATH . 'files/scanpdf/';
                $fileName = $jns . '-' . $id_surat . '.pdf';

                return $this->uploadScanSurat($id, $docupload, $filePath, $fileName, $page, $jns);

                break;
        }
    }

    private function inaproc($page, $jns, $action, $menu)
    {
        switch ($action) {
            case 'view':

                $dt_surat = $this->model->getSelectedData('tb_surat', ['jenis_surat' => $jns, 'rowstatus' => 1, 'arsip' => null])->getResultArray();

                $data = [
                    'title' => (!empty($menu)) ? $menu['nama_menu'] : 'Surat Sisuro',
                    'active_surat' => 'active',
                    'dt_surat' => $dt_surat,
                    'dt_arsip' => $this->model->getSelectedData('tb_surat', ['jenis_surat' => $jns, 'rowstatus' => 2, 'arsip' => null])->getResultArray(),
                    'qrgen' => $this->randomString(5),
                    'dt_jabatan' => $this->model->getAllData('tb_jabatan'),
                    'dt_kabupaten' => $this->model->getAllData('tb_kabupaten'),
                    'tb_provinsi' => $this->model->getAllData('tb_provinsi'),
                    'dt_garansi' => $this->model->getSelectedData('tb_sertifikat_garansi', ['rowstatus' => 1])->getResult(),
                    'dt_satuan' => $this->model->getAllData('tb_satuan'),
                    'page' => $page,
                    'jns' => $jns,
                    'nomor_surat' => $this->modelBo->kodeSurat() . '/' . $this->modelBo->lastNumberCustom($jns, 7) . '/SRT/' . $jns . '/APTI/',
                    'sphp' => $this->modelBo->kodeSurat() . '/' . $this->modelBo->lastNumberCustom($jns, 8) . '/SRT/SPHP-I/APTI/',
                    'sg' => $this->modelBo->kodeSurat() . '/' . $this->modelBo->lastNumberCustom($jns, 9) . '/SRT/SG-I/APTI/',
                    'sppp' => $this->modelBo->kodeSurat() . '/' . $this->modelBo->lastNumberCustom($jns, 10) . '/SRT/SPPP-I/APTI/',
                    'spp' => $this->modelBo->kodeSurat() . '/' . $this->modelBo->lastNumberCustom($jns, 11) . '/SRT/SPP-I/APTI/',
                    'inv' => $this->modelBo->kodeSurat() . '/' . $this->modelBo->lastNumberCustom($jns, 12) . '/SRT/INV-I/APTI/',
                    'kwn' => $this->modelBo->kodeSurat() . '/' . $this->modelBo->lastNumberCustom($jns, 13) . '/SRT/KWN-I/APTI/',
                ];

                $this->renderView($data, $page);

                break;

            case 'add':

                $rules = [
                    'kategori_barang' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Mohon isi Garansi Kategori Barang',
                        ]
                    ],
                ];

                if (!$this->validate($rules)) {
                    foreach ($this->validator->getErrors() as $e) {
                        return redirect()->to('surat/menuSurat?page=' . $page . '&jns=' . encrypt_data($jns) . '&action=' . encrypt_data('view'))->with('error', $e);
                    }
                }

                $isi = [
                    "qrgen" => $this->request->getPost('qrgen'),
                    "img_ttd" => $this->request->getPost('img_ttd'),
                    "nomor_surat" => $this->request->getPost('nomor_surat'),
                    "tgl_spb" => $this->request->getPost('tgl_spb'),
                    "sphp" => $this->request->getPost('sphp'),
                    "tgl_sphp" => $this->request->getPost('tgl_sphp'),
                    "sg" => $this->request->getPost('sg'),
                    "tgl_sg" => $this->request->getPost('tgl_sg'),
                    "sppp" => $this->request->getPost('sppp'),
                    "tgl_sppp" => $this->request->getPost('tgl_sppp'),
                    "spp" => $this->request->getPost('spp'),
                    "tgl_spp" => $this->request->getPost('tgl_spp'),
                    "inv" => $this->request->getPost('inv'),
                    "tgl_inv" => $this->request->getPost('tgl_inv'),
                    "kwn" => $this->request->getPost('kwn'),
                    "tgl_kwn" => $this->request->getPost('tgl_kwn'),
                    "mengetahui" => $this->request->getPost('mengetahui'),
                    "no_pemesanan" => $this->request->getPost('no_pemesanan'),
                    "tgl_pemesanan" => $this->request->getPost('tgl_pemesanan'),
                    "no_surat_pemesanan" => $this->request->getPost('no_surat_pemesanan'),
                    "tgl_surat_pemesanan" => $this->request->getPost('tgl_surat_pemesanan'),
                    "nama_ppk" => $this->request->getPost('nama_ppk'),
                    "divisi" => $this->request->getPost('divisi'),
                    "satuan_kerja" => $this->request->getPost('satuan_kerja'),
                    "alamat_pemesan" => $this->request->getPost('alamat_pemesan'),
                    "nama_kabupaten" => $this->request->getPost('nama_kabupaten'),
                    "nama_provinsi" => $this->request->getPost('nama_provinsi'),
                    "nama_instansi" => $this->request->getPost('nama_instansi'),
                    "npwp_satuan_kerja" => $this->request->getPost('npwp_satuan_kerja'),
                    "permintaan_tiba" => $this->request->getPost('permintaan_tiba'),
                    "perlu_dikirim_sebelum" => $this->request->getPost('perlu_dikirim_sebelum'),
                    "mulai_dikirim" => $this->request->getPost('mulai_dikirim'),
                    "estimasi_tiba" => $this->request->getPost('estimasi_tiba'),
                    "catatan_permintaan_tiba" => $this->request->getPost('catatan_permintaan_tiba'),
                    "pembayaran" => $this->request->getPost('pembayaran'),
                    "pengiriman" => $this->request->getPost('pengiriman'),
                    "nama_penerima" => $this->request->getPost('nama_penerima'),
                    "alamat_pengiriman" => $this->request->getPost('alamat_pengiriman'),
                    "notlp_penerima" => $this->request->getPost('notlp_penerima'),
                    "catatan_alamat_pengiriman" => $this->request->getPost('catatan_alamat_pengiriman'),
                    "vendor_pengiriman" => $this->request->getPost('vendor_pengiriman'),
                    "no_transaksi" => $this->request->getPost('no_transaksi'),
                    "no_resi" => $this->request->getPost('no_resi'),
                    "tanggal_pengiriman" => $this->request->getPost('tanggal_pengiriman'),
                    "kategori_barang" => $this->request->getPost('kategori_barang'),
                    "no_1" => $this->request->getPost('no_1'),
                    "nama_barang_1" => $this->request->getPost('nama_barang_1'),
                    "jumlah_1" => $this->request->getPost('jumlah_1'),
                    "satuan_1" => $this->request->getPost('satuan_1'),
                    "harga_1" => $this->request->getPost('harga_1'),
                    "total_harga_1" => $this->request->getPost('total_harga_1'),
                    "no_2" => $this->request->getPost('no_2'),
                    "nama_barang_2" => $this->request->getPost('nama_barang_2'),
                    "jumlah_2" => $this->request->getPost('jumlah_2'),
                    "satuan_2" => $this->request->getPost('satuan_2'),
                    "harga_2" => $this->request->getPost('harga_2'),
                    "total_harga_2" => $this->request->getPost('total_harga_2'),
                    "no_3" => $this->request->getPost('no_3'),
                    "nama_barang_3" => $this->request->getPost('nama_barang_3'),
                    "jumlah_3" => $this->request->getPost('jumlah_3'),
                    "satuan_3" => $this->request->getPost('satuan_3'),
                    "harga_3" => $this->request->getPost('harga_3'),
                    "total_harga_3" => $this->request->getPost('total_harga_3'),
                    "no_4" => $this->request->getPost('no_4'),
                    "nama_barang_4" => $this->request->getPost('nama_barang_4'),
                    "jumlah_4" => $this->request->getPost('jumlah_4'),
                    "satuan_4" => $this->request->getPost('satuan_4'),
                    "harga_4" => $this->request->getPost('harga_4'),
                    "total_harga_4" => $this->request->getPost('total_harga_4'),
                    "no_5" => $this->request->getPost('no_5'),
                    "nama_barang_5" => $this->request->getPost('nama_barang_5'),
                    "jumlah_5" => $this->request->getPost('jumlah_5'),
                    "satuan_5" => $this->request->getPost('satuan_5'),
                    "harga_5" => $this->request->getPost('harga_5'),
                    "total_harga_5" => $this->request->getPost('total_harga_5'),
                    "no_6" => $this->request->getPost('no_6'),
                    "nama_barang_6" => $this->request->getPost('nama_barang_6'),
                    "jumlah_6" => $this->request->getPost('jumlah_6'),
                    "satuan_6" => $this->request->getPost('satuan_6'),
                    "harga_6" => $this->request->getPost('harga_6'),
                    "total_harga_6" => $this->request->getPost('total_harga_6'),
                    "no_7" => $this->request->getPost('no_7'),
                    "nama_barang_7" => $this->request->getPost('nama_barang_7'),
                    "jumlah_7" => $this->request->getPost('jumlah_7'),
                    "satuan_7" => $this->request->getPost('satuan_7'),
                    "harga_7" => $this->request->getPost('harga_7'),
                    "total_harga_7" => $this->request->getPost('total_harga_7'),
                    "harga_ongkir" => $this->request->getPost('harga_ongkir'),
                    "total_harga_ongkir" => $this->request->getPost('total_harga_ongkir'),
                    "total_all" => $this->request->getPost('total_all'),
                ];

                $isiSurat = json_encode($isi);
                $xttd = json_encode($this->chooseTtd($this->request->getPost('mengetahui')));

                $insertData = [
                    'jenis_surat' => $jns,
                    'no_surat' => $this->request->getPost('nomor_surat'),
                    'nama_surat' => $menu['nama_menu'],
                    'tanggal' => date('Y-m-d'),
                    'qrgen' => $this->request->getPost('qrgen'),
                    'isi_surat' => $this->gantikutip($isiSurat),
                    'tanda_tangan' => $xttd,
                    'createdon' => date('Y-m-d H:i:s'),
                    'createdby' => session()->get('fullname'),
                    'rowstatus' => 1,
                ];

                $this->generateQrcode($this->request->getPost('qrgen'));
                $this->model->insertData('tb_surat', $insertData);

                return redirect()->to('surat/menuSurat?page=' . $page . '&jns=' . encrypt_data($jns) . '&action=' . encrypt_data('view'))->with('success', 'Data berhasil di tambah');

                break;

            case 'edit':

                $id['id_surat'] = $this->request->getPost('id_surat');
                $id_surat = $this->request->getPost('id_surat');

                $isi = [
                    "qrgen" => $this->request->getPost('qrgen'),
                    "img_ttd" => $this->request->getPost('img_ttd'),
                    "nomor_surat" => $this->request->getPost('nomor_surat'),
                    "tgl_spb" => $this->request->getPost('tgl_spb'),
                    "sphp" => $this->request->getPost('sphp'),
                    "tgl_sphp" => $this->request->getPost('tgl_sphp'),
                    "sg" => $this->request->getPost('sg'),
                    "tgl_sg" => $this->request->getPost('tgl_sg'),
                    "sppp" => $this->request->getPost('sppp'),
                    "tgl_sppp" => $this->request->getPost('tgl_sppp'),
                    "spp" => $this->request->getPost('spp'),
                    "tgl_spp" => $this->request->getPost('tgl_spp'),
                    "inv" => $this->request->getPost('inv'),
                    "tgl_inv" => $this->request->getPost('tgl_inv'),
                    "kwn" => $this->request->getPost('kwn'),
                    "tgl_kwn" => $this->request->getPost('tgl_kwn'),
                    "mengetahui" => $this->request->getPost('mengetahui'),
                    "no_pemesanan" => $this->request->getPost('no_pemesanan'),
                    "tgl_pemesanan" => $this->request->getPost('tgl_pemesanan'),
                    "no_surat_pemesanan" => $this->request->getPost('no_surat_pemesanan'),
                    "tgl_surat_pemesanan" => $this->request->getPost('tgl_surat_pemesanan'),
                    "nama_ppk" => $this->request->getPost('nama_ppk'),
                    "divisi" => $this->request->getPost('divisi'),
                    "satuan_kerja" => $this->request->getPost('satuan_kerja'),
                    "alamat_pemesan" => $this->request->getPost('alamat_pemesan'),
                    "nama_kabupaten" => $this->request->getPost('nama_kabupaten'),
                    "nama_provinsi" => $this->request->getPost('nama_provinsi'),
                    "nama_instansi" => $this->request->getPost('nama_instansi'),
                    "npwp_satuan_kerja" => $this->request->getPost('npwp_satuan_kerja'),
                    "permintaan_tiba" => $this->request->getPost('permintaan_tiba'),
                    "perlu_dikirim_sebelum" => $this->request->getPost('perlu_dikirim_sebelum'),
                    "mulai_dikirim" => $this->request->getPost('mulai_dikirim'),
                    "estimasi_tiba" => $this->request->getPost('estimasi_tiba'),
                    "catatan_permintaan_tiba" => $this->request->getPost('catatan_permintaan_tiba'),
                    "pembayaran" => $this->request->getPost('pembayaran'),
                    "pengiriman" => $this->request->getPost('pengiriman'),
                    "nama_penerima" => $this->request->getPost('nama_penerima'),
                    "alamat_pengiriman" => $this->request->getPost('alamat_pengiriman'),
                    "notlp_penerima" => $this->request->getPost('notlp_penerima'),
                    "catatan_alamat_pengiriman" => $this->request->getPost('catatan_alamat_pengiriman'),
                    "vendor_pengiriman" => $this->request->getPost('vendor_pengiriman'),
                    "no_transaksi" => $this->request->getPost('no_transaksi'),
                    "no_resi" => $this->request->getPost('no_resi'),
                    "tanggal_pengiriman" => $this->request->getPost('tanggal_pengiriman'),
                    "kategori_barang" => $this->request->getPost('kategori_barang'),
                    "no_1" => $this->request->getPost('no_1'),
                    "nama_barang_1" => $this->request->getPost('nama_barang_1'),
                    "jumlah_1" => $this->request->getPost('jumlah_1'),
                    "satuan_1" => $this->request->getPost('satuan_1'),
                    "harga_1" => $this->request->getPost('harga_1'),
                    "total_harga_1" => $this->request->getPost('total_harga_1'),
                    "no_2" => $this->request->getPost('no_2'),
                    "nama_barang_2" => $this->request->getPost('nama_barang_2'),
                    "jumlah_2" => $this->request->getPost('jumlah_2'),
                    "satuan_2" => $this->request->getPost('satuan_2'),
                    "harga_2" => $this->request->getPost('harga_2'),
                    "total_harga_2" => $this->request->getPost('total_harga_2'),
                    "no_3" => $this->request->getPost('no_3'),
                    "nama_barang_3" => $this->request->getPost('nama_barang_3'),
                    "jumlah_3" => $this->request->getPost('jumlah_3'),
                    "satuan_3" => $this->request->getPost('satuan_3'),
                    "harga_3" => $this->request->getPost('harga_3'),
                    "total_harga_3" => $this->request->getPost('total_harga_3'),
                    "no_4" => $this->request->getPost('no_4'),
                    "nama_barang_4" => $this->request->getPost('nama_barang_4'),
                    "jumlah_4" => $this->request->getPost('jumlah_4'),
                    "satuan_4" => $this->request->getPost('satuan_4'),
                    "harga_4" => $this->request->getPost('harga_4'),
                    "total_harga_4" => $this->request->getPost('total_harga_4'),
                    "no_5" => $this->request->getPost('no_5'),
                    "nama_barang_5" => $this->request->getPost('nama_barang_5'),
                    "jumlah_5" => $this->request->getPost('jumlah_5'),
                    "satuan_5" => $this->request->getPost('satuan_5'),
                    "harga_5" => $this->request->getPost('harga_5'),
                    "total_harga_5" => $this->request->getPost('total_harga_5'),
                    "no_6" => $this->request->getPost('no_6'),
                    "nama_barang_6" => $this->request->getPost('nama_barang_6'),
                    "jumlah_6" => $this->request->getPost('jumlah_6'),
                    "satuan_6" => $this->request->getPost('satuan_6'),
                    "harga_6" => $this->request->getPost('harga_6'),
                    "total_harga_6" => $this->request->getPost('total_harga_6'),
                    "no_7" => $this->request->getPost('no_7'),
                    "nama_barang_7" => $this->request->getPost('nama_barang_7'),
                    "jumlah_7" => $this->request->getPost('jumlah_7'),
                    "satuan_7" => $this->request->getPost('satuan_7'),
                    "harga_7" => $this->request->getPost('harga_7'),
                    "total_harga_7" => $this->request->getPost('total_harga_7'),
                    "harga_ongkir" => $this->request->getPost('harga_ongkir'),
                    "total_harga_ongkir" => $this->request->getPost('total_harga_ongkir'),
                    "total_all" => $this->request->getPost('total_all'),
                ];

                $isiSurat = json_encode($isi);
                $xttd = json_encode($this->chooseTtd($this->request->getPost('mengetahui')));

                $updateData = [
                    'jenis_surat' => $jns,
                    'no_surat' => $this->request->getPost('nomor_surat'),
                    'nama_surat' => $menu['nama_menu'],
                    'tanggal' => date('Y-m-d'),
                    'qrgen' => $this->request->getPost('qrgen'),
                    'isi_surat' => $this->gantikutip($isiSurat),
                    'tanda_tangan' => $xttd,
                    'kategori_barang' => $this->request->getPost('kategori_barang'),
                ];

                $this->model->updateData('tb_surat', $updateData, $id);
                return redirect()->to('surat/menuSurat?page=' . $page . '&jns=' . encrypt_data($jns) . '&action=' . encrypt_data('view'))->with('success', 'Data berhasil di edit');

                break;

            case 'cetakSurat':

                $id['id_surat'] = $this->request->getGet('idx');

                $row_surat = $this->model->getSelectedData('tb_surat', $id)->getRowArray();
                $row_isiSurat = json_decode($row_surat['isi_surat']);

                $viewFile = $page;
                $outFileName = 'DOKUMEN EKATALOG_' . $row_surat['qrgen'] . '_' . date('d-m-Y') . '.pdf';

                $configLayout = [
                    'title' => 'Cetak Surat',
                    'orientation' => 'P',
                    'format' => 'Folio',
                    'lang' => 'en',
                    'unicode' => false,
                    'encoding' => 'ISO-8859-15',
                    'margin' => [12, 6, 11, 7],
                    'output' => 'I',
                ];

                $this->renderPdf($id, $viewFile, $outFileName, $configLayout);

                break;

            case 'uploadScan':

                $id_surat = $this->request->getPost('id_surat');
                $id['id_surat'] = $this->request->getPost('id_surat');

                $docupload = ['file_scan'];
                $filePath = WRITEPATH . 'files/scanpdf/';
                $fileName = $jns . '-' . $id_surat . '.pdf';

                return $this->uploadScanSurat($id, $docupload, $filePath, $fileName, $page, $jns);

                break;
        }
    }

    private function invoice_pemerintah($page, $jns, $action, $menu)
    {
        switch ($action) {
            case 'view':

                $dt_surat = $this->model->getSelectedData('tb_surat', ['jenis_surat' => $jns, 'rowstatus' => 1, 'arsip' => null])->getResultArray();

                $data = [
                    'title' => (!empty($menu)) ? $menu['nama_menu'] : 'Surat Sisuro',
                    'active_surat' => 'active',
                    'dt_surat' => $dt_surat,
                    'dt_arsip' => $this->model->getSelectedData('tb_surat', ['jenis_surat' => $jns, 'rowstatus' => 2, 'arsip' => null])->getResultArray(),
                    'qrgen' => $this->randomString(5),
                    'dt_jabatan' => $this->model->getAllData('tb_jabatan'),
                    'dt_kabupaten' => $this->model->getAllData('tb_kabupaten'),
                    'tb_provinsi' => $this->model->getAllData('tb_provinsi'),
                    'dt_garansi' => $this->model->getSelectedData('tb_sertifikat_garansi', ['rowstatus' => 1])->getResult(),
                    'dt_satuan' => $this->model->getAllData('tb_satuan'),
                    'page' => $page,
                    'jns' => $jns,
                    'nomor_surat' => $this->modelBo->kodeSurat() . '/' . $this->modelBo->lastNumberCustom($jns, 7) . '/SRT/' . $jns . '/APTI/' . $this->getRomawi(date('m')) . date('Y'),
                ];

                $this->renderView($data, $page);

                break;
            case 'add':

                $isi = [
                    "qrgen" => $this->request->getPost('qrgen'),
                    "img_ttd" => $this->request->getPost('img_ttd'),
                    "mengetahui" => $this->request->getPost('mengetahui'),
                    "nama_client" => $this->request->getPost('nama_client'),
                    "alamat_client" => $this->request->getPost('alamat_client'),
                    "kota_client" => $this->request->getPost('kota_client'),
                    "no_tlp" => $this->request->getPost('no_tlp'),
                    "email" => $this->request->getPost('email'),
                    "noted" => $this->request->getPost('noted'),
                    "no_1" => $this->request->getPost('no_1'),
                    "nama_barang_1" => $this->request->getPost('nama_barang_1'),
                    "jumlah_1" => $this->request->getPost('jumlah_1'),
                    "satuan_1" => $this->request->getPost('satuan_1'),
                    "harga_1" => $this->request->getPost('harga_1'),
                    "total_harga_1" => $this->request->getPost('total_harga_1'),
                    "no_2" => $this->request->getPost('no_2'),
                    "nama_barang_2" => $this->request->getPost('nama_barang_2'),
                    "jumlah_2" => $this->request->getPost('jumlah_2'),
                    "satuan_2" => $this->request->getPost('satuan_2'),
                    "harga_2" => $this->request->getPost('harga_2'),
                    "total_harga_2" => $this->request->getPost('total_harga_2'),
                    "no_3" => $this->request->getPost('no_3'),
                    "nama_barang_3" => $this->request->getPost('nama_barang_3'),
                    "jumlah_3" => $this->request->getPost('jumlah_3'),
                    "satuan_3" => $this->request->getPost('satuan_3'),
                    "harga_3" => $this->request->getPost('harga_3'),
                    "total_harga_3" => $this->request->getPost('total_harga_3'),
                    "no_4" => $this->request->getPost('no_4'),
                    "nama_barang_4" => $this->request->getPost('nama_barang_4'),
                    "jumlah_4" => $this->request->getPost('jumlah_4'),
                    "satuan_4" => $this->request->getPost('satuan_4'),
                    "harga_4" => $this->request->getPost('harga_4'),
                    "total_harga_4" => $this->request->getPost('total_harga_4'),
                    "no_5" => $this->request->getPost('no_5'),
                    "nama_barang_5" => $this->request->getPost('nama_barang_5'),
                    "jumlah_5" => $this->request->getPost('jumlah_5'),
                    "satuan_5" => $this->request->getPost('satuan_5'),
                    "harga_5" => $this->request->getPost('harga_5'),
                    "total_harga_5" => $this->request->getPost('total_harga_5'),
                    "no_6" => $this->request->getPost('no_6'),
                    "nama_barang_6" => $this->request->getPost('nama_barang_6'),
                    "jumlah_6" => $this->request->getPost('jumlah_6'),
                    "satuan_6" => $this->request->getPost('satuan_6'),
                    "harga_6" => $this->request->getPost('harga_6'),
                    "total_harga_6" => $this->request->getPost('total_harga_6'),
                    "no_7" => $this->request->getPost('no_7'),
                    "nama_barang_7" => $this->request->getPost('nama_barang_7'),
                    "jumlah_7" => $this->request->getPost('jumlah_7'),
                    "satuan_7" => $this->request->getPost('satuan_7'),
                    "harga_7" => $this->request->getPost('harga_7'),
                    "total_harga_7" => $this->request->getPost('total_harga_7'),
                    "no_8" => $this->request->getPost('no_8'),
                    "nama_barang_8" => $this->request->getPost('nama_barang_8'),
                    "jumlah_8" => $this->request->getPost('jumlah_8'),
                    "satuan_8" => $this->request->getPost('satuan_8'),
                    "harga_8" => $this->request->getPost('harga_8'),
                    "total_harga_8" => $this->request->getPost('total_harga_8'),
                    "no_9" => $this->request->getPost('no_9'),
                    "nama_barang_9" => $this->request->getPost('nama_barang_9'),
                    "jumlah_9" => $this->request->getPost('jumlah_9'),
                    "satuan_9" => $this->request->getPost('satuan_9'),
                    "harga_9" => $this->request->getPost('harga_9'),
                    "total_harga_9" => $this->request->getPost('total_harga_9'),
                    "no_10" => $this->request->getPost('no_10'),
                    "nama_barang_10" => $this->request->getPost('nama_barang_10'),
                    "jumlah_10" => $this->request->getPost('jumlah_10'),
                    "satuan_10" => $this->request->getPost('satuan_10'),
                    "harga_10" => $this->request->getPost('harga_10'),
                    "total_harga_10" => $this->request->getPost('total_harga_10'),
                    "total_sementara" => $this->request->getPost('total_sementara'),
                    "no_diskon" => $this->request->getPost('no_diskon'),
                    "persen_diskon" => $this->request->getPost('persen_diskon'),
                    "diskon" => $this->request->getPost('diskon'),
                    "no_uang_muka" => $this->request->getPost('no_uang_muka'),
                    "persen_uang_muka" => $this->request->getPost('persen_uang_muka'),
                    "uang_muka" => $this->request->getPost('uang_muka'),
                    "total_all" => $this->request->getPost('total_all'),
                ];

                $isiSurat = json_encode($isi);
                $xttd = json_encode($this->chooseTtd($this->request->getPost('mengetahui')));

                $insertData = [
                    'jenis_surat' => $jns,
                    'no_surat' => $this->request->getPost('nomor_surat'),
                    'nama_surat' => $menu['nama_menu'],
                    'tanggal' => date('Y-m-d'),
                    'qrgen' => $this->request->getPost('qrgen'),
                    'isi_surat' => $this->gantikutip($isiSurat),
                    'tanda_tangan' => $xttd,
                    'createdon' => date('Y-m-d H:i:s'),
                    'createdby' => session()->get('fullname'),
                    'rowstatus' => 1,
                ];

                $this->generateQrcode($this->request->getPost('qrgen'));
                $this->model->insertData('tb_surat', $insertData);

                return redirect()->to('surat/menuSurat?page=' . $page . '&jns=' . encrypt_data($jns) . '&action=' . encrypt_data('view'))->with('success', 'Data berhasil di tambah');

                break;

            case 'edit':

                $id['id_surat'] = $this->request->getPost('id_surat');
                $id_surat = $this->request->getPost('id_surat');

                $isi = [
                    "qrgen" => $this->request->getPost('qrgen'),
                    "img_ttd" => $this->request->getPost('img_ttd'),
                    "mengetahui" => $this->request->getPost('mengetahui'),
                    "nama_client" => $this->request->getPost('nama_client'),
                    "alamat_client" => $this->request->getPost('alamat_client'),
                    "kota_client" => $this->request->getPost('kota_client'),
                    "no_tlp" => $this->request->getPost('no_tlp'),
                    "email" => $this->request->getPost('email'),
                    "noted" => $this->request->getPost('noted'),
                    "no_1" => $this->request->getPost('no_1'),
                    "nama_barang_1" => $this->request->getPost('nama_barang_1'),
                    "jumlah_1" => $this->request->getPost('jumlah_1'),
                    "satuan_1" => $this->request->getPost('satuan_1'),
                    "harga_1" => $this->request->getPost('harga_1'),
                    "total_harga_1" => $this->request->getPost('total_harga_1'),
                    "no_2" => $this->request->getPost('no_2'),
                    "nama_barang_2" => $this->request->getPost('nama_barang_2'),
                    "jumlah_2" => $this->request->getPost('jumlah_2'),
                    "satuan_2" => $this->request->getPost('satuan_2'),
                    "harga_2" => $this->request->getPost('harga_2'),
                    "total_harga_2" => $this->request->getPost('total_harga_2'),
                    "no_3" => $this->request->getPost('no_3'),
                    "nama_barang_3" => $this->request->getPost('nama_barang_3'),
                    "jumlah_3" => $this->request->getPost('jumlah_3'),
                    "satuan_3" => $this->request->getPost('satuan_3'),
                    "harga_3" => $this->request->getPost('harga_3'),
                    "total_harga_3" => $this->request->getPost('total_harga_3'),
                    "no_4" => $this->request->getPost('no_4'),
                    "nama_barang_4" => $this->request->getPost('nama_barang_4'),
                    "jumlah_4" => $this->request->getPost('jumlah_4'),
                    "satuan_4" => $this->request->getPost('satuan_4'),
                    "harga_4" => $this->request->getPost('harga_4'),
                    "total_harga_4" => $this->request->getPost('total_harga_4'),
                    "no_5" => $this->request->getPost('no_5'),
                    "nama_barang_5" => $this->request->getPost('nama_barang_5'),
                    "jumlah_5" => $this->request->getPost('jumlah_5'),
                    "satuan_5" => $this->request->getPost('satuan_5'),
                    "harga_5" => $this->request->getPost('harga_5'),
                    "total_harga_5" => $this->request->getPost('total_harga_5'),
                    "no_6" => $this->request->getPost('no_6'),
                    "nama_barang_6" => $this->request->getPost('nama_barang_6'),
                    "jumlah_6" => $this->request->getPost('jumlah_6'),
                    "satuan_6" => $this->request->getPost('satuan_6'),
                    "harga_6" => $this->request->getPost('harga_6'),
                    "total_harga_6" => $this->request->getPost('total_harga_6'),
                    "no_7" => $this->request->getPost('no_7'),
                    "nama_barang_7" => $this->request->getPost('nama_barang_7'),
                    "jumlah_7" => $this->request->getPost('jumlah_7'),
                    "satuan_7" => $this->request->getPost('satuan_7'),
                    "harga_7" => $this->request->getPost('harga_7'),
                    "total_harga_7" => $this->request->getPost('total_harga_7'),
                    "no_8" => $this->request->getPost('no_8'),
                    "nama_barang_8" => $this->request->getPost('nama_barang_8'),
                    "jumlah_8" => $this->request->getPost('jumlah_8'),
                    "satuan_8" => $this->request->getPost('satuan_8'),
                    "harga_8" => $this->request->getPost('harga_8'),
                    "total_harga_8" => $this->request->getPost('total_harga_8'),
                    "no_9" => $this->request->getPost('no_9'),
                    "nama_barang_9" => $this->request->getPost('nama_barang_9'),
                    "jumlah_9" => $this->request->getPost('jumlah_9'),
                    "satuan_9" => $this->request->getPost('satuan_9'),
                    "harga_9" => $this->request->getPost('harga_9'),
                    "total_harga_9" => $this->request->getPost('total_harga_9'),
                    "no_10" => $this->request->getPost('no_10'),
                    "nama_barang_10" => $this->request->getPost('nama_barang_10'),
                    "jumlah_10" => $this->request->getPost('jumlah_10'),
                    "satuan_10" => $this->request->getPost('satuan_10'),
                    "harga_10" => $this->request->getPost('harga_10'),
                    "total_harga_10" => $this->request->getPost('total_harga_10'),
                    "total_sementara" => $this->request->getPost('total_sementara'),
                    "no_diskon" => $this->request->getPost('no_diskon'),
                    "persen_diskon" => $this->request->getPost('persen_diskon'),
                    "diskon" => $this->request->getPost('diskon'),
                    "no_uang_muka" => $this->request->getPost('no_uang_muka'),
                    "persen_uang_muka" => $this->request->getPost('persen_uang_muka'),
                    "uang_muka" => $this->request->getPost('uang_muka'),
                    "total_all" => $this->request->getPost('total_all'),
                ];

                $isiSurat = json_encode($isi);
                $xttd = json_encode($this->chooseTtd($this->request->getPost('mengetahui')));

                $updateData = [
                    'jenis_surat' => $jns,
                    'no_surat' => $this->request->getPost('nomor_surat'),
                    'nama_surat' => $menu['nama_menu'],
                    'tanggal' => date('Y-m-d'),
                    'qrgen' => $this->request->getPost('qrgen'),
                    'isi_surat' => $this->gantikutip($isiSurat),
                    'tanda_tangan' => $xttd,
                    'kategori_barang' => $this->request->getPost('kategori_barang'),
                ];

                $this->model->updateData('tb_surat', $updateData, $id);
                return redirect()->to('surat/menuSurat?page=' . $page . '&jns=' . encrypt_data($jns) . '&action=' . encrypt_data('view'))->with('success', 'Data berhasil di edit');

                break;

            case 'cetakSurat':

                $id['id_surat'] = $this->request->getGet('idx');

                $row_surat = $this->model->getSelectedData('tb_surat', $id)->getRowArray();
                $row_isiSurat = json_decode($row_surat['isi_surat']);

                $viewFile = $page;
                $outFileName = 'INVS_' . $row_surat['qrgen'] . '_' . date('d-m-Y') . '.pdf';

                $configLayout = [
                    'title' => 'Cetak Surat',
                    'orientation' => 'P',
                    'format' => 'Folio',
                    'lang' => 'en',
                    'unicode' => false,
                    'encoding' => 'ISO-8859-15',
                    'margin' => [10, 6, 9, 7],
                    'output' => 'I',
                ];

                $this->renderPdf($id, $viewFile, $outFileName, $configLayout);

                break;

            case 'uploadScan':

                $id_surat = $this->request->getPost('id_surat');
                $id['id_surat'] = $this->request->getPost('id_surat');

                $docupload = ['file_scan'];
                $filePath = WRITEPATH . 'files/scanpdf/';
                $fileName = $jns . '-' . $id_surat . '.pdf';

                return $this->uploadScanSurat($id, $docupload, $filePath, $fileName, $page, $jns);

                break;
        }
    }

    private function renderView($data, $page)
    {
        echo view('bo/pages/v_header', $data);
        echo view('bo/surat/menu/v_' . $page);
        echo view('bo/pages/v_footer');
    }

    private function renderPdf($id, $viewFile, $outFileName, $configLayout, $customData = [])
    {
        $row_surat = $this->model->getSelectedData('tb_surat', $id)->getRowArray();

        $dataDefault = [
            'title' => $configLayout['title'],
            'row_surat' => $row_surat,
            'model' => $this->model,
        ];

        $html = view('bo/surat/cetak/' . $viewFile, array_merge($dataDefault, $customData));

        ob_end_clean();
        $html2pdf = new Html2Pdf(
            $configLayout['orientation'],
            $configLayout['format'],
            $configLayout['lang'],
            $configLayout['unicode'],
            $configLayout['encoding'],
            $configLayout['margin']
        );
        $html2pdf->writeHTML($html);
        header('Content-Type: application/pdf');
        $html2pdf->output($outFileName, $configLayout['output']);
        exit;
    }

    private function uploadScanSurat($id, $docupload, $filePath, $fileName, $page, $jns)
    {
        $row_surat = $this->model->getSelectedData('tb_surat', $id)->getRowArray();

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

                if (!$this->validate($validationRule)) {
                    return redirect()->back()->withInput()->with('error', $this->validator->getErrors());
                }

                if ($fileupload->isValid() && !$fileupload->hasMoved()) {


                    if (!is_dir($filePath)) {
                        mkdir($filePath, 0777, TRUE);
                    }

                    if ($row_surat['file_scan'] !== null && $row_surat['file_scan'] !== '') {
                        unlink($filePath . $fileName);
                    }

                    $fileupload->move($filePath, $fileName);

                    $docuploadfile[$i] = array(
                        $i => $fileupload->getName(),
                    );
                    $this->model->updateData('tb_surat', $docuploadfile[$i], $id);
                }
            } else {
                // No file was uploaded
            }
        }

        return redirect()->to('surat/menuSurat?page=' . $page . '&jns=' . encrypt_data($jns) . '&action=' . encrypt_data('view'))->with('success', 'File berhasil di upload');
    }

    private function chooseTtd($mengetahui)
    {
        $row_ttd = $this->modelBo->cekTtd($mengetahui);
        if (empty($row_ttd) || $row_ttd == null) {
            redirect()->back()->with('error', 'Karyawan dengan Jabatan Marketing Tidak ditemukan')->send();
            exit;
        }

        if ($mengetahui != 1) {
            $head = 'An.' . strtoupper('KEPALA ' . $this->modelBo->nameCompany()['content']);
            $wakilkan = 1;
        } else {
            $head = strtoupper('KEPALA ' . $this->modelBo->nameCompany()['content']);
            $wakilkan = 0;
        }

        $ttd = array(
            "nama" => $row_ttd['nama_pegawai'],
            "nip" => $row_ttd['nip'],
            "jabatan" => strtoupper("$row_ttd[jabatan]"),
            "wakilkan" => $wakilkan,
            "head" => $head,
            "id_jabatan" => $mengetahui
        );

        return $ttd;
    }

    public function deleteSurat()
    {
        $id['id_surat'] = $this->request->getUri()->getSegment(3);
        $this->model->updateData('tb_surat', ['rowstatus' => 0], $id);
        return redirect()->back()->with('success', 'Data berhasil di hapus');
    }

    public function lihatScanSurat()
    {
        $id_surat = $this->request->getUri()->getSegment(3);
        $id['id_surat'] = $this->request->getUri()->getSegment(3);

        $row_surat = $this->model->getSelectedData('tb_surat', $id)->getRowArray();

        $filename = $row_surat['jenis_surat'] . '-' . $id_surat . '.pdf';

        $filePath = WRITEPATH . 'files/scanpdf/' . $filename;

        if (file_exists($filePath)) {
            return $this->response
                ->setHeader('Content-Type', 'application/pdf')
                ->setHeader('Content-Disposition', 'inline; filename="' . $filename . '"')
                ->setBody(file_get_contents($filePath));
        } else {
            return "File tidak ditemukan.";
        }
    }

    public function archive()
    {
        $id_surat = $this->request->getUri()->getSegment(3);
        $id['id_surat'] = $this->request->getUri()->getSegment(3);
        $this->model->updateData('tb_surat', ['rowstatus' => 2], $id);
        return redirect()->back()->with('success', 'Data berhasil di arsip');
    }
    public function unarchive()
    {
        $id_surat = $this->request->getUri()->getSegment(3);
        $id['id_surat'] = $this->request->getUri()->getSegment(3);
        $this->model->updateData('tb_surat', ['rowstatus' => 1], $id);
        return redirect()->back()->with('success', 'Data berhasil dikeluarkan dari arsip');
    }

    private function generateQrcode($code)
    {
        $qrCode = new QrCode($code);

        // Membuat instance PngWriter
        $writer = new PngWriter();

        $filePath = WRITEPATH . '/files/qrcode/';
        $filePathName = $filePath . 'qrcode-' . $code . '.png';

        if (!is_dir($filePath)) {
            mkdir($filePath, 0777, true);
        }

        // Menyimpan QR Code ke file
        $writer->write($qrCode)->saveToFile($filePathName);

        return $filePathName;
    }
}
