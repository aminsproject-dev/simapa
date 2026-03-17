<?php

namespace App\Models;

use CodeIgniter\Model;

class GuaranteeModel extends Model
{
    protected $table            = 'tb_sertifikat_garansi';
    protected $primaryKey       = 'id_sertifikat_garansi';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'kategori_barang',
        'nama_sertifikat',
        'isi_sertifikat',
        'aktif',
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
    protected $validationRules      = [
        'nama_sertifikat' => 'required|trim',
        'isi_sertifikat' => 'required',
    ];
    protected $validationMessages   = [
        'nama_sertifikat' => [
            'required' => 'Nama Sertifikat tidak boleh kosong',
        ],
        'isi_sertifikat' => [
            'required' => 'Konten Sertifikat tidak boleh kosong',
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

    public function getSertifGaransi()
    {
        return $this->join('tb_kategori_barang a', 'tb_sertifikat_garansi.kategori_barang=a.id_kategori_barang')
            ->findAll();
    }
}
