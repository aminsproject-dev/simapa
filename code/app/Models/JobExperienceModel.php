<?php

namespace App\Models;

use CodeIgniter\Model;

class JobExperienceModel extends Model
{
    protected $table            = 'tb_pengalaman_pekerjaan';
    protected $primaryKey       = 'id_pengalaman';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
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
        'status',
        'created_at',
        'updated_at',
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function getAllData()
    {
        $builder = $this->db->table('tb_pengalaman_pekerjaan t');

        $builder->select('
            t.*,

            kp.nama_kategori_pekerjaan,
            kbli.kode_kbli,
            kbli.nama_kbli,

            negara.nama_negara,

            prov_pekerjaan.nama_provinsi as provinsi_pekerjaan,
            kab_pekerjaan.nama_kabupaten as kabupaten_pekerjaan,

            ji.nama_jenis_instansi,
            ni.nama_instansi,
            sk.nama_satuan_kerja,

            prov_instansi.nama_provinsi as provinsi_instansi,
            kab_instansi.nama_kabupaten as kabupaten_instansi
        ');

        $builder->join('tb_kategori_pekerjaan kp', 'kp.id_kategori_pekerjaan = t.id_kategori_pekerjaan', 'left');
        $builder->join('tb_kbli kbli', 'kbli.id_kbli = t.id_kbli', 'left');
        $builder->join('tb_negara negara', 'negara.id_negara = t.id_negara_pekerjaan', 'left');
        $builder->join('tb_provinsi prov_pekerjaan', 'prov_pekerjaan.id = t.id_provinsi_pekerjaan', 'left');
        $builder->join('tb_kabupaten kab_pekerjaan', 'kab_pekerjaan.id_kabupaten = t.id_kabupaten_pekerjaan', 'left');
        $builder->join('tb_jenis_instansi ji', 'ji.id_jenis_instansi = t.id_jenis_instansi', 'left');
        $builder->join('tb_nama_instansi ni', 'ni.id_nama_instansi = t.id_nama_instansi', 'left');
        $builder->join('tb_satuan_kerja sk', 'sk.id_satuan_kerja = t.id_satuan_kerja', 'left');
        $builder->join('tb_provinsi prov_instansi', 'prov_instansi.id = t.id_provinsi_instansi', 'left');
        $builder->join('tb_kabupaten kab_instansi', 'kab_instansi.id_kabupaten = t.id_kabupaten_instansi', 'left');
        $builder->where('t.status', 'aktif');
        $builder->orderBy('t.id_pengalaman', 'DESC');

        $result = $builder->get()->getResultArray();

        return $result;
    }

    public function getSelectedData($id)
    {
        $builder = $this->db->table('tb_pengalaman_pekerjaan t');

        $builder->select('
            t.*,

            kp.nama_kategori_pekerjaan,
            kbli.kode_kbli,
            kbli.nama_kbli,

            negara.nama_negara,

            prov_pekerjaan.nama_provinsi as provinsi_pekerjaan,
            kab_pekerjaan.nama_kabupaten as kabupaten_pekerjaan,

            ji.nama_jenis_instansi,
            ni.nama_instansi,
            sk.nama_satuan_kerja,

            prov_instansi.nama_provinsi as provinsi_instansi,
            kab_instansi.nama_kabupaten as kabupaten_instansi
        ');

        $builder->join('tb_kategori_pekerjaan kp', 'kp.id_kategori_pekerjaan = t.id_kategori_pekerjaan', 'left');
        $builder->join('tb_kbli kbli', 'kbli.id_kbli = t.id_kbli', 'left');
        $builder->join('tb_negara negara', 'negara.id_negara = t.id_negara_pekerjaan', 'left');
        $builder->join('tb_provinsi prov_pekerjaan', 'prov_pekerjaan.id = t.id_provinsi_pekerjaan', 'left');
        $builder->join('tb_kabupaten kab_pekerjaan', 'kab_pekerjaan.id_kabupaten = t.id_kabupaten_pekerjaan', 'left');
        $builder->join('tb_jenis_instansi ji', 'ji.id_jenis_instansi = t.id_jenis_instansi', 'left');
        $builder->join('tb_nama_instansi ni', 'ni.id_nama_instansi = t.id_nama_instansi', 'left');
        $builder->join('tb_satuan_kerja sk', 'sk.id_satuan_kerja = t.id_satuan_kerja', 'left');
        $builder->join('tb_provinsi prov_instansi', 'prov_instansi.id = t.id_provinsi_instansi', 'left');
        $builder->join('tb_kabupaten kab_instansi', 'kab_instansi.id_kabupaten = t.id_kabupaten_instansi', 'left');
        $builder->where('t.status', 'aktif');
        $builder->where('t.id_pengalaman', $id);
        $builder->orderBy('t.id_pengalaman', 'DESC');

        $result = $builder->get()->getRowArray();

        return $result;
    }
}
