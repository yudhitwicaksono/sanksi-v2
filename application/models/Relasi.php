<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Relasi extends CI_Model {


	public function v_pelanggaran($cKondisi="") {
		$Query = $this->db->query("SELECT * FROM v_pelanggaran ".$cKondisi."");
		return $Query->result_array();	
	}

	public function v_pelanggaran_sum($cKondisi="") {
		$Query = $this->db->query("SELECT * FROM v_pelanggaran_sum ".$cKondisi."");
		return $Query->result_array();	
	}

	public function v_tahun() {
		$Query = $this->db->query("SELECT DISTINCT tahun_pelanggaran FROM history_pelanggaran");
		return $Query->result_array();	
	}

	public function v_Panduan($cKondisi="") {
		$Query = $this->db->query("SELECT * FROM v_panduan ".$cKondisi." ");
		return $Query->result_array();	
	}

	public function v_Blog($cKondisi="") {
		$Query = $this->db->query("SELECT * FROM v_blog  ".$cKondisi." ");
		return $Query->result_array();	
	}


	public function grafik_bulan_tahun_default($cBulan,$cTahun) {
		$Query = $this->db->query("CALL p_grafik_bulan_tahun($cBulan,$cTahun)");
		return $Query->result_array();	
	}
	public function grafik_kelas_default($cIdKelas) {
		$Query = $this->db->query("CALL p_grafik_kelas($cIdKelas)");
		return $Query->result_array();	
	}

	public function grafik_kelas_bulan_tahun_default($cIdKelas,$cBulan,$cTahun) {
		$Query = $this->db->query("CALL p_grafik_kelas_bulan_tahun($cIdKelas,$cBulan,$cTahun)");
		return $Query->result_array();	
	}



}