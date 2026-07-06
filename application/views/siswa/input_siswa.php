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
						Data Siswa
					</h3> </div>
					<form role="form" action="<?php echo site_url();?>/main/insertSiswa" method="POST">
						<div class="form-group"> 
							<label class="control-label">Nis</label> 
							<input type="text" name="nis" required class="form-control underlined">
						</div>
						<div class="form-group"> 
							<label class="control-label">Nama Siswa</label> 
							<input type="text" name="nama_siswa" required class="form-control underlined">
						</div>
						<div class="form-group"> 
							<label class="control-label">Kelas</label> 
							<select name="id_kelas" required class="form-control underlined">
								<option value=""></option>
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
							<label class="control-label">Tahun Masuk</label> 
							<select name="tahun_ajaran_masuk" required class="form-control underlined">
								<option value=""></option>
							
								<?php
								$y  = date("Y");
									for ($i=1990; $i <= $y ; $i++) { 
										echo "
										<option value='$i'>$i</option>
										";
									}
								?>
								
							</select>
						</div>
						<div class="form-group"> 
							<label class="control-label">Alamat</label> 
							<textarea name="alamat_siswa" required class="form-control underlined"></textarea>
						</div>
						<div class="form-group"> 
							<label class="control-label">Tempat Lahir</label> 
							<input type="text" name="tempat_lahir" required class="form-control underlined">
						</div>
						<div class="form-group"> 
							<label class="control-label">Tanggal Lahir</label> 
							<input type="date" name="tgl_lahir" required class="form-control underlined">
						</div>
						
					</div>
			</div>
			<div class="col-md-6">
				<div class="card card-block sameheight-item">
					<div class="title-block">
						<h3 class="title">
							Data Wali
						</h3> </div>
						<form role="form" action="<?php echo site_url();?>/main/insertBagianKedisiplinan" method="POST">
							<div class="form-group"> 
								<label class="control-label">Id Wali</label> 
								<input type="text" value="<?php echo $id ?>" readonly name="id_wali_murid" required class="form-control underlined">
							</div>
							<div class="form-group"> 
								<label class="control-label">Nama Wali Siswa</label> 
								<input type="text" name="nama_wali" required class="form-control underlined">
							</div>
							<div class="form-group"> 
								<label class="control-label">Alamat Wali Siswa</label> 
								<textarea name="alamat_wali" required class="form-control underlined"></textarea>
							</div>
							<div class="form-group"> 
								<label class="control-label">No Telepon</label> 
								<input type="number" min="0" name="no_hp_wali" required class="form-control underlined">
							</div>
							<div class="form-group"> 
								<label class="control-label">Email</label> 
								<input type="email" name="email_wali" required class="form-control underlined">
							</div>
							
							
							<button type="submit" class="btn btn-primary">Simpan</button>
						</form>
				</div>
			</div>
			
		</div>
	</section>	