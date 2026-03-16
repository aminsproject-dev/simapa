<?php

namespace App\Models\Bo;

use CodeIgniter\Model;

class BoModel extends Model
{
    // START MASTER
    public function getAllDataPegawai()
    {
        return $this->db->table('tb_pegawai a')
            ->select('*')
            ->join('tb_jabatan b', 'a.jabatan=b.id_jabatan', 'left')
            ->where('rowstatus', 1)
            ->get()
            ->getResult();
    }

    public function getSertifGaransi()
    {
        return $this->db->table('tb_sertifikat_garansi a')
            ->select('*')
            ->join('tb_kategori_barang b', 'a.kategori_barang=b.id_kategori_barang')
            ->where('a.rowstatus', 1)
            ->get()
            ->getResult();
    }

    public function getPegawaiByPosition($position_id)
    {
        return $this->db->table('tb_pegawai a')
            ->select('*')
            ->join('tb_jabatan b', 'a.jabatan=b.id_jabatan', 'left')
            ->where('a.rowstatus', 1)
            ->where('a.jabatan', $position_id)
            ->get()
            ->getRow();
    }

    public function getAllDataPengguna()
    {
        return $this->db->table('tb_user a')
            ->select('*')
            ->join('tb_pegawai b', 'a.id_pegawai=b.id_pegawai', 'left')
            ->join('tb_jabatan c', 'b.jabatan=c.id_jabatan', 'left')
            ->where('status_user', 1)
            ->get()
            ->getResult();
    }
    // END MASTER

    // START SURAT
    public function getAllMenuSurat()
    {
        return $this->db->table('tb_menu_surat')
            ->select('*')
            ->where('kode IS NOT NULL')
            ->where('kode !=', '')
            ->get()
            ->getResult();
    }

    public function kodeSurat()
    {
        $qry = $this->db->table('tb_menu_surat')
            ->select('kode')
            ->where('url', '?page=' . service('request')->getGet('page'))
            ->get()
            ->getRowArray();
        return $qry['kode'];
    }

    public function lastNumber($jns)
    {
        $last = $this->db->table('tb_surat')
            ->select("SUBSTRING_INDEX(SUBSTRING_INDEX(no_surat,' / ',2),' / ',-1)+1 AS nomor")
            ->where('jenis_surat', $jns)
            ->where('YEAR(tanggal) = YEAR(NOW())', null, false)
            ->where('rowstatus', 1)
            ->orderBy('id_surat', 'DESC')
            ->limit(1)
            ->get()
            ->getRowArray();

        if ($last && isset($last['nomor'])) {
            return (int) $last['nomor'];
        }

        return 1;
    }
    public function lastNumberCustom($jns, int $number)
    {
        $last = $this->db->table('tb_surat')
            ->select("SUBSTRING_INDEX(SUBSTRING_INDEX(no_surat,'/',2),'/',-1)+" . $number . " AS nomor")
            ->where('jenis_surat', $jns)
            ->where('YEAR(tanggal) = YEAR(NOW())', null, false)
            ->where('rowstatus', 1)
            ->orderBy('id_surat', 'DESC')
            ->limit(1)
            ->get()
            ->getRowArray();

        if ($last && isset($last['nomor'])) {
            return (int) $last['nomor'];
        }

        return $number + 1;
    }

    public function cekTtd($mengetahui)
    {
        return $this->db->table('tb_pegawai a')
            ->select('a.nama_pegawai, a.nip, b.`nama` as jabatan')
            ->join('tb_jabatan b', 'a.`jabatan`=b.`id_jabatan`', 'left')
            ->where('a.jabatan', $mengetahui)
            ->where('a.`aktif`', 1)
            ->where('a.`rowstatus`', 1)
            ->get()
            ->getRowArray();
    }

    // END SURAT

    // START SETTINGS
    public function nameCompany()
    {
        return $this->db->table('conf_sistem')
            ->select('content')
            ->where('id', 7)
            ->get()
            ->getRowArray();
    }

    // END SETTINGS
}
