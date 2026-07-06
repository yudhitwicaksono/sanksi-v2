<?php 
	$this->session->unset_userdata('pesan');
	$this->session->unset_userdata('parameter');
?>
<section class="section">
	<div class="row sameheight-container">
		<div class="col-xl-8">
			<div class="card sameheight-item items" data-exclude="xs,sm,lg">
				<div class="card-header bordered">
					<div class="header-block">
						<h3 class="title">
            				Data Siswa
						</h3>  </div>
						<div class="header-block pull-left">
						<form method="POST" action="<?php echo site_url();?>/main/PelanggaranSiswa">
						<label class="search">
            				<input class="form-control underlined" name="nis" placeholder="Cari Nis...">
            				<i class="fa fa-search search-icon"></i>
						</label>
						</form>
						</div>
						<div class="header-block pull-left"> 
						<form method="POST" action="<?php echo site_url();?>/main/PelanggaranSiswa">
            				<select name="id_kelas" required id="id_kelas" onchange="this.form.submit()" class="form-control underlined">
								<option value="">Pilih Kelas</option>
								<?php
									$i = 0 ;
									foreach ($kelas->result() as $row) {
										$i++;
									?>
									<option value="<?= $row->id_kelas ?>"><?= $row->kelas." ".$row->jurusan." ".$row->no_kelas ?></option>
									<?php
									}
								?>
								<option value="">Semua Kelas</option>
							</select>
							
							</form>
						</div>
				</div>
				<ul class="item-list striped">
					<li class="item item-list-header hidden-sm-down">
						<div class="item-row">
							<div class="item-col item-col-header fixed item-col-img xs"></div>
							<div class="item-col item-col-header item-col-title">
								<div> <span>Nama</span> </div>
							</div>
							<div class="item-col item-col-header item-col-sales">
								<div> <span>Kelas</span> </div>
							</div>
							<div class="item-col item-col-header item-col-sales">
								<div> <span>Aksi</span> </div>
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
												<?= $row->nis.' '.$row->nama_siswa ?>
											</h4> </a>
									</div>
								</div>
								<div class="item-col item-col-sales">
									<div class="item-heading">Sales</div>
									<div> <?= $row->kelas.' '.$row->jurusan.' '.$row->no_kelas ?> </div>
								</div>
								
								<div class="item-col item-col-sales">
									<div class="item-heading">Published</div>
									<div> <a href="<?= site_url() ?>/main/i_pelanggaran_siswa/<?= $row->nis ?>"> <i class="fa fa-pencil"> Input Pelanggaran</i></a>
												 </div>
								</div>
							</div>
						</li>
						<?php
						}
						if($i < 1){
							?>
							<li class="item">
								<div class="item-row">
								 <p>Siswa yang anda cari tidak ada</p>
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
	