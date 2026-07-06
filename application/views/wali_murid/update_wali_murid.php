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
						Update Wali Murid
					</h3> </div>
					 <?php   foreach($wali_murid->result() as $detail){ ?>
					<form role="form" action="<?php echo site_url();?>/main/updateWali" method="POST">
			
						<div class="form-group"> 
								<label class="control-label">Id Wali</label> 
								<input type="text" value="<?php echo $detail->id_wali_murid ?>"  readonly name="id_wali_murid" required class="form-control underlined">
							</div>
							<div class="form-group"> 
								<label class="control-label">Nama Wali Siswa</label> 
								<input type="text" name="nama_wali" value="<?php echo $detail->nama_wali ?>" required class="form-control underlined">
							</div>
							<div class="form-group"> 
								<label class="control-label">Alamat Wali Siswa</label> 
								<textarea name="alamat_wali" required class="form-control underlined"><?php echo $detail->alamat_wali ?></textarea>
							</div>
							<div class="form-group"> 
								<label class="control-label">No Telepon</label> 
								<input type="number" min="0" name="no_hp_wali" value="<?php echo $detail->no_hp_wali ?>"  required class="form-control underlined">
							</div>
							<div class="form-group"> 
								<label class="control-label">Email</label> 
								<input type="email" name="email_wali" required value="<?php echo $detail->email_wali ?>"  class="form-control underlined">
							</div>
						
						<button type="submit" class="btn btn-primary">Simpan</button>
					</form>
			<?php } ?>
			</div>
		</div>
		
	</div>
</section>