<?php 
$url=$this->uri->segment(1); 

if($url=="ujian_online" || $url=="ujian_soal_one" || $url=="ujian_soal_all"){
	$slid="sidebar-collapse";
}else{
	$slid="";
}
?>

</head>
<body class="hold-transition skin-green sidebar-mini <?php echo $slid; ?>">
    <div class="wrapper">

        <header class="main-header">
            <a href="<?php echo site_url('home') ?>" class="logo"><b>SIMONEV HIDAYAH</b></a>
            <nav class="navbar navbar-static-top" role="navigation">
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
						
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-user"></i> <?php echo strtoupper($this->session->userdata("userNama"));?>
                                <span class="hidden-xs"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="user-header">
                                    <img src="<?php echo base_url('assets/images/user-icon.jpg') ?>" class="img-circle" alt="User Image" />
                                    <p>
                                        LOGIN USER
                                        <small>Waktu Login : <?php echo $this->session->userdata("waktuLogin");?></small>
                                    </p>
                                </li>
                                <li class="user-footer">
									<div class="pull-left">
										<a href="<?php echo site_url('auth/update_password') ?>" class="btn btn-default btn-flat"><i class="fa fa-lock"></i> Password</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="<?php echo site_url('auth/logout') ?>" class="btn btn-default btn-flat"><i class="fa fa-sign-out"></i> Keluar</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>