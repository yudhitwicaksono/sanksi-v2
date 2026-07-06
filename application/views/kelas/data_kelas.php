<?php 
	$this->session->unset_userdata('pesan');
	$this->session->unset_userdata('parameter');
?>

<section class="section">
	<div class="row">
		<div class="col-md-12">
			<a href="<?php echo site_url(); ?>/main/input_data_kelas" >
			<button type="submit" class="btn btn-primary">Tambah Kelas</button>
		    </a>
		</div>
		<div class="col-md-12">
			<div class="card">
				<div class="card-block">
					<div class="card-title-block">
						<h3 class="title">
							Data Kelas
						</h3> </div>
						<section class="example">
							<div class="table-flip-scroll">
								<table class="table table-striped table-bordered table-hover flip-content" id="dataTables-example">
									<thead class="flip-header">
										<tr>
											<th style="text-align:center">No</th>
											<th style="text-align:center">Kelas</th>
										    <th style="text-align:center">Aksi</th>
										</tr>
									</thead>
									<tbody>
										<?php
											$i = 0 ;
											foreach ($kelas->result() as $row) {
												$i++;
											?>
											<tr scope="row">
												
												<td><?= $i ?></td> 
												<td><?= $row->kelas." ".$row->jurusan." ".$row->no_kelas ?></td>
											    <td style="text-align:center">	
													<a href="<?= site_url() ?>/main/hapusKelas/<?= $row->id_kelas ?>"> <i class="fa fa-trash"></i></a>
												</td>
											</tr>
											<?php
											}
										?>
									</tbody>
								</table>
							</div>
						</section>
				</div>
			</div>
		</div>
	</div> 
</section> 


