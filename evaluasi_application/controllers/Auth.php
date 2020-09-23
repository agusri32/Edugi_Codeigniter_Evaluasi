<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->output->enable_profiler(FALSE);
		$this->load->model("auth_model","am");
		$this->load->model("master_model", "mm");
		date_default_timezone_set("Asia/Jakarta");
	}

    function index()
    {
		if($this->session->userdata('isLoggedInSMV') === TRUE)
        {
        	redirect('home');
        }
        else
        {
			$this->load->view('view_login/home');
        }
    }

    function validate_credential()
    {
		if($this->input->post('btn_login') === 'btn_login')
		{
			$find = array("//","\\");
			$username=str_replace($find,"'",$this->input->post('txt_user_name'));
			$password=str_replace($find,"'",$this->input->post('txt_user_password'));
			
			//autentifikasi user login
			$filter_username=$this->anti_xss($username,TRUE);
			$filter_password=$this->anti_xss($password,TRUE);
			$query = $this->am->validate($filter_username,$filter_password);
			if($query)
			{
				//definisikan user id
				$user_id      = $query->user_id;
				$user_nama    = $query->user_nama;
				$user_kelamin = $query->user_kelamin;
				$user_email   = $query->user_email;
				
				//untuk cek device yang digunakan
				$u_agent=$_SERVER['HTTP_USER_AGENT'];
				$is_mobile = preg_match('/android.+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge|maemo|meego.+mobile|midp|mmp|netfront|opera m(ob|in)i|palm(os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$u_agent);
				if($is_mobile){ $device='Mobile'; }else{ $device='Desktop'; }

				//untuk membuatkan session user
				$data = array(
					'userId'      => $user_id,
					'userNama'    => $user_nama,
					'userKelamin' => $user_kelamin,
					'userEmail'   => $user_email,
					'waktuLogin'  => $waktu_masuk=date('Y-m-d H:i:s'),
					'device' 	  => $device,
					'isLoggedInSMV' => TRUE
				);
				$this->session->set_userdata($data);
				
				//dekripsi user session
				$user = $this->session->userdata("userId");
				
				//untuk update user counter
				$this->am->log_counter($user);
				
				//untuk cek setup user kegiatan
				$cekdata = "setup_user=".$user;
				$cek_setup = $this->mm->check_duplicate("tbl_setup", "setup" ,$cekdata);
				if($cek_setup->jml === "0")
				{
					$field = "*";
					$param = "";
					$res = $this->mm->get_all_data_by_param("m_jenis_kegiatan",$field,"kegiatan", $param);
					
					foreach($res as $row)
					{
						//untuk kegiatan mandatori
						$kegiatan_id = $row->kegiatan_id;
						$kegiatan_mandatori = $row->kegiatan_mandatori;
						if($kegiatan_mandatori==1){ $status=1; }else{ $status=0; }
						$insert_data = $this->mm->insert_data_setup($user, $kegiatan_id, $status);
					}
				}
				
				//untuk input log monitoring
				$type="Normal";
				$error="0";
				$waktu_keluar="";
				$ip_address=$_SERVER['REMOTE_ADDR'];
				$u_agent=$_SERVER['HTTP_USER_AGENT'];
				$info=$this->getBrowser($u_agent);
				$sistem_operasi=$info['platform'];
				$browser=$info['name'];
				$this->insert_log_monitoring($user,$u_agent,$waktu_masuk,$waktu_keluar,$ip_address,$sistem_operasi,$browser,$device,$type,$error);

				redirect("home");
				
			}else{
				
				$msg = base64_encode($rand."-Username atau Password Anda Salah");
				$alert = base64_encode($rand."-failed");
				redirect(site_url("auth?m=".$msg."&a=".$alert));
			}
			
		}
		else
		{
			$this->load->view('view_login/home');
		}
    }
	
	function user_registration()
    {
		if($this->input->post('btn_signup') === 'btn_signup')
		{	
			//get post data
			$user_nama    = strtolower($this->anti_xss($this->input->post("txt_nama")));
			$user_kelamin = strtolower($this->anti_xss($this->input->post("opt_jkel")));
			$user_email   = strtolower($this->anti_xss($this->input->post("txt_email")));
			$user_passwd  = md5(strtolower($this->anti_xss($this->input->post("txt_passwd"))));
			
			//list field
			$field[] = "user_nama,";
			$field[] = "user_kelamin,";
			$field[] = "user_email,";
			$field[] = "user_password,";
			$field[] = "user_role,";
			$field[] = "user_is_active,";
			$field[] = "user_is_delete,";
			$field[] = "user_update_by,";
			$field[] = "user_update_date";
			
			//list data
			$data[] = "'".$user_nama."',";
			$data[] = "'".$user_kelamin."',";
			$data[] = "'".$user_email."',";
			$data[] = "'".$user_passwd."',";
			$data[] = "0,";
			$data[] = "1,";
			$data[] = "0,";
			$data[] = "1,";
			$data[] = "'".date("Y-m-d H:i:s")."'";

			//cek jika ada data yang sama
			$cekdata="user_email LIKE '".$user_email."' AND user_is_active=1";
			$cek_user = $this->mm->check_duplicate("tbl_user", "user" ,$cekdata);

			if($cek_user->jml === "0")
			{
				$insert_data = $this->mm->insert_data("tbl_user", $field, $data);
				if($insert_data === 1)
				{
					$rand = rand();
					$msg = base64_encode($rand."-Berhasil Registrasi");
					$alert = base64_encode($rand."-success");
					redirect(site_url("auth?m=".$msg."&a=".$alert));
				}
				else
				{
					$msg = base64_encode($rand."-Gagal Registrasi");
					$alert = base64_encode($rand."-warning");
					redirect(site_url("auth?m=".$msg."&a=".$alert));
				}
			}
			else
			{
				?>
				<script type="text/javascript">
				alert("Email sudah pernah didaftarkan");
				window.history.back();
				</script>
				<?php
			}
		}
		else
		{
			$this->load->view('view_login/home');
		}
    }
	
	function logout()
	{
		if($this->session->userdata('isLoggedInSMV') === TRUE)
        {
			$user_id=$this->session->userdata('userId');
			$waktu_masuk=$this->session->userdata('waktuLogin');
			$waktu_keluar=date('Y-m-d H:i:s');
			
			if($waktu_masuk=="" || $waktu_keluar=="" || $user_id==""){
				$this->session->sess_destroy();
				redirect("auth");
			}else{
				$this->am->log_update_monitoring($user_id,$waktu_masuk,$waktu_keluar);
				$this->session->sess_destroy();
				redirect("auth");
			}
        }else{
			$this->session->sess_destroy();
			redirect("auth");
		}
	}
	
	function info_account()
	{
		$data["page"]  = "template/info_account";
        $data["title"] = "Info Account";
		$this->load->view('template/template', $data);
	}
	

	function change_password()
	{
		$this->load->library('form_validation');
        $this->load->view("view_master/login/form");
	}
	
	function update_password()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('txt_old_password', 'Password Lama', 'trim|required');
		$this->form_validation->set_rules('txt_new_password', 'Password Baru', 'trim|required|matches[txt_confirm_password]');
		$this->form_validation->set_rules('txt_confirm_password', 'Password Confirmation', 'required');

		if ($this->form_validation->run() == FALSE)
		{
			//Notifikasi (fixed)
			if($this->input->get("m") && $this->input->get("a"))
			{
				$get_a = $this->input->get("a");
				$dec_a = base64_decode("$get_a");
				$a = explode("-",$dec_a);
				$alert = $a[1];
				
				$get_m = $this->input->get("m");
				$dec_m = base64_decode("$get_m");
				$m = explode("-",$dec_m);
				$message = $m[1];
				
				$data["alert"] = $alert;
				$data["message"] = $message;
				
				if(is_string($alert)==FALSE || ($alert!='success' && $alert!='warning') || is_string($message)==FALSE){
					redirect(site_url("auth/warning"));
				}
			}
			
			$data["title"] = "Ubah Password";
			$data["page"] = "view_login/form";
			$this->load->view("template/template", $data);
		}
		else
		{
			$data["old_password"] = $this->input->post("txt_old_password");
			$data["new_password"] = $this->input->post("txt_new_password");
			$data["confirm_password"] = $this->input->post("txt_confirm_password");
			
			$cek_old_password = $this->am->check_password($data["old_password"]);

			if($cek_old_password->jml === "1")
			{
				$update = $this->am->update_password($data);

				$data["title"]   = "Ubah Password";
				$data["status"]  = "info";
				$data["page"]    = "view_login/form";
				$data["message"] = "Password Berhasil diubah. Silahkan Logout dan Login kembali";
				$this->load->view("template/template", $data);
			}
			else
			{
				$data["title"]   = "Ubah Password";
				$data["status"]  = "danger";
				$data["page"]    = "view_login/form";
				$data["message"] = "Password Lama tidak sama";
				$this->load->view("template/template", $data);
			}
		}
	}
	
	//untuk mencatat log user login, error akses, dan error input
	function insert_log_monitoring($user_id,$u_agent,$waktu_masuk,$waktu_keluar,$ip_address,$sistem_operasi,$browser,$device,$type,$error)
	{
		$userGeoData = $this->getGeoIP($ip_address); 
		$negara_kode=$userGeoData['negara'];
		$negara_kota=$userGeoData['kota'];
		
		$field[] = "log_user,";
		$field[] = "log_user_agent,";
		$field[] = "log_waktu_masuk,";
		$field[] = "log_waktu_keluar,";
		$field[] = "log_ip_address,";
		$field[] = "log_negara_kode,";
		$field[] = "log_negara_kota,";
		$field[] = "log_sistem_operasi,";
		$field[] = "log_browser,";
		$field[] = "log_device,";
		$field[] = "log_type,";
		$field[] = "log_error";
		
		$data[] = "'".$this->anti_xss($user_id)."',";
		$data[] = "'".$this->anti_xss($u_agent)."',";
		$data[] = "'".$this->anti_xss($waktu_masuk)."',";
		$data[] = "'".$this->anti_xss($waktu_keluar)."',";
		$data[] = "'".$this->anti_xss($ip_address)."',";
		$data[] = "'".$this->anti_xss($negara_kode)."',";
		$data[] = "'".$this->anti_xss($negara_kota)."',";
		$data[] = "'".$this->anti_xss($sistem_operasi)."',";
		$data[] = "'".$this->anti_xss($browser)."',";
		$data[] = "'".$this->anti_xss($device)."',";
		$data[] = "'".$this->anti_xss($type)."',";
		$data[] = "'".$this->anti_xss($error)."'";

		$insert_data = $this->mm->insert_data("tbl_monitoring", $field, $data);
	}
	
	//mengetahui informasi user login
	function getBrowser($u_agent) 
	{ 
		$bname = 'Unknown';
		$platform = 'Unknown';
		$version= "";
		 
		if (preg_match('/linux/i', $u_agent)) {
			$platform = 'Linux';
		}
		elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
			$platform = 'Mac';
		}
		elseif (preg_match('/windows|win32/i', $u_agent)) {
			$platform = 'Windows';
		}
		 
		if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)) 
		{ 
			$bname = 'Internet Explorer'; 
			$ub = "MSIE"; 
		} 
		elseif(preg_match('/Firefox/i',$u_agent)) 
		{ 
			$bname = 'Mozilla Firefox'; 
			$ub = "Firefox"; 
		} 
		elseif(preg_match('/Chrome/i',$u_agent)) 
		{ 
			$bname = 'Google Chrome'; 
			$ub = "Chrome"; 
		} 
		elseif(preg_match('/Safari/i',$u_agent)) 
		{ 
			$bname = 'Apple Safari'; 
			$ub = "Safari"; 
		} 
		elseif(preg_match('/Opera/i',$u_agent)) 
		{ 
			$bname = 'Opera'; 
			$ub = "Opera"; 
		} 
		elseif(preg_match('/Netscape/i',$u_agent)) 
		{ 
			$bname = 'Netscape'; 
			$ub = "Netscape"; 
		} 

		$known = array('Version', $ub, 'other');
		$pattern = '#(?<browser>' . join('|', $known) .
		')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
		if (!preg_match_all($pattern, $u_agent, $matches)) {
		}
		 
		 
		$i = count($matches['browser']);
		if ($i != 1) {
			 
			if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
				$version= $matches['version'][0];
			}
			else {
				$version= $matches['version'][1];
			}
		}
		else {
			$version= $matches['version'][0];
		}
		 
		 
		if ($version==null || $version=="") {$version="?";}
		 
		return array(
			'userAgent' => $u_agent,
			'name'      => $bname,
			'version'   => $version,
			'platform'  => $platform,
			'pattern'   => $pattern
		);
	} 
	
	//mengetahui lokasi user login
	function getGeoIP($ip) {
		$details = json_decode(file_get_contents("http://ipinfo.io/{$ip}"));
		
		if(!empty($details->country)){
			$negara=$details->country;
		}else{
			$negara="";
		}
		
		if(!empty($details->city)){
			$kota=$details->city;
		}else{
			$kota="";
		}
			 
		return array(
			'negara' => $negara,
			'kota' => $kota,
		);
	}
	
	//untuk log monitoring saat kesalahan input
	function warning()
	{
		$user_id = $this->session->userdata("userId");
		$this->am->log_violation($user_id);
		
		$data["page"] = "template/info_access";
        $data["title"] = "Input is Denied";
		$this->load->view('template/template', $data);
		
		$type="Error";
		$error="Input";
		$waktu_keluar="";
		$waktu_masuk=$this->session->userdata('waktuLogin');
		$ip_address=$_SERVER['REMOTE_ADDR'];
		$u_agent=$_SERVER['HTTP_USER_AGENT'];
		
		$info=$this->getBrowser($u_agent);
		$sistem_operasi=$info['platform'];
		$browser=$info['name'];
		
		$is_mobile = preg_match('/android.+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge|maemo|meego.+mobile|midp|mmp|netfront|opera m(ob|in)i|palm(os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$u_agent);
		if($is_mobile){ $device='Mobile'; }else{ $device='Desktop'; }

		$this->insert_log_monitoring($user_id,$u_agent,$waktu_masuk,$waktu_keluar,$ip_address,$sistem_operasi,$browser,$device,$type,$error);
	}
	
	//untuk log monitoring saat kesalahan akses
	function forbidden()
	{
		$user_id = $this->session->userdata("userId");
		$this->am->log_violation($user_id);
		
		$data["page"] = "template/info_access";
        $data["title"] = "Access is Denied";
		$this->load->view('template/template', $data);
		
		$type="Error";
		$error="Akses";
		$waktu_keluar="";
		$waktu_masuk=$this->session->userdata('waktuLogin');
		$ip_address=$_SERVER['REMOTE_ADDR'];
		$u_agent=$_SERVER['HTTP_USER_AGENT'];
		
		$info=$this->getBrowser($u_agent);
		$sistem_operasi=$info['platform'];
		$browser=$info['name'];
		
		$is_mobile = preg_match('/android.+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge|maemo|meego.+mobile|midp|mmp|netfront|opera m(ob|in)i|palm(os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$u_agent);
		if($is_mobile){ $device='Mobile'; }else{ $device='Desktop'; }

		$this->insert_log_monitoring($user_id,$u_agent,$waktu_masuk,$waktu_keluar,$ip_address,$sistem_operasi,$browser,$device,$type,$error);
	}
	
	//jika javascript browser di non-aktifkan
	function disabled(){
		$this->session->sess_destroy();
		$this->load->view('template/info_javascript');
	}
	
	//filter input data
	function anti_xss($string)
	{
		$filter=stripslashes(strip_tags(htmlspecialchars(trim($string),ENT_QUOTES)));
		return $filter;
	}
}