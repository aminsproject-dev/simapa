<?php

namespace App\Controllers\Bo;

use App\Controllers\BaseController;

class PengalamanPekerjaanControllers extends BaseController
{
    public function index()
    {
        $builder = $this->model->getSelectedData('tb_pengalaman_pekerjaan', [], true)->orderBy('tanggal_mulai', 'DESC');

        $data = [
            'title' => 'Data Pengalaman Perusahaan',
            'open_data' => 'show',
            'show_pengalaman' => 'show',
            'active_pengalaman' => 'active',
            'dt_pengalaman' => $builder->get()->getResult(),
        ];
        echo view('bo/pages/v_header', $data);
        echo view('bo/pengalaman/v_index_csv');
        echo view('bo/pages/v_footer');
    }

    public function export()
    {
        $builder = $this->model->getSelectedData('tb_pengalaman_pekerjaan', [], true)->orderBy('tanggal_mulai', 'DESC');

        $rows = $builder->get()->getResultArray();

        $filename = 'data_pengalaman_' . date('YmdHis') . '.csv';

        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Pragma: no-cache');
        header('Expires: 0');

        $output = fopen('php://output', 'w');

        $header = [
            'nama_kontrak',
            'nomor_kontrak',
            'tanggal_mulai',
            'tanggal_selesai',
            'tanggal_serah_terima',
            'nilai_kontrak',
            'id_kategori_pekerjaan',
            'persentase_pekerjaan',
            'uraian_pekerjaan',
            'ruang_lingkup_pekerjaan',
            'id_kbli',
            'alamat_pekerjaan',
            'id_negara_pekerjaan',
            'id_provinsi_pekerjaan',
            'id_kabupaten_pekerjaan',
            'id_jenis_instansi',
            'id_nama_instansi',
            'id_satuan_kerja',
            'id_provinsi_instansi',
            'id_kabupaten_instansi',
            'alamat_instansi',
            'telepon_instansi',
        ];
        fputcsv($output, $header);

        foreach ($rows as $r) {
            $line = [];
            foreach ($header as $field) {
                $line[] = $r[$field] ?? '';
            }
            fputcsv($output, $line);
        }
        fclose($output);
        exit;
    }

    public function import()
    {
        $data = [
            'title' => 'Import CSV Pengalaman Perusahaan',
            'open_data' => 'show',
            'show_pengalaman' => 'show',
            'actvie_pengalaman' => 'active',
        ];
        echo view('bo/pages/v_header', $data);
        echo view('bo/pengalaman/v_import_csx');
        echo view('bo/pages/v_footer');
    }

    public function importSave()
    {
        $file = $this->request->getFile('file_csv');
        if (!$file || !$file->isValid()) {
            return redirect()->back()->with('error', 'file tidak valid');
        }

        if (strtolower($file->getClientExtension()) !== 'csv') {
            return redirect()->back()->with('error', 'Format file harus .csv');
        }

        $path = $file->getTempName();
        $handle = fopen($path, 'r');
        if (!$handle) {
            return redirect()->back()->with('error', 'Gagal membuka file csv');
        }

        $header = fgetcsv($handle, 0, ',');
        $inserBatch = [];
        while (($row = fgetc($handle, 0, ',')) !== false) {
            if (empty($row[0])) {
                continue;
            }

            $inserBatch[] = [
                'nama_kontrak' => $row[0] ?? null,
                'nomor_kontrak' => $row[1] ?? null,
                'tanggal_mulai' => $row[2] ?? null,
                'tanggal_selesai' => $row[3] ?? null,
                'tanggal_serah_terima' => $row[4] ?? null,
                'nilai_kontrak' => $row[5] ?? null,
                'id_kategori_pekerjaan' => $row[6] ?? null,
                'persentase_pekerjaan' => $row[7] ?? null,
                'uraian_pekerjaan' => $row[8] ?? null,
                'ruang_lingkup_pekerjaan' => $row[9] ?? null,
                'id_kbli' => $row[10] ?? null,
                'alamat_pekerjaan' => $row[11] ?? null,
                'id_negara_pekerjaan' => $row[12] ?? null,
                'id_provinsi_pekerjaan' => $row[13] ?? null,
                'id_kabupaten_pekerjaan' => $row[14] ?? null,
                'id_jenis_instansi' => $row[15] ?? null,
                'id_nama_instansi' => $row[16] ?? null,
                'id_satuan_kerja' => $row[17] ?? null,
                'id_provinsi_instansi' => $row[18] ?? null,
                'id_kabupaten_instansi' => $row[19] ?? null,
                'alamat_instansi' => $row[20] ?? null,
                'telepon_instansi' => $row[21] ?? null,
                'rowstatus' => 1,
                'createdon' => date('Y-m-d H:i:s'),
                'createdby' => session()->get('fullname'),
            ];
        }
        fclose($handle);
        if (!empty($inserBatch)) {
            foreach ($inserBatch as $ins) {
                $this->model->insertData('tb_pengalaman_pekerjaan', $ins);
            }
        }
        return redirect()->to('bo/pengalaman')->with('success', 'Import csv pengalaman berhasil');
    }
}
