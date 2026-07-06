<?php  error_reporting(0) ?>
<!doctype html>
<html class="no-js" lang="en">
	
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title> SMAN 8 Bandung </title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <!-- Place favicon.ico in the root directory -->
		<link href="<?php echo base_url(); ?>dataTables/dataTables.bootstrap.css" rel='stylesheet' type='text/css' /> 
			<link href="<?php echo base_url(); ?>css/bootstrap.min.css" rel='stylesheet' type='text/css' />
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/vendor.css">
		<link rel="stylesheet" id="theme-style" href="<?php echo base_url(); ?>css/app.css">
		<link rel="stylesheet" id="theme-style" href="<?php echo base_url(); ?>css/app-blue.css">
		
		
		
	</head>
	
    <body>
        <div class="main-wrapper">
            <div class="app" id="app">
                <header class="header">
                    <div class="header-block header-block-collapse hidden-lg-up"> <button class="collapse-btn" id="sidebar-collapse-btn">
						<i class="fa fa-bars"></i>
					</button> </div>
                    <div class="header-block header-block-search hidden-sm-down">
						
					</div>
                    
                    <div class="header-block header-block-nav">
                        <ul class="nav-profile">
							
                            <li class="profile dropdown">
                                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                    <?php if($this->session->userdata('foto')==""){ ?>
									<div class="img" style="background-image: url('<?php echo base_url(); ?>img/user.jpg')"> </div> 
									<?php }else{ ?>
										<div class="img" style="background-image: url('<?php echo base_url(); ?>img/<?php echo $this->session->userdata('foto') ?>')"> </div> 
									<?php } ?>
									<span class="name">
										<?php echo $this->session->userdata('nama') ?>
									</span> </a>
									<div class="dropdown-menu profile-dropdown-menu" aria-labelledby="dropdownMenu1">
									<?php if($this->session->userdata('role')=='Admin' or $this->session->userdata('role')=='Bagian Kedisiplinan'){ ?>
									<a class="dropdown-item" href="<?php echo site_url(); ?>/main/setting_admin/<?php echo $this->session->userdata('username') ?>">
											<i class="fa fa-user icon"></i> Profile </a>
									<?php }else{
									?>
									<a class="dropdown-item" href="<?php echo site_url(); ?>/main/setting_siswa/<?php echo $this->session->userdata('username') ?>">
										<i class="fa fa-user icon"></i> Profile </a>
								    <?php	
										} ?>		
										<div class="dropdown-divider"></div>
										<a class="dropdown-item" href="<?php echo site_url(); ?>/login/logout 
									""> <i class="fa fa-power-off icon"></i> Logout </a>
							</div>
						</li>
					</ul>
				</div>
			</header>
			<aside class="sidebar">
				<div class="sidebar-container">
					<div class="sidebar-header">
						<div class="brand">
						<div class="logo"> <span class="l l1"></span> <span class="l l2"></span> <span class="l l3"></span> <span class="l l4"></span> <span class="l l5"></span> </div> SMAN 8 Bandung </div>
					</div>
					<nav class="menu">
						<ul class="nav metismenu" id="sidebar-menu">
							<li class="active">
								<a href="<?php echo site_url(); ?>/main/index"> <i class="fa fa-home"></i> Dashboard </a>
							</li>
							<?php if($this->session->userdata('role')=='Admin' or $this->session->userdata('role')=='Bagian Kedisiplinan'){ ?>
                                <li>
                                    <a href=""> <i class="fa fa-th-large"></i> Master <i class="fa arrow"></i> </a>
                                    <ul>
                                        <li> <a href="<?php echo site_url(); ?>/main/kelas">
											Kelas
										</a> </li>
                                        <li> <a href="<?php echo site_url(); ?>/main/siswa">
											Siswa
										</a> </li>
										<li> <a href="<?php echo site_url(); ?>/main/data_wali_murid">
											Wali Murid
										</a> </li>
										<li> <a href="<?php echo site_url(); ?>/main/bagian_kedisiplinan">
											Bagian Kedisiplinan
										</a> </li>
										<li> <a href="<?php echo site_url(); ?>/main/data_pelanggaran">
											Pelanggaran 
										</a> </li>
									</ul>
								</li>
                                <li>
                                    <a href=""> <i class="fa fa-pencil-square-o"></i> Kelola Kedisiplinan <i class="fa arrow"></i> </a>
                                    <ul>
                                        <li> <a href="<?php echo site_url(); ?>/main/PelanggaranSiswa">
											Input Pelanggaran
										</a> </li>
										<li> <a href="<?php echo site_url(); ?>/main/lihat_pelanggaran">
											Edit Pelanggaran
										</a> </li>
                                        <li> <a href="<?php echo site_url(); ?>/main/input_periode">
											Data Pelanggaran
										</a> </li>
									</ul>
								</li>
                                <li>
                                    <a href=""> <i class="fa fa-table"></i> Surat Panggilan <i class="fa arrow"></i> </a>
                                    <ul>
                                        <li> <a href="<?php echo site_url(); ?>/main/data_wali_muridP">
											Wali Murid
										</a> </li>  
									</ul>
								</li>
								<?php } 
								if ($this->session->userdata('role')=='Siswa'){ 
								?>
								<li>
                                    <a href=""> <i class="fa fa-pencil-square-o"></i> Pelanggaran <i class="fa arrow"></i> </a>
                                    <ul>
										
                                        <li> <a href="<?php echo site_url(); ?>/main/data_pelanggaran_siswa">
											Data Pelanggaran
										</a> </li>
										
									</ul>
								</li>
								
								<?php
									
								}?>
								
								
								
						</ul>
					</nav>
				</div>
				<footer class="sidebar-footer">
					<ul class="nav metismenu" id="customize-menu">
						<li>
							
							<a href="<?php echo site_url(); ?>/login/logout"> <i class="fa fa-power-off"></i> Logout </a>
					</li>
				</ul>
			</footer>
		</aside>
		<div class="sidebar-overlay" id="sidebar-overlay"></div>
		<article class="content dashboard-page">
			<!-- konten dinamis -->  
			
			<?php if ($this->session->userdata('parameter')=='1'){ ?>
				<br>
				<div class="row">
					<div class="col-lg-12">
						<div class="alert alert-success alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<?php echo $this->session->userdata('pesan') ?>.
						</div>
					</div>
				</div>
				<?php }if ($this->session->userdata('parameter')=='2'){ ?>
				<br>
				<div class="row">
					<div class="col-lg-12">
						<div class="alert alert-danger alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<?php echo $this->session->userdata('pesan') ?>.
						</div>
					</div>
				</div>
				<?php }	if ($this->session->userdata('parameter')=='3'){ ?>
				<br>
				<div class="row">
					<div class="col-lg-12">
						<div class="alert alert-danger alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<?php echo $this->session->userdata('pesan') ?>.
						</div>
					</div>
				</div> 
				<?php } $this->load->view($view); ?>   
		</article>
		<footer class="footer">
			<div class="footer-block buttons">  </div>
			<div class="footer-block author">
				<ul>
					<li> Template by <a href="https://github.com/modularcode">ModularCode</a> </li>
					<li>Redesign Yudhit Widy Wicaksono 6301134065</li>
				</ul>
			</div>
		</footer>
		<div class="modal fade" id="modal-media">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header"> <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    					<span aria-hidden="true">&times;</span>
    					<span class="sr-only">Close</span>
					</button>
					<h4 class="modal-title">Media Library</h4> </div>
					<div class="modal-body modal-tab-container">
						<ul class="nav nav-tabs modal-tabs" role="tablist">
							<li class="nav-item"> <a class="nav-link" href="#gallery" data-toggle="tab" role="tab">Gallery</a> </li>
							<li class="nav-item"> <a class="nav-link active" href="#upload" data-toggle="tab" role="tab">Upload</a> </li>
						</ul>
						<div class="tab-content modal-tab-content">
							<div class="tab-pane fade" id="gallery" role="tabpanel">
								<div class="images-container">
									<div class="row"> </div>
								</div>
							</div>
							<div class="tab-pane fade active in" id="upload" role="tabpanel">
								<div class="upload-container">
									<div id="dropzone">
										<form action="/" method="POST" enctype="multipart/form-data" class="dropzone needsclick dz-clickable" id="demo-upload">
											<div class="dz-message-block">
												<div class="dz-message needsclick"> Drop files here or click to upload. </div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer"> <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> <button type="button" class="btn btn-primary">Insert Selected</button> </div>
				</div>
				<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
		</div>
		<!-- /.modal -->
		<div class="modal fade" id="confirm-modal">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header"> <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    					<span aria-hidden="true">&times;</span>
					</button>
					<h4 class="modal-title"><i class="fa fa-warning"></i> Alert</h4> </div>
					<div class="modal-body">
						<p>Are you sure want to do this?</p>
					</div>
					<div class="modal-footer"> <button type="button" class="btn btn-primary" data-dismiss="modal">Yes</button> <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button> </div>
				</div>
				<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
		</div>
		<!-- /.modal -->
	</div>
</div>
<!-- Reference block for JS -->
<div class="ref" id="ref">
	<div class="color-primary"></div>
	<div class="chart">
		<div class="color-primary"></div>
		<div class="color-secondary"></div>
	</div>
</div>
<script src="<?php echo base_url(); ?>js/vendor.js"></script>
<script src="<?php echo base_url(); ?>js/app.js"></script>
<script src="<?php echo base_url(); ?>dataTables/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>dataTables/dataTables.bootstrap.js"></script>
<script>
	$(document).ready(function () {
		$('#dataTables-example').dataTable();
		
		
	});
	$(document).ready(function () {
		$('#dataTables-example1').dataTable();
	});
</script>
</body>

</html>						