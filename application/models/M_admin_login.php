<?php
/*
* Some useful return methods:
* return $query->row_array();
* return $query->result_array();
* echo $last_query = $this->db->last_query();
*/

class M_admin_login extends CI_Model
{
	var $Id;
	var $Username;
	var $Password;
	
	static $table = "admin_login";
	
	
	function __construct()
    {
        parent::__construct();
    }
	
	function check_auth($Username,$Password)
	{
		$this->db->select('COUNT(*) AS verify, id, username')->from(self::$table);
        $this->db->where(array('username'=>$Username,'password'=>md5($Password)));
		return $this->db->get()->row_array();
	}
	
	
}


?>