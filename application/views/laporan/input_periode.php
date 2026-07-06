<?php 
	$this->session->unset_userdata('pesan');
	$this->session->unset_userdata('parameter');	
	$cari = $wali_murid+1; 
	$id = "WM-".$cari ;	
?> 
<section class="section">
	<div class="row sameheight-container">
		<div class="col-md-6">
			<div class="card card-block sameheight-item">
				<div class="title-block">
					<h3 class="title">
						Pilih Periode
					</h3> </div>
					<form role="form" action="<?php echo site_url();?>/main/ViewLaporan" method="POST">
						<div class="form-group"> 
							<label class="control-label">Kelas</label> 
							<select name="id_kelas" required class="form-control underlined">
								<option value="semua-kelas">Semua Kelas</option>
								<?php
									$i = 0 ;
									foreach ($kelas->result() as $row) {
										$i++;
									?>
									<option value="<?= $row->id_kelas ?>"><?= $row->kelas." ".$row->jurusan." ".$row->no_kelas ?></option>
									<?php
									}
								?>
							</select>
						</div>
						<div class="form-group"> 
							<label class="control-label">Bulan</label> 
							<select name="bulan" required class="form-control underlined">
								<option value="semua-bulan">Belum Dipilih</option>
								<option value="01">Januari</option>
								<option value="02">Februari</option>
								<option value="03">Maret</option>
								<option value="04">April</option>
								<option value="05">Mei</option>
								<option value="06">Juni</option>
								<option value="07">Juli</option>
								<option value="08">Agustus</option>
								<option value="09">September</option>
								<option value="10">Oktober</option>
								<option value="11">November</option>
								<option value="12">Desember</option>
							</select>
						</div>
						<div class="form-group"> 
							<label class="control-label">Tahun</label> 
							<select name="tahun" required class="form-control underlined">
								<option value="semua-tahun">Belum Dipilih</option>
								<?php 
								$cDb = $this->db->query("SELECT DISTINCT tahun_pelanggaran FROM history_pelanggaran ");
								foreach ($cDb->result_array() as $key => $vaData) {
									# code...
								?>
								<option value="<?=$vaData['tahun_pelanggaran']?>">
									<?=$vaData['tahun_pelanggaran']?>	
								</option>
								<?php } ?>
							</select>
						</div>
						
						<button type="submit" class="btn btn-primary">Lihat laporan</button>
					</div>
			</div>
			
			
		</div>
	</section>		