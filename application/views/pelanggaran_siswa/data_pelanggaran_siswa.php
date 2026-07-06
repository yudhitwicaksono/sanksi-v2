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
										
										<?php }
									}
								?>  
								
							</div>  
							<div class="form-group">  
								<label class="control-label">Alamat</label> 
								<textarea name="alamat_siswa" readonly required class="form-control underlined"><?php echo $detail->alamat_siswa ?></textarea>
							</div>
							
						</form>
					<?php } ?>
			</div>
		</div>
	</div>
</section>			
<section class="section">
	<div class="row sameheight-container">
		<div class="col-xl-8">
			<div class="card sameheight-item items" data-exclude="xs,sm,lg">
				<div class="card-header bordered">
					<div class="header-block">
						<h3 class="title">
							Data Pelanggaran
						</h3>  </div>
						<div class="header-block pull-left">
							<form method="POST" action="<?php echo site_url();?>/main/data_pelanggaran_siswa">
								<label class="search">
									<select name="bulan" required class="form-control underlined">
										<option value="">Pilih Bulan</option>
										<option value="01">Januari</option>
										<option value="02">Februari</option>
										<option value="03">Maret</option>
										<option value="04">April</option>
										<option value="05">Mei</option>
										<option value="06">Juni</option>
										<option value="07">Juli</option>
										<option value="08">Agustus</option>
										<option value="09">September</option>
										<option value="10">Oktober</option>
										<option value="11">November</option>
										<option value="12">Desember</option>
									</select>
									<i class="fa fa-search search-icon"></i>
								</label>
								
							</div>
							<div class="header-block pull-left"> 
								
								<select name="tahun" required class="form-control underlined" onchange="this.form.submit()">
									<option value="">Pilih Tahun</option>
									
									<?php
										$y  = date("Y");
										for ($i=2016; $i <= $y ; $i++) { 
											echo "
											<option value='$i'>$i</option>
											";
										}
									?>
									<option value="">Semua Tahun</option>
								</select>
								
							</form>
						</div>
				</div>
				<ul class="item-list striped">
					<li class="item item-list-header hidden-sm-down">
						<div class="item-row">
							<div class="item-col item-col-header fixed item-col-img xs"></div>
							<div class="item-col item-col-header item-col-title">
								<div> <span>Nama Pelangaran</span> </div>
							</div>
							<div class="item-col item-col-header item-col-sales">
								<div> <span>Tanggal Pelanggaran</span> </div>
							</div>
							<div class="item-col item-col-header item-col-date">
								<div> <span>Point</span> </div>
							</div>
						</div>
					</li>
					<?php
						$i = 0 ;
						foreach ($siswa->result() as $row) {
							$i++;
						?>
						<li class="item">
							<div class="item-row">
								<div class="item-col fixed item-col-img xs">
									<a href="">
										<div class="item-img xs rounded" style="background-image: url(<?php echo base_url(); ?>/img/<?php echo $row->foto ?>)"></div>
									</a>
								</div>
								<div class="item-col item-col-title no-overflow">
									<div>
										<a href="" class="">
											<h4 class="item-title no-wrap">
												<?= $i.' '.$row->nama_pelanggaran ?>
											</h4> </a>
									</div>
								</div>
								<div class="item-col item-col-sales">
									<div class="item-heading">Sales</div>
									<div> <?= $row->tgl_pelanggaran ?> </div>
								</div>
								
								<div class="item-col item-col-date">
									<div class="item-heading">Published</div>
									<div> <?= $row->point ?> </div>
								</div>
							</div>
						</li>
						<?php
							$total +=$row->point; 
							
						}
						if($i < 1){
						?>
						<li class="item">
							<div class="item-row">
								<p> Tidak ada Pelanggaran</p>
							</div>
						</li>
						<?php
							}else{
						?>
						<li class="item">
							<div class="item-row">
								<div class="item-col fixed item-col-img xs">
									
								</div>
								<div class="item-col item-col-title no-overflow">
									<div>
										<a href="" class="">
											<h4 class="item-title no-wrap">
												
											</h4> </a>
									</div>
								</div>
								<div class="item-col item-col-sales">
									<div class="item-heading">Sales</div>
									<div> Total Pelanggaran </div>
								</div>
								
								<div class="item-col item-col-date">
								<div class="item-heading">Published</div>
								<div> <?= $total ?> </div>
								</div>
								</div>
								</li>
								<?php
								
								}
								?>
								
								
								</ul>
								</div>
								</div>
								
								</div>
								</section>	
																