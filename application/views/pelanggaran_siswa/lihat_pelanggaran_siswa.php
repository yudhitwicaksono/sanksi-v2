<?php 
	$this->session->unset_userdata('pesan');
	$this->session->unset_userdata('parameter');
?>

<section class="section">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-block">
					<div class="card-title-block">
						<h3 class="title">
							Data Pelanggaran
						</h3> </div>
						<section class="example">
							
							<div class="table-flip-scroll">
								<div class="table-responsive">
									<table class="table table-striped table-bordered table-hover flip-content" id="dataTables-example">
										<thead class="flip-header">
											<tr>
												<th style="text-align:center">No</th>
												<th style="text-align:center">Siswa</th>
												<th style="text-align:center">Kelas</th>
												<th style="text-align:center">Tanggal</th>
												<th style="text-align:center">Pelanggaran</th>
												<th style="text-align:center">Point</th>
												<th style="text-align:center">Aksi</th>
											</tr>
										</thead>
										<tbody>
											<?php $i = 0 ; foreach ($siswa as $key => $vaData) { ?>
												<tr scope="row">
													<td><?= ++$i ?></td>
													<td><?= $vaData['nis'] ?> - <?= $vaData['nama_siswa'] ?></td>
													<td><?=$vaData['kelas']?> - 
													<?=$vaData['jurusan']?> -
													<?=$vaData['no_kelas']?></td>
													<td><?=$vaData['tgl_pelanggaran']?></td>
													<td><?= $vaData['nama_pelanggaran'] ?> </td>
													<td style="text-align:center"><?= number_format($vaData['point']) ?> Point</td>
													
													<td style="text-align:center">	
														<a href="<?= site_url() ?>/main/update_h_pelanggaran/<?=$vaData['id_history']?>"> <i class="fa fa-pencil"></i></a>
														<a href="<?= site_url() ?>/main/hapus_h_pelanggaran/<?=$vaData['id_history']?>"> <i class="fa fa-trash"></i></a>
													</td>
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


