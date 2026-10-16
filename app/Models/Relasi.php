<?php

namespace App\Models;

use CodeIgniter\Model as BaseModel;

class Relasi extends BaseModel
{
    protected $db;

    public function __construct()
    {
        parent::__construct();
        $this->db = \Config\Database::connect();
    }

    public function v_pelanggaran($cKondisi = "")
    {
        $sql = "SELECT * FROM v_pelanggaran " . $cKondisi;
        $res = $this->db->query($sql);
        return $res ? $res->getResultArray() : [];
    }

    public function v_pelanggaran_sum($cKondisi = "")
    {
        $sql = "SELECT * FROM v_pelanggaran_sum " . $cKondisi;
        $res = $this->db->query($sql);
        return $res ? $res->getResultArray() : [];
    }

    public function v_tahun()
    {
        $sql = "SELECT DISTINCT tahun_pelanggaran FROM history_pelanggaran WHERE tahun_pelanggaran IS NOT NULL ORDER BY tahun_pelanggaran DESC";
        $res = $this->db->query($sql);
        return $res ? $res->getResultArray() : [];
    }

    public function grafik_bulan_tahun_default($cBulan, $cTahun)
    {
        // Using direct SQL query matching the stored procedure logic to ensure zero connection state issues
        $sql = "SELECT p.nama_pelanggaran,
                    (SELECT COUNT(hp.id_pelanggaran) 
                     FROM history_pelanggaran hp 
                     WHERE hp.id_pelanggaran = p.id_pelanggaran 
                       AND MONTH(hp.tgl_pelanggaran) = ? 
                       AND YEAR(hp.tgl_pelanggaran) = ?) AS JumlahPelanggaran 
                FROM pelanggaran p
                ORDER BY JumlahPelanggaran DESC";
        $res = $this->db->query($sql, [(int)$cBulan, (int)$cTahun]);
        return $res ? $res->getResultArray() : [];
    }

    public function grafik_kelas_default($cIdKelas)
    {
        $sql = "SELECT p.nama_pelanggaran,
                    (SELECT COUNT(hp.id_pelanggaran) 
                     FROM history_pelanggaran hp 
                     WHERE hp.id_pelanggaran = p.id_pelanggaran 
                       AND hp.id_kelas = ?) AS JumlahPelanggaran 
                FROM pelanggaran p
                ORDER BY JumlahPelanggaran DESC";
        $res = $this->db->query($sql, [(int)$cIdKelas]);
        return $res ? $res->getResultArray() : [];
    }

    public function grafik_kelas_bulan_tahun_default($cIdKelas, $cBulan, $cTahun)
    {
        $sql = "SELECT p.nama_pelanggaran,
                    (SELECT COUNT(hp.id_pelanggaran) 
                     FROM history_pelanggaran hp 
                     WHERE hp.id_pelanggaran = p.id_pelanggaran 
                       AND hp.id_kelas = ?
                       AND MONTH(hp.tgl_pelanggaran) = ? 
                       AND YEAR(hp.tgl_pelanggaran) = ?) AS JumlahPelanggaran 
                FROM pelanggaran p
                ORDER BY JumlahPelanggaran DESC";
        $res = $this->db->query($sql, [(int)$cIdKelas, (int)$cBulan, (int)$cTahun]);
        return $res ? $res->getResultArray() : [];
    }
}
