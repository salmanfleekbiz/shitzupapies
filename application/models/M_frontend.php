<?php
/*
* Some useful return methods:
* return $query->row_array();
* return $query->result_array();
* echo $last_query = $this->db->last_query();
*/

class M_frontend extends CI_Model
{


	function __construct()
    {
        parent::__construct();
    }
	
	// User Signup
	function signup_user($email,$password,$postcode)
	{
		$check_user = "SELECT * FROM `users` where `email` = ? ";
		$result = $this->db->query($check_user , array($email));
		$row = $result->num_rows();
		if($row > 0) {
			$messages = array('message' => 'already');
			return json_encode($messages);
		} else {
			$insert_user = "INSERT INTO `users`(`first_name`, `last_name`, `email`, `phone`, `password`, `address_one`, `address_two`, `city`, `post_code`, `country`, `state`, `social_link`) VALUES ( ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? )";
			$pass = $this->db->query($insert_user, array('','',$email,'',md5($password),'','','',$postcode,'','',''));
			$messages = array('message' => 'pass','userid' => $this->db->insert_id());
			return json_encode($messages);
		}
	}
	
	//Create New Page
	function newpage($userid,$tel,$email,$sociallink,$pagename,$pageurl,$petstype,$breed,$banner,$url,$sex,$age,$ref,$keynotes,$desc) {
			$insert_user = "INSERT INTO `pages`(`uid`,`tel`,`email`,`sociallink`, `type_id`, `breed_id`, `page_url`, `page_name`, `banner` ,  `youtube_url`, `sex`, `age`, `ref`, `keynotes`, `description`, `payment`, `payment_date`, `status`) VALUES ( ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? )";
			$pass = $this->db->query($insert_user, array($userid,$tel,$email,$sociallink,$petstype,$breed,$pageurl,$pagename,$banner,$url,$sex,$age,$ref,$keynotes,$desc,'','','1'));
			if($pass){
				echo "pass";	
			}	
	}
	
	//Update Page
	function updatepage($pageid,$uid,$tel,$email,$sociallink,$banner,$url,$sex,$age,$ref,$keynotes,$desc) {
		
			//echo $banner;
		
			if($banner == ''){
				$update = "UPDATE `pages` SET `tel` = ?, `email` = ?, `sociallink` = ?, `youtube_url`=?,`sex`=?,`age`=?,`ref`=?,`keynotes`=?,`description`=? WHERE `page_id`= ?";
				$pass = $this->db->query($update, array($tel,$email,$sociallink,$url,$sex,$age,$ref,$keynotes,$desc,$pageid));
				if($pass){
				echo "pass";	
				}	
			} else {
				$update = "UPDATE `pages` SET `tel` = ?, `email` = ?, `sociallink` = ?, `banner`=?,`youtube_url`=?,`sex`=?,`age`=?,`ref`=?,`keynotes`=?,`description`=? WHERE `page_id`= ?";
			$pass = $this->db->query($update, array($tel,$email,$sociallink,$banner,$url,$sex,$age,$ref,$keynotes,$desc,$pageid));
			if($pass){
				echo "pass";	
			}	
			}
				
	}
	
	
	
	function fetch_pet($petid) {
		$check = "select id, breed from pet_breed where type_id = ?";
		$chk_query = $this->db->query($check, array($petid));	
		return $chk_query->result_array();
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
		$query = "UPDATE `pet_breed` SET `type_id`= ? ,`breed`= ? , `description` = ? WHERE `id`= ?";
		$pass = $this->db->query($query, array($type_id,$breed,$desc,$id));
		return "pass";	
	}
	
