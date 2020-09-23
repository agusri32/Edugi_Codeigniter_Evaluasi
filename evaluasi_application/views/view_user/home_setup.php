<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<section class="content-header">
	<h1>
		<?php echo $title; ?>
	</h1>
</section>

<section class="content">
	<div class="row">
	
		<div class="col-md-3">
			<div class="box box-warning">
				<div class="box-body box-profile">
				
					<div class="box-body no-padding">
					  <table class="table table-striped">
						<tr>
							<th style="width: 10px">#</th>
							<th>Nama Ibadah</th>
							<th style="width: 40px">Status</th>
						</tr>
						<?php
						$nomor=0;
						foreach($query_setup as $row){
							$setup_id = $row->setup_id;
							$status   = $row->setup_status;
							$nomor    = $nomor+1;
							
							$esetup_id     = $setup_id;
							$mode_aktif    = "1";
							$mode_nonaktif = "0";
							
							if($status==1){
								$statusku="<a href='javascript:;' title='Klik Ubah Status' onClick=update_function('".$mode_aktif."','".$esetup_id."')><span class='label label-success'>Tampil</span></a>";
							}else{
								$statusku="<a href='javascript:;' title='Klik Ubah Status' onClick=update_function('".$mode_nonaktif."','".$esetup_id."')><span class='label label-danger'>Tidak</span></a>";
							}
							?>
							<tr>
								<td><?php echo $nomor;?></td>
								<td><?php echo ucwords($row->kegiatan_nama);?></td>
								<td><?php echo $statusku; ?></td>
							</tr>
							<?php
						}
						?>
					  </table>
					</div>
				
				</div>
			</div>
		</div>
		
	</div>
</section>

<script type="text/javascript">
function update_function(mo,id) {
	var base_url = "setup/update?mo="+mo+"&id="+id;
	window.location.href = "<?php echo site_url(); ?>"+base_url;
}
</script>