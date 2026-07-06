<?php 
	$this->session->unset_userdata('pesan');
	$this->session->unset_userdata('parameter');
?>

<section class="section">
	<div class="row">
		<div class="col-md-12">
			<a href="<?php echo site_url(); ?>/main/input_pelanggaran" >
				<button type="submit" class="btn btn-primary">Tambah Data Pelanggaran</button>
			</a>
		</div>
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
												<th style="text-align:center">Nama Pelanggaran</th>
												<!--<th style="text-align:center">Sanksi Pelanggaran</th>-->
												<th style="text-align:center">Point</th>
												<th style="text-align:center">Aksi</th>
											</tr>
										</thead>
										<tbody>
											<?php
												$i = 0 ;
												foreach ($pelanggaran->result() as $row) {
													$i++;
												?>
												<tr scope="row">
													
													
													<td><?= $i ?></td>
													<td><?= $row->nama_pelanggaran ?></td>
													<!--<td><?= $row->sanksi_pelanggaran ?></td>-->
													<td style="text-align:center"><?= number_format($row->point) ?> Point</td>
													
													<td style="text-align:center">	
														<a href="<?= site_url() ?>/main/update_pelanggaran/<?= $row->id_pelanggaran ?>"> <i class="fa fa-pencil"></i></a>
														<a href="<?= site_url() ?>/main/hapus_peanggaran/<?= $row->id_pelanggaran ?>"> <i class="fa fa-trash"></i></a>
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


