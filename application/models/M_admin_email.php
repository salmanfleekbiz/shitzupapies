<?php
/*
* Some useful return methods:
* return $query->row_array();
* return $query->result_array();
* echo $last_query = $this->db->last_query();
*/

class M_admin_email extends CI_Model
{
	function __construct()
    {
        parent::__construct();
    }
	
	function alldata(){
		$query = $this->db->query("SELECT * FROM emailsend order by id desc");
		return $query->result_array();
	}
	
	function delete($id){
		$query = "DELETE FROM `emailsend` WHERE `id` = ?";
		$pass = $this->db->query($query , array($id));
	}
}


?>