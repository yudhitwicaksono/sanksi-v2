<?php 
	$this->session->unset_userdata('pesan');
	$this->session->unset_userdata('parameter');	
?> 
<section class="section">
	<div class="row sameheight-container">
		<div class="col-md-6">
			<div class="card card-block sameheight-item">
				<div class="title-block">
					<h3 class="title">
						Update Siswa
					</h3> </div>
					 <?php   foreach($siswa->result() as $detail){ ?>
					<form role="form" action="<?php echo site_url();?>/main/updateSiswa" method="POST">
					
						<div class="form-group"> 
							<label class="control-label">Nis</label> 
							<input type="text" name="nis" readonly value="<?php echo $detail->nis ?>"   required class="form-control underlined">
						</div>
						<div class="form-group"> 
							<label class="control-label">Nama Siswa</label> 
							<input type="text" name="nama_siswa" value="<?php echo $detail->nama_siswa ?>"  required class="form-control underlined">
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
									<option <?php if($detail->id_kelas==$row->id_kelas){ echo 'selected'; } ?> value="<?= $row->id_kelas ?>"><?= $row->kelas." ".$row->jurusan." ".$row->no_kelas ?></option>
									<?php
									}
								?>
							</select>
						</div>
						<div class="form-group"> 
							<label class="control-label">Alamat</label> 
							<textarea name="alamat_siswa" required class="form-control underlined"><?php echo $detail->alamat_siswa ?></textarea>
						</div>
						<div class="form-group"> 
							<label class="control-label">Tempat Lahir</label> 
							<input type="text" name="tempat_lahir" value="<?php echo $detail->tempat_lahir ?>"  required class="form-control underlined">
						</div>
						<div class="form-group"> 
							<label class="control-label">Tanggal Lahir</label> 
							<input type="date" name="tgl_lahir" value="<?php echo $detail->tgl_lahir ?>"  required class="form-control underlined">
						</div>
						
						
						<button type="submit" class="btn btn-primary">Simpan</button>
					</form>
			<?php } ?>
			</div>
		</div>
		
	</div>
</section>