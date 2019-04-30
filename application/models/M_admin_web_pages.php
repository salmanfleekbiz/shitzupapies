<?php
/*
* Some useful return methods:
* return $query->row_array();
* return $query->result_array();
* echo $last_query = $this->db->last_query();
*/

class M_admin_web_pages extends CI_Model
{
	
	var $id;
	//static $table = "users";
	
	
	function __construct()
    {
        parent::__construct();
    }
	
	// Fetch All details
	function fetch_pages()
	{
		$query = $this->db->query("SELECT * FROM `web_pages`");
		return $query->result_array();
	}
	
	// Delete page
	function delete_pages($id)
	{
		$query = "DELETE FROM `web_pages` WHERE `id` = ?";
		$pass = $this->db->query($query , array($id));
		return "pass";
	}
	
	
	// Edit Pages
	function edit_page($id) {
		$chkstatus = "SELECT * FROM `web_pages` WHERE `id` = ?";
		$chkstatus_query = $this->db->query($chkstatus , array($id));
		return $chkstatus_query->result_array();
	}
	
	// Disable Page
	public function disable_page($id){
		
		$chkstatus = "SELECT * FROM `web_pages` WHERE `id` = ?";
		$chkstatus_query = $this->db->query($chkstatus , array($id));
		$result = $chkstatus_query->row_array();
		if($result['status'] == 1){
			$query = "UPDATE `web_pages` SET `status`= 0 WHERE `id` = ?";
			$pass = $this->db->query($query , array($id));
			return "pass";	
			
		} else {
			$query = "UPDATE `web_pages` SET `status`= 1 WHERE `id` = ?";
			$pass = $this->db->query($query , array($id));
			return "pass";	
		}
		
		
	}

}


?>