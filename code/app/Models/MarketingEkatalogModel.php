<?php

namespace App\Models;

use CodeIgniter\Model;

class MarketingEkatalogModel extends Model
{
    protected $table            = 'tb_marketing_ekatalog';
    protected $primaryKey       = 'id_marketing_ekatalog';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'nip',
        'jabatan',
        'nama_pegawai',
        'email',
        'no_hp',
        'alamat',
        'tempat_lahir',
        'tanggal_lahir',
        'jenkel',
        'instansi',
        'satuan_kerja',
        'alamat_satuan_kerja',
        'nama_pp',
        'jabatan_pp',
        'nip_pp',
        'email_pp',
        'no_tlp_pp',
        'nama_ppk',
        'jabatan_ppk',
        'nip_ppk',
        'email_ppk',
        'no_tlp_ppk',
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
}
