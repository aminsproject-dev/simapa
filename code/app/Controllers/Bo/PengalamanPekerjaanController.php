<?php

namespace App\Controllers\Bo;

use App\Controllers\BaseController;
use App\Models\JenisInstansiModel;
use App\Models\NamaInstansiModel;
use App\Models\RegencyModel;
use App\Models\SatuanKerjaModel;
use App\Models\CountryModel;
use App\Models\KategoriPekerjaanModel;
use App\Models\JobExperienceModel;
use App\Models\KbliModel;
use App\Models\ProvinceModel;
use CodeIgniter\Validation\Exceptions\ValidationException;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use RuntimeException;

class PengalamanPekerjaanController extends BaseController
{
    protected $jobExperienceModel;
    protected $kategoriPekerjaanModel;
    protected $kbliModel;
    protected $countryModel;
    protected $provinceModel;
    protected $regencyModel;
    protected $jenisInstansiModel;
    protected $namaInstansiModel;
    protected $satuanKerjaModel;
    public function __construct()
    {
        $this->jobExperienceModel = new JobExperienceModel();
        $this->kategoriPekerjaanModel = new KategoriPekerjaanModel();
        $this->kbliModel = new KbliModel();
        $this->countryModel = new CountryModel();
        $this->provinceModel = new ProvinceModel();
        $this->regencyModel = new RegencyModel();
        $this->jenisInstansiModel = new JenisInstansiModel();
        $this->namaInstansiModel = new NamaInstansiModel();
        $this->satuanKerjaModel = new SatuanKerjaModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Data Pengalaman Perusahaan',
            'open_data' => 'show',
            'show_pengalaman' => 'show',
            'active_pengalaman' => 'active',
            'dt_pengalaman' => $this->jobExperienceModel->orderBy('tanggal_mulai', 'desc')->findAll(),
        ];

