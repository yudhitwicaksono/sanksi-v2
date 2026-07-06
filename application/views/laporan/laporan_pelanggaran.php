
<br>
<div class="row">
	<div class="col-xs-12">
		<div class="panel panel-default">
			<!-- logo -->
			<br>
			<div class="col-xs-12">
				<table  width="100%">
					<tr>
						<td width="5%">
							<h1>
								<img width="100px" height="100px" src="<?PHP echo base_url(); ?>img/sma8.jpg">
							</h1>
						</td>
						<td align="center">
							<h3>SMAN 8 BANDUNG</h3>
							<h3>Bagian Kedisiplinan</h3>
							<h5>Alamat : Jalan Solontongan No. 3 Bandung - Jawa Barat 40264</h5>
						</td>
						<td width="5%"></td>
					</tr>
				</table>
			</div>
			<div class="clearfix"></div>
			<hr>
			
			<hr>
			<div class="clearfix"></div>
			
			<center>
				<h3>Laporan Pelanggaran Siswa</h3>
				<?php if ($id_kelas == 'semua-kelas') { ?>
				<h4>Kelas <?=$id_kelas?> Bulan <?=$bulan?> Tahun <?=$tahun?></h4>
				<?php } else { 
					foreach ($kelas as $key => $vaData) {
				?>
				<h4>Kelas <?=$vaData['kelas']?> <?=$vaData['jurusan']?> <?=$vaData['no_kelas']?> Bulan <?=$bulan?> Tahun <?=$tahun?></h4>
				<?php } } ?>
			</center>
			<!-- client details -->
			<br>
			<br>
			<br>
			<div class="row">
				<div class="col-xs-12">
				
				<div class="panel-body">
					<p>
						Bagian Kedisiplinan SMAN 8 BANDUNG, dengan ini menyatakan dibaawah ini telah melakukan pelanggran . 
						Berikut nama-nama siswa yang telah melakukan pelanggaran:
							<br>
					</p>
				</div>
				
				</div>
				
			</div> <!-- /client details -->
		
			<!-- items -->
			<div class="row">
				
					<div class="col-xs-12">
						<div class="panel-body">
							<table border="1" width="100%"  class="table table-striped table-bordered table-hover" id="">
								
								<tr>
									<td align="center">Nis</td>
									<td align="center">Nama</td>
									<td align="center">Tanggal</td>
									<td align="center">Pelanggaran</td>
									<td align="center">Point</td>
									
								</tr>
								
								<?php
									//Kita akan melakukan looping sesuai dengan data yang dimiliki
									$i = 1; //nantinya akan digunakan untuk pengisian Nomor
									$total=0;
									foreach ($row as $key => $vaData) { 
									?>
									<tr>
										
										<td><?= $vaData['nis'] ?></td> <!-- karena berbentuk objek, maka kita menggunakan panah (->) untuk menunjuk field yang ada di database -->
										<td><?= $vaData['nama_siswa'] ?></td>
										<td><?= $vaData['tgl_pelanggaran'] ?></td>
										<td><?= $vaData['nama_pelanggaran'] ?></td>
										<td><?= number_format($vaData['point']) ?></td>
									
							
										
									</tr>
									<?php
									
									}
								?>
							</table>
						</div>
						
					</div>
				
			</div>
			<div class="row">
				<div class="col-xs-12">
					
					<div class="panel-body">
						<p>
							Demikian Laporan Pelanggaran ini dibuat dengan sesungguhnya.
							
						</p>
					</div>
					
				</div>
				
			</div>
			<br>
			<br>
			<div class="row">
				<div class="col-xs-12">
					<table   width="100%">
						<tr>
							<td width="5%" rowspan="2">
								
							</td>
							<td rowspan="2">
							</td>
							<td width="30%" align="center" >
								Bandung, <br>
								Menyetujui Kepala Sekolah
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								
							</td>
						</tr>
						<tr>
							<td>
								&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; NIP..........
							</td>
						</td>
					</tr>
				</table>
			</div>
		</div>
		<br>
		<br>
		
	</div>
</div>
</div><!-- /row -->


<a href="<?= site_url() ?>/Main/viewPrint/<?= $id_kelas."_".$bulan."_".$tahun ?>" target="_blank"> <i class="fa fa-print"></i> Laporan Pelanggaran</a> 

