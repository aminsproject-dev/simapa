<?php

namespace App\Controllers\Bo;

use App\Controllers\BaseController;
use App\Models\PeralatanModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use RuntimeException;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\IOFactory;

class PeralatanController extends BaseController
{
    protected $peralatanModel;
    protected string $uploadPath = WRITEPATH . 'uploads/peralatan/';

    public function __construct()
    {
        $this->peralatanModel = new PeralatanModel();

        if (!is_dir($this->uploadPath)) {
            mkdir($this->uploadPath, 0755, true);
        }
    }

    private function handleFileUpload(string $field): ?string
    {
        $file = $this->request->getFile($field);

        if (!$file || !$file->isValid() || $file->hasMoved()) {
            return null;
        }

        $allowedTypes = ['image/jpg', 'image/jpeg', 'image/png', 'application/pdf'];
        if (!in_array($file->getMimeType(), $allowedTypes)) {
            throw new RuntimeException('File ' . str_replace('_', ' ', $field) . ' harus berupa file JPG, JPEG, PNG, atau PDF');
        }

        if ($file->getSize() > 2048 * 1024) {
            throw new RuntimeException('File ' . str_replace('_', ' ', $field) . ' maksimal 2MB');
        }

        $newName = $file->getRandomName();
        $file->move($this->uploadPath, $newName);

        return $newName;
    }

    private function deleteOldFile(?string $filename): void
    {
        if (!empty($filename) && file_exists($this->uploadPath . $filename)) {
            unlink($this->uploadPath . $filename);
        }
    }

    public function index()
    {
        $keyword = $this->request->getGet('search');
        $data = [
            'title' => 'Katalog Peralatan',
            'open_data' => 'show',
            'show_peralatan' => 'show',
            'active_peralatan' => 'active',
            'list_peralatan' => $keyword ? $this->peralatanModel->searchData($keyword) : $this->peralatanModel->getAll(),
            'keyword' => $keyword,
        ];

        echo view('bo/pages/v_header', $data);
        echo view('bo/peralatan/v_index');
        echo view('bo/pages/v_footer');
    }

    public function add()
    {
        $data = [
            'title' => 'Tambah Peralatan',
            'open_data' => 'show',
            'show_peralatan' => 'show',
            'active_peralatan' => 'active',
        ];

        echo view('bo/pages/v_header', $data);
        echo view('bo/peralatan/v_add');
        echo view('bo/pages/v_footer');
    }

