<?php 
	$this->session->unset_userdata('pesan');
	$this->session->unset_userdata('parameter');
	foreach ($field as $column){
		$IdHistory = $column['id_history'];
		$foto = $column['foto'];
		$nama = $column['nama_siswa'];
		$nis  = $column['nis'];
		$sanksi  = $column['sanksi_pelanggaran'];
		$tanggal = $column['tgl_pelanggaran'];
		$kelas = $column['kelas'];
		$jurusan = $column['jurusan'];
		$no_kelas = $column['no_kelas'];
		$IdPelanggaran = $column['id_pelanggaran'];
		
	} 	
?> 
<section class="section">
	
	<div class="row sameheight-container">
		
		<div class="col-md-6">
			
			<div class="col-sm-3 col-md-4">
				
				<div class="thumbnail">

					<?php if($foto=='') { ?>
					<img src="<?php echo base_url(); ?>img/user.jpg" width="300" height="300">
					<?php } else { ?>
					<img src="<?php echo base_url(); ?>img/<?= $foto ?>" width="300" height="300">
					<?php } ?>
					<div class="caption">
						<br>
						<h3><?= $nama ?></h3>
						<br>
						
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

						<form role="form" action="<?php echo site_url();?>/main/editPelanggaranM/<?=$IdHistory?>" method="POST">
							
							<div class="form-group"> 
								<label class="control-label">Nis</label> 
								<input type="text" name="nis" readonly value="<?=$nis?>"   required class="form-control underlined">
							</div>
							<div class="form-group"> 
								<label class="control-label">Nama Siswa</label> 
								<input type="text" readonly name="nama_siswa" value="<?=$nama?>"  required class="form-control underlined">
							</div>
							<div class="form-group"> 
								<label class="control-label">Kelas</label> 
										<input type="text" readonly name="" value="<?=$kelas?> <?=$jurusan?> - <?=$no_kelas?>" class="form-control underlined">
	
								
							</div>
							
							<div class="form-group"> 
								<label class="control-label">Tanggal Pelanggaran</label> 
								<input type="date" name="tgl_pelanggaran" value="<?=$tanggal?>" required class="form-control underlined" >
							</div>
						
							<div class="form-group">  
								<label class="control-label">Pelanggaran</label> 
							<select name="id_pelanggaran" required class="form-control underlined">
								<option></option>
					 				<?php foreach ($pelanggaran as $key => $vaData) { ?>
					 				<option value="<?=$vaData['id_pelanggaran']?>"<?php if($vaData['id_pelanggaran'] == $IdPelanggaran)echo "selected"; ?>>
					 					<?=$vaData['nama_pelanggaran']?>
					 				</option>	
					 				<?php } ?>
								
							</select>	</div>
							
							<div class="form-group"> 
								<label class="control-label">Sanksi Pelanggaran</label> 
								<input type="text" name="sanksi" value="<?=$sanksi?>" required class="form-control underlined">
							</div>
							
							
							<button type="submit" class="btn btn-primary">Submit</button>
						</form>
					
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