	//Check Url available
	function urlcheck($url) {
		$check_url = "SELECT * FROM `pages` where `page_name` = ? ";
		$result = $this->db->query($check_url , array($url));
		$row = $result->num_rows();
		if($row > 0) {
			echo $url.'-'.$row;
		} else {
			echo $url;	
		}
	}
	
	
	//Payment Process
	function paymentcomplate($url,$email) {
		$getdate  = date("d-m-Y");
		$page_path = $url; 
		$check_user = "SELECT * FROM `users` where `email` = ?";
		$result_user = $this->db->query($check_user, array($email));
		$row_user = $result_user->num_rows();
		$row_user_array = $result_user->row_array();
		if($row_user > 0 ) {
			$check_url = "SELECT * FROM `pages` where `page_url` = ? and `uid` = ?";
			$result = $this->db->query($check_url , array($page_path, $row_user_array['id']));
			$row = $result->num_rows();
			if($row > 0) {
				
				$check_url = "UPDATE `pages` SET `payment`= ? , `remaindate` = ? ,`payment_date`= ?, `currentdate` = ? ,`status`= 1 WHERE `uid` = ? and `page_url` = ?";
				$result = $this->db->query($check_url , array('done', '30' ,$getdate, $getdate , $row_user_array['id'], $page_path));
				return "pass";
			} else {
				return "fail";	
			}	
		}
	}	
	
	//Renew payment Process
	function renewpayment($pageid,$remaindate) {
		
		$dates = $remaindate + 30;
		
		$getdate  = date("d-m-Y");
		$check_url = "SELECT * FROM `pages` where `page_id` = ?";
		$result = $this->db->query($check_url , array($pageid));
		$row = $result->num_rows();
			if($row > 0) {
				$check_url = "UPDATE `pages` SET `payment`= ? ,`payment_date`= ?,  `remaindate` = ?  ,`status`= 1 WHERE `page_id` = ?";
				$result = $this->db->query($check_url , array('done', $getdate , $dates ,$pageid));
				return "pass";
			} else {
				return "fail";	
			}	
	}	
	
	
	
	//Edit Payment Process
	function editpaymentcomplate($url,$userid) {
		$getdate  = date("d-m-Y");
		//$getdate =  $date_now['mday']."-".$date_now['mon']."-".$date_now['year'];
		
		$page_path = $url; 
		$check_url = "SELECT * FROM `pages` where `page_url` = ? and `uid` = ?";
		$result = $this->db->query($check_url , array($page_path, $userid));
		$row = $result->num_rows();
		if($row > 0) {
			$check_url = "UPDATE `pages` SET `remaindate` = ? , `payment`= ? ,`payment_date`= ? ,`currentdate`= ? ,`status`= 1 WHERE `uid` = ? and `page_url` = ?";
			$result = $this->db->query($check_url , array('30', 'done', $getdate, $getdate , $userid, $page_path));
			return "pass";
		} else {
			return "fail";	
		}	
	}	
	
	
	// Edit Page Delete keynotes
	function deletekeynotes($keynotedelete,$pageid,$keynotevalue){
		$check_url = "SELECT * FROM `pages` where `page_id` = ? ";
		$result = $this->db->query($check_url , array($pageid));
		$row = $result->row_array();
		$keynotes = explode(',,,,',$row['keynotes']);
		$pos = array_search($keynotevalue, $keynotes);
		unset($keynotes[$pos]);
		$updatekeynotes = implode(',,,,',$keynotes);
		$check_url = "UPDATE `pages` SET `keynotes`= ? WHERE `page_id` = ?";
		$result = $this->db->query($check_url , array($updatekeynotes, $pageid));
		echo "pass";
	}
	
	// Edit Page Delete Url
	function deleteurl($deleteurl,$pageid,$urlvalue,$sexvalue,$agevalue,$refvalue) {
		$check_url = "SELECT * FROM `pages` where `page_id` = ? ";
		$result = $this->db->query($check_url , array($pageid));
		$row = $result->row_array();
		
		$youtube_url = explode(',',$row['youtube_url']);
		$sex = explode(',',$row['sex']);
		$age = explode(',',$row['age']);
		$ref = explode(',',$row['ref']);
		
		$posurl = array_search($urlvalue, $youtube_url);
		$possex = array_search($sexvalue, $sex);
		$posage = array_search($agevalue, $age);
		$posref = array_search($refvalue, $ref);
		
		unset($youtube_url[$posurl]);
		unset($sex[$possex]);
		unset($age[$posage]);
		unset($ref[$posref]);
		
		
		$updateyoutube_url = implode(',',$youtube_url);
		$updatesex = implode(',',$sex);
		$updateage = implode(',',$age);
		$updateref = implode(',',$ref);
		
		$check_url = "UPDATE `pages` SET `youtube_url`= ? ,`sex`= ? ,`age`= ? ,`ref`= ?  WHERE `page_id` = ?";
		$result = $this->db->query($check_url , array($updateyoutube_url,$updatesex,$updateage,$updateref,$pageid));
		echo "pass";
	}	
	
