<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Userlogin extends CI_Controller {
	
	public function __construct() {
        parent::__construct();
		$this->load->model("m_process");
		if($this->session->userdata('userid')){redirect(base_url('dashboard'));} else {}
    }
	public function index()
	{
		$alldata['footer_pages'] = $this->m_process->menu_fetch();
		$this->load->view('userlogin',$alldata);
	}
	public function process(){
		$useremail = $this->input->post("useremail");
		$userpassword = $this->input->post("userpassword");
		$authentication = $this->m_process->login($useremail, $userpassword);
		if($authentication['verify'] == '1'){
		    $user_session_data = array(
                'userid'     => $authentication['id'],
                'email'  => $authentication['email']
            );
            $this->session->set_userdata($user_session_data);
        	echo "pass";
		} else {
			echo "fail";
		}
	}
	
	public function forgotpass() {
		$useremail = $this->input->post("useremail");
		$authentication = $this->m_process->forgotpass($useremail);
		
	}
}
