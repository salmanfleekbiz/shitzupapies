<?php
/*
* Some useful return methods:
* return $query->row_array();
* return $query->result_array();
* echo $last_query = $this->db->last_query();
*/

class M_admin_pages extends CI_Model
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
		//SELECT pages.page_id as pegesid, pages.uid as pegesuid, pages.type_id as pagestypeid, pages.breed_id as pagesbreedid, pages.page_url, pages.page_name, pages.payment, pet_type.id, pet_type.type, pet_breed.id, pet_breed.type_id, pet_breed.breed, users.id, users.first_name, users.last_name FROM pet_breed, pet_type, users, pages WHERE pet_breed.type_id = pet_type.id
		$query = $this->db->query("SELECT pg.page_id as pegesid, pg.uid as pegesuid, pg.type_id as pagestypeid, pg.breed_id as pagesbreedid, pg.page_url, pg.page_name, pg.payment, pg.status,pg.admin_status, pt.id, pt.type, pb.id, pb.type_id, pb.breed, usr.id, usr.first_name, usr.last_name FROM pages pg left JOIN pet_breed pb on pg.breed_id = pb.id left JOIN pet_type pt on pg.type_id = pt.id left JOIN users usr on pg.uid = usr.id");
		return $query->result_array();
	}
	
	// Delete page
	function delete_pages($id)
	{
		$query = "DELETE FROM `pages` WHERE `page_id` = ?";
		$pass = $this->db->query($query , array($id));
		if($pass){
			return "1";	
		}else {
			return "fail";
		}
	}
	
	
	// Edit Pages
	function edit_pages($id) {
		$query = "SELECT 
					pages.page_id as pegesid,
					pages.uid as pegesuid, 
					pages.type_id as pegestypeid, 
					pages.breed_id as pegesbreedid, 
					pages.page_url as pegespageurl, 
					pages.page_name as pegesname, 
					pages.banenr as pegesbanner, 
					pages.youtube_url as pegesyoutube, 
					pages.sex as pegessex, 
					pages.age as pegesage, 
					pages.ref as pegesref, 
					pages.keynotes as pegeskeynotes, 
					pages.description as pegesdescription, 
					pages.payment as pegespayment,
					pages.payment_date as pegespaymentdate, 
					pages.status as pegesstatus,
					pet_type.id as petid, 
					pet_type.type as pettypename, 
					pet_breed.id as petbreedid, 
					pet_breed.type_id as petbreedtypeid, 
					pet_breed.breed as petbreedname,
					users.id as userid, 
					users.first_name as userfirstname, 
					users.last_name as userlastname,
					users.email as useremail,
					users.phone as userphone
					FROM 
					pages 
					JOIN pet_type
					ON 
					pet_type.id = pages.type_id
					JOIN pet_breed
					ON 
					pet_breed.id = pages.breed_id
					JOIN users
					ON 
					users.id = pages.uid
					where pages.page_id = '".$id."'";
					
		$pass = $this->db->query($query , array($id))->result_array();
		return $pass;
		
	}
	
	// Disable Page
	public function disable_page($id){
		
		$chkstatus = "SELECT * FROM `pages` WHERE `page_id` = ?";
		$chkstatus_query = $this->db->query($chkstatus , array($id));
		$result = $chkstatus_query->row_array();
		
		if($result['admin_status'] == 1){
			$query = "UPDATE `pages` SET `admin_status`=0 WHERE `page_id` = ?";
			$pass = $this->db->query($query , array($id));
			if($pass){
				return "pass";	
			}else {
				return "fail";
			}
		} else {
			$query = "UPDATE `pages` SET `admin_status`=1 WHERE `page_id` = ?";
			$pass = $this->db->query($query , array($id));
			if($pass){
				return "pass";	
			}else {
				return "fail";
			}
		}
		
		
	}

}


?>