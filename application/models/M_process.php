<?php
/*
* Some useful return methods:
* return $query->row_array();
* return $query->result_array();
* echo $last_query = $this->db->last_query();
*/

class M_process extends CI_Model
{

	static $table = "users";


	function __construct()
    {
        parent::__construct();
    }
	
	function login($useremail, $userpassword) {
		$this->db->select('COUNT(*) AS verify, id, email')->from(self::$table);
        $this->db->where(array('email'=>$useremail,'password'=>md5($userpassword)));
		return $this->db->get()->row_array();	
	}
	
	function forgotpass($useremail) {
		
		function generateRandomString($length = 10) {
			$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$charactersLength = strlen($characters);
			$randomString = '';
			for ($i = 0; $i < $length; $i++) {
				$randomString .= $characters[rand(0, $charactersLength - 1)];
			}
			return $randomString;
		}
		
		$newpass = generateRandomString();
		
		$query = "SELECT * FROM `users` where `email` = ?";
		$query_run = $this->db->query($query , array($useremail));
		if($query_run->num_rows() < 1){
			return "notfound";
		} else {
			
			$query = "UPDATE `users` SET  `password`= ? WHERE `email` = ?";
			$query_run = $this->db->query($query , array(md5($newpass), $useremail));
			
			echo "new password is :".$newpass;
		}
	}
	
	function fetch_dashboard($userid) {
		$query = "SELECT * FROM `pages` where `uid` = ?";
		$query_run = $this->db->query($query , array($userid));
		return $query_run->result_array();
	}
	
	//Fetch Page
	function fetch_url($get_page) {
		$url = $get_page;
		$query = "SELECT * FROM `pages` where `page_url` = ?";
		$query_run = $this->db->query($query , array($url));
		return $query_run->result_array();
	}
	
	function fetch_user($uid) {
		$query = "SELECT * FROM `users` where `id` = ?";
		$query_run = $this->db->query($query , array($uid));
		return $query_run->result_array();
	}	
	
	
	// Fetch Pet Type
	function fetch_type($typeid)
	{
		$query = "SELECT * FROM `pet_type` WHERE `id` = ? ";
		$query_run = $this->db->query($query , array($typeid));
		return $query_run->result_array();
	}
	
	//Update Remain Date Counter
	function remain_date_update() {
		date_default_timezone_set('America/Chicago');
		$datechk = "SELECT * FROM `pages` LIMIT 0 , 1";
		$datechk_query_run = $this->db->query($datechk);
		$fetch_date = $datechk_query_run->row_array(); 
		$current_date = date('d-m-Y');		

		$date1= new DateTime($current_date);
		$date2=  new DateTime($fetch_date['currentdate']);
		
		$diff = date_diff($date1,$date2);
		$date_diff =  $diff->format("%R%a days");
		
		if($date_diff < 0){
			$fetch_complete_table = "SELECT * FROM `pages`";
			$fetch_complete_table_run = $this->db->query($fetch_complete_table)->result_array();
			
			foreach($fetch_complete_table_run as $data ) {
				$remain_day = $data['remaindate'] - 1;
				if($data['remaindate'] <= 0){
					
				} else {
					$query = "UPDATE `pages` SET `remaindate`= ? where `page_id` = ?";
					$query_run = $this->db->query($query, array($remain_day, $data['page_id']));
				}
					
			}
			
			$query = "UPDATE `pages` SET `currentdate`= ? ";
			$query_run = $this->db->query($query, array($current_date));
		}
	}	
	
	// Fetch Pet Breed
	function fetch_breed($breed)
	{
		$query = "SELECT * FROM `pet_breed` WHERE `id` = ? ";
		$query_run = $this->db->query($query , array($breed));
		return $query_run->result_array();
	}
	
