<?php
/*
* Some useful return methods:
* return $query->row_array();
* return $query->result_array();
* echo $last_query = $this->db->last_query();
*/

class M_admin_breed extends CI_Model
{
	
	var $id;
	var $typeid;
	var $breedname;
	//static $table = "users";
	
	
	function __construct()
    {
        parent::__construct();
    }
	
	// Fetch Pet Breed
	function fetch_breed()
	{
		$query = $this->db->query("SELECT pet_breed.id as petid, pet_breed.type_id, pet_breed.breed, pet_type.id, pet_type.type  FROM pet_breed, pet_type WHERE pet_breed.type_id = pet_type.id");
		return $query->result_array();
	}
	
	// Add Pet Breed
	function add_breed($pettype,$petbreed,$desc)
	{
		$pettype = str_replace(" ","-",$pettype);
		$petbreed = str_replace(" ","-",$petbreed);
		$desc = htmlentities($desc,ENT_QUOTES);
		
		$check = "select * from pet_breed where `breed` = ? and type_id = ?";
		$chk_query = $this->db->query($check, array($petbreed, $pettype));
		if($chk_query->num_rows() > 0){
			return "duplicate";			
		} else {
			$query = "INSERT INTO `pet_breed`(`type_id`, `breed`, `description`) VALUES (? , ?, ?)";
			$pass = $this->db->query($query , array($pettype, $petbreed, $desc));
			return "pass";	
		}
	}
	
	// Delete Pet Breed
	function delete($id){
		
		$query = "DELETE FROM `pet_breed` WHERE `id` = ?";
		$pass = $this->db->query($query, array($id));
		
		if($query){
			return "pass";
		} else {
			return "fail";
		}

	}
	
	
	// Edit Pet Breed Page show content
	function edit_breed($id){
		$query = "SELECT pet_breed.id as petid, pet_breed.type_id, pet_breed.breed, pet_breed.description, pet_type.id, pet_type.type  FROM pet_breed, pet_type WHERE pet_breed.type_id = pet_type.id and pet_breed.id = ?";
		$pass = $this->db->query($query, array($id));
		if($pass){
			return $pass->row_array();
		} else {
			return "fail";
		}	
	}
	
	// Edit Pet Breed
	function update_breed($id,$type_id, $breed, $desc){
		
		$type_id = str_replace(" ","-",$type_id);
		$breed = str_replace(" ","-",$breed);
		$desc = htmlentities($desc,ENT_QUOTES);
		
		/*$check = "select * from pet_breed where `type_id` = ? and `breed`= ?";
		$chk_query = $this->db->query($check, array($id,$type_id, $breed));
		if($chk_query->num_rows() > 0){
			return "duplicate";			
		} else {*/
			$query = "UPDATE `pet_breed` SET `type_id`= ? ,`breed`= ? , `description` = ? WHERE `id`= ?";
			$pass = $this->db->query($query, array($type_id,$breed,$desc,$id));
			return "pass";
		/*}*/	
	}
}


?>