	// Delete Page Image
	function deleteimage($deleteimage,$imagename,$pageid){
		$check_url = "SELECT * FROM `pages` where `page_id` = ? ";
		$result = $this->db->query($check_url , array($pageid));
		$row = $result->row_array();
		$images = explode(',',$row['banner']);
		$pos = array_search($imagename, $images);
		unset($images[$pos]);
		$updatebanner = implode(',',$images);
		$check_url = "UPDATE `pages` SET `banner`= ? WHERE `page_id` = ?";
		$result = $this->db->query($check_url , array($updatebanner, $pageid));
		echo "pass";
	}
	
	
	// Page Contact form
	function emailsend($pageid,$email,$fullname,$message,$phone,$pageowneremail) {
	$to = $pageowneremail;
	$subject = "Pageurl Contact form";
	$body  = '	<style>	
				<table width="600" cellspacing="0" cellpadding="10" border="0" style="margin:0;padding:0;font-family:Century Gothic,Calibri,Helvetica,Arial,sans-serif;border-collapse:collapse">
				<tbody>
				<tr style="margin:0;padding:0;font-family:Century Gothic,Calibri,Helvetica,Arial,sans-serif;text-align:center">
				<td colspan="2" style="background:rgb(238,238,238)">
				<a href="http://clients.5stardesigners.net/shihtzupapies/"><h2>Peturl</h2></a>
				</td>
				</tr>
				<tr style="margin:0;padding:0;font-family:Century Gothic,Calibri,Helvetica,Arial,sans-serif;text-align:center">
				<td colspan="2" style="background:rgb(238,238,238)"><h4>Contact Information</h4></td>
				</tr>
				<tr style="margin:0;padding:0;font-family:Century Gothic,Calibri,Helvetica,Arial,sans-serif;text-align:center">
				<td width="96" style="background:rgb(238,238,238)">Full Name</td>
				<td width="464" style="background:rgb(238,238,238)">'.$fullname.'</td>
				</tr>
				<tr style="margin:0;padding:0;font-family:Century Gothic,Calibri,Helvetica,Arial,sans-serif;text-align:center">
				<td style="background:rgb(238,238,238)">Email</td>
				<td style="background:rgb(238,238,238)">'.$email.'</td>
				</tr>
				<tr style="margin:0;padding:0;font-family:Century Gothic,Calibri,Helvetica,Arial,sans-serif;text-align:center">
				<td style="background:rgb(238,238,238)">Message</td>
				<td style="background:rgb(238,238,238)">'.$message.'</td>
				</tr>
				<tr style="margin:0;padding:0;font-family:Century Gothic,Calibri,Helvetica,Arial,sans-serif;text-align:center">
				<td style="background:rgb(238,238,238)">Phone</td>
				<td style="background:rgb(238,238,238)">'.$phone.'</td>
				</tr>
				<tr style="margin:0;padding:0;font-family:Century Gothic,Calibri,Helvetica,Arial,sans-serif;text-align:center">
				<td style="background:rgb(238,238,238)">&nbsp;</td>
				<td style="background:rgb(238,238,238)">&nbsp;</td>
				</tr>
				</tbody>
				</table>';
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: info@peturl.com' . "\r\n" .'Reply-To: info@peturl.com';
		$sent = mail($to,$subject,$body,$headers);	
		if($sent) {
				$data = array(
				   'pageid' => $pageid ,
				   'fullname' => $fullname ,
				   'email' => $email ,
				   'message' => $message ,
				   'phone' => $phone,
				   'pageowneremail' => $pageowneremail
				);
				$this->db->insert('emailsend', $data);
				echo "pass";
		}
		else {
		echo "0";	
		}

			
	}
	
}


?>