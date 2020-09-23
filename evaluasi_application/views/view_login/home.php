<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>SIMONEV - Website Sistem Monitoring Evaluasi</title>
	<link rel="shortcut icon" href="<?php echo base_url("assets/images/favicon.ico"); ?>" type="image/x-icon">
	<meta name="ROBOTS" content="NOINDEX,NOFOLLOW,NOARCHIVE,NOODP,NOYDIR,NOSNIPPET">
	<meta name="viewport" content="width=1,initial-scale=1,user-scalable=1" />
	<meta name="keywords" content="Sistem Informasi Monitoring & Evaluasi, Simonev, Hidayah, Kang Agus, Ri32 Web Project"/>

	<link rel="stylesheet prefetch" href="<?php echo base_url("assets/login/css/foundation.min.css"); ?>">
	<link rel="stylesheet" href="<?php echo base_url("assets/login/css/style.css");?>">
	
	<script language="javascript">
		document.onkeydown = function(e) {
			if (e.ctrlKey && e.keyCode === 85){
				return false;
			} else {
				return true;
			}
		};
	</script>
</head>
<body oncontextmenu='return false;'>
	<div class="row green-row">
		<div class="large-6 large-centered columns"><br><br>
			<dl class="tabs g-2" data-tab data-options="scroll_to_content:false" data-options="deep_linking:true" >
				<dd class="active"><a href="#panel2-1">Login</a></dd>
				<dd><a href="#panel2-2">Daftar</a></dd>
			</dl>
			<div class="tabs-content">
				<div class="content active" id="panel2-1">
					<h3 class="text-center"><a href="<?php echo site_url("auth"); ?>"><img src="<?php echo base_url("assets/images/logo.jpg"); ?>"></a></h3><br>
					<form class="row" action="<?php echo site_url("auth/validate_credential"); ?>" method="post">
						<div class="large-9 column large-centered">
							<label>Email<input type="text" id="txt_user_name" name="txt_user_name" placeholder="Email" autofocus="autofocus" required/></label>
							<label>Password<input type="password" id="txt_user_password" name="txt_user_password" placeholder="Password" required/></label>
							<input type="hidden" name="btn_login" value="btn_login">
							<input type="submit" value="LOGIN" class="button radius small"/>
						</div>
						
						<center>
						<?php
						$get_a = $this->input->get("a");
						if(isset($get_a) && $get_a!=""){
							$dec_a = base64_decode($get_a);
							$a = explode("-",$dec_a);
							$alert = $a[1];
							
							if($alert=="success"){ echo "<font color='green' face='verdana' size='2'> Berhasil Registrasi & Silahkan Login </font>"; }
							if($alert=="warning"){ echo "<font color='red' face='verdana' size='2'> Gagal Registrasi & Silahkan Coba Kembali </font>"; }
							if($alert=="failed"){ echo "<font color='red' face='verdana' size='2'> Username atau Password Anda Salah </font>"; }
						}
						?>
						</center>
						
					</form>
				</div>
				
				<div class="content" id="panel2-2">
					<h3 class="text-center"><img src="<?php echo base_url("assets/images/registrasi.png"); ?>"></h3><br>
					<form class="row" action="<?php echo site_url("auth/user_registration"); ?>" method="post">
					<div class="large-7 column large-centered">
						<label>Nama Lengkap<input type="text" name="txt_nama" id="txt_nama" placeholder="" required/></label>
						<label>Jenis Kelamin
						<select name="opt_jkel">
							<option value="1">Laki-laki</option>
							<option value="2">Perempuan</option>
						</select>
						</label>
						<label>Email<input type="email" name="txt_email" id="txt_email" placeholder="" required /></label>
						<label>Password<input type="password" name="txt_passwd" id="txt_passwd" placeholder="" required /></label>
						<input type="hidden" name="btn_signup" value="btn_signup">
						<input type="submit" value="BISMILLAH" class="button radius small"/>
					</div>
					<hr><center><font color="blues"><i>Mohon isi dengan nama dan alamat email yang valid!</i></font></center>
					</form>
				</div>
			</div><br><br>
		</div>
	</div> 

	<script src="<?php echo base_url("assets/login/js/jquery.min.js");?>"></script>
	<script src="<?php echo base_url("assets/login/js/foundation.min.js");?>"></script>
	<script src="<?php echo base_url("assets/login/js/index.js");?>"></script>
</body>
</html>
