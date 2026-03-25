<?php

namespace App\Models;

use CodeIgniter\Model;

class DistrictModel extends Model
{
    protected $table            = 'tb_kecamatan';
    protected $primaryKey       = 'id_kecamatan';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_kabupaten',
        'nama_kecamatan',
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
        'id_kabupaten' => 'required|trim',
        'nama_kecamatan' => 'required|trim',
    ];
    protected $validationMessages   = [
        'id_kabupaten' => [
            'required' => 'Kabupaten tidak boleh kosong'
        ],
        'nama_kecamatan' => [
            'required' => 'Nama Kecamatan tidak boleh kosong'
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

    public function getAllDistrict($id_regency)
    {
        return $this->join('tb_kabupaten a', 'tb_kecamatan.id_kabupaten=a.id_kabupaten')
            ->where('tb_kecamatan.id_kabupaten', $id_regency)
            ->findAll();
    }
}
