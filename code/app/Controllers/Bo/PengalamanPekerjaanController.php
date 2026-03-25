<?php

namespace App\Controllers\Bo;

use App\Controllers\BaseController;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

class PengalamanPekerjaanController extends BaseController
{
    public function index()
    {
        $rows = $this->db->table('tb_pengalaman_pekerjaan')
            ->orderBy('tanggal_mulai', 'DESC')
            ->get()
            ->getResult();

        $data = [
            'title' => 'Data Pengalaman Perusahaan',
            'open_data' => 'show',
            'show_pengalaman' => 'show',
            'active_pengalaman' => 'active',
            'dt_pengalaman' => $rows,
        ];

        echo view('bo/pages/v_header', $data);
        echo view('bo/pengalaman/v_index');
        echo view('bo/pages/v_footer');
    }

    public function export()
    {
        $rows = $this->db->table('tb_pengalaman_pekerjaan')
            ->orderBy('tanggal_mulai', 'DESC')
            ->get()
            ->getResultArray();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $headers = [
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

        $filename = 'data_pengalaman_' . date('YmdHis') . '.xlsx';

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
            return redirect()->to('pengalaman')->with('error', 'File tidak valid');
        }

        $ext = strtolower($file->getClientExtension());
        if (! in_array($ext, ['xlsx', 'xls'])) {
            return redirect()->to('pengalaman')->with('error', 'Format file harus .xlsx atau .xls');
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
                    'nama_kontrak' => $row[0]  ?? null,
                    'nomor_kontrak' => $row[1]  ?? null,
                    'tanggal_mulai' => $row[2]  ?? null,
                    'tanggal_selesai' => $row[3]  ?? null,
                    'tanggal_serah_terima' => $row[4]  ?? null,
                    'nilai_kontrak' => $row[5]  ?? null,
                    'id_kategori_pekerjaan' => $row[6]  ?? null,
                    'persentase_pekerjaan' => $row[7]  ?? null,
                    'uraian_pekerjaan' => $row[8]  ?? null,
                    'ruang_lingkup_pekerjaan' => $row[9]  ?? null,
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

            if (!empty($insertBatch)) {
                $this->db->table('tb_pengalaman_pekerjaan')->insertBatch($insertBatch);
            }
            return redirect()->to('pengalaman')->with('success', 'Import Excel berhasil. Total ' . count($insertBatch) . ' data diimport.');
        } catch (\Exception $e) {
            return redirect()->to('pengalaman')->with('error', 'Gagal membaca file Excel: ' . $e->getMessage());
        }
    }
}
