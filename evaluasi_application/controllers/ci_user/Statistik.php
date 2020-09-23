<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Statistik extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->cek_login();
		$this->output->enable_profiler(FALSE);
		$this->load->model("master_model", "mm");
	}
	
	public function index()
	{
		//untuk mengambil soal satu per satu
		$dataPerhalaman = 5;
		
		//apabila variable halaman sudah didefinisikan, gunakan nomor halaman tersebut, 
		$page=$this->input->get('pg');
		if(isset($page)){
			$nohalaman = $this->anti_xss($page);
		}else{ 
			$nohalaman = 1;
		}
		
		//pencegahan server error
		if($nohalaman=="" || is_numeric($nohalaman)==FALSE){
			redirect(site_url("auth/warning"));
		}
		
		//jika tidak ada page, maka redirect ke halaman ujian
		if(isset($page) && empty($nohalaman)){
			redirect(site_url("statistik"));
		}
		
		//parameter query
		$user_id     = $this->session->userdata("userId");
		$parameter_1 = " rekap_user=".$user_id." AND rekap";
		$parameter_2 = " rekap_user=".$user_id;
		
		//untuk menampilkan rekap dengan teknik paging
		$offset = ($nohalaman-1) * $dataPerhalaman;
		$result = $this->mm->get_all_data_rekap("v_rekap", "rekap_tanggal desc", $parameter_1, $dataPerhalaman, $offset);
		
		//untuk menampilkan jumlah data rekap
		$query   = $this->mm->check_duplicate("v_rekap", "rekap", $parameter_2);
		$jumData = $query->jml;
		
		//menentukan jumlah nomor halaman yang muncul berdasarkan jumlah semua data
		$jumhalaman = ceil($jumData/$dataPerhalaman);

		$data["result"]      = $result;
		$data["jumData"]     = $jumData;
		$data["jumhalaman"]  = $jumhalaman;
		$data["nohalaman"]   = $nohalaman;
		$data["offset"]      = $offset;
		
		$data["page"]   = "view_user/home_statistik";
        $data["title"]  = "Statistik Ibadah Harian";
		$this->load->view("template/template", $data);
	}
	
	function anti_xss($string)
	{
		$filter=stripslashes(strip_tags(htmlspecialchars(trim($string),ENT_QUOTES)));
		return $filter;
	}
	
	private function cek_login()
    {
        if( ! $this->session->userdata("isLoggedInSMV") OR $this->session->userdata("isLoggedInSMV") === FALSE)
        {
            redirect("auth");
        }
    }
}