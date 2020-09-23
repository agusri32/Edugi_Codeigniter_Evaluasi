<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php
switch(date("l"))
{
	case 'Monday':$nmh="Senin";break; 
	case 'Tuesday':$nmh="Selasa";break; 
	case 'Wednesday':$nmh="Rabu";break; 
	case 'Thursday':$nmh="Kamis";break; 
	case 'Friday':$nmh="Jum'at";break; 
	case 'Saturday':$nmh="Sabtu";break; 
	case 'Sunday':$nmh="Minggu";break; 
}

switch(date("n")){       
    case '1':$nmb="Januari";break; 
	case '2':$nmb="Februari";break; 
	case '3':$nmb="Maret";break; 
	case '4':$nmb="April";break; 
	case '5':$nmb="Mei";break; 
	case '6':$nmb="Juni";break; 
	case '7':$nmb="Juli";break; 
	case '8':$nmb="Agustus";break; 
	case '9':$nmb="September";break; 
	case '10':$nmb="Oktober";break; 
	case '11':$nmb="November";break; 
	case '12':$nmb="Desember";break; 
}

$get_tgl = $this->input->get('id');
if(isset($get_tgl) && $get_tgl!=""){
	$tanggal = $qry_rekap->rekap_tanggal;
	$waktu   = $qry_rekap->rekap_waktu;
	$hari    = $qry_rekap->rekap_hari;
	$bulan   = $qry_rekap->rekap_bulan;
	
	$mode  = 'update';
	$waktu = $qry_rekap->hari_ket.", ".substr($tanggal,8,2)." ".$qry_rekap->bulan_ket." ".substr($tanggal,0,4);
	$harian_waktu   = $waktu;
	$harian_tanggal = $tanggal;
	$harian_hari    = $hari;
	$harian_bulan   = $bulan;
}else{
	$mode  = 'insert';
	$waktu = $nmh.", ".date("d")." ".$nmb." ".date("Y");
	$harian_waktu   = date("Y-m-d H:i:s");
	$harian_tanggal = date("Y-m-d");
	$harian_hari    = date("N");
	$harian_bulan   = date("n");
}
?>

<section class="content-header">
	<h1>
		<?php echo $waktu; ?> 
	</h1>
</section>

