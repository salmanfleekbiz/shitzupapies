<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Userhome extends CI_Controller {
	
	public function __construct() {
        parent::__construct();
		$this->load->model("m_admin_breed");
		$this->load->model("m_admin_type");
		$this->load->model("m_frontend");
		$this->load->model("m_process");
		$this->load->model("M_adminpages");
    }
	public function index()
	{
		if($this->session->userdata('userid')){redirect(base_url('dashboard'));} else {}
		$this->m_process->remain_date_update();
		$userid = $this->session->userdata('userid');
		$alldata['footer_pages'] = $this->m_process->menu_fetch();
		//$alldata['fetch_dashboard'] = $this->m_process->fetch_dashboard($userid);
		//echo $this->router->class;
		//if($this->router->class){
		//	echo "pass";	
		//} else {
		$this->load->model("m_admin_slider");
		$alldata['slide'] = $this->m_admin_slider->alldata();	
		$alldata['home_page'] = $this->M_adminpages->homepage_fetch();
		$this->load->view('userhome',$alldata);
		//}
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
				$output .= "<option value='".$row['id']."'>". str_replace('-',' ',$row['breed']) ."</option>";
			}
			$output .= '</select>';
			echo $output;
		}
	}
	
	
	//Check Url available 
	public function urlcheck() {
		$url = str_replace(" ","-",$this->input->post('url'));
		$result = $this->m_frontend->urlcheck($url);
		echo $result;
	}
	
	
	// Page Email
		public function senduseremail() {
		$pageid = $this->input->post('pageid');
		$email = $this->input->post('email');
		$fullname = $this->input->post('fullname');
		$message = $this->input->post('message');
		$phone = $this->input->post('phone');
		$pageowneremail = $this->input->post('pageowneremail');
		$this->m_frontend->emailsend($pageid,$email,$fullname,$message,$phone,$pageowneremail);
	}
	
}
