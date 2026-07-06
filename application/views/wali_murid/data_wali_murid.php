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
							Data Wali Murid
						</h3> </div>
						<section class="example">
							<div class="table-flip-scroll">
								<table class="table table-striped table-bordered table-hover flip-content" id="dataTables-example">
									<thead class="flip-header">
										<tr>
											<th style="text-align:center">Id Wali</th>
											<th style="text-align:center">Nama Wali</th>
										    <th style="text-align:center">Alamat</th>
										     <th style="text-align:center">No Hp</th>
										     <th style="text-align:center">Email</th>
										    <th style="text-align:center">Aksi</th>
										</tr>
									</thead>
									<tbody>
										<?php
											$i = 0 ;
											foreach ($data_wali_murid->result() as $row) {
												$i++;
											?>
											<tr scope="row">
												
												
												<td><?= $row->id_wali_murid ?></td>
												<td><?= $row->nama_wali ?></td>
												<td><?= $row->alamat_wali ?></td>
												<td><?= $row->no_hp_wali ?></td>
											    <td><?= $row->email_wali ?></td>
											    <td style="text-align:center">	
													<a href="<?= site_url() ?>/main/update_wali_murid/<?= $row->id_wali_murid ?>"> <i class="fa fa-pencil"></i></a>
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


