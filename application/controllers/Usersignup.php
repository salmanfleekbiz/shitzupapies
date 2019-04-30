<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usersignup extends CI_Controller {
	
	public function __construct() {
        parent::__construct();
		$this->load->model("m_admin_breed");
		$this->load->model("m_admin_type");
		$this->load->model("m_frontend");
		$this->load->model("m_process");
		$this->load->helper(array('form', 'url'));
		$this->load->model("M_adminpages");
		if($this->session->userdata('userid')){redirect(base_url('dashboard'));} else {}
    }
	public function index()
	{
		$alldata['fetch_type'] = $this->m_admin_type->fetch_type();
		$alldata['fetch_breed'] = $this->m_admin_breed->fetch_breed();
		$alldata['footer_pages'] = $this->m_process->menu_fetch();
		$alldata['home_page'] = $this->M_adminpages->homepage_fetch();
		$this->load->view('usersignup',$alldata);
	}
	
	//Signup Fetch Breed
	public function petid() {
		$petid = $this->input->post('petid');
		$result = $this->m_frontend->fetch_pet($petid);
		if(empty($result)){
			$output = null;
			echo $output .= '<label class="required">Breed</label><a href="'.base_url().'contactus" class="btn breednotfound">Cannot see the breed tell us about it Submit Here</a><input type="hidden" value="" name="breed" id="breed">';
						
		} else {
			$output = null;
			$output .= '<label class="required">Breed</label><select id="breed" name="breed">';
			foreach ($result as $row)
			{
				$output .= "<option value='".$row['id']."'>".str_replace('-',' ',$row['breed'])."</option>";
			}
			$output .= '</select>';
			echo $output;
		}
	}
	
	//Signup
	public function insert() {
		$email = str_replace(" ","-",$this->input->post('email'));
		$password = str_replace(" ","-",$this->input->post('password'));
		$postcode = str_replace(" ","-",$this->input->post('postcode'));
		$result = $this->m_frontend->signup_user($email,$password,$postcode);
		$decode = json_decode($result,TRUE);
		if($decode['message'] == 'pass'){
		    $user_session_data = array(
                'userid'     => $decode['userid'],
                'email'  => $email
            );
            $this->session->set_userdata($user_session_data);
		}
		echo $result;
	}
	
	
	//Check Url available 
	public function urlcheck() {
		$url = str_replace(" ","-",$this->input->post('url'));
		$result = $this->m_frontend->urlcheck($url);
		echo $result;
	}
	
	
	//Thanks Page 
	public function paymentcomplete() {
		$url = $_GET['url'];
		$email = $_GET['email'];
		$this->m_frontend->paymentcomplate($url,$email);
		redirect(base_url('userlogin'));
		//$this->load->view('usersignup',$alldata);		
	}

}
