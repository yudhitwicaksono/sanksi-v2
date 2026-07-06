<?php 
	$this->session->unset_userdata('pesan');
	$this->session->unset_userdata('parameter');	
?> 
<section class="section">
	
	<div class="row sameheight-container">
		
		<div class="col-md-6">
			
			<div class="col-sm-3 col-md-4">
				
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
						<h3><?php echo $nama ?></h3>
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
					<?php   foreach($siswa->result() as $detail){ ?>
						<form role="form" action="<?php echo site_url();?>/main/insertPelanggaranM" method="POST">
							
							<div class="form-group"> 
								<label class="control-label">Nis</label> 
								<input type="text" name="nis" readonly value="<?php echo $nis=$detail->nis ?>"   required class="form-control underlined">
							</div>
							<div class="form-group"> 
								<label class="control-label">Nama Siswa</label> 
								<input type="text" readonly name="nama_siswa" value="<?php echo $detail->nama_siswa ?>"  required class="form-control underlined">
							</div>
							<div class="form-group"> 
								<label class="control-label">Kelas</label> 
								
								<?php
									$i = 0 ;
									foreach ($kelas->result() as $row) {
										$i++;
										?><?php if($detail->id_kelas==$row->id_kelas){ ?>
										<input type="text" readonly name="" value="<?php echo $row->kelas." ".$row->jurusan." ".$row->no_kelas  ?>" class="form-control underlined">
										<input type="hidden" name="cIdKelas" 
										value="<?=$row->id_kelas?>">
										<?php }
									}
								?>  
								
							</div>  
							<div class="form-group"> 
								<label class="control-label">Tanggal Pelanggaran</label> 
								<input type="date" name="tgl_pelanggaran"   required class="form-control underlined">
							</div>
							
							<div class="form-group">  
								<label class="control-label">Pelanggaran</label> 
							<select name="id_pelanggaran" required class="form-control underlined">
								<option value=""></option>
								<?php
									$i = 0 ;
									foreach ($pelanggaran->result() as $row) {
										$i++;
									?>
									<option value="<?= $row->id_pelanggaran ?>"><?= $row->nama_pelanggaran ?></option>
									<?php
									}
								?>
							</select>	</div>

							<div class="form-group"> 
							<label class="control-label">Sanksi Pelanggaran</label> 
							<input type="text" name="sanksi" required class="form-control underlined">
							</div>
							
							
							
							<button type="submit" class="btn btn-primary">Submit</button>
						</form>
					<?php } ?>
			</div>
		</div>
		
	</div>
</section>			

<section class="section">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-block">
					<!--<div class="card-title-block">
						<h3 class="title">
							Data Pelanggaran
						</h3> </div>-->
						<section class="example">
							
							<div class="table-flip-scroll">
								<div class="table-responsive">
									<table class="table table-striped table-bordered table-hover flip-content" id="dataTables-example">
										<thead class="flip-header">
											<tr>
												<th style="text-align:center">No</th>
												<th style="text-align:center">Tanggal</th>
												<th style="text-align:center">Pelanggaran</th>
												<th style="text-align:center">Sanksi</th>
												<th style="text-align:center">Point</th>
											</tr>
										</thead>
										<tbody>
											<?php $i = 0 ; foreach ($tampil as $key => $vaData) { ?>
												<tr scope="row">
													<td><?= ++$i ?></td>
													<td><?=$vaData['tgl_pelanggaran']?></td>
													<td><?=$vaData['nama_pelanggaran'] ?> </td>
													<td><?=$vaData['sanksi_pelanggaran'] ?> </td>
													<td style="text-align:center"><?=$vaData['point']?> Point</td>
													
												
												</tr>
												<?php
												}
											?>
										</tbody>
									</table>
								</div>
							</div>
						</section>
				</div>
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