<?php

namespace App\Models\Bo;

use CodeIgniter\Model;

class NamaInstansiModel extends Model
{
    protected $table            = 'tb_nama_instansi';
    protected $primaryKey       = 'id_nama_instansi';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_jenis_instansi',
        'nama_instansi',
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
    public function getWithJenisInstansi()
    {
        return $this->select('tb_nama_instansi.*, ji.nama_jenis_instansi')
            ->join(
                'tb_jenis_instansi ji',
                'ji.id_jenis_instansi = tb_nama_instansi.id_jenis_instansi',
                'left'
            )
            ->orderBy('tb_nama_instansi.nama_instansi', 'ASC')
            ->findAll();
    }

    public function getByJenis($idJenis)
    {
        return $this->where('id_jenis_instansi', $idJenis)
            ->where('rowstatus', 1)
            ->orderBy('nama_instansi', 'ASC')
            ->findAll();
    }
}
