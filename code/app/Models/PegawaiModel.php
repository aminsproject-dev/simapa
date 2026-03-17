<?php

namespace App\Models;

use CodeIgniter\Model;

class PegawaiModel extends Model
{
    protected $table            = 'tb_pegawai';
    protected $primaryKey       = 'id_pegawai';
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
        'nip' => 'required|trim',
        'jabatan' => 'required|trim',
        'nama_pegawai' => 'required|trim',
        'email' => 'required|trim',
        'no_hp' => 'required|trim',
        'aktif' => 'required|trim|integer',
    ];
    protected $validationMessages   = [
        'nip' => [
            'required' => 'Nip tidak boleh kosong',
        ],
        'jabatan' => [
            'required' => 'Jabatan pegawai tidak boleh kosong',
        ],
        'nama_pegawai' => [
            'required' => 'Nama pegawai tidak boleh kosong',
        ],
        'email' => [
            'required' => 'Email pegawai tidak boleh kosong',
        ],
        'no_hp' => [
            'required' => 'No Handphone pegawai tidak boleh kosong',
        ],
        'aktif' => [
            'required' => 'Status pegawai tidak boleh kosong',
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

    public function getAllDataPegawai()
    {
        return $this->join('tb_jabatan a', 'tb_pegawai.jabatan=a.id_jabatan', 'left')
            ->where('rowstatus', 1)
            ->findAll();
    }

    public function getSelectedEmployeeByPosition($position_id)
    {
        return $this->join('tb_jabatan a', 'tb_pegawai.jabatan=a.id_jabatan', 'left')
            ->where('tb_pegawai.jabatan', $position_id)
            ->where('rowstatus', 1)
            ->first();
    }
}
