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
					<img src="<?php echo base_url(); ?>/img/user.jpg" >
					<?php }else{
					?>
					<img src="<?php echo base_url(); ?>/img/<?php echo $foto ?>" >
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
						Data Admin
					</h3> </div>
					<?php   foreach($bagian_kedisiplinan->result() as $detail){ ?>
					<form role="form" action="<?php echo site_url();?>/main/updateBagianKedisiplinanP" method="POST">
						<div class="form-group"> 
							<label class="control-label">Nip</label> 
							<input type="text" value="<?php echo $nip = $detail->nip ?>" readonly  name="nip" required class="form-control underlined">
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
						
						
						<?php echo form_open_multipart('Main/prosesuploadFotoA'); ?>
						<div class="col-md-6">
						<input type="hidden" name="nip" readonly value="<?php echo $nip ?>"   required class="form-control underlined">
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