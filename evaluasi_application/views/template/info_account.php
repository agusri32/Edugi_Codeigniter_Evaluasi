<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<section class="content-header">
	<h1>
		<?php echo $title; ?>
	</h1>
</section>

<section class="content">
	<div class="row">
		<div class="col-md-3">
			<div class="box box-primary">
				<div class="box-body box-profile">
				<center>
					<img class="profile-user-img img-responsive" src="<?php echo base_url('assets/images/user-icon.jpg') ?>">
				</center>
				
				<p><?php $login="LOGIN USER";?></p>
				<h3 class="profile-username text-center"><?php echo $login; ?></h3>
				<p class="text-muted text-center">Waktu Login : <?php echo $this->session->userdata("waktuLogin");?></p>
				<br>
				
				<ul class="list-group list-group-unbordered">
					<li class="list-group-item">
						<b>Nama Lengkap</b> : <?php echo strtoupper($this->session->userdata("userNama")); ?></a>
					</li>
					<li class="list-group-item">
						<?php 
						$jkel = $this->session->userdata("userKelamin"); 
						if($jkel==1){
							$kelamin="Laki-laki";
						}else{
							$kelamin="Perempuan";
						}
						?>
						<b>Jenis Kelamin</b> : <?php echo $kelamin;?></a>
					</li>
					<li class="list-group-item">
						<b>Email</b> : <?php echo strtolower($this->session->userdata("userEmail")); ?></a>
					</li>
				</ul>
				</div>
			</div>
		</div>
	</div>
</section>