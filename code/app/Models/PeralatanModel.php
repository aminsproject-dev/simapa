<?php

namespace App\Models;

use CodeIgniter\Model;

class PeralatanModel extends Model
{
    protected $table            = 'tb_peralatan';
    protected $primaryKey       = 'id_peralatan';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $useTimestamps    = true;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';

    protected $allowedFields = [
        'nama_peralatan',
        'merk_tipe',
        'kapasitas',
        'tahun_pembuatan',
        'jumlah',
        'kondisi',
        'status_kepemilikan',
        'lokasi_sekarang',
        'bukti_kepemilikan',
        'keterangan',
    ];

    protected $validationRules = [
        'nama_peralatan' => 'required|max_length[255]',
        'merk_tipe' => 'permit_empty|max_length[255]',
        'kapasitas' => 'permit_empty|max_length[100]',
        'tahun_pembuatan' => 'permit_empty|integer|greater_than[1900]',
        'jumlah' => 'required|integer|greater_than[0]',
        'kondisi' => 'required|in_list[Baik,Buruk]',
        'status_kepemilikan' => 'required|in_list[Sendiri,Sewa,Dukungan]',
        'lokasi_sekarang' => 'permit_empty|max_length[255]',
        'keterangan' => 'permit_empty',
    ];

    protected $validationMessages = [
        'nama_peralatan' => ['required' => 'Nama peralatan wajib diisi.'],
        'jumlah' => ['required' => 'Jumlah wajib diisi.', 'integer' => 'Jumlah harus berupa angka.'],
        'kondisi' => ['required' => 'Kondisi wajib dipilih.'],
        'status_kepemilikan' => ['required' => 'Status kepemilikan wajib dipilih.'],
    ];

    protected $skipValidation = false;

    public function getAll()
    {
        return $this->orderBy('nama_peralatan', 'ASC')->findAll();
    }

    public function getSelectedData($id)
    {
        return $this->where('id_peralatan', $id)->first();
    }

    public function searchData($keyword)
    {
        return $this->groupStart()
            ->like('nama_peralatan', $keyword)
            ->orLike('merk_tipe', $keyword)
            ->orLike('lokasi_sekarang', $keyword)
            ->orLike('status_kepemilikan', $keyword)
            ->groupEnd()
            ->orderBy('nama_peralatan', 'ASC')
            ->findAll();
    }
}
