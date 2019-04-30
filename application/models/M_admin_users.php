<?php
/*
* Some useful return methods:
* return $query->row_array();
* return $query->result_array();
* echo $last_query = $this->db->last_query();
*/

class M_admin_users extends CI_Model
{
	
	var $id;
	//static $table = "users";
	
	
	function __construct()
    {
        parent::__construct();
    }
	
	function fetch_users()
	{
		$query = $this->db->query("select * from users");
		return $query->result_array();
	}
	
	function delete_users($id)
	{
		$query = $this->db->query("DELETE FROM `users` WHERE `id` = '".$id."'");
		
		if($query){
			return "1";	
		}else {
			return "fail";
		}
	}
	
	function view_user($id)
	{
		$check = "SELECT * FROM `users` WHERE `id` = ?";
		$chk_query = $this->db->query($check, array($id));
		if($chk_query->num_rows() > 0){
			return $query->result_array();
		} else {
			return "fail";	
		}
		
	}
	
	
}


?>