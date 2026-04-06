<?php

namespace App\Controllers\Bo;

use App\Controllers\BaseController;
use App\Models\PekerjaModel;
use App\Models\EmploymentStatustModel;
use App\Models\TypeExpertModel;
use App\Models\CountryModel;
use App\Models\ProvinceModel;
use App\Models\RegencyModel;
use App\Models\PendidikanAkhirModel;
use App\Models\PengalamanPekerjaModel;
use CodeIgniter\Validation\Exceptions\ValidationException;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use RuntimeException;

class PekerjaController extends BaseController
{
    protected $pekerjaModel;
    protected $statusKepegawaianModel;
    protected $jenisTenagaAhliModel;
    protected $countryModel;
    protected $provinceModel;
    protected $regencyModel;
    protected $pendidikanAkhirModel;
    protected $pengalamanPekerjaModel;
    protected array $fotoFields = [
        'foto_ktp',
        'foto_ijazah',
        'foto_transkrip_nilai',
        'foto_npwp',
        'foto_sertifikasi',
        'foto_nilai_sertifikasi',
    ];
    protected string $uploadPath = 'public/uploads/pekerja/';

    public function __construct()
    {
        $this->pekerjaModel = new PekerjaModel();
        $this->statusKepegawaianModel = new EmploymentStatustModel();
        $this->jenisTenagaAhliModel = new TypeExpertModel();
        $this->countryModel = new CountryModel();
        $this->provinceModel = new ProvinceModel();
        $this->regencyModel = new RegencyModel();
        $this->pendidikanAkhirModel = new PendidikanAkhirModel();
        $this->pengalamanPekerjaModel = new PengalamanPekerjaModel();

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

        if (!in_array($file->getMimeType(), ['image/jpeg', 'image/jpg'])) {
            throw new RuntimeException('File ' . str_replace('_', ' ', $field) . ' harus berupa gambar JPEG');
        }

        if ($file->getSize() > 2 * 1024 * 1024) {
            throw new RuntimeException('File ' . str_replace('_', ' ', $field) . ' maksimal 2MB.');
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
        $data = [
            'title' => 'Data Pekerja',
            'open_data' => 'show',
            'show_pekerja' => 'show',
            'active_pekerja' => 'active',
            'dt_pekerja' => $this->pekerjaModel->getAllData(),
        ];

        echo view('bo/pages/v_header', $data);
        echo view('bo/pekerja/v_index');
        echo view('bo/pages/v_footer');
    }

    public function view($id)
    {
        $id_pekerja = decrypt_data($id);

        $data = [
            'title' => 'Lihat Data Pekerja',
            'open_data' => 'show',
            'show_pekerja' => 'show',
            'active_pekerja' => 'active',
            'row_pekerja' => $this->pekerjaModel->getSelectedData($id_pekerja),
            'dt_pengalaman' => $this->pengalamanPekerjaModel->getByPekerja($id_pekerja),
        ];

        echo view('bo/pages/v_header', $data);
        echo view('bo/pekerja/v_view');
        echo view('bo/pages/v_footer');
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Data Pekerja',
            'open_data' => 'show',
            'show_pekerja' => 'show',
            'active_pekerja' => 'active',
            'dt_status_kepegawaian' => $this->statusKepegawaianModel->where('status', 1)->findAll(),
            'dt_jenis_tenaga_ahli' => $this->jenisTenagaAhliModel->where('status', 1)->findAll(),
            'dt_country' => $this->countryModel->findAll(),
            'dt_province' => $this->provinceModel->findAll(),
            'dt_kabupaten' => $this->regencyModel->findAll(),
            'dt_pendidikan_akhir' => $this->pendidikanAkhirModel->findAll(),
            'opt_jenis_kelamin' => ['Pria', 'Wanita'],
            'opt_tingkat_bahasa' => ['Baik', 'Sedang', 'Buruk'],
        ];

        echo view('bo/pages/v_header', $data);
        echo view('bo/pekerja/v_add');
        echo view('bo/pages/v_footer');
    }

