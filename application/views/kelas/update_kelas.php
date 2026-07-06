<?php 
$this->session->unset_userdata('pesan');
$this->session->unset_userdata('parameter');
	
	?> 
   <div class="xs">
	<h3>Update Data Kelas</h3>
	<div class="well1 white">
		<?php   foreach($kelas->result() as $detail){ ?>
        <form class="form-horizontal" action="<?php echo site_url();?>/main/updateDbKelas" method="POST">
			<fieldset>
				
				<div class="form-group">
					<label class="col-sm-2 control-label">Nama Kelas</label>
					<div class="col-md-6">
						<input type="text" value="<?php echo $detail->namakelas ?>" class="form-control1 ng-invalid ng-invalid-required ng-touched" name="namakelas" required>
					<input type="hidden" value="<?php echo $detail->idkelas ?>" class="form-control1 ng-invalid ng-invalid-required ng-touched" name="idkelas" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label"></label>
					<div class="col-md-6">
						<button type="submit" class="btn btn-primary">Submit</button>
						<button type="reset" class="btn btn-default">Reset</button>
					</div>
				</div>
			</fieldset>
		</form>
		 <?php } ?>
	</div>
</div>
         