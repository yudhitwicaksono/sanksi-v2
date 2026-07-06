<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Login extends CI_Controller {
		
		//--------------- Function Login --------------//
		public function index(){
			$this->load->view('login');
		}
		
		public function validasiLogin(){
			$this->db->where('username',$this->input->post('username'));
			$this->db->where('password',$this->input->post('password'));
			
			$user = $this->db->get('user');
			if ($user->num_rows()==1) {
				foreach ($user->result() as $sess) {
					$sess_data['username'] = $sess->username;
					$sess_data['role'] = $sess->role;
					$this->session->set_userdata($sess_data);
				}
				
				if($this->session->userdata('role')=='Admin' or $this->session->userdata('role')=='Bagian Kedisiplinan'){
					$this->db->where('nip',$this->input->post('username'));
					$bagian_kedisiplinan = $this->db->get('bagian_kedisiplinan');
					
					foreach ($bagian_kedisiplinan->result() as $sess) {
						$sess_data['nama'] = $sess->nama_guru;
						$sess_data['foto'] = $sess->foto;
						$this->session->set_userdata($sess_data);
					}
					
					
				}
				
				if($this->session->userdata('role')=='Siswa'){
					$this->db->where('nis',$this->input->post('username'));
					$siswa = $this->db->get('siswa');
					
					foreach ($siswa->result() as $sess) {
						$sess_data['nama'] = $sess->nama_siswa;
						$sess_data['foto'] = $sess->foto;
						$this->session->set_userdata($sess_data);
					}
					
					
				}
				
				
				if ($this->session->userdata('role')=='Admin' or $this->session->userdata('role')=='Siswa' or $this->session->userdata('role')=='Bagian Kedisiplinan' or $this->session->userdata('role')=='Kepala Sekolah' or $this->session->userdata('role')=='Sapras'  ){
					$sess_data['pesan'] = 'Selamat Datang '.$this->session->userdata('role').' '.$this->session->userdata('nama').' di Aplikasi Sanksi dan Pelanggaran';
					$sess_data['parameter'] = '1';
			        $this->session->set_userdata($sess_data);
					redirect('main/index');			
					}else {
					echo "<script>alert('Gagal login: Cek username, password!');history.go(-1);</script>";
					$this->load->view('login');
				}
				}else{
				echo "<script>alert('Gagal login: Cek username, password!');history.go(-1);</script>";
				$this->load->view('login');
				
			}
		}
		
		public function logout(){
			$this->session->sess_destroy();
			?><script>alert('Berhasil Logout');
			document.location="<?php echo base_url(); ?>index.php/login/index";		
			</script><?php
			//$this->load->view('login');
		}
	}
