<?php

namespace App\Controllers\Bo;

use App\Controllers\BaseController;
use App\Models\PengalamanPekerjaModel;
use App\Models\PekerjaModel;

class PengalamanPekerjaController extends BaseController
{
    protected $pengalamanPekerjaModel;
    protected $pekerjaModel;

    public function __construct()
    {
        $this->pengalamanPekerjaModel = new PengalamanPekerjaModel();
        $this->pekerjaModel = new PekerjaModel();
    }

    public function add($id_pekerja_enc)
    {
        $id_pekerja = decrypt_data($id_pekerja_enc);
        $row_pekerja = $this->pekerjaModel->find($id_pekerja);

        if (empty($row_pekerja)) {
            return redirect()->back()->with('error', 'Data pekerja tidak ditemukan');
        }

        $data = [
            'title' => 'Tambah Pengalaman Kontrak',
            'open_data' => 'show',
            'show-pekerja' => 'show',
            'active_pekerja' => 'active',
            'row_pekerja' => $row_pekerja,
        ];

        echo view('bo/pages/v_header', $data);
        echo view('bo/pekerja/v_add_pengalaman');
        echo view('bo/pages/v_footer');
    }

    public function getAvailable($id_pekerja_enc)
    {
        $id_pekerja = decrypt_data($id_pekerja_enc);

        $linked    = $this->pengalamanPekerjaModel->where('id_pekerja', $id_pekerja)->findAll();
        $linkedIds = array_column($linked, 'id_pengalaman');

        $builder = $this->db->table('tb_pengalaman_pekerjaan');
        $builder->select('id_pengalaman, nama_kontrak, nomor_kontrak, tanggal_mulai, tanggal_selesai, nilai_kontrak, tanggal_serah_terima, status');

        if (!empty($linkedIds)) {
            $builder->whereNotIn('id_pengalaman', $linkedIds);
        }

        $builder->orderBy('tanggal_mulai', 'DESC');
        $data = $builder->get()->getResultArray();

        return $this->response->setJSON($data);
    }

    public function save()
    {
        $id_pekerja     = $this->request->getPost('id_pekerja');
        $id_pengalamans = $this->request->getPost('id_pengalaman');

        if (empty($id_pekerja) || empty($id_pengalamans)) {
            return redirect()->back()->with('error', 'Data tidak lengkap');
        }

        $id_pekerja = decrypt_data($id_pekerja);

        $insertBatch = [];
        foreach ($id_pengalamans as $id_pengalaman) {
            $exists = $this->pengalamanPekerjaModel
                ->where('id_pekerja', $id_pekerja)
                ->where('id_pengalaman', $id_pengalaman)
                ->first();

            if (!$exists) {
                $insertBatch[] = [
                    'id_pekerja'    => $id_pekerja,
                    'id_pengalaman' => $id_pengalaman,
                ];
            }
        }

        if (!empty($insertBatch)) {
            if (!$this->pengalamanPekerjaModel->insertBatch($insertBatch)) {
                log_message('error', (string) $this->pengalamanPekerjaModel->errors());
                return redirect()->back()->with('error', 'Gagal menyimpan data pengalaman');
            }
        }

        return redirect()->back()->with('success', count($insertBatch) . ' data pengalaman berhasil ditambahkan');
    }

    public function delete($id_enc)
    {
        $id_pengalaman_pekerja = decrypt_data($id_enc);

        $row = $this->pengalamanPekerjaModel->find($id_pengalaman_pekerja);

        if (empty($row)) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }

        if (!$this->pengalamanPekerjaModel->delete($id_pengalaman_pekerja)) {
            log_message('error', (string) $this->pengalamanPekerjaModel->errors());
            return redirect()->back()->with('error', 'Gagal menghapus data pengalaman');
        }

        return redirect()->back()->with('success', 'Data pengalaman berhasil dihapus');
    }
}
