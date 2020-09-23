<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kegiatan extends CI_Controller
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
		if($this->input->get("m") && $this->input->get("a"))
		{
			$get_a = $this->input->get("a");
			$alert = $get_a;
			$get_m = $this->input->get("m");
			$message = $get_m;
			$data["alert"] = $alert;
			$data["message"] = $message;
			
			if(is_string($alert)==FALSE || ($alert!='info' && $alert!='danger' && $alert!='warning') || is_string($message)==FALSE){
				redirect(site_url("auth/warning"));
			}
		}
		
		$user_id = $this->session->userdata("userId");
		$now_tgl = date("Y-m-d");
		$get_tgl = $this->input->get('id');
		if(isset($get_tgl) && $get_tgl!=""){
			$tanggal=$get_tgl;
			$data["qry_rekap"] = $this->mm->get_data_by_id("rekap_tanggal","'".$tanggal."'","v_rekap","rekap");
		}else{
			$tanggal=$now_tgl;
		}
		
		//menampilkan data kegiatan satuan
		$param_1  = " AND harian_kegiatan='1'  AND harian_user=".$user_id." AND harian_tanggal='".$tanggal."'";
		$param_2  = " AND harian_kegiatan='2'  AND harian_user=".$user_id." AND harian_tanggal='".$tanggal."'";
		$param_3  = " AND harian_kegiatan='3'  AND harian_user=".$user_id." AND harian_tanggal='".$tanggal."'";
		$param_4  = " AND harian_kegiatan='4'  AND harian_user=".$user_id." AND harian_tanggal='".$tanggal."'";
		$param_5  = " AND harian_kegiatan='5'  AND harian_user=".$user_id." AND harian_tanggal='".$tanggal."'";
		$param_6  = " AND harian_kegiatan='6'  AND harian_user=".$user_id." AND harian_tanggal='".$tanggal."'";
		$param_7  = " AND harian_kegiatan='7'  AND harian_user=".$user_id." AND harian_tanggal='".$tanggal."'";
		$param_8  = " AND harian_kegiatan='8'  AND harian_user=".$user_id." AND harian_tanggal='".$tanggal."'";
		$param_9  = " AND harian_kegiatan='9'  AND harian_user=".$user_id." AND harian_tanggal='".$tanggal."'";
		$param_10 = " AND harian_kegiatan='10' AND harian_user=".$user_id." AND harian_tanggal='".$tanggal."'";
		$param_11 = " AND harian_kegiatan='11' AND harian_user=".$user_id." AND harian_tanggal='".$tanggal."'";
		$param_12 = " AND harian_kegiatan='12' AND harian_user=".$user_id." AND harian_tanggal='".$tanggal."'";
		$param_13 = " AND harian_kegiatan='13' AND harian_user=".$user_id." AND harian_tanggal='".$tanggal."'";
		$param_14 = " AND harian_kegiatan='14' AND harian_user=".$user_id." AND harian_tanggal='".$tanggal."'";
			
		$query_1  = $this->mm->get_one_data_by_param("tbl_harian", "harian_nilai", "harian", $param_1);
		$query_2  = $this->mm->get_one_data_by_param("tbl_harian", "harian_nilai", "harian", $param_2);
		$query_3  = $this->mm->get_one_data_by_param("tbl_harian", "harian_nilai", "harian", $param_3);
		$query_4  = $this->mm->get_one_data_by_param("tbl_harian", "harian_nilai", "harian", $param_4);
		$query_5  = $this->mm->get_one_data_by_param("tbl_harian", "harian_nilai", "harian", $param_5);
		$query_6  = $this->mm->get_one_data_by_param("tbl_harian", "harian_nilai", "harian", $param_6);
		$query_7  = $this->mm->get_one_data_by_param("tbl_harian", "harian_nilai", "harian", $param_7);
		$query_8  = $this->mm->get_one_data_by_param("tbl_harian", "harian_nilai", "harian", $param_8);
		$query_9  = $this->mm->get_one_data_by_param("tbl_harian", "harian_nilai", "harian", $param_9);
		$query_10 = $this->mm->get_one_data_by_param("tbl_harian", "harian_nilai", "harian", $param_10);
		$query_11 = $this->mm->get_one_data_by_param("tbl_harian", "harian_nilai", "harian", $param_11);
		$query_12 = $this->mm->get_one_data_by_param("tbl_harian", "harian_nilai", "harian", $param_12);
		$query_13 = $this->mm->get_one_data_by_param("tbl_harian", "harian_nilai", "harian", $param_13);
		$query_14 = $this->mm->get_one_data_by_param("tbl_harian", "harian_nilai", "harian", $param_14);
		
		if(!empty($query_1)){  $data["nilai_1"] =$query_1->harian_nilai;  }else{ $data["nilai_1"]  = 0; }
		if(!empty($query_2)){  $data["nilai_2"] =$query_2->harian_nilai;  }else{ $data["nilai_2"]  = 0; }
		if(!empty($query_3)){  $data["nilai_3"] =$query_3->harian_nilai;  }else{ $data["nilai_3"]  = 0; }
		if(!empty($query_4)){  $data["nilai_4"] =$query_4->harian_nilai;  }else{ $data["nilai_4"]  = 0; }
		if(!empty($query_5)){  $data["nilai_5"] =$query_5->harian_nilai;  }else{ $data["nilai_5"]  = 0; }
		if(!empty($query_6)){  $data["nilai_6"] =$query_6->harian_nilai;  }else{ $data["nilai_6"]  = 0; }
		if(!empty($query_7)){  $data["nilai_7"] =$query_7->harian_nilai;  }else{ $data["nilai_7"]  = 0; }
		if(!empty($query_8)){  $data["nilai_8"] =$query_8->harian_nilai;  }else{ $data["nilai_8"]  = 0; }
		if(!empty($query_9)){  $data["nilai_9"] =$query_9->harian_nilai;  }else{ $data["nilai_9"]  = 0; }
		if(!empty($query_10)){ $data["nilai_10"]=$query_10->harian_nilai; }else{ $data["nilai_10"] = 0; }
		if(!empty($query_11)){ $data["nilai_11"]=$query_11->harian_nilai; }else{ $data["nilai_11"] = 0; }
		if(!empty($query_12)){ $data["nilai_12"]=$query_12->harian_nilai; }else{ $data["nilai_12"] = 0; }
		if(!empty($query_13)){ $data["nilai_13"]=$query_13->harian_nilai; }else{ $data["nilai_13"] = 0; }
		if(!empty($query_14)){ $data["nilai_14"]=$query_14->harian_nilai; }else{ $data["nilai_14"] = 0; }

		//untuk mencari presentase pencapaian kegiatan hari ini
		$param  = " AND rekap_user=".$user_id." AND rekap_tanggal='".$tanggal."'";
		$query  = $this->mm->get_one_data_by_param("tbl_rekap", "rekap_prosen", "rekap", $param);
		if(!empty($query)){ $data["rekap_prosen"]=$query->rekap_prosen; }else{ $data["rekap_prosen"] = 0; }
		
		//menampilkan data setup
		$parameter = " AND setup_user=".$user_id." AND setup_status=1";
		$data["query_setup"] = $this->mm->get_all_data_by_param("v_setup", "*", "setup", $parameter);
		
		$data["page"] = "view_user/home_kegiatan";
        $data["title"] = "Kegiatan Ibadah Harian";
		$this->load->view("template/template", $data);
	}
	
	function submit()
	{
		$submit = $this->input->post('submit');
		if(isset($submit) && $submit!=""){
			
			//data master
			$user_id = $this->session->userdata("userId");
			$user    = $user_id;
			$mode    = $this->input->post('harian_mode');
			$waktu   = $this->input->post('harian_waktu');
			$tanggal = $this->input->post('harian_tanggal');
			$hari    = $this->input->post('harian_hari');
			$bulan   = $this->input->post('harian_bulan');
			$total_bobot = $this->input->post('tot_bobot');
			$inputan = "";
			
			//untuk menghapus kegiatan
			$this->mm->delete_data_kegiatan($tanggal,$user);
			
			//ambil data form
			$giat_1  = $this->input->post('kegiatan_1');
			$giat_2  = $this->input->post('kegiatan_2');
			$giat_3  = $this->input->post('kegiatan_3');
			$giat_4  = $this->input->post('kegiatan_4');
			$giat_5  = $this->input->post('kegiatan_5');
			$giat_6  = $this->input->post('kegiatan_6');
			$giat_7  = $this->input->post('kegiatan_7');
			$giat_8  = $this->input->post('kegiatan_8');
			$giat_9  = $this->input->post('kegiatan_9');
			$giat_10 = $this->input->post('kegiatan_10');
			$giat_11 = $this->input->post('kegiatan_11');
			$giat_12 = $this->input->post('kegiatan_12');
			$giat_13 = $this->input->post('kegiatan_13');
			$giat_14 = $this->input->post('kegiatan_14');
			
			$hdd_giat_1  = $this->input->post('hdd_giat_1');
			$hdd_giat_2  = $this->input->post('hdd_giat_2');
			$hdd_giat_3  = $this->input->post('hdd_giat_3');
			$hdd_giat_4  = $this->input->post('hdd_giat_4');
			$hdd_giat_5  = $this->input->post('hdd_giat_5');
			$hdd_giat_6  = $this->input->post('hdd_giat_6');
			$hdd_giat_7  = $this->input->post('hdd_giat_7');
			$hdd_giat_8  = $this->input->post('hdd_giat_8');
			$hdd_giat_9  = $this->input->post('hdd_giat_9');
			$hdd_giat_10 = $this->input->post('hdd_giat_10');
			$hdd_giat_11 = $this->input->post('hdd_giat_11');
			$hdd_giat_12 = $this->input->post('hdd_giat_12');
			$hdd_giat_13 = $this->input->post('hdd_giat_13');
			$hdd_giat_14 = $this->input->post('hdd_giat_14');
			
			//menentukan nilai
			if(isset($giat_1)  && $giat_1!==""){  $bobot_giat_1 =$giat_1;  }else{ $bobot_giat_1 =0; }
			if(isset($giat_2)  && $giat_2!==""){  $bobot_giat_2 =$giat_2;  }else{ $bobot_giat_2 =0; }
			if(isset($giat_3)  && $giat_3!==""){  $bobot_giat_3 =$giat_3;  }else{ $bobot_giat_3 =0; }
			if(isset($giat_4)  && $giat_4!==""){  $bobot_giat_4 =$giat_4;  }else{ $bobot_giat_4 =0; }
			if(isset($giat_5)  && $giat_5!==""){  $bobot_giat_5 =$giat_5;  }else{ $bobot_giat_5 =0; }
			if(isset($giat_6)  && $giat_6!==""){  $bobot_giat_6 =$giat_6;  }else{ $bobot_giat_6 =0; }
			if(isset($giat_7)  && $giat_7!==""){  $bobot_giat_7 =$giat_7;  }else{ $bobot_giat_7 =0; }
			if(isset($giat_8)  && $giat_8!==""){  $bobot_giat_8 =$giat_8;  }else{ $bobot_giat_8 =0; }
			if(isset($giat_9)  && $giat_9!==""){  $bobot_giat_9 =$giat_9;  }else{ $bobot_giat_9 =0; }
			if(isset($giat_10) && $giat_10!==""){ $bobot_giat_10=$giat_10; }else{ $bobot_giat_10=0; }
			if(isset($giat_11) && $giat_11!==""){ $bobot_giat_11=$giat_11; }else{ $bobot_giat_11=0; }
			if(isset($giat_12) && $giat_12!==""){ $bobot_giat_12=$giat_12; }else{ $bobot_giat_12=0; }
			if(isset($giat_13) && $giat_13!==""){ $bobot_giat_13=$giat_13; }else{ $bobot_giat_13=0; }
			if(isset($giat_14) && $giat_14!==""){ $bobot_giat_14=$giat_14; }else{ $bobot_giat_14=0; }
			
			//input kegiatan
			if(isset($hdd_giat_1)){  $this->mm->insert_data_kegiatan($waktu,$tanggal,$hari,$bulan,$user,"1",$bobot_giat_1,$inputan); }
			if(isset($hdd_giat_2)){  $this->mm->insert_data_kegiatan($waktu,$tanggal,$hari,$bulan,$user,"2",$bobot_giat_2,$inputan); }
			if(isset($hdd_giat_3)){  $this->mm->insert_data_kegiatan($waktu,$tanggal,$hari,$bulan,$user,"3",$bobot_giat_3,$inputan); }
			if(isset($hdd_giat_4)){  $this->mm->insert_data_kegiatan($waktu,$tanggal,$hari,$bulan,$user,"4",$bobot_giat_4,$inputan); }
			if(isset($hdd_giat_5)){  $this->mm->insert_data_kegiatan($waktu,$tanggal,$hari,$bulan,$user,"5",$bobot_giat_5,$inputan); }
			if(isset($hdd_giat_6)){  $this->mm->insert_data_kegiatan($waktu,$tanggal,$hari,$bulan,$user,"6",$bobot_giat_6,$inputan); }
			if(isset($hdd_giat_7)){  $this->mm->insert_data_kegiatan($waktu,$tanggal,$hari,$bulan,$user,"7",$bobot_giat_7,$inputan); }
			if(isset($hdd_giat_8)){  $this->mm->insert_data_kegiatan($waktu,$tanggal,$hari,$bulan,$user,"8",$bobot_giat_8,$inputan); }
			if(isset($hdd_giat_9)){  $this->mm->insert_data_kegiatan($waktu,$tanggal,$hari,$bulan,$user,"9",$bobot_giat_9,$inputan); }
			if(isset($hdd_giat_10)){ $this->mm->insert_data_kegiatan($waktu,$tanggal,$hari,$bulan,$user,"10",$bobot_giat_10,$inputan); }
			if(isset($hdd_giat_11)){ $this->mm->insert_data_kegiatan($waktu,$tanggal,$hari,$bulan,$user,"11",$bobot_giat_11,$inputan); }
			if(isset($hdd_giat_12)){ $this->mm->insert_data_kegiatan($waktu,$tanggal,$hari,$bulan,$user,"12",$bobot_giat_12,$inputan); }
			if(isset($hdd_giat_13)){ $this->mm->insert_data_kegiatan($waktu,$tanggal,$hari,$bulan,$user,"13",$bobot_giat_13,$inputan); }
			if(isset($hdd_giat_14)){ $this->mm->insert_data_kegiatan($waktu,$tanggal,$hari,$bulan,$user,"14",$bobot_giat_14,$inputan); }
			
			//hitung jumlah prosentasi pencapaian target kegiatan ibadah
			$bobot_giat    = $bobot_giat_1+$bobot_giat_2+$bobot_giat_3+$bobot_giat_4+$bobot_giat_5+$bobot_giat_6+$bobot_giat_7+$bobot_giat_8+$bobot_giat_9+$bobot_giat_10+$bobot_giat_11+$bobot_giat_12+$bobot_giat_13+$bobot_giat_14;
			$prosentase    = ($bobot_giat/$total_bobot)*100;
			$tampil_prosen = round($prosentase,2);
			
			//untuk menghapus rekap 
			$this->mm->delete_rekap_kegiatan($tanggal,$user);
			
			//simpan data rekap
			$query_prosen  = $this->mm->insert_rekap_kegiatan($waktu,$tanggal,$hari,$bulan,$user,$tampil_prosen);
			if($query_prosen){
				$msg   = "Kegiatan berhasil disimpan";
				$alert = "info";
				
				if($mode=="update"){
					$eid=$tanggal;
					redirect(site_url("kegiatan?m=".$msg."&a=".$alert."&id=".$eid));
				}else{
					redirect(site_url("kegiatan?m=".$msg."&a=".$alert));
				}
				
			}else{
				$msg   = "Kegiatan tidak berhasil disimpan";
				$alert = "danger";
				redirect(site_url("kegiatan?m=".$msg."&a=".$alert));
			}
			
		}else{
			redirect(site_url("auth/warning"));
		}
	}
	
	private function cek_login()
    {
        if( ! $this->session->userdata("isLoggedInSMV") OR $this->session->userdata("isLoggedInSMV") === FALSE)
        {
            redirect("auth");
        }
    }
}