    public function add()
    {
        $data = $this->request->getPost();

        foreach ($this->fotoFields as $field) {
            try {
                $filename = $this->handleFileUpload($field);
                if ($filename === null) {
                    return redirect()->back()->withInput()->with('error', 'File ' . str_replace('_', ' ', $field) . ' wajib diisi');
                }
                $data[$field] = $filename;
            } catch (RuntimeException $e) {
                return redirect()->back()->withInput()->with('error', $e->getMessage());
            }
        }

        if (!$this->pekerjaModel->insert($data)) {
            log_message('error', (string)$this->pekerjaModel->errors());
            return redirect()->back()->withInput()->with('error', $this->pekerjaModel->errors());
        }

        return redirect()->to('pekerja')->with('success', 'Data berhasil ditambah');
    }

    public function edit($id)
    {
        $row_pekerja = $this->pekerjaModel->where('id_pekerja', decrypt_data($id))->first();

        $data = [
            'title' => 'Edit Data Pekerja',
            'open_data' => 'show',
            'show_pekerja' => 'show',
            'active_pekerja' => 'active',
            'row_pekerja' => $row_pekerja,
            'dt_status_kepegawaian' => $this->statusKepegawaianModel->where('status', 1)->findAll(),
            'dt_jenis_tenaga_ahli' => $this->jenisTenagaAhliModel->where('status', 1)->findAll(),
            'dt_country' => $this->countryModel->findAll(),
            'dt_province' => $this->provinceModel->findAll(),
            'dt_kabupaten' => $this->regencyModel->orderBy('nama_kabupaten', 'asc')->findAll(), // ✅ tambah
            'dt_pendidikan_akhir' => $this->pendidikanAkhirModel->findAll(),
            'opt_jenis_kelamin' => ['Pria', 'Wanita'],
            'opt_tingkat_bahasa' => ['Baik', 'Sedang', 'Buruk'],
            'dt_kabupaten_domisili' => !empty($row_pekerja['id_provinsi_domisili']) ? $this->regencyModel->getSpecificRegency($row_pekerja['id_provinsi_domisili']) : [],
        ];

        echo view('bo/pages/v_header', $data);
        echo view('bo/pekerja/v_edit');
        echo view('bo/pages/v_footer');
    }

    public function update($id)
    {
        if (empty($row_pekerja = $this->pekerjaModel->where('id_pekerja', decrypt_data($id))->first())) {
            log_message('alert', 'Data tidak ditemukan');
            return redirect()->back()->withInput()->with('error', 'Data tidak ditemukan');
        }

        $data = $this->request->getPost();

        foreach ($this->fotoFields as $field) {
            try {
                $filename = $this->handleFileUpload($field);
                if ($filename !== null) {
                    $this->deleteOldFile($row_pekerja[$field] ?? null);
                    $data[$field] = $filename;
                } elseif (empty($row_pekerja[$field])) {
                    return redirect()->back()->withInput()->with('error', 'File ' . str_replace('_', ' ', $field) . ' wajib diisi');
                } else {
                    unset($data[$field]);
                }
            } catch (RuntimeException $e) {
                return redirect()->back()->withInput()->with('error', $e->getMessage());
            }
        }

        if (!$this->pekerjaModel->update($row_pekerja['id_pekerja'], $data)) {
            log_message('error', (string)$this->pekerjaModel->errors());
            return redirect()->back()->withInput()->with('error', $this->pekerjaModel->errors());
        }

        return redirect()->to('pekerja')->with('success', 'Data berhasil diubah');
    }

    public function delete($id)
    {
        if (empty($row_pekerja = $this->pekerjaModel->where('id_pekerja', decrypt_data($id))->first())) {
            log_message('alert', 'Data tidak ditemukan');
            return redirect()->back()->withInput()->with('error', 'Data tidak ditemukan');
        }

        foreach ($this->fotoFields as $field) {
            $this->deleteOldFile($row_pekerja[$field] ?? null);
        }

        if (!$this->pekerjaModel->delete($row_pekerja['id_pekerja'])) {
            log_message('error', (string)$this->pekerjaModel->errors());
            return redirect()->back()->withInput()->with('error', $this->pekerjaModel->errors());
        }

        return redirect()->to('pekerja')->with('success', 'Data berhasil dihapus');
    }

