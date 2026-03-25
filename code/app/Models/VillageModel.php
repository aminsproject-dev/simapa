<?php

namespace App\Models;

use CodeIgniter\Model;

class VillageModel extends Model
{
    protected $table            = 'tb_desa';
    protected $primaryKey       = 'id_desa';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_kecamatan',
        'nama_desa',
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
    protected $validationRules      = [
        'id_kecamatan' => 'required|trim',
        'nama_desa' => 'required|trim',
    ];
    protected $validationMessages   = [
        'id_kecamatan' => [
            'required' => 'Kecamatan tidak boleh kosong',
        ],
        'nama_desa' => [
            'required' => 'Nama Desa tidak boleh kosong',
        ],
    ];
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

    public function getAllVillage($id_regency)
    {
        return $this->join('tb_kecamatan a', 'tb_desa.id_kecamatan=a.id_kecamatan')
            ->where('a.id_kabupaten', $id_regency)
            ->findAll();
    }
}
