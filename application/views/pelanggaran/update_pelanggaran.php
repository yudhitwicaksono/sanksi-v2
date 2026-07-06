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
						Update Pelanggaran
					</h3> </div>
					 <?php   foreach($pelanggaran->result() as $detail){ ?>
					<form role="form" action="<?php echo site_url();?>/main/updatePelanggaran" method="POST">
						
							<input type="hidden" value="<?php echo $detail->id_pelanggaran ?>" readonly  name="id_pelanggaran" required class="form-control underlined">
				
					<div class="form-group"> 
							<label class="control-label">Nama Pelanggaran</label> 
							<textarea name="nama_pelanggaran" required class="form-control underlined"><?php echo $detail->nama_pelanggaran ?></textarea>
					    </div>
						<!--<div class="form-group"> 
							<label class="control-label">Sanksi Pelanggaran</label> 
							<textarea name="sanksi_pelanggaran" required class="form-control underlined"><?php echo $detail->sanksi_pelanggaran ?></textarea>
					    </div>-->
						<div class="form-group"> 
							<label class="control-label">Point</label> 
							<input type="number" min="1" name="point" value="<?php echo $detail->point ?>"  required class="form-control underlined">
					    </div>
						<button type="submit" class="btn btn-primary">Simpan</button>
					</form>
			<?php } ?>
			</div>
		</div>
		
	</div>
</section>