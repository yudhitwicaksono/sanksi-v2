<?php 
	$this->session->unset_userdata('pesan');
	$this->session->unset_userdata('parameter');
?>

<section class="section">
	<div class="row">
		<div class="col-md-12">
			<a href="<?php echo site_url(); ?>/main/input_bagian_kedisiplinan" >
				<button type="submit" class="btn btn-primary">Tambah Bagian Kedisiplinan</button>
			</a>
		</div>
		<div class="col-md-12">
			<div class="card">
				<div class="card-block">
					<div class="card-title-block">
						<h3 class="title">
							Data Bagian Kedisiplinan
						</h3> </div>
						<section class="example">
							<div class="table-flip-scroll">
								<table class="table table-striped table-bordered table-hover flip-content" id="dataTables-example">
									<thead class="flip-header">
										<tr>
											<th style="text-align:center">Nip</th>
											<th style="text-align:center">Nama</th>
											<th style="text-align:center">Alamat</th>
											<th style="text-align:center">Telepon</th>
											<th style="text-align:center">Email</th>
										    <th style="text-align:center">Aksi</th>
										</tr>
									</thead>
									<tbody>
										<?php
											$i = 0 ;
											foreach ($bagian_kedisiplinan->result() as $row) {
												$i++;
											?>
											<tr scope="row">
												
												
												<td><?= $row->nip ?></td>
												<td><?= $row->nama_guru ?></td>
												<td><?= $row->alamat_guru ?></td>
												<td><?= $row->no_hp ?></td>
												<td><?= $row->email ?></td>
												
											    <td style="text-align:center">	
													<a href="<?= site_url() ?>/main/uBagianKedisiplinan/<?= $row->nip ?>"> <i class="fa fa-pencil"></i></a>
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


