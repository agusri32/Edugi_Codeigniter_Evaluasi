<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Master_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    /*
     * @param string $table nama table di database
     * @param string $is_delete nama field is_delete di table
     * @param string $order_by nama field order di table
     */
	function get_all_data($table, $is_delete, $order_by=NULL, $limit = "10", $offset="0", $field="*")
	{
		if($order_by === NULL)
		{
			$sql = "SELECT ".$field." FROM ".$table." WHERE ".$is_delete."_is_delete=0 LIMIT ".$limit." OFFSET ".$offset;
		}
		else
		{
			$sql = "SELECT ".$field." FROM ".$table." WHERE ".$is_delete."_is_delete=0 ORDER BY ".$order_by ." LIMIT ".$limit." OFFSET ".$offset;
		}
		
		//echo $sql;exit;
		
        $qry = $this->db->query($sql);
        return $qry->num_rows() > 0 ? $qry->result() : FALSE;
	}

	
    /*
     * @param string $table nama table di database
     * @param string $type_join type join= INNER, RIGHT, LEFT
     * @param string $table_join nama table yang ingin dijoin
     * @param string $on_join nama field penghubung antara table
     * @param string $is_delete nama field is_delete di table
     * @param string $order_by nama field order di table
     */
	function get_all_join_data($table, $type_join="LEFT JOIN", $table_join, $on_join, $is_delete, $order_by=NULL, $limit = "10", $offset="0", $field="*")
	{
		if($order_by === NULL)
		{
			$sql = "SELECT ".$field." FROM ".$table." ".$type_join." ".$table_join." ON ".$on_join." WHERE ".$is_delete."_is_delete=0 LIMIT ".$limit." OFFSET ".$offset;
		}
		else
		{
			$sql = "SELECT ".$field." FROM ".$table." ".$type_join." ".$table_join." ON ".$on_join." WHERE ".$is_delete."_is_delete=0 ORDER BY ".$order_by ." LIMIT ".$limit." OFFSET ".$offset;
		}
		
		//echo $sql;exit;
		
        $qry = $this->db->query($sql);
        return $qry->num_rows() > 0 ? $qry->result() : FALSE;
	}
	
	/*
     * @param string $table nama table di database
     * @param string $where kondisi field yang ingin dicari
     * @param string $is_delete nama field is_delete di table
	 * @param string $order_by nama field order di table
	 */
	function get_search_data($table, $where, $is_delete, $order_by = NULL, $limit = "10", $offset="0", $field="*")
	{
		
		if($limit=="-1"){
			$limit_ku=" ";
		}else{
			$limit_ku=" LIMIT ".$limit." OFFSET ".$offset;
		}
		
		if($order_by === NULL)
		{
			$sql = "SELECT ".$field." FROM ".$table." WHERE ".$is_delete."_is_delete=0 AND ".$where.$limit_ku;
		}
		else
		{
			$sql = "SELECT ".$field." FROM ".$table." WHERE ".$is_delete."_is_delete=0 AND ".$where." ORDER BY ".$order_by.$limit_ku;
		}
		
		//echo $sql;exit;
		
        $qry = $this->db->query($sql);
        return $qry->num_rows() > 0 ? $qry->result() : FALSE;
	}
	
    /*
     * @param string $table nama table di database
     * @param string $type_join type join= INNER, RIGHT, LEFT
     * @param string $table_join nama table yang ingin dijoin
     * @param string $on_join nama field penghubung antara table
     * @param string $where kondisi field yang ingin dicari
     * @param string $is_delete nama field is_delete di table
	 * @param string $order_by nama field order di table
	 */
	function get_search_join_data($table, $type_join="LEFT JOIN", $table_join, $on_join, $where, $is_delete, $order_by = NULL, $limit = "10", $offset="0", $field="*")
	{
		if($order_by === NULL)
		{
			$sql = "SELECT ".$field." FROM ".$table." ".$type_join." ".$table_join." ON ".$on_join." WHERE ".$is_delete."_is_delete=0 AND ".$where." LIMIT ".$limit." OFFSET ".$offset;
		}
		else
		{
			$sql = "SELECT ".$field." FROM ".$table." ".$type_join." ".$table_join." ON ".$on_join." WHERE ".$is_delete."_is_delete=0 AND ".$where." ORDER BY ".$order_by." LIMIT ".$limit." OFFSET ".$offset;
		}
		
		//echo $sql;exit;
		
        $qry = $this->db->query($sql);
        return $qry->num_rows() > 0 ? $qry->result() : FALSE;
	}
	
    /*
     * @param string $table nama table di database
     * @param string $is_delete nama field is_delete di table
     */

	function count_all_data($table, $where = NULL, $is_delete, $field="*")
	{
		if($where === NULL)
		{
			$sql = "SELECT count(".$field.") AS jml FROM ".$table." WHERE ".$is_delete."_is_delete=0";
		}
		else
		{
			$sql = "SELECT count(".$field.") AS jml FROM ".$table." WHERE ".$is_delete."_is_delete=0 AND ".$where;
		}
		
		//echo $sql;exit;
		
        $qry = $this->db->query($sql);
        return $qry->row();
	}
	
    /*
     * @param string $table nama table di database
     * @param string $is_delete nama field is_delete di table
     */
	function count_all_join_data($table, $type_join="LEFT JOIN", $table_join, $on_join, $where = NULL, $is_delete, $field="*")
	{
		if($where === NULL)
		{
			$sql = "SELECT count(".$field.") AS jml FROM ".$table." ".$type_join." ".$table_join." ON ".$on_join." WHERE ".$is_delete."_is_delete=0";
		}
		else
		{
			$sql = "SELECT count(".$field.") AS jml FROM ".$table." ".$type_join." ".$table_join." ON ".$on_join." WHERE ".$is_delete."_is_delete=0 AND ".$where;
		}
		
		//echo $sql;exit;
		
        $qry = $this->db->query($sql);
        return $qry->row();
	}
	
    /*
     * @param string $table nama table di database
     * @param array $field nama field di table
     * @param array $data value yang ingin diinsert
	 */
	function insert_data($table, $field=array(), $data=array())
	{
		$sql = "INSERT INTO ".$table." (";
		for($i=0;$i<count($field);$i++)
		{
			$sql .= $field[$i];
		}
		$sql .= ") VALUES (";
		
		for($i=0;$i<count($data);$i++)
		{
			$sql .= $data[$i];
		}
		$sql .= ")";
		
		//echo $sql;exit;
		
		$qry = $this->db->query($sql);
		return $this->db->affected_rows();
	}
	
    /*
     * @param string $table nama table di database
     * @param string $pk nama field PK di table
     * @param string $id value PK di table
     * @param array $data value yang ingin diinsert
	 */
	function update_data($table, $pk, $id, $data=array())
	{
		$sql = "UPDATE ".$table." SET ";
		foreach($data as $key=>$row)
		{
			$sql .= $key."=".$row;
		}
		$sql .= " WHERE ".$pk."=".$id;
		
		//echo $sql;exit;
		
		$qry = $this->db->query($sql);
		return $this->db->affected_rows();
	}


	
    /*
     * @param string $table nama table di database
     * @param string $field_name nama awalan field di table
     * @param string $field_id nama field id di table
     * @param string $value_id value from form
	 */
	function delete_data($table, $field_name, $field_id, $value_id)
	{
		$id = is_int($value_id)===TRUE ? $value_id : "'".$value_id."'";
		$user = $this->session->userdata("userId") ? $this->session->userdata("userId") : 0;
		$date = date("Y-m-d H:i:s");
		
		$sql = "UPDATE ".$table." SET ".$field_name."_is_delete=1, ".$field_name ."_update_by=".$user.", ".$field_name."_update_date='".$date."' WHERE ".$field_id."=".$id;
		
		//echo $sql;exit;
		
		$qry = $this->db->query($sql);
		return $this->db->affected_rows();
	}
	
	/*
	 * @param string $pk nama field primary_key
	 * @param string $id id value 
     * @param string $table nama table di database
     * @param string $is_delete nama field is_delete di table
     */
	function get_data_by_id($pk, $id, $table, $is_delete)
	{
        $sql = "SELECT * FROM ".$table." WHERE ".$pk."=".$id." AND ".$is_delete."_is_delete=0";
		
		//echo $sql;exit;
		
        $qry = $this->db->query($sql);
        return $qry->num_rows() > 0 ? $qry->row() : FALSE;
	}
	
    /*
	 * @param string $pk nama field primary_key
	 * @param string $id id value 
     * @param string $table nama table di database
     * @param string $is_delete nama field is_delete di table
     */
	function get_data_join_by_id($pk, $id, $table, $type_join, $table_join, $on_join, $is_delete)
	{
        $sql = "SELECT * FROM ".$table." ".$type_join." ".$table_join." ON ".$on_join." WHERE ".$pk."=".$id." AND ".$is_delete."_is_delete=0";
		
		//echo $sql;exit;

        $qry = $this->db->query($sql);
        return $qry->num_rows() > 0 ? $qry->row() : FALSE;
	}
	
    /*
     * @param string $table nama table di database
     * @param string $order_by nama field order di table
	 * Menampilkan semua data termasuk yang di delete
     */
	function get_data($table, $order_by=NULL, $limit = "10", $offset="0")
	{
		if($order_by === NULL)
		{
			$sql = "SELECT * FROM ".$table." LIMIT ".$limit." OFFSET ".$offset;
		}
		else
		{
			$sql = "SELECT * FROM ".$table." ORDER BY ".$order_by ." LIMIT ".$limit." OFFSET ".$offset;
		}
		
		//echo $sql;exit;
		
        $qry = $this->db->query($sql);
        return $qry->num_rows() > 0 ? $qry->result() : FALSE;
	}
	
	/*
     * @param string $table nama table di database
     * @param string $parameter nama field cek duplikat di table
	 * Mengecek duplikasi data
     */
	function check_duplicate($table, $is_delete, $parameter){
		$sql = "SELECT COUNT(*) as jml FROM ".$table." WHERE ".$is_delete."_is_delete=0 AND ".$parameter;
        
		//echo $sql;exit;
		
        $qry = $this->db->query($sql);
        return $qry->row();
	}
	
	//menampilkan semua data dari satu table tertentu berdasarkan parameter
	function get_all_data_by_param($table, $field, $is_delete, $parameter)
	{
        $sql = "SELECT ".$field." FROM ".$table." WHERE ".$is_delete."_is_delete=0 ".$parameter;
		
		//echo $sql;exit;

        $qry = $this->db->query($sql);
        return $qry->num_rows() > 0 ? $qry->result() : FALSE;
	}
	
	//menampilkan satu record data dari satu table tertentu berdasarkan parameter
	function get_one_data_by_param($table, $field, $is_delete, $parameter)
	{
        $sql = "SELECT ".$field." FROM ".$table." WHERE ".$is_delete."_is_delete=0 ".$parameter;
		
		//echo $sql;exit;

        $qry = $this->db->query($sql);
		return $qry->num_rows() > 0 ? $qry->row() : FALSE;
	}
	
	//untuk insert data setup user kegiatan
	function insert_data_setup($user_id, $kegiatan_id, $status)
	{
		$sql = "Insert into tbl_setup(setup_user,setup_kegiatan,setup_status,setup_is_delete,setup_update_by,setup_update_date)VALUES(".$user_id.",".$kegiatan_id.",".$status.",'0','1','".date("Y-m-d H:i:s")."')";
		
		//echo $sql;exit;
		
        $this->db->query($sql);
		return $this->db->affected_rows();
	}
	
	//untuk insert data kegiatan user
	function insert_data_kegiatan($waktu,$tanggal,$hari,$bulan,$user,$kegiatan,$nilai,$inputan)
	{
		$sql = "Insert into tbl_harian VALUES('','".$waktu."','".$tanggal."',".$hari.",".$bulan.",".$user.",".$kegiatan.",".$nilai.",'".$inputan."',0,".$user.",'".date("Y-m-d H:i:s")."')";
		
		//echo $sql;exit;
		
        $this->db->query($sql);
		return $this->db->affected_rows();
	}
	
	//untuk delete data kegiatan user
	function delete_data_kegiatan($tanggal,$user)
	{
		$sql = "DELETE FROM tbl_harian WHERE harian_tanggal='".$tanggal."' AND harian_user=".$user;
		
		//echo $sql;exit;
		
        $this->db->query($sql);
		return $this->db->affected_rows();
	}
	
	//untuk insert rekap user
	function insert_rekap_kegiatan($waktu,$tanggal,$hari,$bulan,$user,$prosen)
	{
		$sql = "Insert into tbl_rekap VALUES('','".$waktu."','".$tanggal."',".$hari.",".$bulan.",".$user.",'".$prosen."',0,".$user.",'".date("Y-m-d H:i:s")."')";
		
		//echo $sql;exit;
		
        $this->db->query($sql);
		return $this->db->affected_rows();
	}
	
	//untuk delete rekap user
	function delete_rekap_kegiatan($tanggal,$user)
	{
		$sql = "DELETE FROM tbl_rekap WHERE rekap_tanggal='".$tanggal."' AND rekap_user=".$user;
		
		//echo $sql;exit;
		
        $this->db->query($sql);
		return $this->db->affected_rows();
	}
	
	//untuk menampilkan data statistik
	function get_all_data_rekap($table, $order , $is_delete, $limit, $offset)
	{
		$sql = "SELECT * FROM ".$table." WHERE ".$is_delete."_is_delete=0 ORDER BY ".$order." LIMIT ".$limit." OFFSET ".$offset;

        //echo $sql;exit;
		
		$qry = $this->db->query($sql);
        return $qry->num_rows() > 0 ? $qry->result() : FALSE;
	}
}