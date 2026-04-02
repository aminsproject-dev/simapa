<?php

namespace App\Models;

use CodeIgniter\Model;

class PengalamanPekerjaModel extends Model
{
    protected $table            = 'tb_pengalaman_pekerja';
    protected $primaryKey       = 'id_pengalaman_pekerja';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_pekerja',
        'id_pengalaman',
        'created_at',
        'updated_at',
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = '';

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

    public function getByPekerja($id_pekerja)
    {
        return $this->db->table('tb_pengalaman_pekerja pp')
            ->select('
            pp.id_pengalaman_pekerja,
            pp.id_pekerja,
            p.nama_kontrak,
            p.nomor_kontrak,
            p.tanggal_mulai,
            p.tanggal_selesai,
            p.tanggal_serah_terima,
            p.nilai_kontrak,
            p.status
        ')
            ->join('tb_pengalaman_pekerjaan p', 'p.id_pengalaman = pp.id_pengalaman', 'left')
            ->where('pp.id_pekerja', $id_pekerja)
            ->orderBy('p.tanggal_mulai', 'DESC')
            ->get()
            ->getResultArray();
    }
}
