<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_user extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model("m_admin_users");
		//$this->load->model("admin_login_model");
	}
	
	public function index() {
		$checked_user['data'] = $this->m_admin_users->fetch_users();
		$checked_user['title'] = 'User Dashboard';
		$checked_user['user_name'] = $this->session->userdata('username'); 
		
		if($this->session->userdata('user_id')){
			$this->load->view('admin_user',$checked_user);	
		} else {
			redirect(base_url('admin_login'));		
		}
	}
	
	public function delete($id) {
		$result = $this->m_admin_users->delete_users($id);
		if($result == '1'){
			redirect(base_url("admin_user?success=1"));	
		}
		else {
			redirect(base_url("admin_user?error=1"));	
		}
	}
	
	public function view($id) {
		$result = $this->m_admin_users->view_user($id);
		if($result == "fail"){
			redirect(base_url("admin_user?notfound=1"));
		} else {
			$this->load->view('admin_view',$result);		
		}
		//$this->load->view('user_profile',$result);
	}
	
}
