<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->cek_login();
		$this->output->enable_profiler(FALSE);
		$this->load->model("master_model", "mm");
	}
	
	public function index()
	{
		$user_id = $this->session->userdata("userId");

		//untuk info pencapaian
		$param1  = " AND rekap_user=".$user_id." AND rekap_tanggal='".date("Y-m-d")."'";
		$query1  = $this->mm->get_one_data_by_param("tbl_rekap", "rekap_prosen", "rekap", $param1);
		if(!empty($query1)){ $data["info_pencapaian"]=$query1->rekap_prosen; }else{ $data["info_pencapaian"] = 0; }
		
		//untuk info kegiatan
		$param2  = " rekap_user=".$user_id;
		$query2  = $this->mm->check_duplicate("tbl_rekap", "rekap", $param2);
		if(!empty($query2)){ $data["info_data"]=$query2->jml; }else{ $data["info_data"] = 0; }
		
		//untuk info setup
		$param3  = " setup_user=".$user_id;
		$query3  = $this->mm->check_duplicate("tbl_setup", "setup", $param3);
		if(!empty($query3)){ $data["info_setup"]=$query3->jml; }else{ $data["info_setup"] = 0; }
		
		//untuk info tausiah
		$random  = rand(1,9);
		$param4  = " AND tausiah_id=".$random;
		$query4  = $this->mm->get_one_data_by_param("tbl_tausiah", "tausiah_ket", "tausiah", $param4);
		
		$data["title"]   = "Assalamu'alaikum";
		$data["tausiah"] = $query4->tausiah_ket;
		$data["page"]    = "home";
		$this->load->view('template/template',$data);
	}
	
	private function cek_login()
    {
        if( ! $this->session->userdata('isLoggedInSMV') OR $this->session->userdata('isLoggedInSMV') === FALSE)
        {
            redirect("auth");
        }
    }
}
