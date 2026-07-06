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
						Update Bagian Kedisiplinan
					</h3> </div>
					 <?php   foreach($bagian_kedisiplinan->result() as $detail){ ?>
					<form role="form" action="<?php echo site_url();?>/main/updateBagianKedisiplinan" method="POST">
						<div class="form-group"> 
							<label class="control-label">Nip</label> 
							<input type="text" value="<?php echo $detail->nip ?>" readonly  name="nip" required class="form-control underlined">
					    </div>
						<div class="form-group"> 
							<label class="control-label">Nama</label> 
							<input type="text" value="<?php echo $detail->nama_guru ?>"  name="nama_guru" required class="form-control underlined">
					    </div>
						<div class="form-group"> 
							<label class="control-label">Alamat</label> 
							<textarea name="alamat_guru" required class="form-control underlined"><?php echo $detail->alamat_guru ?></textarea>
					    </div>
						<div class="form-group"> 
							<label class="control-label">No Hp</label> 
							<input type="number" min="1" name="no_hp" value="<?php echo $detail->no_hp ?>"  required class="form-control underlined">
					    </div>
						<div class="form-group"> 
							<label class="control-label">Email</label> 
							<input type="email" name="email" value="<?php echo $detail->email ?>"  required class="form-control underlined">
					    </div>
						
						
						<button type="submit" class="btn btn-primary">Simpan</button>
					</form>
			<?php } ?>
			</div>
		</div>
		
	</div>
</section>