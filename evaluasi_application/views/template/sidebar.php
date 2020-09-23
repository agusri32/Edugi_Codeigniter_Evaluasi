<?php $uri = $this->uri->segment(1)==""?"home":$this->uri->segment(1); ?>
<aside class="main-sidebar">
    <section class="sidebar">
        <ul class="sidebar-menu">
            <li class="header">MENU UTAMA</li>
			<li <?php if($uri=="home"){ echo "class='active'"; } ?>><a href="<?php echo base_url("home"); ?>"><i class="fa fa-home"></i> Home</a></li>
			<li <?php if($uri=="kegiatan"){ echo "class='active'"; } ?>><a href="<?php echo base_url("kegiatan"); ?>"><i class="fa fa-heartbeat"></i> Kegiatan</a></li>
			<li <?php if($uri=="statistik"){ echo "class='active'"; } ?>><a href="<?php echo base_url("statistik"); ?>"><i class="fa fa-line-chart"></i> Statistik</a></li>
			<li <?php if($uri=="setup"){ echo "class='active'"; } ?>><a href="<?php echo base_url("setup"); ?>"><i class="fa fa-cogs"></i> Setup</a></li>
        </ul>
    </section>
</aside>
<div class="content-wrapper">