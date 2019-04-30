<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_pages extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model("m_admin_type");
		$this->load->model("m_admin_breed");
		$this->load->model("m_admin_pages");
		//$this->load->model("admin_login_model");
	}
	
	public function index() {
		$checked_user['data'] = $this->m_admin_pages->fetch_pages();
		$checked_user['title'] = 'Pages Dashboard';
		$checked_user['user_name'] = $this->session->userdata('username'); 
		if($this->session->userdata('user_id')){
			$this->load->view('admin_pages',$checked_user);	
		} else {
			redirect(base_url('admin_login'));		
		}
	}
	
	// Delete Pages
	public function delete($id) {
		$result = $this->m_admin_pages->delete_pages($id);
		if($result == '1'){
			redirect(base_url("admin_pages?success=1"));	
		}
		else {
			redirect(base_url("admin_pages?error=1"));	
		}
	}
	
	// Edit Pages
	public function admin_edit_pages($id) {
		$checked_pages['pettypedata'] = $this->m_admin_type->fetch_type();
		$checked_pages['petbreeddata'] = $this->m_admin_breed->fetch_breed();
		$checked_pages['data'] = $this->m_admin_pages->edit_pages($id);
		$checked_pages['user_name'] = $this->session->userdata('username'); 
		
		$checked_pages['title'] = 'Edit Pages Dashboard';
		$this->load->view('admin_edit_pages',$checked_pages);	
			
	}
	
	// Disable Pages
	public function admin_disable_pages($id) {
		$result = $this->m_admin_pages->disable_page($id);
		if($result == 'pass'){
			redirect(base_url("admin_pages?success=1"));	
		}
		else {
			redirect(base_url("admin_pages?error=1"));	
		}
			
	}
	
}