    public function importExample()
    {
        $dt_status = $this->statusKepegawaianModel->where('status', 1)->findAll();
        $dt_jenis = $this->jenisTenagaAhliModel->where('status', 1)->findAll();
        $dt_pendidikan = $this->pendidikanAkhirModel->findAll();

        $spreadsheet = new Spreadsheet();

        $optSheet = $spreadsheet->createSheet();
        $optSheet->setTitle('_options');

        foreach ($dt_status as $i => $row) {
            $optSheet->setCellValue('A' . ($i + 1), $row['nama_status']);
        }

        foreach ($dt_jenis as $i => $row) {
            $optSheet->setCellValue('B' . ($i + 1), $row['nama_jenis']);
        }

        foreach ($dt_pendidikan as $i => $row) {
            $optSheet->setCellValue('C' . ($i + 1), $row['nama_pendidikan_akhir']);
        }

        $optSheet->setSheetState(\PhpOffice\PhpSpreadsheet\Worksheet\Worksheet::SHEETSTATE_HIDDEN);

        $sheet = $spreadsheet->getSheet(0);
        $spreadsheet->setActiveSheetIndex(0);

        $headers = [
            'A' => 'nama',
            'B' => 'id_status_kepegawaian',
            'C' => 'id_jenis_tenaga_ahli',
            'D' => 'kewarganegaraan',
            'E' => 'nik_paspor',
            'F' => 'npwp',
            'G' => 'no_bpjs_kesehatan',
            'H' => 'no_bpjs_ketenagakerjaan',
            'I' => 'id_negara_tempat_lahir',
            'J' => 'id_kabupaten_tempat_lahir',
            'K' => 'tanggal_lahir',
            'L' => 'jenis_kelamin',
            'M' => 'email',
            'N' => 'telepon',
            'O' => 'website',
            'P' => 'alamat',
            'Q' => 'id_provinsi_domisili',
            'R' => 'id_kabupaten_domisili',
            'S' => 'lama_pengalaman_kerja_tahun',
            'T' => 'tingkat_bahasa_indonesia',
            'U' => 'tingkat_bahasa_inggris',
            'V' => 'tingkat_bahasa_setempat',
            'W' => 'pendidikan_formal',
            'X' => 'pendidikan_non_formal',
            'Y' => 'id_pendidikan_akhir',
            'Z' => 'profesi_keahlian',
        ];

        foreach ($headers as $col => $header) {
            $sheet->setCellValue($col . '1', $header);
        }

        $contoh = [
            'A' => 'John Doe',
            'B' => $dt_status[0]['nama_status'] ?? 'Tetap',
            'C' => $dt_jenis[0]['nama_jenis'] ?? 'Individu WNI',
            'D' => 'Indonesia',
            'E' => '1234567890123456',
            'F' => '12.345.678.9-012.345',
            'G' => '0001234567890',
            'H' => '0001234567890',
            'I' => 'Indonesia',
            'J' => 'Kota Surabaya',
            'K' => '1990-01-01',
            'L' => 'Pria',
            'M' => 'john.doe@email.com',
            'N' => '08123456789',
            'O' => 'https://example.com',
            'P' => 'Jl. Contoh No. 1, Surabaya',
            'Q' => 'Jawa Timur',
            'R' => 'Kota Surabaya',
            'S' => '5',
            'T' => 'Baik',
            'U' => 'Sedang',
            'V' => 'Buruk',
            'W' => 'S1 Teknik Sipil - Universitas Contoh (2010-2014)',
            'X' => 'Pelatihan AutoCAD (2015)',
            'Y' => $dt_pendidikan[6]['nama_pendidikan_akhir'] ?? 'S1',
            'Z' => 'Struktur, Jalan, Jembatan',
        ];

        foreach ($contoh as $col => $value) {
            $sheet->setCellValue($col . '2', $value);
        }

        $maxRow = 1001;
        $applyDropdown = function (string $col, string $formula) use ($sheet, $maxRow) {
            $range = "{$col}2:{$col}{$maxRow}";
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

        $statusCount = count($dt_status);
        $applyDropdown('B', "_options!\$A\$1:\$A\${$statusCount}");

        $jenisCount = count($dt_jenis);
        $applyDropdown('C', "_options!\$B\$1:\$B\${$jenisCount}");

        $applyDropdown('L', '"Pria,Wanita"');

        $applyDropdown('T', '"Baik,Sedang,Buruk"');
        $applyDropdown('U', '"Baik,Sedang,Buruk"');
        $applyDropdown('V', '"Baik,Sedang,Buruk"');

        $pendidikanCount = count($dt_pendidikan);
        $applyDropdown('Y', "_options!\$C\$1:\$C\${$pendidikanCount}");

        $comments = [
            'B' => 'Pilih dari dropdown. Pastikan sesuai data master status kepegawaian.',
            'C' => 'Pilih dari dropdown: Individu WNI atau Individu WNA.',
            'D' => 'Pastikan nama negara sesuai data master negara pada sistem.',
            'I' => 'Pastikan nama negara tempat lahir sesuai data master negara pada sistem.',
            'J' => 'Pastikan nama kabupaten sesuai data master kabupaten pada sistem.',
            'L' => 'Pilih dari dropdown: Pria atau Wanita.',
            'Q' => 'Pastikan nama provinsi sesuai data master provinsi pada sistem.',
            'R' => 'Pastikan nama kabupaten sesuai data master kabupaten pada sistem.',
            'T' => 'Pilih dari dropdown: Baik, Sedang, atau Buruk.',
            'U' => 'Pilih dari dropdown: Baik, Sedang, atau Buruk.',
            'V' => 'Pilih dari dropdown: Baik, Sedang, atau Buruk.',
            'Y' => 'Pilih dari dropdown sesuai jenjang pendidikan terakhir.',
        ];

        foreach ($comments as $col => $text) {
            $comment = $sheet->getComment($col . '1');
            $comment->getText()->createTextRun($text);
            $comment->setAuthor('Sistem SISURO');
        }

        $filename = 'Master import pekerja.xlsx';
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
                throw new ValidationException('File tidak valid');
            }

            $ext = strtolower($file->getClientExtension());
            if (!in_array($ext, ['xlsx', 'xls'])) {
                throw new ValidationException('Format file harus .xlsx atau .xls');
            }

            $spreadsheet = IOFactory::load($file->getTempName());
            $rows = $spreadsheet->getActiveSheet()->toArray();

            array_shift($rows);

            $statusKepegawaianMap = map_by_name($this->statusKepegawaianModel->findAll(), 'nama_status');
            $jenisTenagaAhliMap = map_by_name($this->jenisTenagaAhliModel->findAll(), 'nama_jenis');
            $countryMap = map_by_name($this->countryModel->findAll(), 'nama_negara');
            $provinceMap = map_by_name($this->provinceModel->findAll(), 'nama_provinsi');
            $pendidikanAkhirMap = map_by_name($this->pendidikanAkhirModel->findAll(), 'nama_pendidikan_akhir');

            $insertBatch = [];
            foreach ($rows as $row) {
                if (empty($row[0])) continue;

                $row_status_kepegawaian = $statusKepegawaianMap[normalize($row[1])] ?? null;
                $row_jenis_tenaga_ahli = $jenisTenagaAhliMap[normalize($row[2])] ?? null;
                $row_kewarganegaraan = $countryMap[normalize($row[3])] ?? null;
                $row_negara_lahir = $countryMap[normalize($row[8])] ?? null;

                $row_kab_lahir = $this->regencyModel
                    ->like('nama_kabupaten', normalize($row[9]), 'both', null, true)
                    ->first();

                $row_provinsi_domisili = $provinceMap[normalize($row[16])] ?? null;

                $kab_domisili_builder = $this->regencyModel
                    ->like('nama_kabupaten', normalize($row[17]), 'both', null, true);

                if (!empty($row_provinsi_domisili)) {
                    $kab_domisili_builder->where('id_provinsi', $row_provinsi_domisili['id']);
                }

                $row_kab_domisili = $kab_domisili_builder->first();
                $row_pendidikan_akhir = $pendidikanAkhirMap[normalize($row[24])] ?? null;

                $insertBatch[] = [
                    'nama' => $row[0]  ?? null,
                    'id_status_kepegawaian' => $row_status_kepegawaian['id_status'] ?? null,
                    'id_jenis_tenaga_ahli' => $row_jenis_tenaga_ahli['id_jenis'] ?? null,
                    'id_kewarganegaraan' => $row_kewarganegaraan['id_negara'] ?? null,
                    'nik_paspor' => $row[4] ?? null,
                    'npwp' => $row[5] ?? null,
                    'no_bpjs_kesehatan' => $row[6] ?? null,
                    'no_bpjs_ketenagakerjaan' => $row[7] ?? null,
                    'id_negara_tempat_lahir' => $row_negara_lahir['id_negara'] ?? null,
                    'id_kabupaten_tempat_lahir' => $row_kab_lahir['id_kabupaten'] ?? null,
                    'tanggal_lahir' => $row[10] ?? null,
                    'jenis_kelamin' => $row[11] ?? null,
                    'email' => $row[12] ?? null,
                    'telepon' => $row[13] ?? null,
                    'website' => $row[14] ?? null,
                    'alamat' => $row[15] ?? null,
                    'id_provinsi_domisili' => $row_provinsi_domisili['id'] ?? null,
                    'id_kabupaten_domisili' => $row_kab_domisili['id_kabupaten'] ?? null,
                    'lama_pengalaman_kerja_tahun' => $row[18] ?? null,
                    'tingkat_bahasa_indonesia' => $row[19] ?? null,
                    'tingkat_bahasa_inggris' => $row[20] ?? null,
                    'tingkat_bahasa_setempat' => $row[21] ?? null,
                    'pendidikan_formal' => $row[22] ?? null,
                    'pendidikan_non_formal' => $row[23] ?? null,
                    'id_pendidikan_akhir' => $row_pendidikan_akhir['id_pendidikan_akhir'] ?? null,
                    'profesi_keahlian' => $row[25] ?? null,
                ];
            }

            if (!empty($insertBatch)) {
                if (!$this->pekerjaModel->insertBatch($insertBatch)) {
                    throw new RuntimeException((string)$this->pekerjaModel->errors());
                }
            }

            $db->transCommit();
            return redirect()->to('pekerja')->with('success', 'Import Excel berhasil. Total ' . count($insertBatch) . ' data diimport.');
        } catch (\Exception $e) {
            $db->transRollback();
            log_message('error', $e->getMessage() . ' | ' . $e->getLine() . ' | ' . $e->getFile());
            return redirect()->to('pekerja')->with('error', 'Gagal membaca file Excel: ' . $e->getMessage());
        }
    }

    public function export()
    {
        $dt_pekerja = $this->pekerjaModel->getAllData();
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $headers = [
            'nama',
            'status_kepegawaian',
            'jenis_tenaga_ahli',
            'kewarganegaraan',
            'nik_paspor',
            'npwp',
            'no_bpjs_kesehatan',
            'no_bpjs_ketenagakerjaan',
            'negara_tempat_lahir',
            'kabupaten_tempat_lahir',
            'tanggal_lahir',
            'jenis_kelamin',
            'email',
            'telepon',
            'website',
            'alamat',
            'provinsi_domisili',
            'kabupaten_domisili',
            'lama_pengalaman_kerja_tahun',
            'tingkat_bahasa_indonesia',
            'tingkat_bahasa_inggris',
            'tingkat_bahasa_setempat',
            'pendidikan_formal',
            'pendidikan_non_formal',
            'pendidikan_akhir',
            'profesi_keahlian',
        ];

        $col = 'A';
        foreach ($headers as $header) {
            $sheet->setCellValue($col . '1', $header);
            $col++;
        }

        $rowNum = 2;
        foreach ($dt_pekerja as $row) {
            $dataRow = [
                $row['nama'] ?? '',
                $row['nama_status'] ?? '',
                $row['nama_jenis_tenaga_ahli'] ?? '',
                $row['negara_kewarganegaraan'] ?? '',
                $row['nik_paspor'] ?? '',
                $row['npwp'] ?? '',
                $row['no_bpjs_kesehatan'] ?? '',
                $row['no_bpjs_ketenagakerjaan'] ?? '',
                $row['negara_tempat_lahir'] ?? '',
                $row['kabupaten_tempat_lahir'] ?? '',
                !empty($row['tanggal_lahir'])
                    ? date('d-m-Y', strtotime($row['tanggal_lahir']))
                    : '',
                $row['jenis_kelamin'] ?? '',
                $row['email'] ?? '',
                $row['telepon'] ?? '',
                $row['website'] ?? '',
                strip_tags($row['alamat'] ?? ''),
                $row['provinsi_domisili'] ?? '',
                $row['kabupaten_domisili'] ?? '',
                $row['lama_pengalaman_kerja_tahun'] ?? '',
                $row['tingkat_bahasa_indonesia'] ?? '',
                $row['tingkat_bahasa_inggris'] ?? '',
                $row['tingkat_bahasa_setempat'] ?? '',
                strip_tags($row['pendidikan_formal'] ?? ''),
                strip_tags($row['pendidikan_non_formal'] ?? ''),
                $row['nama_pendidikan_akhir'] ?? '',
                $row['profesi_keahlian'] ?? '',
            ];

            $sheet->fromArray($dataRow, null, 'A' . $rowNum);
            $rowNum++;
        }

        $filename = 'Data pekerja ' . date('Y-m-d') . '.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }
}
