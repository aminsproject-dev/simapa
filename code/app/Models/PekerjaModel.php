<?php

namespace App\Models;

use CodeIgniter\Model;

class PekerjaModel extends Model
{
    protected $table            = 'tb_pekerja';
    protected $primaryKey       = 'id_pekerja';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
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
        'created_at',
        'updated_at',
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts        = [];
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
        $builder = $this->db->table('tb_pekerja t');

        $builder->select('
            t.*,

            sk.nama_status,

            jta.nama_jenis as nama_jenis_tenaga_ahli,

            negara_wn.nama_negara as negara_kewarganegaraan,

            negara_lahir.nama_negara as negara_tempat_lahir,

            kab_lahir.nama_kabupaten as kabupaten_tempat_lahir,

            prov_domisili.nama_provinsi as provinsi_domisili,

            kab_domisili.nama_kabupaten as kabupaten_domisili,

            pa.nama_pendidikan_akhir
        ');

        $builder->join('tb_status_kepegawaian sk', 'sk.id_status = t.id_status_kepegawaian', 'left');
        $builder->join('tb_jenis_tenaga_ahli jta', 'jta.id_jenis = t.id_jenis_tenaga_ahli', 'left');
        $builder->join('tb_negara negara_wn', 'negara_wn.id_negara = t.id_kewarganegaraan', 'left');
        $builder->join('tb_negara negara_lahir', 'negara_lahir.id_negara = t.id_negara_tempat_lahir', 'left');
        $builder->join('tb_kabupaten kab_lahir', 'kab_lahir.id_kabupaten = t.id_kabupaten_tempat_lahir', 'left');
        $builder->join('tb_provinsi prov_domisili', 'prov_domisili.id = t.id_provinsi_domisili', 'left');
        $builder->join('tb_kabupaten kab_domisili', 'kab_domisili.id_kabupaten = t.id_kabupaten_domisili', 'left');
        $builder->join('tb_pendidikan_akhir pa', 'pa.id_pendidikan_akhir = t.id_pendidikan_akhir', 'left');
        $builder->orderBy('t.id_pekerja', 'DESC');

        $result = $builder->get()->getResultArray();

        return $result;
    }

    public function getSelectedData($id)
    {
        $builder = $this->db->table('tb_pekerja t');

        $builder->select('
            t.*,

            sk.nama_status,

            jta.nama_jenis as nama_jenis_tenaga_ahli,

            negara_wn.nama_negara as negara_kewarganegaraan,

            negara_lahir.nama_negara as negara_tempat_lahir,

            kab_lahir.nama_kabupaten as kabupaten_tempat_lahir,

            prov_domisili.nama_provinsi as provinsi_domisili,

            kab_domisili.nama_kabupaten as kabupaten_domisili,

            pa.nama_pendidikan_akhir
        ');

        $builder->join('tb_status_kepegawaian sk', 'sk.id_status = t.id_status_kepegawaian', 'left');
        $builder->join('tb_jenis_tenaga_ahli jta', 'jta.id_jenis = t.id_jenis_tenaga_ahli', 'left');
        $builder->join('tb_negara negara_wn', 'negara_wn.id_negara = t.id_kewarganegaraan', 'left');
        $builder->join('tb_negara negara_lahir', 'negara_lahir.id_negara = t.id_negara_tempat_lahir', 'left');
        $builder->join('tb_kabupaten kab_lahir', 'kab_lahir.id_kabupaten = t.id_kabupaten_tempat_lahir', 'left');
        $builder->join('tb_provinsi prov_domisili', 'prov_domisili.id = t.id_provinsi_domisili', 'left');
        $builder->join('tb_kabupaten kab_domisili', 'kab_domisili.id_kabupaten = t.id_kabupaten_domisili', 'left');
        $builder->join('tb_pendidikan_akhir pa', 'pa.id_pendidikan_akhir = t.id_pendidikan_akhir', 'left');
        $builder->where('t.id_pekerja', $id);

        $result = $builder->get()->getRowArray();

        return $result;
    }
}
