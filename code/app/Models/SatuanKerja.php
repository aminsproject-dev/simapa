<?php

namespace App\Models\Bo;

use CodeIgniter\Model;

class SatuanKerjaModel extends Model
{
    protected $table            = 'tb_satuan_kerja';
    protected $primaryKey       = 'id_satuan_kerja';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_nama_instansi',
        'nama_satuan_kerja',
        'status',
        'rowstatus',
        'createdon',
        'createdby',
        'modifiedon',
        'modifiedby',
    ];

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

    // Custom Methods
    public function getWithNamaInstansi()
    {
        return $this->select('tb_satuan_kerja.*, ni.nama_instansi')
            ->join(
                'tb_nama_instansi ni',
                'ni.id_nama_instansi = tb_satuan_kerja.id_nama_instansi',
                'left'
            )
            ->orderBy('tb_satuan_kerja.nama_satuan_kerja', 'ASC')
            ->findAll();
    }

    public function getByNamaInstansi($idNamaInstansi)
    {
        return $this->where('id_nama_instansi', $idNamaInstansi)
            ->where('rowstatus', 1)
            ->orderBy('nama_satuan_kerja', 'ASC')
            ->findAll();
    }
}
