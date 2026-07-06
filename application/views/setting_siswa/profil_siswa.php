<?php 
	$this->session->unset_userdata('pesan');
	$this->session->unset_userdata('parameter');	
?> 
<section class="section">
	
	<div class="row sameheight-container">
		
		<div class="col-md-6">
			
			<div class="col-sm-3 col-md-12">
				
				<div class="thumbnail">
					<?php if($foto==""){ ?>
					<img src="<?php echo base_url(); ?>/img/user.jpg" width="300" height="300">
					<?php }else{
					?>
					<img src="<?php echo base_url(); ?>/img/<?php echo $foto ?>" width="300" height="300">
					<?php	
						} ?>
					<div class="caption">
						<br>
						<h3 style="text-align:center"><?php echo $nama ?></h3>
						<br>
						<p><a href="#" data-toggle="modal" data-target="#modal-media" class="btn btn-primary" role="button">Ganti Foto</a></p>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="card card-block sameheight-item">
				<div class="title-block">
					<h3 class="title">
						Data Siswa
					</h3> </div>
					<?php   foreach($siswa->result() as $detail){ ?>
						<form role="form" action="<?php echo site_url();?>/main/updateProfil" method="POST">
							
							<div class="form-group"> 
								<label class="control-label">Nis</label> 
								<input type="text" name="nis" readonly value="<?php echo $nis=$detail->nis ?>"   required class="form-control underlined">
							</div>
							<div class="form-group"> 
								<label class="control-label">Nama Siswa</label> 
								<input type="text" name="nama_siswa" value="<?php echo $detail->nama_siswa ?>"  required class="form-control underlined">
							</div>
							<div class="form-group"> 
								<label class="control-label">Kelas</label> 
								
								<?php
									$i = 0 ;
									foreach ($kelas->result() as $row) {
										$i++;
										?><?php if($detail->id_kelas==$row->id_kelas){ ?>
										<input type="text" readonly name="" value="<?php echo $row->kelas." ".$row->jurusan." ".$row->no_kelas  ?>" class="form-control underlined">
										
										<?php }
									}
								?>  
								
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
							
							
							<button type="submit" class="btn btn-primary">Ubah</button>
						</form>
					<?php } ?>
			</div>
		</div>
		
	</div>
</section>						
<div class="modal fade" id="modal-media">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header"> <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				<span class="sr-only">Close</span>
			</button>
			<h4 class="modal-title">Media Library</h4> </div>
			<div class="modal-body modal-tab-container">
				<ul class="nav nav-tabs modal-tabs" role="tablist">
					<li class="nav-item"> <a class="nav-link active" href="#upload" data-toggle="tab" role="tab">Upload</a> </li>
				</ul>
				<div class="tab-content modal-tab-content">
					
					<div class="tab-pane fade active in" id="upload" role="tabpanel">
						
						
						<?php echo form_open_multipart('Main/prosesuploadFoto'); ?>
						<div class="col-md-6">
						<input type="hidden" name="nis" readonly value="<?php echo $nis ?>"   required class="form-control underlined">
							<input type="file" name="userfile" required class="form-control underlined" >
							
							<input type="submit" value="upload" name="submit" class="btn btn-primary" value="Submit">
						</div>
					</form>
					
				</div>
			</div>
		</div>
	</div>
	<div class="modal-footer"> <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button></div>
</div>
<!-- /.modal-content -->
</div>