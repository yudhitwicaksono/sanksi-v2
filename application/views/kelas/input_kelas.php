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
						Input Kelas
					</h3> </div>
					<form role="form" action="<?php echo site_url();?>/main/insertKelas" method="POST">
						<div class="form-group"> 
							<label class="control-label">Kelas</label> 
							<select name="kelas" required class="form-control underlined">
								<option value="">Pilih Kelas</option>
								<option value="X">X</option>
								<option value="XI">XII</option>
								<option value="XII">XII</option>
							</select>
						</div>
						<div class="form-group"> 
							<label class="control-label">Jurusan</label> 
							<select name="jurusan" required class="form-control underlined">
								<option value="">Pilih Jurusan</option>
								<option value="MIPA">MIPA</option>
								<option value="IPS">IPS</option>
								<option value="Bahasa">Bahasa</option>
								<option value="-">-</option>
							</select>
						</div>
						
						<div class="form-group"> 
							<label class="control-label">No Kelas</label> 
							<select name="no_kelas" required class="form-control underlined">
								<option value="">Pilih No Kelas</option>
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
								<option value="6">6</option>
								<option value="7">7</option>
								<option value="8">8</option>
								<option value="9">9</option>
								<option value="10">10</option>
							</select>
						</div>
						
						
						<button type="submit" class="btn btn-primary">Simpan</button>
					</form>
			</div>
		</div>
		
	</div>
</section>