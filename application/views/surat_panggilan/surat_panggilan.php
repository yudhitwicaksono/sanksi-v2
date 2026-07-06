<?php 
	$random = (rand()%9);
	foreach ($row as $column) {
		$cNis	=	$column['nis']	;
	}
?>
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
			<div class="row">
				<div class="col-xs-12">
					
					<div class="panel-body">
						<p>Nomor : <?php echo $random ?>/SMAN.8/BK/<?php echo date("Y") ?></p>
						<p>Lampiran : - </p>
						<p>Perihal : Panggilan Orang Tua/ Wali murid </p>
						<!-- client details -->
						<p>Kepada Yth    : </p> 
						<p>Bapak/ Ibu Wali Murid </p>
						<p> <?php echo $nama_siswa ?> </p>
						<p>kelas <?php echo $kelas.' '.$jurusan.' '.$no_kelas ?>  </p>
						<p>di <?php echo $alamat_wali ?></p>
					</div>
				</div>	
			</div> 
			<div class="row">
				<div class="col-xs-12">
					
					<div class="panel-body">
					<pre>
						
	Dengan hormat,
	Sehubungan dengan proses pembelajaran Putra  Bapak/ Ibu/ saudara, maka kami mengharapkan 
	kehadiran Bapak/ Ibu/ saudara :

		Tempat         : SMA Negeri 8 Bandung
		Kepentingan    : Konsultasi dengan Orang Tua / Wali Murid
		<?php foreach ($row as $key => $vaData) { ?>Pelanggaran    : <?=$vaData['nama_pelanggaran']?>
		<br>		Tanggal	       : <?=$vaData['tgl_pelanggaran']?>
		<?php } ?>
<br>
	Demikian Surat Panggilan ini kami sampaikan, atas kehadiran Bapak / Ibu/ saudara 
	kami ucapkan terima kasih.

					</pre>
				</div>
				
			</div>
			
		</div> <!-- /client details -->
		
		<div class="row">
			<div class="col-xs-12">
				
				<div class="panel-body">
				
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
<a href="<?= site_url() ?>/Main/viewPrintSurat/<?=$id_wali ?>/<?php echo $cNis?>" target="_blank"> <i class="fa fa-print"></i> Cetak Surat</a> 