	// Delete/Unpublish pages form Dashboard
	function delete($pageid,$userid) {
		$chkstatus = "SELECT * FROM `pages` WHERE `page_id` = ? and `uid` = ?";
		$chkstatus_query = $this->db->query($chkstatus , array($pageid,$userid));
		$result = $chkstatus_query->row_array();
		/*if(($result['payment_date'] == '') && ($result['payment'] == '')) {
			return "payoutfirst";				
		} else {*/
			if($result['status'] == 1){
				$query = "UPDATE `pages` SET `status`=0 WHERE `page_id` = ? and `uid` = ?";
				$pass = $this->db->query($query , array($pageid,$userid));
				if($pass){
					return "0";	
				}else {
					return "fail";
				}
			} else {
				$query = "UPDATE `pages` SET `status`=1 WHERE `page_id` = ? and `uid` = ?";
				$pass = $this->db->query($query , array($pageid,$userid));
				if($pass){
					return "1";	
				}else {
					return "fail";
				}
			}
		/*}*/
	}
	
	//Profile Update 
	function updateprofile($uid,$fname,$lname,$email,$telephone,$password,$address1,$address2,$city,$postcode,$country,$region,$aliymo,$oldpassword) {
		
		if($password == '') {
			if($password == '' && $oldpassword == '') {
				$query = "UPDATE `users` SET `first_name`= ? ,`last_name`= ? ,`email`= ? ,`phone`= ? ,`address_one`= ? ,`address_two`= ? ,`city`= ? ,`post_code`= ? ,`country`= ? ,`state`= ? ,`social_link`= ? WHERE `id` = ?";
				$query_run = $this->db->query($query , array($fname,$lname,$email,$telephone,$address1,$address2,$city,$postcode,$country,$region,$aliymo,$uid));	
				echo "pass";
			} 
		} else {
			if($password != '' && $oldpassword != '') {
				$query = "SELECT * FROM `users` where `email` = ? and `password` = ?";
				$query_run = $this->db->query($query , array($email,md5($oldpassword)));
				if($query_run->num_rows() < 1){
					echo "oldpasswordnotmatch";
				} else {
					$query = "UPDATE `users` SET `first_name`= ? ,`last_name`= ? ,`email`= ? ,`phone`= ? ,`password`= ? ,`address_one`= ? ,`address_two`= ? ,`city`= ? ,`post_code`= ? ,`country`= ? ,`state`= ? ,`social_link`= ? WHERE `id` = ?";
					$query_run = $this->db->query($query , array($fname,$lname,$email,$telephone,md5($password),$address1,$address2,$city,$postcode,$country,$region,$aliymo,$uid));
					echo "pass";
				}
			} else {
				echo "fillallfield2";
			}				
		}
	}	
	
	//Fetch Menu 
	function menu_fetch() {
		$query = "SELECT * FROM `web_pages`";
		$query_run = $this->db->query($query);
		return $query_run->result_array();
	}
	
	//Show Menu
	function menu_show($get_page) {
		$query = "SELECT * FROM `web_pages` where  `page_name` = ? ";
		$query_run = $this->db->query($query, array($get_page));
		return $query_run->result_array();
	}	
	
	//Update Page
	function updateview($get_page,$uid) {
		$url = $get_page;
		$query = "SELECT * FROM `pages` where `page_url` = ?";
		$query_run = $this->db->query($query,array($url));
		$fetch_run = $query_run->row_array();
		$addview = $fetch_run['view'] + 1;
		$query_update = "UPDATE `pages` SET `view`= ? WHERE `page_url` = ? and `uid` = ?";
		$pass_update = $this->db->query($query_update, array($addview, $url, $uid));
	}
	
	//Update Page
	function editpage($id,$userid) {
		$chkstatus = "SELECT * FROM `pages` WHERE `page_id` = ? and `uid` = ?";
		$chkstatus_query = $this->db->query($chkstatus , array($id,$userid));
		$result = $chkstatus_query->result_array();	
		return $result;
	}
	
	// Fetch Pet Breed
	function fetch_cat_breed($breed)
	{
		$query = "SELECT * FROM `pet_breed` WHERE `type_id` = ? ";
		$query_run = $this->db->query($query , array($breed));
		return $query_run->result_array();
	}
	
}


?>