<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table            = 'tb_user';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_pegawai',
        'username',
        'password',
        'status_user',
        'foto',
        'role',
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
        'id_pegawai' => 'required|trim',
        'username' => 'required|trim',
        'password' => 'required|trim',
    ];
    protected $validationMessages   = [
        'id_pegawai' => [
            'required' => 'Pegawai tidak ditemukan',
        ],
        'username' => [
            'required' => 'Username tidak boleh kosong',
        ],
        'password' => [
            'required' => 'Password tidak boleh kosong',
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

    public function getAllDataPengguna()
    {
        return $this
            ->join('tb_pegawai a', 'tb_user.id_pegawai=a.id_pegawai', 'left')
            ->join('tb_jabatan b', 'a.jabatan=b.id_jabatan', 'left')
            ->where('status_user', 1)
            ->findAll()
        ;
    }

    public function getUserByUsername($username)
    {
        return $this->join('tb_pegawai a', 'tb_user.id_pegawai=a.id_pegawai')
            ->where('username', $username)
            ->limit(1)
            ->first();
    }
}
