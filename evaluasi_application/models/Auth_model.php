<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function validate($username, $userpassword, $field="*")
    {		
		$sql = "select ".$field." from tbl_user where user_email='".$username."' and user_password=md5('".$userpassword."') and user_is_delete=0 and user_is_active=1";
		
		//echo $sql;exit;
		
		$query = $this->db->query($sql);
        return $query->num_rows() == 1 ? $query->row() : FALSE;
    }

    function update_password($data = array())
    {
        $old_password = $data["old_password"];
        $new_password = md5($data["new_password"]);
		
		$user = $this->session->userdata("userId");
        $date = date('Y-m-d H:i:s');

        $sql = "update tbl_user set user_password='".$new_password."', user_update_date='".$date."' where user_id=".$user;
		
		//echo $sql;exit;
		
        $qry = $this->db->query($sql);
        return $this->db->affected_rows();
    }
    
	function check_password($password)
	{
		$user = $this->session->userdata("userId");
		$sql  = "select count(*) as jml from tbl_user where user_id=".$user." and user_password='".md5($password)."'";
		
		//echo $sql;exit;
		
		$qry = $this->db->query($sql);
        return $qry->row();
	}
	
	function rekap_akses($filter_tanggal)
	{
		$sql = "SELECT count(distinct log_user) as jumlah FROM v_user_log ".$filter_tanggal;
		
		//echo $sql;exit;
		
		$qry = $this->db->query($sql);
        return $qry->row();
	}
	
	function log_violation($user_id)
	{
		$sql = "update tbl_user set user_violation=user_violation+1 where user_id=".$user_id;
		
		//echo $sql;exit;
		
		$qry = $this->db->query($sql);
		return $this->db->affected_rows();
	}
	
	function log_counter($user_id)
	{
		$sql = "update tbl_user set user_counter=user_counter+1 where user_id=".$user_id;
		
		//echo $sql;exit;
		
		$qry = $this->db->query($sql);
		return $this->db->affected_rows();
	}
	
	function log_update_monitoring($user_id,$waktu_masuk,$waktu_keluar)
	{
		$sql = "update tbl_monitoring set log_waktu_keluar='".$waktu_keluar."' where log_user=".$user_id." AND log_waktu_masuk='".$waktu_masuk."'";
		
		//echo $sql;exit;
		
		$qry = $this->db->query($sql);
		return $this->db->affected_rows();
	}
}