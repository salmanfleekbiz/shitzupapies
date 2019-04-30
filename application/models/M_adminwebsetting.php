<?php
/*
* Created By: Dabeer ul Hasan
* Developer Email: dabeer.hasan@gmail.com
* Created On: Mon - Feb 24, 2016
*/

/*
* Some useful return methods:
* return $query->row_array();
* return $query->result_array();
* echo $last_query = $this->db->last_query();
*/

class M_adminwebsetting extends CI_Model
{
    var $id;
    var $admin_email;
    var $admin_password;
    var $admin_username;
    
	static $table = "web_pages";

    function __construct()
    {
        parent::__construct();
    }
	
	function all_datashow(){
		 $result = $this->db->query("SELECT * FROM `admin_login` WHERE `id` = 1");	
		 return $result->result_array();
	}
	
	function update($id,$admin_email,$admin_password,$admin_username,$aliymo){
		
		if($admin_password = ''){
			$query = "UPDATE `admin_login` SET `username`= ? ,`email`= ?, `aliymo`= ?  WHERE `id`= ?";
			$pass = $this->db->query($query, array($admin_username,$admin_email,$aliymo,$id));
			return "pass";
		} else {
			$query = "UPDATE `admin_login` SET `username`= ? ,`password`= ? ,`email`= ? , `aliymo`= ?  WHERE `id`= ?";
			$pass = $this->db->query($query, array($admin_username,md5($admin_password),$admin_email,$aliymo,$id));
			return "pass";	
		} 
	}
}

?>