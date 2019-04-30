<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {
	
	public function __construct() {
        parent::__construct();
		$this->load->model("m_process");
		if($this->session->userdata('userid')){} else {redirect(base_url());}
    }
	public function index()
	{
		$userid = $this->session->userdata('userid');
		$alldata['fetch_dashboard'] = $this->m_process->fetch_user($userid);
		$alldata['footer_pages'] = $this->m_process->menu_fetch();
		//$alldata['fetch_breed'] = $this->m_admin_breed->fetch_breed();
		$this->load->view('profile',$alldata);
	}
	
	function updateprofile() {
		$userid = $this->session->userdata('userid');
		$fname = $this->input->post('fname');
		$lname = $this->input->post('lname');
		$email = $this->input->post('email');
		$telephone = $this->input->post('telephone');
		$password = $this->input->post('password');
		$address1 = $this->input->post('address1');
		$address2 = $this->input->post('address2');
		$city = $this->input->post('city');
		$postcode = $this->input->post('postcode');
		$country = $this->input->post('country');
		$region = $this->input->post('region');
		$aliymo = $this->input->post('aliymo');
		$oldpassword = $this->input->post('oldpassword');
		
		$result = $this->m_process->updateprofile($userid,$fname,$lname,$email,$telephone,$password,$address1,$address2,$city,$postcode,$country,$region,$aliymo,$oldpassword);
		echo $result;	
	}
	
}
