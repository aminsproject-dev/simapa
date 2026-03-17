<?php

namespace App\Models;

use CodeIgniter\Model;

class MenuSuratModel extends Model
{
    protected $table            = 'tb_menu_surat';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'nama_menu',
        'url',
        'icon',
        'kode',
        'jenis',
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
        'nama_menu' => 'required|trim',
        'url' => 'required|trim',
        'kode' => 'required|trim',
        'jenis' => 'required|trim',
    ];
    protected $validationMessages   = [
        'nama_menu' => [
            'required' => 'Nama menu tidak boleh kosong',
        ],
        'url' => [
            'required' => 'Url tidak boleh kosong',
        ],
        'kode' => [
            'required' => 'Kode Surat tidak boleh kosong',
        ],
        'jenis' => [
            'required' => 'Jenis Surat tidak boleh kosong',
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
}
