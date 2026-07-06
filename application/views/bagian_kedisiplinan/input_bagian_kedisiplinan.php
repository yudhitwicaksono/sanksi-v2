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
						Input Bagian Kedisiplinan
					</h3> </div>
					<form role="form" action="<?php echo site_url();?>/main/insertBagianKedisiplinan" method="POST">
						<div class="form-group"> 
							<label class="control-label">Nip</label> 
							<input type="text" name="nip" required class="form-control underlined">
					    </div>
						<div class="form-group"> 
							<label class="control-label">Nama</label> 
							<input type="text" name="nama_guru" required class="form-control underlined">
					    </div>
						<div class="form-group"> 
							<label class="control-label">Alamat</label> 
							<textarea name="alamat_guru" required class="form-control underlined"></textarea>
					    </div>
						<div class="form-group"> 
							<label class="control-label">No Hp</label> 
							<input type="number" min="0" name="no_hp" required class="form-control underlined">
					    </div>
						<div class="form-group"> 
							<label class="control-label">Email</label> 
							<input type="email" name="email" required class="form-control underlined">
					    </div>
						
						
						<button type="submit" class="btn btn-primary">Simpan</button>
					</form>
			</div>
		</div>
		
	</div>
</section>