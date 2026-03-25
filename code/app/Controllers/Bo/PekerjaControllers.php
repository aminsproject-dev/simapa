<?php

namespace App\Controllers\Bo;

use App\Controllers\BaseController;

class PekerjaControllers extends BaseController
{
    public function index()
    {
        $builder = $this->model->getSelectedData('tb_pekerja', [], true)->orderBy('nama', 'ASC');

        $data = [
            'title' => 'Data Pekerja',
            'open_data' => 'show',
            'show_pekerja' => 'show',
            'active_pekerja' => 'active',
            'dt_pekerja' => $builder->get()->getResult(),
        ];
        echo view('bo/pages/v_header', $data);
        echo view('bo/pekerja/v_index_csv');
        echo view('bo/pages/v_footer');
    }

    public function export()
    {
        $builder = $this->model->getSelectedData('tb_pekerja', [], true)->orderBy('nama', 'ASC');
        $rows = $builder->get()->getResultArray();
        $filename = 'data_pekerja_' . date('YmdHis') . '.csv';

        header('Content-Type: text/csv: charset=utf-8');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Pragma: no-cache');
        header('Expiress: 0');

        $output = fopen('php://output', 'w');

        $header = [
            'nama',
            'id_status_kepegawaian',
            'id_jenis_tenaga_ahli',
            'id_kewarganegaraan',
            'nik_paspor',
            'npwp',
            'no_bpjs_kesehatan',
            'no_bpjs_ketenagakerjaan',
            'id_negara_tempat_lahir',
            'id_kabupaten_tempat_lahir',
            'tanggal_lahir',
            'jenis_kelamin',
            'email',
            'telepon',
            'website',
            'alamat',
            'id_provinsi_domisili',
            'id_kabupaten_domisili',
            'lama_pengalaman_kerja_tahun',
            'tingkat_bahasa_indonesia',
            'tingkat_bahasa_inggris',
            'tingkat_bahasa_setempat',
            'pendidikan_formal',
            'pendidikan_non_formal',
            'id_pendidikan_akhir',
            'profesi_keahlian',
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
            'title' => 'Import CSV Data Pekerja',
            'open_data' => 'show',
            'show_pekerja' => 'shpw',
            'active_pekerja' => 'active',
        ];
        echo view('bo/pages/v_header', $data);
        echo view('bo/pekerja/v_import_csv');
        echo view('bo/pages/v_footer');
    }

    public function importSave()
    {
        $file = $this->request->getFile('file_csv');
        if (!$file || !$file->isValid()) {
            return redirect()->back()->with('error', 'File tidak valid');
        }

        if (strtolower($file->getClientExtension()) !== 'csv') {
            return redirect()->back()->with('error', 'Format file harus .csv');
        }

        $path = $file->getTempName();
        $handle = fopen($path, 'r');
        if (!$handle) {
            return redirect()->back()->with('error', 'Gagal membuka file CSV');
        }

        $header = fgetcsv($handle, 0, ',');

        $insertBatch = [];
        while (($row = fgetcsv($handle, 0, ',')) !== false) {
            if (empty($row[0])) {
                continue;
            }

            $insertBatch[] = [
                'nama' => $row[0] ?? null,
                'id_status_kepegawaian' => $row[1] ?? null,
                'id_jenis_tenaga_ahli' => $row[2] ?? null,
                'id_kewarganegaraan' => $row[3] ?? null,
                'nik_paspor' => $row[4] ?? null,
                'npwp' => $row[5] ?? null,
                'no_bpjs_kesehatan' => $row[6] ?? null,
                'no_bpjs_ketenagakerjaan' => $row[7] ?? null,
                'id_negara_tempat_lahir' => $row[8] ?? null,
                'id_kabupaten_tempat_lahir' => $row[9] ?? null,
                'tanggal_lahir' => $row[10] ?? null,
                'jenis_kelamin' => $row[11] ?? null,
                'email' => $row[12] ?? null,
                'telepon' => $row[13] ?? null,
                'website' => $row[14] ?? null,
                'alamat' => $row[15] ?? null,
                'id_provinsi_domisili' => $row[16] ?? null,
                'id_kabupaten_domisili' => $row[17] ?? null,
                'lama_pengalaman_kerja_tahun' => $row[18] ?? null,
                'tingkat_bahasa_indonesia' => $row[19] ?? null,
                'tingkat_bahasa_inggris' => $row[20] ?? null,
                'tingkat_bahasa_setempat' => $row[21] ?? null,
                'pendidikan_formal' => $row[22] ?? null,
                'pendidikan_non_formal' => $row[23] ?? null,
                'id_pendidikan_akhir' => $row[24] ?? null,
                'profesi_keahlian' => $row[25] ?? null,
                'rowstatus' => 1,
                'createdon' => date('Y-m-d H:i:s'),
                'createdby' => session()->get('fullname'),
            ];
        }
        fclose($handle);

        if (!empty($insertBatch)) {
            foreach ($insertBatch as $ins) {
                $this->model->insertData('tb_pekerja', $ins);
            }
        }
        return redirect()->to('bo/pekerja')->with('success', 'Import CSV data pekerja berhasil');
    }
}
