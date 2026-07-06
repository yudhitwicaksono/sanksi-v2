<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	//error_reporting(0);
	class Main extends CI_Controller {
		
		/**
			* Index Page for this controller.
			*
			* Maps to the following URL
			* 		http://example.com/index.php/welcome
			*	- or -
			* 		http://example.com/index.php/welcome/index
			*	- or -
			* Since this controller is set as the default controller in
			* config/routes.php, it's displayed at http://example.com/
			*
			* So any other public methods not prefixed with an underscore will
			* map to /index.php/welcome/<method_name>
			* @see https://codeigniter.com/user_guide/general/urls.html
		*/
		
		function __construct(){
			parent::__construct();
			$this->load->helper('url'); 
			$this->load->model('model');
        	$this->load->model('relasi');
			if ($this->session->userdata('username')=='') {
				redirect('login/index');
			}
			
		}

		public  function Date2String($dTgl){
			//return 2012-11-22
			list($cDate,$cMount,$cYear)	= explode("-",$dTgl) ;
			if(strlen($cDate) == 2){
				$dTgl	= $cYear . "-" . $cMount . "-" . $cDate ;
			}
			return $dTgl ; 
		}
		
		public  function String2Date($dTgl){
			//return 22-11-2012  
			list($cYear,$cMount,$cDate)	= explode("-",$dTgl) ;
			if(strlen($cYear) == 4){
				$dTgl	= $cDate . "-" . $cMount . "-" . $cYear ;
			} 
			return $dTgl ; 	
		}
		
		public function TimeStamp() {
			date_default_timezone_set("Asia/Jakarta");
			$Data = date("H:i:s");
			return $Data ;
			}
			
		public function DateStamp() {
   			date_default_timezone_set("Asia/Jakarta");
			$Data = date("d-m-Y");
			return $Data ;
			}  
			
		public function DateTimeStamp() {
   			date_default_timezone_set("Asia/Jakarta");
			$Data = date("Y-m-d h:i:s");
			return $Data ;
		}
		
		public function index()
		{
			$data['view']='home';
			$this->load->view('beranda',$data);
		}
		
		
		
		public function data_wali_murid(){
			
			$data['data_wali_murid'] = $this->db->query('select * from  wali_murid');
			$data['view']='wali_murid/data_wali_murid';
			$this->load->view('beranda',$data);
		}
		public function data_wali_muridP(){
			
			/*$data['data_wali_murid'] = $this->db->query('select * from siswa s 
			inner join kelas k on s.id_kelas = k.id_kelas
			inner join wali_murid w on s.id_wali_murid = w.id_wali_murid');*/
			$data['row']	 = $this->relasi->v_pelanggaran_sum("WHERE point >= '10'");
			$data['view']='surat_panggilan/data_wali_muridP';
			$this->load->view('beranda',$data);
		}
		
		
		public function surat_panggilan($id="",$nis="") {
			
			$this->db->query("UPDATE siswa SET status_surat = 'sudah-dicetak' WHERE nis = '$nis'");
			$siswa = $this->db->query("select * from siswa s 
			inner join kelas k on s.id_kelas = k.id_kelas
			inner join wali_murid w on s.id_wali_murid = w.id_wali_murid
			where w.id_wali_murid='$id'
			");
			foreach ($siswa->result() as $sess) {
			$data['nama_wali'] = $sess->nama_wali;
			$data['alamat_wali'] = $sess->alamat_wali;
			$data['nama_siswa'] = $sess->nama_siswa;
			$data['kelas'] = $sess->kelas;
			$data['jurusan'] = $sess->jurusan;
			$data['no_kelas'] = $sess->no_kelas;
			}

			$data['row']	 = $this->relasi->v_pelanggaran("WHERE nis = '$nis' AND point >= '10' ORDER BY tgl_pelanggaran LIMIT 0,1");


			$data['id_wali'] = $id;
			$data['view']='surat_panggilan/surat_panggilan';
			$this->load->view('beranda',$data);
		}
		
			public function viewPrintSurat($id="",$nis=""){
			
			$siswa = $this->db->query("select * from siswa s 
			inner join kelas k on s.id_kelas = k.id_kelas
			inner join wali_murid w on s.id_wali_murid = w.id_wali_murid
			where w.id_wali_murid='$id'
			");
			foreach ($siswa->result() as $sess) {
				$nama_wali = $sess->nama_wali;
				$data['alamat_wali'] = $sess->alamat_wali;
			$data['nama_siswa'] = $sess->nama_siswa;
			$data['kelas'] = $sess->kelas;
			$data['jurusan'] = $sess->jurusan;
			$data['no_kelas'] = $sess->no_kelas;
			}

			$data['row']	 = $this->relasi->v_pelanggaran("WHERE nis = '$nis' AND point >= '10' ORDER BY tgl_pelanggaran LIMIT 0,1");
			$data['id_wali'] = $id;
			$this->load->view('surat_panggilan/surat_panggilan',$data);
			// dapatkan output html
			
			
			
			
			$html = $this->output->get_output();
			
			// Load/panggil library dompdfnya
			$this->load->library('dompdf_gen');
			
			// Convert to PDF
			$this->dompdf->load_html($html);
			$this->dompdf->render();
			//utk menampilkan preview pdf
			$this->dompdf->stream("surat_panggilan-".$nama_wali.".pdf",array('Attachment'=>0));
			//atau jika tidak ingin menampilkan (tanpa) preview di halaman browser
			//$this->dompdf->stream("welcome.pdf");
		}
		
		public function update_wali_murid($id){
			$data['wali_murid'] = $this->db->query("select * from wali_murid where id_wali_murid='$id'");
			$data['view']='wali_murid/update_wali_murid';
			$this->load->view('beranda',$data);
		}
		
		public function updateWali(){
			
			$data2=array(
			
			'nama_wali' => $this->input->post('nama_wali'),
			'alamat_wali' => $this->input->post('alamat_wali'),
			'no_hp_wali' => $this->input->post('no_hp_wali'),
			'email_wali' => $this->input->post('email_wali'),
			
			);
			$id_wali_murid = $this->input->post('id_wali_murid'); 
			$this->db->where('id_wali_murid',$id_wali_murid); 
			$this->db->update('wali_murid', $data2);
			$sess_data['pesan'] = 'Data Wali Siswa '.$this->input->post('nama_wali').' berhasil Diupdate';
			$sess_data['parameter'] = '1';
			$this->session->set_userdata($sess_data);
			redirect('main/data_wali_murid');
		}
		
		public function data_pelanggaran(){
			
			$data['pelanggaran'] = $this->db->query('select * from pelanggaran	');
			$data['view']='pelanggaran/data_pelanggaran';
			$this->load->view('beranda',$data);
		}
		public function input_pelanggaran(){
			$data['view']='pelanggaran/input_pelanggaran';
			$this->load->view('beranda',$data);
		}
		
		
		public function update_pelanggaran($id){
			$data['pelanggaran'] = $this->db->query("select * from pelanggaran where id_pelanggaran='$id'");
			$data['view']='pelanggaran/update_pelanggaran';
			$this->load->view('beranda',$data);
		}
		
		public function insertPelanggaran(){
			$data = array(
			'nama_pelanggaran' => $this->input->post('nama_pelanggaran'),
			'sanksi_pelanggaran' => $this->input->post('sanksi_pelanggaran'),
			'point' => $this->input->post('point'),
			
			);
			
			
			$nama_pelanggaran = $this->input->post('nama_pelanggaran');
			$this->db->where('nama_pelanggaran',$nama_pelanggaran);
            $num = $this->db->count_all_results('pelanggaran');
			if($num < 1){
				
				$this->db->insert('pelanggaran', $data);
				
				$sess_data['pesan'] = 'Berhasil Menambah data pelanggaran';
				$sess_data['parameter'] = '1';
				}else{
				$sess_data['pesan'] = 'Maaf pelanggaran yang anda masukan sudah ada tercatat';
				$sess_data['parameter'] = '2';
				
			}
			$this->session->set_userdata($sess_data);
			redirect('main/data_pelanggaran');
		}
		
		public function insertPelanggaranM(){
			$data = array(
			'nis' => $this->input->post('nis'),
			'id_pelanggaran' => $this->input->post('id_pelanggaran'),
			'tgl_pelanggaran' => $this->input->post('tgl_pelanggaran'),
			'status_pelanggaran' => "Belum Validasi",
			
			);

			if ($data['tgl_pelanggaran'] < date("Y/m/d")) {
				$info = 'Tanggal melebihi hari ini';
			} else {
			$nis = $this->input->post('nis');
			$id_pelanggaran = $this->input->post('id_pelanggaran');
			$tgl_pelanggaran = $this->input->post('tgl_pelanggaran');
			$this->db->where('id_pelanggaran',$id_pelanggaran);
			$this->db->where('tgl_pelanggaran',$tgl_pelanggaran);
			$this->db->where('nis',$nis);
            $num = $this->db->count_all_results('history_pelanggaran');
				if($num < 1){
					
					$this->db->insert('history_pelanggaran', $data);
					
					$sess_data['pesan'] = 'Berhasil Menambah data pelanggaran Siswa';
					$sess_data['parameter'] = '1';
					}else{
					$sess_data['pesan'] = 'Maaf pelanggaran yang anda masukan sudah ada tercatat pada tanggal ini';
					$sess_data['parameter'] = '2';
					
				}
				$this->session->set_userdata($sess_data);
			}
			
			
			redirect('main/i_pelanggaran_siswa/'.$nis);
		}
		
		public function editPelanggaranM($id){
			$data = array(
			'nis' => $this->input->post('nis'),
			'id_pelanggaran' => $this->input->post('id_pelanggaran'),
			'tgl_pelanggaran' => $this->input->post('tgl_pelanggaran'),
			'status_pelanggaran' => "Belum Validasi"
			
			);
				
				$this->model->Update('history_pelanggaran','id_history',$id,$data);

				$sess_data['pesan'] = 'Berhasil Update data pelanggaran Siswa';
				$sess_data['parameter'] = '1';
				
			$this->session->set_userdata($sess_data);
			redirect('main/lihat_pelanggaran/');
		}
		
		public function siswa(){
			
			$data['siswa'] = $this->db->query('select * from siswa s 
			inner join kelas k on s.id_kelas = k.id_kelas
			inner join wali_murid w on s.id_wali_murid = w.id_wali_murid
			');
			$data['view']='siswa/data_siswa';
			$this->load->view('beranda',$data);
		}
		
		public function PelanggaranSiswa(){
			$nis = $this->input->post('nis');
			$id_kelas=$this->input->post('id_kelas'); 
			$data['kelas'] = $this->db->query('select * from kelas');
			if($nis=="" and $id_kelas==""){
				$data['siswa'] = $this->db->query('select * from siswa s 
				inner join kelas k on s.id_kelas = k.id_kelas
				inner join wali_murid w on s.id_wali_murid = w.id_wali_murid
				');
			}
			if($nis!=""){
				$data['siswa'] = $this->db->query("select * from siswa s 
				inner join kelas k on s.id_kelas = k.id_kelas
				inner join wali_murid w on s.id_wali_murid = w.id_wali_murid
				where s.nis='$nis'
				");
			}
			if($id_kelas!=""){
				$data['siswa'] = $this->db->query("select * from siswa s 
				inner join kelas k on s.id_kelas = k.id_kelas
				inner join wali_murid w on s.id_wali_murid = w.id_wali_murid
				where s.id_kelas='$id_kelas'
				");
			}
			$data['view']='pelanggaran_siswa/pelanggaran_siswa';
			$this->load->view('beranda',$data);
		}

		public function data_pelanggaran_siswa(){
			$nis = $this->session->userdata('username');
			$bulan=$this->input->post('bulan'); 
			$tahun=$this->input->post('tahun'); 
			$data['kelas'] = $this->db->query('select * from kelas');
		    $siswa = $this->db->query("select * from siswa where nis='$nis'");
			foreach ($siswa->result() as $sess) {
				$data['foto'] = $sess->foto;
				$data['nama'] = $sess->nama_siswa;
			}
			if($bulan=="" and $tahun=="" ){
				$data['siswa'] = $this->db->query("select * from history_pelanggaran hp
				inner join siswa s on hp.nis = s.nis 
				inner join kelas k on s.id_kelas = k.id_kelas
				inner join pelanggaran w on hp.id_pelanggaran = w.id_pelanggaran
				where hp.nis='$nis'
				");
			}
			
			if($bulan!="" and $tahun!="" ){
				$data['siswa'] = $this->db->query("select * from history_pelanggaran hp
				inner join siswa s on hp.nis = s.nis 
				inner join kelas k on s.id_kelas = k.id_kelas
				inner join pelanggaran w on hp.id_pelanggaran = w.id_pelanggaran
				where hp.nis='$nis' and month(hp.tgl_pelanggaran)='$bulan' and year(hp.tgl_pelanggaran)='$tahun'
				");
			}
			
			
			if($bulan=="" and $tahun!="" ){
				$data['siswa'] = $this->db->query("select * from history_pelanggaran hp
				inner join siswa s on hp.nis = s.nis 
				inner join kelas k on s.id_kelas = k.id_kelas
				inner join pelanggaran w on hp.id_pelanggaran = w.id_pelanggaran
				where hp.nis='$nis' and year(hp.tgl_pelanggaran)='$tahun'
				");
			}
			
			$data['view']='pelanggaran_siswa/data_pelanggaran_siswa';
			$this->load->view('beranda',$data);
		}

		public function lihat_pelanggaran(){
			


			//$data['action'] 	= $Aksi ; 
			$data['siswa']		= $this->model->ViewAsc('v_pelanggaran','tgl_pelanggaran');

			$data['view']='pelanggaran_siswa/lihat_pelanggaran_siswa';
			$this->load->view('beranda',$data);
		}


		public function ViewLaporan(){
			
			
			$id_kelas=$this->input->post('id_kelas'); 
			$bulan=$this->input->post('bulan');
			$tahun=$this->input->post('tahun');


			if ($id_kelas != 'semua-kelas' && $bulan == 'semua-bulan' && $tahun == 'semua-tahun') {
				$data['row']		= $this->model->ViewWhere('v_pelanggaran','id_kelas',$id_kelas);
				$data['kelas']		= $this->model->ViewWhere('kelas','id_kelas',$id_kelas);
			} elseif ($bulan !== 'semua-bulan' && $id_kelas == 'semua-kelas' && $tahun == 'semua-tahun') {
				$data['row']		= $this->model->ViewWhere('v_pelanggaran','month(tgl_pelanggaran)',$bulan);

			} elseif ($tahun !== 'semua-tahun' && $id_kelas == 'semua-kelas' && $bulan == 'semua-bulan') {
				$data['row']		= $this->model->ViewWhere('v_pelanggaran','year(tgl_pelanggaran)',$tahun);
			} elseif ($id_kelas !== 'semua-kelas' && $bulan !== 'semua-bulan' && $tahun == 'semua-tahun') {
				$data['row']		= $this->relasi->v_pelanggaran("WHERE id_kelas = '$id_kelas' AND month(tgl_pelanggaran) = '$bulan' ");
				$data['kelas']		= $this->model->ViewWhere('kelas','id_kelas',$id_kelas);
			} elseif ($id_kelas !== 'semua-kelas' && $tahun !== 'semua-tahun' && $bulan == 'semua-bulan') {
				$data['row']		= $this->relasi->v_pelanggaran("WHERE id_kelas = '$id_kelas' AND year(tgl_pelanggaran) = '$tahun' ");
				$data['kelas']		= $this->model->ViewWhere('kelas','id_kelas',$id_kelas);
			} elseif ($bulan !== 'semua-bulan' && $tahun !== 'semua-tahun' && $id_kelas == 'semua-kelas') {
				$data['row']		= $this->relasi->v_pelanggaran("WHERE month(tgl_pelanggaran) = '$bulan' AND year(tgl_pelanggaran) = '$tahun' ");
			} elseif ($id_kelas == 'semua-kelas' && $bulan == 'semua-bulan' && $tahun == 'semua-tahun') {
				$data['row']		= $this->model->ViewWhere('v_pelanggaran','id_history');
			}

			//$data['siswa']   = $this->model->ViewWhere('v_pelanggaran_sum','',);

			$data['siswa'] = $this->db->query("select k.*, hp.*, s.* , sum(w.point) as point from history_pelanggaran hp
			inner join siswa s on hp.nis = s.nis 
			inner join kelas k on s.id_kelas = k.id_kelas
			inner join pelanggaran w on hp.id_pelanggaran = w.id_pelanggaran
			where s.id_kelas='$id_kelas' and month(hp.tgl_pelanggaran)='$bulan' and year(hp.tgl_pelanggaran)='$tahun'
			group by hp.nis");
			
			$data['id_kelas']=$id_kelas;
			$data['bulan']=$bulan;
			$data['tahun']=$tahun;
			$data['view']='laporan/laporan_pelanggaran';
			$this->load->view('beranda',$data);
		}
		
		
		public function viewPrint($id){
			
			$pisah = explode("_",$id);
			
			$id_kelas=$pisah[0]; 
			$bulan=$pisah[1]; 
			$tahun=$pisah[2]; 
		    $data['id_kelas']=$id_kelas;
			$data['bulan']=$bulan;
			$data['tahun']=$tahun;


			$data['siswa'] = $this->db->query("select k.*, hp.*, s.* , sum(w.point) as point from history_pelanggaran hp
			inner join siswa s on hp.nis = s.nis 
			inner join kelas k on s.id_kelas = k.id_kelas
			inner join pelanggaran w on hp.id_pelanggaran = w.id_pelanggaran
			where s.id_kelas='$id_kelas' and month(hp.tgl_pelanggaran)='$bulan' and year(hp.tgl_pelanggaran)='$tahun'
			group by hp.nis");

			if ($id_kelas != 'semua-kelas' && $bulan == 'semua-bulan' && $tahun == 'semua-tahun') {
				$data['row']		= $this->model->ViewWhere('v_pelanggaran','id_kelas',$id_kelas);
				$data['kelas']		= $this->model->ViewWhere('kelas','id_kelas',$id_kelas);
			} elseif ($bulan !== 'semua-bulan' && $id_kelas == 'semua-kelas' && $tahun == 'semua-tahun') {
				$data['row']		= $this->model->ViewWhere('v_pelanggaran','month(tgl_pelanggaran)',$bulan);

			} elseif ($tahun !== 'semua-tahun' && $id_kelas == 'semua-kelas' && $bulan == 'semua-bulan') {
				$data['row']		= $this->model->ViewWhere('v_pelanggaran','year(tgl_pelanggaran)',$tahun);
			} elseif ($id_kelas !== 'semua-kelas' && $bulan !== 'semua-bulan' && $tahun == 'semua-tahun') {
				$data['row']		= $this->relasi->v_pelanggaran("WHERE id_kelas = '$id_kelas' AND month(tgl_pelanggaran) = '$bulan' ");
				$data['kelas']		= $this->model->ViewWhere('kelas','id_kelas',$id_kelas);
			} elseif ($id_kelas !== 'semua-kelas' && $tahun !== 'semua-tahun' && $bulan == 'semua-bulan') {
				$data['row']		= $this->relasi->v_pelanggaran("WHERE id_kelas = '$id_kelas' AND year(tgl_pelanggaran) = '$tahun' ");
				$data['kelas']		= $this->model->ViewWhere('kelas','id_kelas',$id_kelas);
			} elseif ($bulan !== 'semua-bulan' && $tahun !== 'semua-tahun' && $id_kelas == 'semua-kelas') {
				$data['row']		= $this->relasi->v_pelanggaran("WHERE month(tgl_pelanggaran) = '$bulan' AND year(tgl_pelanggaran) = '$tahun' ");
			} elseif ($id_kelas == 'semua-kelas' && $bulan == 'semua-bulan' && $tahun == 'semua-tahun') {
				$data['row']		= $this->model->ViewWhere('v_pelanggaran','id_history');
			}


			$this->load->view('laporan/laporan_pelanggaran',$data);
			// dapatkan output html
			
			
			
			
			$html = $this->output->get_output();
			
			// Load/panggil library dompdfnya
			$this->load->library('dompdf_gen');
			
			// Convert to PDF
			$this->dompdf->load_html($html);
			$this->dompdf->render();
			//utk menampilkan preview pdf
			$this->dompdf->stream("Laporan-Pelanggaran.pdf",array('Attachment'=>0));
			//atau jika tidak ingin menampilkan (tanpa) preview di halaman browser
			//$this->dompdf->stream("welcome.pdf");
		}
		
	
		
		public function i_pelanggaran_siswa($id){
			$data['pelanggaran'] = $this->db->query('select * from pelanggaran');
			$data['kelas'] = $this->db->query('select * from kelas');
		    $data['wali_murid'] = $this->db->count_all_results('wali_murid');
			$data['siswa'] = $this->db->query("select * from siswa where nis='$id'");
			$siswa = $this->db->query("select * from siswa where nis='$id'");
			foreach ($siswa->result() as $sess) {
				$data['foto'] = $sess->foto;
				$data['nama'] = $sess->nama_siswa;
			}
			
			$data['view']='pelanggaran_siswa/i_pelanggaran_siswa';
			$this->load->view('beranda',$data);
		}

		public function update_h_pelanggaran($id){
			$data['field'] = $this->model->ViewWhere('v_pelanggaran','id_history',$id);
			$data['pelanggaran'] = $this->model->ViewAsc('pelanggaran','id_pelanggaran');
			$data['view']='pelanggaran_siswa/e_pelanggaran_siswa';
			$this->load->view('beranda',$data);
		}
		
		
		
		public function input_siswa(){
			$data['kelas'] = $this->db->query('select * from kelas');
		    $data['wali_murid'] = $this->db->count_all_results('wali_murid');
			$data['view']='siswa/input_siswa';
			$this->load->view('beranda',$data);
		}	
		
		public function input_periode(){
			$data['kelas'] = $this->db->query('select * from kelas');
		    $data['view']='laporan/input_periode';
			$this->load->view('beranda',$data);
		}	
		
		
		public function insertSiswa(){
			$data = array(
			'id_wali_murid' => $this->input->post('id_wali_murid'),
			'nama_wali' => $this->input->post('nama_wali'),
			'alamat_wali' => $this->input->post('alamat_wali'),
			'no_hp_wali' => $this->input->post('no_hp_wali'),
			'email_wali' => $this->input->post('email_wali'),
			
			);
			
			$datas = array(
			'nis' => $this->input->post('nis'),
			'id_wali_murid' => $this->input->post('id_wali_murid'),
			'nama_siswa' => $this->input->post('nama_siswa'),
			'id_kelas' => $this->input->post('id_kelas'),
			'alamat_siswa' => $this->input->post('alamat_siswa'),
			'tempat_lahir' => $this->input->post('tempat_lahir'),
			'tgl_lahir' => $this->input->post('tgl_lahir'),
			'status_surat' => 'belum-dikirim'
			);
			
			
			
			$data2 = array(
			'username' => $this->input->post('nis'),
			'password' => $this->input->post('nis'),
			'role' => "Siswa",
			
			
			);
		    
			$datah = array(
			'nis' => $this->input->post('nis'),
			'id_kelas' => $this->input->post('id_kelas'),
		    'tahun_ajaran_masuk' => $this->input->post('tahun_ajaran_masuk'),
		    );
			
			$nis = $this->input->post('nis');
			$this->db->where('nis',$nis);
            $num = $this->db->count_all_results('siswa');
			if($num < 1){
				$this->db->insert('user', $data2);
				$this->db->insert('wali_murid', $data);
				$this->db->insert('siswa', $datas);
				$this->db->insert('histori_kelas', $datah);
				
				$sess_data['pesan'] = 'Berhasil Menambah Siswa';
				$sess_data['parameter'] = '1';
				}else{
				$sess_data['pesan'] = 'Maaf NIS sudah ada tercatat';
				$sess_data['parameter'] = '2';
				
			}
			$this->session->set_userdata($sess_data);
			redirect('main/siswa');
		}
		
		public function update_siswa($id){
			$data['kelas'] = $this->db->query('select * from kelas');
		    $data['wali_murid'] = $this->db->count_all_results('wali_murid');
			$data['siswa'] = $this->db->query("select * from siswa where nis='$id'");
			$data['view']='siswa/update_siswa';
			$this->load->view('beranda',$data);
		}
		
		public function setting_siswa($id){
			$data['kelas'] = $this->db->query('select * from kelas');
		    $data['wali_murid'] = $this->db->count_all_results('wali_murid');
			$data['siswa'] = $this->db->query("select * from siswa where nis='$id'");
			$siswa = $this->db->query("select * from siswa where nis='$id'");
			foreach ($siswa->result() as $sess) {
				$data['foto'] = $sess->foto;
				$data['nama'] = $sess->nama_siswa;
			}
			
			$data['view']='setting_siswa/profil_siswa';
			$this->load->view('beranda',$data);
		}
		
		public function setting_admin($id){
			$data['bagian_kedisiplinan'] = $this->db->query("select * from bagian_kedisiplinan where nip='$id'");
			$bagian_kedisiplinan = $this->db->query("select * from bagian_kedisiplinan where nip='$id'");
			foreach ($bagian_kedisiplinan->result() as $sess) {
				$data['foto'] = $sess->foto;
				$data['nama'] = $sess->nama_guru;
			}
			
			$data['view']='setting_admin/profil_admin';
			$this->load->view('beranda',$data);
		}
		
		
		
		public function kelas(){
			$data['kelas'] = $this->db->query('select * from kelas');
			$data['view']='kelas/data_kelas';
			$this->load->view('beranda',$data);
		}
		public function hapusKelas($id){
			$this->db->where('id_kelas', $id);
			$this->db->delete('kelas');
		    $sess_data['pesan'] = 'Data kelas berhasil Dihapus';
			$sess_data['parameter'] = '1';
			$this->session->set_userdata($sess_data);
			redirect('main/kelas');
		}
		public function hapus_peanggaran($id){
			$this->db->where('id_pelanggaran', $id);
			$this->db->delete('pelanggaran');
		    $sess_data['pesan'] = 'Data pelanggaran berhasil Dihapus';
			$sess_data['parameter'] = '1';
			$this->session->set_userdata($sess_data);
			redirect('main/data_pelanggaran');
		}
		public function hapus_h_pelanggaran($id){
			$this->model->Delete('history_pelanggaran','id_history',$id);
		    $sess_data['pesan'] = 'Data pelanggaran berhasil Dihapus';
			$sess_data['parameter'] = '1';
			$this->session->set_userdata($sess_data);
			redirect('main/lihat_pelanggaran');
		}
		public function bagian_kedisiplinan(){
			$data['bagian_kedisiplinan'] = $this->db->query('select * from bagian_kedisiplinan bk inner join user u on bk.nip=u.username');
			$data['view']='bagian_kedisiplinan/data_bagian_kedisiplinan';
			$this->load->view('beranda',$data);
		}
		
		
		public function input_bagian_kedisiplinan(){
			$data['view']='bagian_kedisiplinan/input_bagian_kedisiplinan';
			$this->load->view('beranda',$data);
		}	
		
		public function uBagianKedisiplinan($id){
			
			$data['bagian_kedisiplinan'] = $this->db->query("select * from bagian_kedisiplinan where nip='$id'");
			$data['view']='bagian_kedisiplinan/update_bagian_kedisiplinan';
			$this->load->view('beranda',$data);
		}
		
		
		public function updatePelanggaran(){
			
			$data2=array(
			
			'nama_pelanggaran' => $this->input->post('nama_pelanggaran'),
			'sanksi_pelanggaran' => $this->input->post('sanksi_pelanggaran'),
			'point' => $this->input->post('point'),
			
			);
			$id_pelanggaran = $this->input->post('id_pelanggaran'); 
			$this->db->where('id_pelanggaran',$id_pelanggaran); 
			$this->db->update('pelanggaran', $data2);
			$sess_data['pesan'] = 'Data pelanggaran berhasil Diupdate';
			$sess_data['parameter'] = '1';
			$this->session->set_userdata($sess_data);
			redirect('main/data_pelanggaran');
		}
		
		public function updateBagianKedisiplinan(){
			
			$data2=array(
			
			'nama_guru' => $this->input->post('nama_guru'),
			'alamat_guru' => $this->input->post('alamat_guru'),
			'no_hp' => $this->input->post('no_hp'),
			'email' => $this->input->post('email'),
			
			
			);
			$nip = $this->input->post('nip'); 
			$this->db->where('nip',$nip); 
			$this->db->update('bagian_kedisiplinan', $data2);
			$sess_data['pesan'] = 'Data guru '.$this->input->post('nama_guru').' berhasil Diupdate';
			$sess_data['parameter'] = '1';
			$this->session->set_userdata($sess_data);
			redirect('main/bagian_kedisiplinan');
		}
		public function updateBagianKedisiplinanP(){
			
			$data2=array(
			
			'nama_guru' => $this->input->post('nama_guru'),
			'alamat_guru' => $this->input->post('alamat_guru'),
			'no_hp' => $this->input->post('no_hp'),
			'email' => $this->input->post('email'),
			
			
			);
			$nip = $this->input->post('nip'); 
			$this->db->where('nip',$nip); 
			$this->db->update('bagian_kedisiplinan', $data2);
			$sess_data['pesan'] = 'Data guru '.$this->input->post('nama_guru').' berhasil Diupdate';
			$sess_data['parameter'] = '1';
			$this->session->set_userdata($sess_data);
			redirect('main/setting_admin/'.$nip);
		}
		
		public function updateProfil(){
			
			$data2=array(
			
			'nama_siswa' => $this->input->post('nama_siswa'),
			'alamat_siswa' => $this->input->post('alamat_siswa'),
			'tempat_lahir' => $this->input->post('tempat_lahir'),
			'tgl_lahir' => $this->input->post('tgl_lahir'),
			
			
			);
			$nis = $this->input->post('nis'); 
			$this->db->where('nis',$nis); 
			$this->db->update('siswa', $data2);
			$sess_data['pesan'] = 'Data Siswa '.$this->input->post('nama_siswa').' berhasil Diupdate';
			$sess_data['parameter'] = '1';
			$this->session->set_userdata($sess_data);
			redirect('main/index');
		}
		
		function prosesuploadFoto() {
			$this->load->helper(array('url', 'form'));
			$this->load->library('form_validation');
			
			
			if($this->input->post('submit'))
			{
				
				$files = $_FILES;
				$config['upload_path'] = './img/';
				$config['allowed_types'] = 'jpg|png';
				$config['max_size'] = '2000000';
				$config['file_name'] =  $files['userfile']['name'];
				$this->load->library('upload', $config);
				$nama= $files['userfile']['name'];
				$this->upload->initialize($config);
				if(! $this->upload->do_upload())
				{
					$error =  $this->upload->display_errors();
					$sess_data['pesan'] = 'Gagal Melakukan Upload '.$error;
					$sess_data['parameter'] = '2';
					
					$this->session->set_userdata($sess_data);
					redirect('main/index');
				}
				else
				{
					$data=$this->upload->data();
					$data1=array(
					
					'foto' => $nama,
					
					);
					$nis = $this->input->post('nis'); 
					$this->db->where('nis',$nis); 
					$this->db->update('siswa', $data1);
					
					$sess_data['pesan'] = 'Foto Berhasil Diganti';
					$sess_data['parameter'] = '1';
					$this->session->set_userdata($sess_data);
					redirect('main/index');
				}
			}
			else
			{
				
				$sess_data['pesan'] = 'Data Berhasil Dismpan';
				$sess_data['parameter'] = '1';
				$this->session->set_userdata($sess_data);
				redirect('main/index');
			}
			//redirect('home/uploadberkas');
		}
		
		function prosesuploadFotoA() {
			$this->load->helper(array('url', 'form'));
			$this->load->library('form_validation');
			
			
			if($this->input->post('submit'))
			{
				
				$files = $_FILES;
				$config['upload_path'] = './img/';
				$config['allowed_types'] = 'jpg|png';
				$config['max_size'] = '2000000';
				$config['file_name'] =  $files['userfile']['name'];
				$this->load->library('upload', $config);
				$nama= $files['userfile']['name'];
				$this->upload->initialize($config);
				if(! $this->upload->do_upload())
				{
					$error =  $this->upload->display_errors();
					$sess_data['pesan'] = 'Gagal Melakukan Upload '.$error;
					$sess_data['parameter'] = '2';
					
					$this->session->set_userdata($sess_data);
					redirect('main/index');
				}
				else
				{
					$data=$this->upload->data();
					$data1=array(
					
					'foto' => $nama,
					
					);
					$nip = $this->input->post('nip'); 
					$this->db->where('nip',$nip); 
					$this->db->update('bagian_kedisiplinan', $data1);
					
					$sess_data['pesan'] = 'Foto Berhasil Diganti';
					$sess_data['parameter'] = '1';
					$this->session->set_userdata($sess_data);
					redirect('main/index');
				}
			}
			else
			{
				
				$sess_data['pesan'] = 'Data Berhasil Dismpan';
				$sess_data['parameter'] = '1';
				$this->session->set_userdata($sess_data);
				redirect('main/index');
			}
			//redirect('home/uploadberkas');
		}
		
		
		public function updateSiswa(){
			
			$data2=array(
			
			'nama_siswa' => $this->input->post('nama_siswa'),
			'id_kelas' => $this->input->post('id_kelas'),
			'alamat_siswa' => $this->input->post('alamat_siswa'),
			'tempat_lahir' => $this->input->post('tempat_lahir'),
			'tgl_lahir' => $this->input->post('tgl_lahir'),
			
			
			);
			$nis = $this->input->post('nis'); 
			$this->db->where('nis',$nis); 
			$this->db->update('siswa', $data2);
			$sess_data['pesan'] = 'Data Siswa '.$this->input->post('nama_siswa').' berhasil Diupdate';
			$sess_data['parameter'] = '1';
			$this->session->set_userdata($sess_data);
			redirect('main/siswa');
		}
		
		
		public function insertBagianKedisiplinan(){
			$data = array(
			'nip' => $this->input->post('nip'),
			'nama_guru' => $this->input->post('nama_guru'),
			'alamat_guru' => $this->input->post('alamat_guru'),
			'no_hp' => $this->input->post('no_hp'),
			'email' => $this->input->post('email'),
			
			);
			$data2 = array(
			'username' => $this->input->post('nip'),
			'password' => $this->input->post('nip'),
			'role' => "Bagian Kedisiplinan",
			
			
			);
			
			$nip = $this->input->post('nip');
			$this->db->where('nip',$nip);
            $num = $this->db->count_all_results('bagian_kedisiplinan');
			if($num < 1){
				$this->db->insert('user', $data2);
				$this->db->insert('bagian_kedisiplinan', $data);
				
				$sess_data['pesan'] = 'Berhasil Menambah Bagian Kedisiplinan';
				$sess_data['parameter'] = '1';
				}else{
				$sess_data['pesan'] = 'Maaf Nip sudah ada tercatat';
				$sess_data['parameter'] = '2';
				
			}
			$this->session->set_userdata($sess_data);
			redirect('main/bagian_kedisiplinan');
		}
		
		
		
		
		public function input_data_kelas(){
			$data['view']='kelas/input_kelas';
			$this->load->view('beranda',$data);
		}	
		
		public function insertKelas(){
			$data = array(
			'kelas' => $this->input->post('kelas'),
			'jurusan' => $this->input->post('jurusan'),
			'no_kelas' => $this->input->post('no_kelas'),
			
			);
			
			$kelas = $this->input->post('kelas');
			$jurusan = $this->input->post('jurusan');
			$no_kelas = $this->input->post('no_kelas');
			$this->db->where('kelas',$kelas);
			$this->db->where('jurusan',$jurusan);
			$this->db->where('no_kelas',$no_kelas);
			$num = $this->db->count_all_results('kelas');
			if($num < 1){
				$this->db->insert('kelas', $data);
				$sess_data['pesan'] = 'Berhasil Menambah Kelas';
				$sess_data['parameter'] = '1';
				}else{
				$sess_data['pesan'] = 'Gagal Menambah Kelas Dikarenakan sudah ada tercatat';
				$sess_data['parameter'] = '2';
				
			}
			$this->session->set_userdata($sess_data);
			redirect('main/kelas');
		}	
		
	}
