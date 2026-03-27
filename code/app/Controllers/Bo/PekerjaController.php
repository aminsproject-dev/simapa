<?php

namespace App\Controllers\Bo;

use App\Controllers\BaseController;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;


class PekerjaController extends BaseController
{
    public function index()
    {
        $rows = $this->db->table('tb_pekerja')
            ->orderBy('nama', 'ASC')
            ->get()
            ->getResult();

        $data = [
            'title' => 'Data Pekerja',
            'open_data' => 'show',
            'show_pekerja' => 'show',
            'active_pekerja' => 'active',
            'dt_pekerja' => $rows,
        ];

        echo view('bo/pages/v_header', $data);
        echo view('bo/pekerja/v_index');
        echo view('bo/pages/v_footer');
    }

    public function export()
    {
        $rows = $this->db->table('tb_pekerja')
            ->orderBy('nama', 'ASC')
            ->get()
            ->getResultArray();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $headers = [
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

        $col = 'A';
        foreach ($headers as $header) {
            $sheet->setCellValue($col . '1', $header);
            $col++;
        }

        $rowNum = 2;
        foreach ($rows as $row) {
            $col = 'A';
            foreach ($headers as $field) {
                $sheet->setCellValue($col . $rowNum, $row[$field] ?? '');
                $col++;
            }
            $rowNum++;
        }

        $filename = 'data_pekerja_' . date('YmdHis') . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }

    public function importSave()
    {
        $file = $this->request->getFile('file_csv');

        if (! $file || ! $file->isValid()) {
            return redirect()->to('pekerja')->with('error', 'File tidak valid');
        }

        $ext = strtolower($file->getClientExtension());
        if (! in_array($ext, ['xlsx', 'xls'])) {
            return redirect()->to('pekerja')->with('error', 'Format file harus .xlsx atau .xls');
        }

        $path = $file->getTempName();

        try {
            $spreadsheet = IOFactory::load($path);
            $sheet = $spreadsheet->getActiveSheet();
            $rows = $sheet->toArray();

            array_shift($rows);

            $insertBatch = [];
            foreach ($rows as $row) {
                if (empty($row[0])) continue;

                $insertBatch[] = [
                    'nama' => $row[0]  ?? null,
                    'id_status_kepegawaian' => $row[1]  ?? null,
                    'id_jenis_tenaga_ahli' => $row[2]  ?? null,
                    'id_kewarganegaraan' => $row[3]  ?? null,
                    'nik_paspor' => $row[4]  ?? null,
                    'npwp' => $row[5]  ?? null,
                    'no_bpjs_kesehatan' => $row[6]  ?? null,
                    'no_bpjs_ketenagakerjaan' => $row[7]  ?? null,
                    'id_negara_tempat_lahir' => $row[8]  ?? null,
                    'id_kabupaten_tempat_lahir' => $row[9]  ?? null,
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
                ];
            }
            if (!empty($insertBatch)) {
                $this->db->table('tb_pekerja')->insertBatch($insertBatch);
            }

            return redirect()->to('pekerja')->with('success', 'Import Excel berhasil. Total ' . count($insertBatch) . ' data diimport.');
        } catch (\Exception $e) {
            return redirect()->to('pekerja')->with('error', 'Gagal membaca file Excel: ' . $e->getMessage());
        }
    }
}
