<?php

namespace App\Models;

use CodeIgniter\Model;

class RegencyModel extends Model
{
    protected $table            = 'tb_kabupaten';
    protected $primaryKey       = 'id_kabupaten';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_provinsi',
        'nama_kabupaten',
        'pusat_pemerintah',
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
        'id_provinsi' => 'required|trim',
        'nama_kabupaten' => 'required|trim',
    ];
    protected $validationMessages   = [
        'id_provinsi' => [
            'required' => 'Provinsi tidak boleh kosong',
        ],
        'nama_kabupaten' => [
            'required' => 'Nama kabupaten tidak boleh kosong',
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

    public function getAllRegency()
    {
        return $this->join('tb_provinsi a', 'tb_kabupaten.id_provinsi=a.id')
            ->findAll();
    }

    public function getSpecificRegency($id)
    {
        return $this->join('tb_provinsi a', 'tb_kabupaten.id_provinsi=a.id')
            ->where('a.id', $id)
            ->findAll();
    }
}
