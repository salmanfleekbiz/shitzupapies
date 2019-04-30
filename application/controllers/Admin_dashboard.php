<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_dashboard extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		//$this->load->model("admin_login_model");
	}
	
	public function index() {
		$checked_user['title'] = 'Admin Dashboard';
		$checked_user['user_name'] = $this->session->userdata('username'); 
		if($this->session->userdata('user_id')){
			$this->load->view('admin_dashboard',$checked_user);	
		} else {
			redirect(base_url('admin_login'));		
		}	
	}
	
	public function logout() {
        $this->session->sess_destroy();
		redirect(base_url('admin_login'));
	}
}
