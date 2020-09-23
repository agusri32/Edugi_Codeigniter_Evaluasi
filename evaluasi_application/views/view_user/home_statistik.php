<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<section class="content-header">
	<h1>
		<?php echo $title; ?>
	</h1>
</section>

<?php
if(!empty($result)){
	foreach($result as $row)
	{
		$kategori[] = $row->rekap_tanggal;	 
		$jumlah[]   = $row->rekap_prosen;
	}
}else{
	$kategori[] = "";	 
	$jumlah[]   = 0;
}

$aray_kategori="'".join("','",$kategori)."'";
$aray_jumlah=join(",",$jumlah);
?>

<script type="text/javascript">
$(function () {
    var chart;
    $(document).ready(function() {
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'container-garis',
                type: 'line'
            },
            title: {
                text: 'Diagram Pencapaian',
                x: -20
            },
            subtitle: {
               text: 'Simonev Hidayah',
                x: -20
            },
			
            xAxis: {
				reversed: true,
                categories: [<?php echo $aray_kategori; ?>]
            },
            yAxis: {
                title: {
                    text: 'Persentase'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
                formatter: function() {
					return '<b>'+ this.series.name +'</b><br/>'+
					this.x +' : '+ this.y +' %';
                }
            },
			plotOptions: {
				line: {
					dataLabels: {
						enabled: true
					},
					enableMouseTracking: true
				}
			},
            legend: {
                layout: 'horizontal',
				align: 'center',
				verticalAlign: 'bottom',
				x: -10,
				y: 10,
				borderWidth: 1
            },
            series: [{
                name: 'Pencapaian',
                data: [<?php echo $aray_jumlah; ?>]
            }]
        });
    });
});
</script>

<section class="content">
	<div class="row">
		<div class="col-md-6">
			<div class="box box-success">
				<div class="box-body border-radius-none">
					<div id="container-garis"></div>
				</div>
			</div>
		</div>
		
		<div class="col-md-6">
			<div class="box box-warning">
				<div class="box-body box-profile">
					<table class="table table-bordered">
					<tr>
					  <th style="width: 10px">#</th>
					  <th>Tanggal</th>
					  <th>Hari</th>
					  <th>Bulan</th>
					  <th style="width: 40px">Pencapaian</th>
					</tr>
					<?php
					if(!empty($result)){
						foreach($result as $row)
						{
							$pencapaian=$row->rekap_prosen;
							if($pencapaian>=0  && $pencapaian<60){ $warna="red"; }
							if($pencapaian>=60 && $pencapaian<80){ $warna="yellow"; }
							if($pencapaian>=80 && $pencapaian<90){ $warna="blue"; }
							if($pencapaian>=90 && $pencapaian<=100){ $warna="green"; }
						?>
						<tr>
							<td><?php echo $offset=$offset+1; ?></td>
							<td><a href="<?php echo base_url("kegiatan?id=".$row->rekap_tanggal); ?>"><?php echo $row->rekap_tanggal;?></a></td>
							<td><?php echo $row->hari_ket;?></td>
							<td><?php echo $row->bulan_ket;?></td>
							<td><span class="badge bg-<?php echo $warna;?>"><?php echo $pencapaian;?> %</span></td>
						</tr>
						<?php
						}
					}
					?>
					</table>

					<div class="box-footer clearfix">
					<?php
					//menampilkan link previous
					if ($nohalaman > 1){
						?> <a href="<?php echo site_url("statistik?pg=".($nohalaman-1)); ?>"><span class='label label-success'><i class="fa fa-angle-double-left"></i>&nbsp;</span></a> <?php
					}
							
					//memunculkan nomor halaman dan linknya
					for($halaman = 1; $halaman <= $jumhalaman; $halaman++)
					{
						if ((($halaman >= $nohalaman - 100) && ($halaman <= $nohalaman + 100)) || ($halaman == 1) || ($halaman == $jumhalaman)) 
						{   
							if ($halaman == $nohalaman){ 
								echo " <span class='label label-warning' title='Nomor soal yang tampil'><b>".$halaman."</b></span>";
							}else{ 
								?> <a href="<?php echo site_url("statistik?pg=".$halaman); ?>"><span class='label label-success'>&nbsp;<?php echo $halaman;?>&nbsp;</span> </a><?php
							} 
						}
					}

					//menampilkan link next
					if ($nohalaman < $jumhalaman){ 
						?> <a href="<?php echo site_url("statistik?pg=".($nohalaman+1)); ?>"><span class='label label-success'>&nbsp;<i class="fa fa-angle-double-right"></i></span></a> <?php
					}
					?>
					<hr>
					<font class="text-blue">Jumlah data : <?php echo $jumData;?></font>
					</div>

				</div>
			</div>
		</div>
	</div>
</section>