<?php
/*
* Some useful return methods:
* return $query->row_array();
* return $query->result_array();
* echo $last_query = $this->db->last_query();
*/

class M_admin_slider extends CI_Model
{
	function __construct()
    {
        parent::__construct();
    }
	
	function insertslide($slidename)
    {
        $this->slidename = $slidename;
		
		$query = "INSERT INTO `slider`(`slidename`) VALUES (?)";
		$pass = $this->db->query($query, array($slidename));
	
    }
	
	function alldata(){
		$query = $this->db->query("SELECT * FROM slider order by id desc");
		return $query->result_array();
	}
	
	function edit($id){
		$query = $this->db->query("SELECT * FROM slider where id =".$id);
		return $query->result_array();
	}
	
	function update($id,$slidename){
		$query = "UPDATE `slider` SET `slidename`='".$slidename."' WHERE `id` = ?";
		$pass = $this->db->query($query , array($id));	
	}
	
	function delete($id){
		$query = "DELETE FROM `slider` WHERE `id` = ?";
		$pass = $this->db->query($query , array($id));
	}
}


?>