<section class="content">
	<div class="row">
		<div class="col-md-4">
			<div class="box box-warning">
				<div class="box-body box-profile">
					<div class="box-body no-padding">
						<?php
						if(isset($message)){
						?>
						<div class="alert alert-<?php echo $alert; ?> alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						  <p><i class="icon fa fa-info"></i><?php echo $message;?></p>
						</div>
						<?php
						}
						?>
						
						<table class="table table-striped">
						<tr>
							<th style="width: 10px">#</th>
							<th>Nama Ibadah</th>
							<th style="width: 160px">Input</th>
						</tr>
						
							<form action="<?php echo site_url("kegiatan/submit");?>" method="post">
								<?php
								$nomor=0;
								$tot_bobot=0;
								foreach($query_setup as $row){
									$kegiatan = $row->setup_kegiatan;
									$bobot = $row->kegiatan_bobot;
									$tot_bobot = $tot_bobot+$bobot;
									$nomor = $nomor+1;
									
									if($kegiatan==1){
									?>
									<tr>
										<td><?php echo $nomor;?></td>
										<td><?php echo ucwords($row->kegiatan_nama);?></td>
										<td>
										<input type="hidden" name="hdd_giat_1" value="1">
										<input type="radio"  name="kegiatan_1" value="2" <?php if($nilai_1==2){ echo "checked"; } ?>> <font class="text-green">Jama'ah</font>&nbsp;&nbsp;
										<input type="radio"  name="kegiatan_1" value="1" <?php if($nilai_1==1){ echo "checked"; } ?>> <font class="text-red">Sendiri</font>
										</td>
									</tr>
									<?php
									}
									
									if($kegiatan==2){
									?>
									<tr>
										<td><?php echo $nomor;?></td>
										<td><?php echo ucwords($row->kegiatan_nama);?></td>
										<td>
										<input type="hidden" name="hdd_giat_2" value="1">
										<input type="radio"  name="kegiatan_2" value="2" <?php if($nilai_2==2){ echo "checked"; } ?>> <font class="text-green">Jama'ah</font>&nbsp;&nbsp;
										<input type="radio"  name="kegiatan_2" value="1" <?php if($nilai_2==1){ echo "checked"; } ?>> <font class="text-red">Sendiri</font> 
										</td>
									</tr>
									<?php
									}
									
									if($kegiatan==3){
									?>
									<tr>
										<td><?php echo $nomor;?></td>
										<td><?php echo ucwords($row->kegiatan_nama);?></td>
										<td>
										<input type="hidden" name="hdd_giat_3" value="1">
										<input type="radio"  name="kegiatan_3" value="2" <?php if($nilai_3==2){ echo "checked"; } ?>> <font class="text-green">Jama'ah</font>&nbsp;&nbsp;
										<input type="radio"  name="kegiatan_3" value="1" <?php if($nilai_3==1){ echo "checked"; } ?>> <font class="text-red">Sendiri</font> 
										</td>
									</tr>
									<?php
									}
									
									if($kegiatan==4){
									?>
									<tr>
										<td><?php echo $nomor;?></td>
										<td><?php echo ucwords($row->kegiatan_nama);?></td>
										<td>
										<input type="hidden" name="hdd_giat_4" value="1">
										<input type="radio"  name="kegiatan_4" value="2" <?php if($nilai_4==2){ echo "checked"; } ?>> <font class="text-green">Jama'ah</font>&nbsp;&nbsp;
										<input type="radio"  name="kegiatan_4" value="1" <?php if($nilai_4==1){ echo "checked"; } ?>> <font class="text-red">Sendiri</font> 
										</td>
									</tr>
									<?php
									}
									
									if($kegiatan==5){
									?>
									<tr>
										<td><?php echo $nomor;?></td>
										<td><?php echo ucwords($row->kegiatan_nama);?></td>
										<td>
										<input type="hidden" name="hdd_giat_5" value="1">
										<input type="radio"  name="kegiatan_5" value="2" <?php if($nilai_5==2){ echo "checked"; } ?>> <font class="text-green">Jama'ah</font>&nbsp;&nbsp;
										<input type="radio"  name="kegiatan_5" value="1" <?php if($nilai_5==1){ echo "checked"; } ?>> <font class="text-red">Sendiri</font> 
										</td>
									</tr>
									<?php
									}
									
									if($kegiatan==6){
									?>
									<tr>
										<td><?php echo $nomor;?></td>
										<td><?php echo ucwords($row->kegiatan_nama);?></td>
										<td>
										<input type="hidden"   name="hdd_giat_6" value="1">
										<input type="checkbox" name="kegiatan_6" value="1" <?php if($nilai_6==1){ echo "checked"; } ?>> <font class="text-green">Iya</font> 
										</td>
									</tr>
									<?php
									}
									
									if($kegiatan==7){
									?>
									<tr>
										<td><?php echo $nomor;?></td>
										<td><?php echo ucwords($row->kegiatan_nama);?></td>
										<td>
										<input type="hidden"   name="hdd_giat_7" value="1">
										<input type="checkbox" name="kegiatan_7" value="1" <?php if($nilai_7==1){ echo "checked"; } ?>> <font class="text-green">Iya</font> 
										</td>
									</tr>
									<?php
									}
									
									if($kegiatan==8){
									?>
									<tr>
										<td><?php echo $nomor;?></td>
										<td><?php echo ucwords($row->kegiatan_nama);?></td>
										<td>
										<input type="hidden"   name="hdd_giat_8" value="1">
										<input type="checkbox" name="kegiatan_8" value="1" <?php if($nilai_8==1){ echo "checked"; } ?>> <font class="text-green">Iya</font> 
										</td>
									</tr>
									<?php
									}
									
									if($kegiatan==9){
									?>
									<tr>
										<td><?php echo $nomor;?></td>
										<td><?php echo ucwords($row->kegiatan_nama);?></td>
										<td>
										<input type="hidden"   name="hdd_giat_9" value="1">
										<input type="checkbox" name="kegiatan_9" value="1" <?php if($nilai_9==1){ echo "checked"; } ?>> <font class="text-green">Iya</font> 
										</td>
									</tr>
									<?php
									}
									
									if($kegiatan==10){
									?>
									<tr>
										<td><?php echo $nomor;?></td>
										<td><?php echo ucwords($row->kegiatan_nama);?></td>
										<td>
										<input type="hidden"   name="hdd_giat_10" value="1">
										<input type="checkbox" name="kegiatan_10" value="1" <?php if($nilai_10==1){ echo "checked"; } ?>> <font class="text-green">Iya</font> 
										</td>
									</tr>
									<?php
									}
									
									if($kegiatan==11){
									?>
									<tr>
										<td><?php echo $nomor;?></td>
										<td><?php echo ucwords($row->kegiatan_nama);?></td>
										<td>
										<input type="hidden"   name="hdd_giat_11" value="1">
										<input type="checkbox" name="kegiatan_11" value="1" <?php if($nilai_11==1){ echo "checked"; } ?>> <font class="text-green">Iya</font> 
										</td>
									</tr>
									<?php
									}
									
									if($kegiatan==12){
									?>
									<tr>
										<td><?php echo $nomor;?></td>
										<td><?php echo ucwords($row->kegiatan_nama);?></td>
										<td>
										<input type="hidden"   name="hdd_giat_12" value="1">
										<input type="checkbox" name="kegiatan_12" value="1" <?php if($nilai_12==1){ echo "checked"; } ?>> <font class="text-green">Iya</font> 
										</td>
									</tr>
									<?php
									}
									
									if($kegiatan==13){
									?>
									<tr>
										<td><?php echo $nomor;?></td>
										<td><?php echo ucwords($row->kegiatan_nama);?></td>
										<td>
										<input type="hidden"   name="hdd_giat_13" value="1">
										<input type="checkbox" name="kegiatan_13" value="1" <?php if($nilai_13==1){ echo "checked"; } ?>> <font class="text-green">Iya</font> 
										</td>
									</tr>
									<?php
									}
									
									if($kegiatan==14){
									?>
									<tr>
										<td><?php echo $nomor;?></td>
										<td><?php echo ucwords($row->kegiatan_nama);?></td>
										<td>
										<input type="hidden"   name="hdd_giat_14" value="1">
										<input type="checkbox" name="kegiatan_14" value="1" <?php if($nilai_14==1){ echo "checked"; } ?>> <font class="text-green">Iya</font> 
										</td>
									</tr>
									<?php
									}
								}
								?>
								<tr>
									<td></td>
									<td></td>
									<td>
										<input type="hidden" name="harian_mode" value="<?php echo $mode;?>">
										<input type="hidden" name="harian_waktu" value="<?php echo $harian_waktu;?>">
										<input type="hidden" name="harian_tanggal" value="<?php echo $harian_tanggal;?>">
										<input type="hidden" name="harian_hari" value="<?php echo $harian_hari;?>">
										<input type="hidden" name="harian_bulan" value="<?php echo $harian_bulan;?>">
										<input type="hidden" name="tot_bobot" value="<?php echo $tot_bobot;?>">
										<button type="submit" class='btn btn-sm btn-info pull-right' id="submit" name="submit" value="submit">SUBMIT KEGIATAN</button>
									</td>
								</tr>
							</form>
							
						</table>
					</div>
				
				</div>
			</div>
		</div>
		
		<?php
		if($rekap_prosen>=0  && $rekap_prosen<60){ $warna="red"; }
		if($rekap_prosen>=60 && $rekap_prosen<80){ $warna="yellow"; }
		if($rekap_prosen>=80 && $rekap_prosen<90){ $warna="blue"; }
		if($rekap_prosen>=90 && $rekap_prosen<=100){ $warna="green"; }
		?>
		
		<div class="col-md-4">
          <div class="info-box bg-<?php echo $warna; ?>">
            <span class="info-box-icon"><i class="ion ion-ios-heart-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Pencapaian Target</span>
              <span class="info-box-number"><?php echo $rekap_prosen;?> %</span>

              <div class="progress">
                <div class="progress-bar" style="width: <?php echo $rekap_prosen;?>%"></div>
              </div>
                  <span class="progress-description">
				  <?php 
				  $sisa=100-$rekap_prosen; 
				  if($sisa==0){
					  ?>Alhamdulillah target telah tercapai<?php
				  }else{
					  ?>Sisa Pencapaian Target <?php
					  echo $sisa." %";
				  }
				  ?> 
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
        </div>
		
	</div>
</section>