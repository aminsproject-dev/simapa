<?php

namespace App\Models;

use CodeIgniter\Model;

class SuratModel extends Model
{
    protected $table            = 'tb_surat';
    protected $primaryKey       = 'id_surat';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'jenis_surat',
        'no_surat',
        'nama_surat',
        'tanggal',
        'qrgen',
        'kategori_barang',
        'isi_surat',
        'tanda_tangan',
        'file_scan',
        'arsip',
        'createdon',
        'createdby',
        'rowstatus',
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
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

    public function lastNumber($jns)
    {
        $last = $this->select("SUBSTRING_INDEX(SUBSTRING_INDEX(no_surat,' / ',2),' / ',-1)+1 AS nomor")
            ->where('jenis_surat', $jns)
            ->where('YEAR(tanggal) = YEAR(NOW())', null, false)
            ->where('rowstatus', 1)
            ->orderBy('id_surat', 'DESC')
            ->limit(1)
            ->first();

        if ($last && isset($last['nomor'])) {
            return (int) $last['nomor'];
        }

        return 1;
    }

    public function getAllSurat($jns)
    {
        return $this
            ->where('jenis_surat', $jns)
            ->where('rowstatus', 1)
            ->where('arsip', null)
            ->findAll()
        ;
    }

    public function getAllSuratArsip($jns)
    {
        return $this
            ->where('jenis_surat', $jns)
            ->where('rowstatus', 2)
            ->where('arsip', null)
            ->findAll()
        ;
    }
}
