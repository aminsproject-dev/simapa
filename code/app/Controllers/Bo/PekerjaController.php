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

    public function __construct()
    {
        $this->pekerjaModel = new PekerjaModel();
        $this->statusKepegawaianModel = new EmploymentStatustModel();
        $this->jenisTenagaAhliModel = new TypeExpertModel();
        $this->countryModel = new CountryModel();
        $this->provinceModel = new ProvinceModel();
        $this->regencyModel = new RegencyModel();
        $this->pendidikanAkhirModel = new PendidikanAkhirModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Data Pekerja',
            'open_data' => 'show',
            'show_pekerja' => 'show',
            'active_pekerja' => 'active',
            'dt_pekerja' => $this->pekerjaModel->orderBy('nama', 'asc')->findAll(),
        ];

        echo view('bo/pages/v_header', $data);
        echo view('bo/pekerja/v_index');
        echo view('bo/pages/v_footer');
    }

    public function view($id)
    {
        $data = [
            'title' => 'Lihat Data Pekerja',
            'open_data' => 'show',
            'show_pekerja' => 'show',
            'active_pekerja' => 'active',
            'row_pekerja' => $this->pekerjaModel->getSelectedData(decrypt_data($id)),
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
            'dt_pendidikan_akhir' => $this->pendidikanAkhirModel->findAll(),
        ];

        echo view('bo/pages/v_header', $data);
        echo view('bo/pekerja/v_add');
        echo view('bo/pages/v_footer');
    }

    public function add()
    {
        $data = $this->request->getPost();

        if (!$this->pekerjaModel->insert($data)) {
            log_message('error', (string)$this->pekerjaModel->errors());
            return redirect()->back()->withInput()->with('error', $this->pekerjaModel->errors());
        }

        return redirect()->to('pekerja')->with('success', 'Data berhasil ditambah');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Data Pekerja',
            'open_data' => 'show',
            'show_pekerja' => 'show',
            'active_pekerja' => 'active',
            'row_pekerja' => $this->pekerjaModel->where('id_pekerja', decrypt_data($id))->first(),
            'dt_status_kepegawaian' => $this->statusKepegawaianModel->where('status', 1)->findAll(),
            'dt_jenis_tenaga_ahli' => $this->jenisTenagaAhliModel->where('status', 1)->findAll(),
            'dt_country' => $this->countryModel->findAll(),
            'dt_province' => $this->provinceModel->findAll(),
            'dt_pendidikan_akhir' => $this->pendidikanAkhirModel->findAll(),
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

        if (!$this->pekerjaModel->delete($row_pekerja['id_pekerja'])) {
            log_message('error', (string)$this->pekerjaModel->errors());
            return redirect()->back()->withInput()->with('error', $this->pekerjaModel->errors());
        }

        return redirect()->to('pekerja')->with('success', 'Data berhasil dihapus');
    }

    public function importExample()
    {
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

        $data = [
            'John Doe',
            'Pegawai Tetap',
            'Tenaga Ahli Sipil',
            'Indonesia',
            '1234567890123456',
            '12.345.678.9-012.345',
            '0001234567890',
            '0001234567890',
            'Indonesia',
            'Kota Surabaya',
            '1990-01-01',
            'Pria',
            'john.doe@email.com',
            '08123456789',
            'https://example.com',
            'Jl. Contoh No. 1, Surabaya',
            'Jawa Timur',
            'Kota Surabaya',
            '5',
            'Aktif',
            'Pasif',
            'Pasif',
            'S1 Teknik Sipil - Universitas Contoh (2010-2014)',
            'Pelatihan AutoCAD (2015)',
            'S1',
            'Struktur, Jalan, Jembatan',
        ];

        $col = 'A';
        foreach ($data as $d) {
            $sheet->setCellValue($col . '2', $d);
            $col++;
        }

        $comments = [
            'B' => 'Pastikan nama status kepegawaian sesuai dengan data master status kepegawaian pada sistem',
            'C' => 'Pastikan nama jenis tenaga ahli sesuai dengan data master jenis tenaga ahli pada sistem',
            'D' => 'Pastikan nama negara kewarganegaraan sesuai dengan data master negara pada sistem',
            'I' => 'Pastikan nama negara tempat lahir sesuai dengan data master negara pada sistem',
            'J' => 'Pastikan nama kabupaten tempat lahir sesuai dengan data master kabupaten pada sistem',
            'Q' => 'Pastikan nama provinsi domisili sesuai dengan data master provinsi pada sistem',
            'R' => 'Pastikan nama kabupaten domisili sesuai dengan data master kabupaten pada sistem',
            'Y' => 'Pastikan pendidikan akhir sesuai dengan data master pendidikan akhir pada sistem',
        ];

        foreach ($comments as $cellCol => $text) {
            $comment = $sheet->getComment($cellCol . '1');
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

            $path = $file->getTempName();

            $spreadsheet = IOFactory::load($path);
            $sheet = $spreadsheet->getActiveSheet();
            $rows = $sheet->toArray();

            array_shift($rows);

            $statusKepegawaianMap = map_by_name($this->statusKepegawaianModel->findAll(), 'nama_status');
            $jenisTenagaAhliMap  = map_by_name($this->jenisTenagaAhliModel->findAll(), 'nama_jenis');
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

                $builder_kab_lahir = $this->regencyModel->like('LOWER(nama_kabupaten)', normalize($row[9]));
                $row_kab_lahir = $builder_kab_lahir->first();

                $row_provinsi_domisili = $provinceMap[normalize($row[16])] ?? null;

                $builder_kab_domisili = $this->regencyModel->like('LOWER(nama_kabupaten)', normalize($row[17]));
                if (!empty($row_provinsi_domisili)) {
                    $builder_kab_domisili->where('id_provinsi', $row_provinsi_domisili['id']);
                }
                $row_kab_domisili = $builder_kab_domisili->first();

                $row_pendidikan_akhir = $pendidikanAkhirMap[normalize($row[24])] ?? null;

                $insertBatch[] = [
                    'nama' => $row[0]  ?? null,
                    'id_status_kepegawaian' => $row_status_kepegawaian['id_status'] ?? null,
                    'id_jenis_tenaga_ahli' => $row_jenis_tenaga_ahli['id_jenis'] ?? null,
                    'id_kewarganegaraan' => $row_kewarganegaraan['id_negara'] ?? null,
                    'nik_paspor' => $row[4]  ?? null,
                    'npwp' => $row[5]  ?? null,
                    'no_bpjs_kesehatan' => $row[6]  ?? null,
                    'no_bpjs_ketenagakerjaan' => $row[7]  ?? null,
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
                strip_tags($row['alamat']) ?? '',
                $row['provinsi_domisili'] ?? '',
                $row['kabupaten_domisili'] ?? '',
                $row['lama_pengalaman_kerja_tahun'] ?? '',
                $row['tingkat_bahasa_indonesia'] ?? '',
                $row['tingkat_bahasa_inggris'] ?? '',
                $row['tingkat_bahasa_setempat'] ?? '',
                strip_tags($row['pendidikan_formal']) ?? '',
                strip_tags($row['pendidikan_non_formal']) ?? '',
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
