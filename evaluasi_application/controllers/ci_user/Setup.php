<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Setup extends CI_Controller
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
		//menampilkan data setup
		$user_id   = $this->session->userdata("userId");
		$parameter = " AND setup_user=".$user_id;
		$data["query_setup"] = $this->mm->get_all_data_by_param("v_setup", "*", "setup", $parameter);
		
		$data["page"] = "view_user/home_setup";
        $data["title"] = "Setup Kegiatan";
		$this->load->view("template/template", $data);
	}
	
	function update(){
		//mengubah status setup
		$user_id  = $this->session->userdata("userId");
		$get_mo   = $this->input->get('mo');
		$get_id   = $this->input->get('id');
		$setup_mo = $get_mo;
		$setup_id = $get_id;
		
		if($setup_mo=="1"){ $setup_status="0"; }else{ $setup_status="1"; }
	
		$data["setup_status"]   = "'".$setup_status."',";
		$data["setup_update_by"] = "".$user_id.",";	
		$data["setup_update_date"] = "'".date("Y-m-d H:i:s")."'";
		
		$update_data = $this->mm->update_data("tbl_setup", "setup_id", $setup_id, $data);
		redirect(site_url("setup"));
	}
	
	private function cek_login()
    {
        if( ! $this->session->userdata("isLoggedInSMV") OR $this->session->userdata("isLoggedInSMV") === FALSE)
        {
            redirect("auth");
        }
    }
}