        echo view('bo/pages/v_header', $data);
        echo view('bo/pengalaman/v_index');
        echo view('bo/pages/v_footer');
    }

    public function view($id)
    {
        $data = [
            'title' => 'Lihat Data Pengalaman Perusahaan',
            'open_data' => 'show',
            'show_pengalaman' => 'show',
            'active_pengalaman' => 'active',
            'row_experience' => $this->jobExperienceModel->getSelectedData(decrypt_data($id)),
        ];

        echo view('bo/pages/v_header', $data);
        echo view('bo/pengalaman/v_view');
        echo view('bo/pages/v_footer');
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Data Pengalaman Perusahaan',
            'open_data' => 'show',
            'show_pengalaman' => 'show',
            'active_pengalaman' => 'active',
            'dt_kategori' => $this->kategoriPekerjaanModel->where('status', 'aktif')->findAll(),
            'dt_kbli' => $this->kbliModel->where('status', 'aktif')->findAll(),
            'dt_country' => $this->countryModel->findAll(),
            'dt_province' => $this->provinceModel->findAll(),
            'dt_jenis_instansi' => $this->jenisInstansiModel->where('status', 'aktif')->findAll(),
            'dt_nama_instansi' => $this->namaInstansiModel->where('status', 'aktif')->findAll(),
            'dt_satker' => $this->satuanKerjaModel->where('status', 'aktif')->findAll(),
        ];

        echo view('bo/pages/v_header', $data);
        echo view('bo/pengalaman/v_add');
        echo view('bo/pages/v_footer');
    }

    public function add()
    {
        $data = $this->request->getPost();
        $data['status'] = 'aktif';

        if (!$this->jobExperienceModel->insert($data)) {
            log_message('error', (string)$this->jobExperienceModel->errors());
            return redirect()->back()->withInput()->with('error', $this->jobExperienceModel->errors());
        }

        return redirect()->to('pengalaman')->with('success', 'Data berhasil ditambah');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Data Pengalaman Perusahaan',
            'open_data' => 'show',
            'show_pengalaman' => 'show',
            'active_pengalaman' => 'active',
            'row_pengalaman' => $this->jobExperienceModel->where('id_pengalaman', decrypt_data($id))->first(),
            'dt_kategori' => $this->kategoriPekerjaanModel->where('status', 'aktif')->findAll(),
            'dt_kbli' => $this->kbliModel->where('status', 'aktif')->findAll(),
            'dt_country' => $this->countryModel->findAll(),
            'dt_province' => $this->provinceModel->findAll(),
            'dt_jenis_instansi' => $this->jenisInstansiModel->where('status', 'aktif')->findAll(),
            'dt_nama_instansi' => $this->namaInstansiModel->where('status', 'aktif')->findAll(),
            'dt_satker' => $this->satuanKerjaModel->where('status', 'aktif')->findAll(),
        ];

        echo view('bo/pages/v_header', $data);
        echo view('bo/pengalaman/v_edit');
        echo view('bo/pages/v_footer');
    }

    public function update($id)
    {
        if (empty($row_pengalaman = $this->jobExperienceModel->where('id_pengalaman', decrypt_data($id))->first())) {
            log_message('alert', 'Data tidak ditemukan');
            return redirect()->back()->withInput()->with('error', 'Data tidak ditemukan');
        }

        $data = $this->request->getPost();

        if (!$this->jobExperienceModel->update($row_pengalaman['id_pengalaman'], $data)) {
            log_message('error', (string)$this->jobExperienceModel->errors());
            return redirect()->back()->withInput()->with('error', $this->jobExperienceModel->errors());
        }

        return redirect()->to('pengalaman')->with('success', 'Data berhasil diubah');
    }

    public function delete($id)
    {
        if (empty($row_pengalaman = $this->jobExperienceModel->where('id_pengalaman', decrypt_data($id))->first())) {
            log_message('alert', 'Data tidak ditemukan');
            return redirect()->back()->withInput()->with('error', 'Data tidak ditemukan');
        }

        if (!$this->jobExperienceModel->delete($row_pengalaman['id_pengalaman'])) {
            log_message('error', (string)$this->jobExperienceModel->errors());
            return redirect()->back()->withInput()->with('error', $this->jobExperienceModel->errors());
        }

        return redirect()->to('pengalaman')->with('success', 'Data berhasil dihapus');
    }

    public function importExample()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $headers = [
            'nama_kontrak',
            'nomor_kontrak',
            'tanggal_mulai',
            'tanggal_selesai',
            'tanggal_serah_terima',
            'nilai_kontrak',
            'kategori_pekerjaan',
            'persentase_pekerjaan',
            'uraian_pekerjaan',
            'ruang_lingkup_pekerjaan',
            'kode kbli',
            'alamat_pekerjaan',
            'negara_pekerjaan',
            'provinsi_pekerjaan',
            'kabupaten_pekerjaan',
            'jenis_instansi',
            'nama_instansi',
            'satuan_kerja',
            'provinsi_instansi',
            'kabupaten_instansi',
            'alamat_instansi',
            'telepon_instansi',
        ];

        $col = 'A';
        foreach ($headers as $header) {
            $sheet->setCellValue($col . '1', $header);
            $col++;
        }

        $data = [
            'kontrka example',
            '22112/CTR/12/20216',
            '2026-12-12',
            '2026-12-12',
            '2026-12-12',
            '100000000',
            'Jasa lainnya',
            '100',
            'pekerjaan ini di buat untuk contoh',
            'pekerjaan ini di buat untuk contoh',
            '433122',
            'alamat pekerjaan ini di buat untuk contoh',
            'Indonesia',
            'Jawa Timur',
            'Kota Madiun',
            'Lingkungan Hidup',
            'Dinas lingkungan hidup',
            'Cipta karya',
            'Jawa timur',
            'Kota Madiun',
            'alamat intansi ini di buat untuk contoh',
            '0895112233344',
        ];

        $col = 'A';
        foreach ($data as $d) {
            $sheet->setCellValue($col . '2', $d);
            $col++;
        }

        $comment = $sheet->getComment('G1');
        $comment->getText()->createTextRun('Pastikan nama kategori pekerjaan sesuai dengan data master kategori pekerjaan pada sistem');
        $comment->setAuthor('Sistem SISURO');

        $comment = $sheet->getComment('K1');
        $comment->getText()->createTextRun('Pastikan Kode KBLI sesuai dengan data master kbli pada sistem');
        $comment->setAuthor('Sistem SISURO');

        $comment = $sheet->getComment('M1');
        $comment->getText()->createTextRun('Pastikan nama negara sesuai dengan data master negara pada sistem');
        $comment->setAuthor('Sistem SISURO');

        $comment = $sheet->getComment('N1');
        $comment->getText()->createTextRun('Pastikan nama provinsi sesuai dengan data master provinsi pada sistem');
        $comment->setAuthor('Sistem SISURO');

        $comment = $sheet->getComment('O1');
        $comment->getText()->createTextRun('Pastikan nama kabupaten sesuai dengan data master kabupaten pada sistem');
        $comment->setAuthor('Sistem SISURO');

        $comment = $sheet->getComment('P1');
        $comment->getText()->createTextRun('Pastikan jenis instansi sesuai dengan data master jenis instansi pada sistem');
        $comment->setAuthor('Sistem SISURO');

        $comment = $sheet->getComment('Q1');
        $comment->getText()->createTextRun('Pastikan nama instansi sesuai dengan data master nama instansi pada sistem');
        $comment->setAuthor('Sistem SISURO');

        $comment = $sheet->getComment('R1');
        $comment->getText()->createTextRun('Pastikan satuan kerja sesuai dengan data master satuan kerja pada sistem');
        $comment->setAuthor('Sistem SISURO');

        $comment = $sheet->getComment('S1');
        $comment->getText()->createTextRun('Pastikan provinsi sesuai dengan data master provinsi pada sistem');
        $comment->setAuthor('Sistem SISURO');

        $comment = $sheet->getComment('T1');
        $comment->getText()->createTextRun('Pastikan kabupaten sesuai dengan data master kabupaten pada sistem');
        $comment->setAuthor('Sistem SISURO');

        $filename = 'Master import pengalaman pekerjaan.xlsx';

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

            // $regencyList = $this->regencyModel->findAll();

            $kategoriPekerjaanMap = map_by_name($this->kategoriPekerjaanModel->findAll(), 'nama_kategori');
            $kbliMap = map_by_name($this->kbliModel->findAll(), 'kode_kbli');
            $countryMap = map_by_name($this->countryModel->findAll(), 'nama_negara');
            $provinceMap = map_by_name($this->provinceModel->findAll(), 'nama_provinsi');

            $jenisInstansiMap = map_by_name($this->jenisInstansiModel->findAll(), 'nama_jenis_instansi');
            $namaInstansiMap = map_by_name($this->namaInstansiModel->findAll(), 'nama_instansi');
            $satuanKerjaMap = map_by_name($this->satuanKerjaModel->findAll(), 'nama_satuan_kerja');

            $insertBatch = [];
            foreach ($rows as $row) {
                if (empty($row[0])) continue;

                $row_kategori_pekerjaan = $kategoriPekerjaanMap[normalize($row[6])];
                $row_kbli = $kbliMap[normalize($row[10])];
                $row_negara_pekerjaan = $countryMap[normalize($row[12])];
                $row_provinsi_pekerjaan = $provinceMap[normalize($row[13])];

                $builder_kabupaten_pekerjaan = $this->regencyModel->like('LOWER(nama_kabupaten)', normalize($row[14]));
                if (!empty($row_provinsi_pekerjaan)) {
                    $builder_kabupaten_pekerjaan->where('id_provinsi', $row_provinsi_pekerjaan['id']);
                }
                $row_kabupaten_pekerjaan = $builder_kabupaten_pekerjaan->first();

                $row_jenis_instansi = $jenisInstansiMap[normalize($row[15])];
                $row_nama_instansi = $namaInstansiMap[normalize($row[16])];
                $row_satuan_kerja = $satuanKerjaMap[normalize($row[17])];
                $row_provinsi_instansi = $provinceMap[normalize($row[18])];

                $builder_kabupaten_instansi = $this->regencyModel->like('LOWER(nama_kabupaten)', normalize($row[19]));
                if (!empty($row_provinsi_instansi)) {
                    $builder_kabupaten_instansi->where('id_provinsi', $row_provinsi_instansi['id']);
                }
                $row_kabupaten_instansi = $builder_kabupaten_instansi->first();

                $data = [
                    'nama_kontrak' => $row[0]  ?? null,
                    'nomor_kontrak' => $row[1]  ?? null,
                    'tanggal_mulai' => $row[2]  ?? null,
                    'tanggal_selesai' => $row[3]  ?? null,
                    'tanggal_serah_terima' => $row[4]  ?? null,
                    'nilai_kontrak' => $row[5]  ?? null,
                    'id_kategori_pekerjaan' => $row_kategori_pekerjaan['id_kategori']  ?? null,
                    'persentase_pekerjaan' => $row[7]  ?? null,
                    'uraian_pekerjaan' => $row[8]  ?? null,
                    'ruang_lingkup_pekerjaan' => $row[9]  ?? null,
                    'id_kbli' => $row_kbli['id_kbli'] ?? null,
                    'alamat_pekerjaan' => $row[11] ?? null,
                    'id_negara_pekerjaan' => $row_negara_pekerjaan['id_negara'] ?? null,
                    'id_provinsi_pekerjaan' => $row_provinsi_pekerjaan['id'] ?? null,
                    'id_kabupaten_pekerjaan' => $row_kabupaten_pekerjaan['id_kabupaten'] ?? null,
                    'id_jenis_instansi' => $row_jenis_instansi['id_jenis_instansi'] ?? null,
                    'id_nama_instansi' => $row_nama_instansi['id_nama_instansi'] ?? null,
                    'id_satuan_kerja' => $row_satuan_kerja['id_satuan_kerja'] ?? null,
                    'id_provinsi_instansi' => $row_provinsi_instansi['id'] ?? null,
                    'id_kabupaten_instansi' => $row_kabupaten_instansi['id_kabupaten'] ?? null,
                    'alamat_instansi' => $row[20] ?? null,
                    'telepon_instansi' => $row[21] ?? null,
                    'status' => 'aktif',
                ];

                $insertBatch[] = $data;
            }

            if (!empty($insertBatch)) {
                if (!$this->jobExperienceModel->insertBatch($insertBatch)) {
                    throw new RuntimeException((string)$this->jobExperienceModel->errors());
                }
            }

            $db->transCommit();
            return redirect()->to('pengalaman')->with('success', 'Import Excel berhasil. Total ' . count($insertBatch) . ' data diimport.');
        } catch (\Exception $e) {
            $db->transRollback();
            log_message('error', $e->getMessage() . ' | ' . $e->getLine() . ' | ' . $e->getFile());
            return redirect()->to('pengalaman')->with('error', 'Gagal membaca file Excel: ' . $e->getMessage());
        }
    }

    public function export()
    {
        $dt_pengalaman = $this->jobExperienceModel->getAllData();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $headers = [
            'nama_kontrak',
            'nomor_kontrak',
            'tanggal_mulai',
            'tanggal_selesai',
            'tanggal_serah_terima',
            'nilai_kontrak',
            'kategori_pekerjaan',
            'persentase_pekerjaan (%)',
            'uraian_pekerjaan',
            'ruang_lingkup_pekerjaan',
            'kbli',
            'alamat_pekerjaan',
            'negara_pekerjaan',
            'provinsi_pekerjaan',
            'kabupaten_pekerjaan',
            'jenis_instansi',
            'nama_instansi',
            'satuan_kerja',
            'provinsi_instansi',
            'kabupaten_instansi',
            'alamat_instansi',
            'telepon_instansi',
        ];

        $col = 'A';
        foreach ($headers as $header) {
            $sheet->setCellValue($col . '1', $header);
            $col++;
        }

        $rowNum = 2;

        foreach ($dt_pengalaman as $row) {

            $dataRow = [
                $row['nama_kontrak'] ?? '',
                $row['nomor_kontrak'] ?? '',
                !empty($row['tanggal_mulai'])
                    ? date('d-m-Y', strtotime($row['tanggal_mulai']))
                    : '',
                !empty($row['tanggal_selesai'])
                    ? date('d-m-Y', strtotime($row['tanggal_selesai']))
                    : '',
                !empty($row['tanggal_serah_terima'])
                    ? date('d-m-Y', strtotime($row['tanggal_serah_terima']))
                    : '',
                number_format($row['nilai_kontrak'] ?? 0, 0, ',', '.'),
                strtoupper($row['nama_kategori'] ?? ''),
                $row['persentase_pekerjaan'] ?? '',
                strip_tags($row['uraian_pekerjaan']) ?? '',
                strip_tags($row['ruang_lingkup_pekerjaan']) ?? '',
                ($row['kode_kbli'] ?? '') . ' - ' . ($row['nama_kbli'] ?? ''),
                strip_tags($row['alamat_pekerjaan']) ?? '',
                $row['nama_negara'] ?? '',
                $row['provinsi_pekerjaan'] ?? '',
                $row['kabupaten_pekerjaan'] ?? '',
                $row['nama_jenis_instansi'] ?? '',
                $row['nama_instansi'] ?? '',
                $row['nama_satuan_kerja'] ?? '',
                $row['provinsi_instansi'] ?? '',
                $row['kabupaten_instansi'] ?? '',
                strip_tags($row['alamat_instansi']) ?? '',
                $row['telepon_instansi'] ?? '',
            ];

            $sheet->fromArray($dataRow, null, 'A' . $rowNum);

            $rowNum++;
        }
        $filename = 'Data pengalaman ' . date('Y-m-d') . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }
}
