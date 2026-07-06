<?php 
	$this->session->unset_userdata('pesan');
	$this->session->unset_userdata('parameter');
?>

<section class="section">
	<div class="row">
		<div class="col-md-12">
			<a href="<?php echo site_url(); ?>/main/input_siswa" >
				<button type="submit" class="btn btn-primary">Tambah Siswa</button>
			</a>
		</div>
		<div class="col-md-12">
			<div class="card">
				<div class="card-block">
					<div class="card-title-block">
						<h3 class="title">
							Data Siswa
						</h3> </div>
						<section class="example">
							<div class="table-flip-scroll">
								<table class="table table-striped table-bordered table-hover flip-content" id="dataTables-example">
									<thead class="flip-header">
										<tr>
											<th style="text-align:center">Nis</th>
											<th style="text-align:center">Nama</th>
											<th style="text-align:center">Nama Wali</th>
											<th style="text-align:center">Kelas</th>
											<th style="text-align:center">TTL</th>
											<th style="text-align:center">Alamat</th>
										    <th style="text-align:center">Aksi</th>
										</tr>
									</thead>
									<tbody>
										<?php
											$i = 0 ;
											foreach ($siswa->result() as $row) {
												$i++;
											?>
											<tr scope="row">
												
												
												<td><?= $row->nis ?></td>
												<td><?= $row->nama_siswa ?></td>
												<td><?= $row->nama_wali ?></td>
												<td><?= $row->kelas.' '.$row->jurusan.' '.$row->no_kelas ?></td>
												<td><?= $row->tempat_lahir.', '.$row->tgl_lahir ?></td>
												<td><?= $row->alamat_siswa ?></td>
											    <td style="text-align:center">	
													<a href="<?= site_url() ?>/main/update_siswa/<?= $row->nis ?>"> <i class="fa fa-pencil"></i></a>
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


