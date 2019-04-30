<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_login extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model("m_admin_login");
	}
	
	public function index() {
		$fetch['title'] = 'Login Panel';
		if($this->session->userdata('user_id')){
			redirect(base_url('admin_dashboard'));	
		} else {
			$this->load->view('admin_login',$fetch);	
		}
	}
	
	public function auth() {
		$username = $this->input->post("username");
		$password = $this->input->post("password");
		
        //To destroy all session variables
        //$this->session->sess_destroy();
		//$password = md5($password);
		$authentication = $this->m_admin_login->check_auth($username, $password);
		
		if($authentication['verify'] == '1'){
		    $user_session_data = array(
                'user_id'     => $authentication['id'],
                'username'  => $authentication['username']
            );
            $this->session->set_userdata($user_session_data);
        	echo "pass";
		} else {
			echo "fail";
		}

	}
}
