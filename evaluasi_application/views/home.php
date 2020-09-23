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
					<center><img class="profile-user-img img-responsive" src="<?php echo base_url('assets/images/user-icon.jpg') ?>"></center>
					<h3 class="profile-username text-center"><?php echo strtoupper($this->session->userdata("userNama")); ?></h3>
					<br>
					<ul class="list-group list-group-unbordered">
						<li class="list-group-item">
							<?php
							$pencapaian=$info_pencapaian;
							if($pencapaian>=0  && $pencapaian<60){ $warna="red"; }
							if($pencapaian>=60 && $pencapaian<80){ $warna="yellow"; }
							if($pencapaian>=80 && $pencapaian<90){ $warna="blue"; }
							if($pencapaian>=90 && $pencapaian<=100){ $warna="green"; }
							?>
							<b>Pencapaian hari ini</b> <a class="pull-right" href="<?php echo base_url("kegiatan"); ?>" title="Klik untuk Kegiatan"><span class="badge bg-<?php echo $warna;?>"><?php echo $pencapaian;?> %</span></a>
						</li>
						<li class="list-group-item">
							<b>Jumlah Data Kegiatan</b> <a class="pull-right" href="<?php echo base_url("statistik"); ?>" title="Klik untuk Statistik"><?php echo $info_data; ?></a>
						</li>
						<li class="list-group-item">
							<b>Jumlah Setup Kegiatan</b> <a class="pull-right" href="<?php echo base_url("setup"); ?>" title="Klik untuk Setup"><?php echo $info_setup; ?></a>
						</li>
					</ul>
					
					<a href="<?php echo site_url('auth/info_account') ?>" class="btn btn-primary btn-block"><b>Profil Saya</b></a>
				</div>
			</div>
		</div>
		
		<div class="col-md-9">
			<div class="box box-success box-solid">
				<div class="box-header with-border">
					<h3 class="box-title">Al-Qur'an & Hadits</h3>
				</div>
				<div class="box-body">
					<?php echo $tausiah;?>
				</div>
			</div>
		</div>
		
		<div class="col-md-9">
			<div class="box box-warning box-solid">
				<div class="box-header with-border">
					<h3 class="box-title">Pengumuman</h3>
					<div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
						<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
					</div>
				</div>
				<div class="box-body">
					<ul>
						<li>Aplikasi ini digunakan untuk monitoring & evaluasi ibadah harian</li>
						<li>Aplikasi ini hanya untuk membantu memberikan motivasi ibadah agar lebih baik dan istiqomah setiap hari</li>
					</ul>
				</div>
			</div>
		</div>	
		
	</div>
</section>