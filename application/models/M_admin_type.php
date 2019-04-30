<?php
/*
* Some useful return methods:
* return $query->row_array();
* return $query->result_array();
* echo $last_query = $this->db->last_query();
*/

class M_admin_type extends CI_Model
{
	
	var $id;
	var $typename;
	//static $table = "users";
	
	
	function __construct()
    {
        parent::__construct();
    }
	
	// Fetch Pet Type
	function fetch_type()
	{
		$query = $this->db->query("select * from pet_type");
		return $query->result_array();
	}
	
	// Add Pet Type
	function add_type($pettype)
	{
		$pettype = str_replace(" ","-",$pettype);
		$check = "select * from pet_type where `type` = ?";
		$chk_query = $this->db->query($check, array($pettype));
		if($chk_query->num_rows() > 0){
			return "duplicate";			
		} else {
			$query = "INSERT INTO `pet_type` (`type`) VALUES (?)";
			$pass = $this->db->query($query, array($pettype));
			return "pass";
		}
	}
	
	// Delete Pet Type
	function delete($id){
		$query = "DELETE FROM `pet_type` WHERE `id` = ?";
		$pass = $this->db->query($query, array($id));
		if($pass){
			return "pass";
		} else {
			return "fail";
		}	
	}
	
	// Edit Pet Type Page show content
	function edit_type($id){
		$query = "Select * FROM `pet_type` WHERE `id` = ?";
		$pass = $this->db->query($query, array($id));
		if($pass){
			return $pass->row_array();
		} else {
			return "fail";
		}	
	}
	
	// Edit Pet Type
	function update_type($id,$name){
		$name = str_replace(" ","-",$name);
		$check = "select * from pet_type where `type` = ?";
		$chk_query = $this->db->query($check, array($name));
		if($chk_query->num_rows() > 0){
			return "duplicate";			
		} else {
			$query = "UPDATE `pet_type` SET `type`= ? WHERE `id`= ?";
			$pass = $this->db->query($query, array($name,$id));
			return "pass";
		}	
	}
}


?>