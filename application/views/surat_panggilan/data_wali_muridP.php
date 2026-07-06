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
											<th style="text-align:center">Nis</th>
											<th style="text-align:center">Nama Siswa</th>
											<th style="text-align:center">Kelas</th>
											<th style="text-align:center">Nama Wali</th>
											<th style="text-align:center">Status Surat</th>
										    <th style="text-align:center">Aksi</th>
										</tr>
									</thead>
									<tbody>
										<?php
											$i = 0 ;
											 foreach ($row as $key => $vaData) { 
												$i++;
											?>
											<tr scope="row">
												
												
												<td><?= $vaData['nis'] ?></td>
												<td><?= $vaData['nama_siswa'] ?></td>
												<td><?= $vaData['kelas']?> <?=$vaData['jurusan']?> - <?=$vaData['no_kelas']?></td>
												<td><?= $vaData['nama_wali'] ?></td>
												<td><?= $vaData['status_surat'] ?></td>
											    <td style="text-align:center">	
													<a href="<?= site_url() ?>/main/surat_panggilan/<?=$vaData['id_wali_murid']?>/<?=$vaData['nis'] ?>/"> <i class="fa fa-pencil"> Buat Surat Panggilan</i></a>
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
			
			
						