    public function store()
    {
        $rules = [
            'nama_peralatan' => 'required|max_length[255]',
            'jumlah' => 'required|integer|greater_than[0]',
            'kondisi' => 'required|in_list[Baik,Buruk]',
            'status_kepemilikan' => 'required|in_list[Sendiri,Sewa,Dukungan]',
            'bukti_kepemilikan' => 'permit_empty|uploaded[bukti_kepemilikan]|max_size[bukti_kepemilikan,2048]|ext_in[bukti_kepemilikan,jpg,jpeg,png,pdf]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = $this->request->getPost();
        $data['bukti_kepemilikan'] = null;

        try {
            $filename = $this->handleFileUpload('bukti_kepemilikan');
            if ($filename !== null) {
                $data['bukti_kepemilikan'] = $filename;
            }
        } catch (RuntimeException $e) {
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }

        if (!$this->peralatanModel->insert($data)) {
            log_message('error', (string)$this->peralatanModel->errors());
            return redirect()->back()->withInput()->with('error', $this->peralatanModel->errors());
        }

        return redirect()->to('peralatan')->with('success', 'Data peralatan berhasil ditambahkan');
    }

    public function view($id)
    {
        $id_peralatan = decrypt_data($id);
        $row_peralatan = $this->peralatanModel->getSelectedData($id_peralatan);

        if (empty($row_peralatan)) {
            return redirect()->to(site_url('peralatan'))->with('error', 'Data tidak ditemukan');
        }

        $data = [
            'title' => 'Detail Peralatan',
            'open_data' => 'show',
            'show_peralatan' => 'show',
            'active_peralatan' => 'active',
            'row_peralatan' => $row_peralatan,
        ];

        echo view('bo/pages/v_header', $data);
        echo view('bo/peralatan/v_view');
        echo view('bo/pages/v_footer');
    }

    public function edit($id)
    {
        $id_peralatan = decrypt_data($id);
        $row_peralatan = $this->peralatanModel->getSelectedData($id_peralatan);

        if (empty($row_peralatan)) {
            return redirect()->to(site_url('peralatan'))->with('error', 'Data tidak ditemukan');
        }

        $data = [
            'title' => 'Edit Peralatan',
            'open_data' => 'show',
            'show_peralatan' => 'show',
            'active_peralatan' => 'active',
            'row_peralatan' => $row_peralatan,
        ];

        echo view('bo/pages/v_header', $data);
        echo view('bo/peralatan/v_edit');
        echo view('bo/pages/v_footer');
    }

    public function update($id)
    {
        $id_peralatan = decrypt_data($id);
        $row_peralatan = $this->peralatanModel->where('id_peralatan', $id_peralatan)->first();

        if (empty($row_peralatan)) {
            return redirect()->to(site_url('peralatan'))->with('error', 'Data tidak ditemukan');
        }

        $rules = [
            'nama_peralatan' => 'required|max_length[255]',
            'jumlah' => 'required|integer|greater_than[0]',
            'kondisi' => 'required|in_list[Baik,Buruk]',
            'status_kepemilikan' => 'required|in_list[Sendiri,Sewa,Dukungan]',
            'bukti_kepemilikan' => 'permit_empty|max_size[bukti_kepemilikan,2048]|ext_in[bukti_kepemilikan,jpg,jpeg,png,pdf]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = $this->request->getPost();

        try {
            $filename = $this->handleFileUpload('bukti_kepemilikan');
            if ($filename !== null) {
                $this->deleteOldFile($row_peralatan['bukti_kepemilikan'] ?? null);
                $data['bukti_kepemilikan'] = $filename;
            }
        } catch (RuntimeException $e) {
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }

        if (!$this->peralatanModel->update($id_peralatan, $data)) {
            log_message('error', (string)$this->peralatanModel->errors());
            return redirect()->back()->withInput()->with('error', $this->peralatanModel->errors());
        }

        return redirect()->to(site_url('peralatan/view/' . encrypt_data($id_peralatan)))->with('success', 'Data peralatan berhasil diperbarui');
    }

    public function delete($id)
    {
        $id_peralatan = decrypt_data($id);
        $row_peralatan = $this->peralatanModel->where('id_peralatan', $id_peralatan)->first();

        if (empty($row_peralatan)) {
            return redirect()->to(site_url('peralatan'))->with('error', 'Data tidak ditemukan');
        }

        $this->deleteOldFile($row_peralatan['bukti_kepemilikan'] ?? null);

        if (!$this->peralatanModel->delete($id_peralatan)) {
            log_message('error', (string)$this->peralatanModel->errors());
            return redirect()->back()->withInput()->with('error', $this->peralatanModel->errors());
        }

        return redirect()->to(site_url('peralatan'))->with('success', 'Data peralatan berhasil dihapus');
    }

    public function serveFile($filename)
    {
        $filepath = $this->uploadPath . basename($filename);

        if (!file_exists($filepath)) {
            throw new PageNotFoundException('File tidak ditemukan');
        }

        $mime = mime_content_type($filepath);
        $allowedTypes = ['image/jpg', 'image/jpeg', 'image/png', 'application/pdf'];

        if (!in_array($mime, $allowedTypes)) {
            throw new PageNotFoundException('File tidak valid');
        }

        return $this->response
            ->setHeader('Content-Type', $mime)
            ->setHeader('Content-Length', filesize($filepath))
            ->setHeader('Cache-Control', 'public, max-age=86400')
            ->setBody(file_get_contents($filepath));
    }

    public function export()
    {
        $list_peralatan = $this->peralatanModel->getAll();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $headers = [
            'nama_peralatan',
            'merk_tipe',
            'kapasitas',
            'tahun_pembuatan',
            'jumlah',
            'kondisi',
            'status_kepemilikan',
            'lokasi_sekarang',
            'keterangan',
        ];

        $col = 'A';
        foreach ($headers as $header) {
            $sheet->setCellValue($col . '1', $header);
            $col++;
        }

        $rowNum = 2;
        foreach ($list_peralatan as $row) {
            $dataRow = [
                $row['nama_peralatan'] ?? '',
                $row['merk_tipe'] ?? '',
                $row['kapasitas'] ?? '',
                !empty($row['tahun_pembuatan']) ? $row['tahun_pembuatan'] : '',
                $row['jumlah'] ?? '',
                $row['kondisi'] ?? '',
                $row['status_kepemilikan'] ?? '',
                $row['lokasi_sekarang'] ?? '',
                $row['keterangan'] ?? '',
            ];

            $sheet->fromArray($dataRow, null, 'A' . $rowNum);

            $stringFields = ['A', 'B', 'C', 'G', 'H', 'I'];
            foreach ($stringFields as $colLetter) {
                $sheet->setCellValueExplicit(
                    $colLetter . $rowNum,
                    (string) ($dataRow[ord($colLetter) - ord('A')] ?? ''),
                    DataType::TYPE_STRING
                );
            }

            $rowNum++;
        }

        $filename = 'Data peralatan ' . date('Y-m-d') . '.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }

    public function importExample()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $headers = [
            'A' => 'nama_peralatan',
            'B' => 'merk_tipe',
            'C' => 'kapasitas',
            'D' => 'tahun_pembuatan',
            'E' => 'jumlah',
            'F' => 'kondisi',
            'G' => 'status_kepemilikan',
            'H' => 'lokasi_sekarang',
            'I' => 'keterangan',
        ];

        foreach ($headers as $col => $header) {
            $sheet->setCellValue($col . '1', $header);
        }

        $contoh = [
            'A' => 'Stiker Reflektor',
            'B' => 'Merek XYZ',
            'C' => '5 Kg',
            'D' => '2020',
            'E' => '10',
            'F' => 'Baik',
            'G' => 'Sendiri',
            'H' => 'Gudang A',
            'I' => 'Dalam kondisi baik',
        ];

        foreach ($contoh as $col => $value) {
            $sheet->setCellValue($col . '2', $value);
        }

        $textColumns = ['A', 'B', 'C', 'H', 'I'];
        foreach ($textColumns as $col) {
            $sheet->getStyle($col . '1:' . $col . '1001')
                ->getNumberFormat()
                ->setFormatCode(NumberFormat::FORMAT_TEXT);
        }

        $applyDropdown = function (string $col, string $formula) use ($sheet) {
            $range = "{$col}2:{$col}1001";
            $validation = $sheet->getCell("{$col}2")->getDataValidation();
            $validation->setType(\PhpOffice\PhpSpreadsheet\Cell\DataValidation::TYPE_LIST);
            $validation->setErrorStyle(\PhpOffice\PhpSpreadsheet\Cell\DataValidation::STYLE_STOP);
            $validation->setAllowBlank(true);
            $validation->setShowDropDown(true);
            $validation->setShowErrorMessage(true);
            $validation->setErrorTitle('Nilai tidak valid');
            $validation->setError('Silahkan pilih nilai dari daftar yang tersedia.');
            $validation->setShowInputMessage(true);
            $validation->setPromptTitle('Pilih dari daftar');
            $validation->setPrompt('Klik dropdown untuk memilih nilai yang tersedia.');
            $validation->setFormula1($formula);
            $validation->setSqref($range);
        };

        $applyDropdown('F', '"Baik,Buruk"');
        $applyDropdown('G', '"Sendiri,Sewa,Dukungan"');

        $filename = 'Master import peralatan.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }

    public function importSave()
    {
        helper('import');

        $db = db_connect();
        $db->transBegin();

        try {
            $file = $this->request->getFile('file_csv');

            if (!$file || !$file->isValid()) {
                throw new \CodeIgniter\Validation\Exceptions\ValidationException('File tidak valid');
            }

            $ext = strtolower($file->getClientExtension());
            if (!in_array($ext, ['xlsx', 'xls'])) {
                throw new \CodeIgniter\Validation\Exceptions\ValidationException('Format file harus .xlsx atau .xls');
            }

            $reader = IOFactory::createReaderForFile($file->getTempName());
            $reader->setReadDataOnly(false);
            $spreadsheet = IOFactory::load($file->getTempName());
            $rows = $spreadsheet->getActiveSheet()->toArray();

            array_shift($rows);

            log_message('debug', 'Import Peralatan - Total rows setelah shift: ' . count($rows));
            if (!empty($rows)) {
                log_message('debug', 'Sample row: ' . print_r($rows[0], true));
            }

            $insertBatch = [];
            foreach ($rows as $row) {
                if (empty($row[0])) continue;

                $insertBatch[] = [
                    'nama_peralatan' => trim($row[0] ?? ''),
                    'merk_tipe' => trim($row[1] ?? ''),
                    'kapasitas' => trim($row[2] ?? ''),
                    'tahun_pembuatan' => $row[3] !== '' ? (int)$row[3] : null,
                    'jumlah' => $row[4] !== '' ? (int)$row[4] : null,
                    'kondisi' => trim($row[5] ?? ''),
                    'status_kepemilikan' => trim($row[6] ?? ''),
                    'lokasi_sekarang' => trim($row[7] ?? ''),
                    'keterangan' => trim($row[8] ?? ''),
                ];
            }

            if (!empty($insertBatch)) {
                $validationResults = [];
                foreach ($insertBatch as $index => $data) {
                    $errors = [];
                    if (empty($data['nama_peralatan'])) $errors[] = 'nama_peralatan kosong';
                    if (empty($data['jumlah'])) $errors[] = 'jumlah kosong';
                    if (empty($data['kondisi'])) $errors[] = 'kondisi kosong';
                    if (empty($data['status_kepemilikan'])) $errors[] = 'status_kepemilikan kosong';

                    if (!empty($errors)) {
                        $validationResults[] = [
                            'row' => $index + 2,
                            'errors' => $errors
                        ];
                    }
                }

                if (!empty($validationResults)) {
                    $db->transRollback();
                    $errorMsg = 'Validasi gagal pada baris: ' . PHP_EOL;
                    foreach ($validationResults as $result) {
                        $errorMsg .= 'Baris ' . $result['row'] . ': ' . implode(', ', $result['errors']) . PHP_EOL;
                    }
                    return redirect()->to('peralatan')->with('error', $errorMsg);
                }

                // Insert satu per satu untuk memastikan escaping dan validasi bekerja
                $successCount = 0;
                foreach ($insertBatch as $data) {
                    if ($this->peralatanModel->insert($data)) {
                        $successCount++;
                    } else {
                        log_message('error', 'Insert error: ' . print_r($data, true) . ' | ' . print_r($this->peralatanModel->errors(), true));
                    }
                }

                if ($successCount !== count($insertBatch)) {
                    throw new RuntimeException('Beberapa data gagal diimport');
                }
            }

            $db->transCommit();
            return redirect()->to('peralatan')->with('success', 'Import Excel berhasil. Total ' . count($insertBatch) . ' data diimport.');
        } catch (\Exception $e) {
            $db->transRollback();
            log_message('error', $e->getMessage() . ' | ' . $e->getLine() . ' | ' . $e->getFile());
            return redirect()->to('peralatan')->with('error', 'Gagal membaca file Excel: ' . $e->getMessage());
        }
    }
}
