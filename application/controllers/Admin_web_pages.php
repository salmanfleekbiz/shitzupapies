<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_web_pages extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model("m_admin_web_pages");
		//$this->load->model("m_admin_type");
		//$this->load->model("m_admin_breed");
		//$this->load->model("m_admin_pages");
		//$this->load->model("admin_login_model");
	}
	
	public function index() {
		$checked_user['data'] = $this->m_admin_web_pages->fetch_pages();
		$checked_user['title'] = 'Pages Dashboard';
		$checked_user['user_name'] = $this->session->userdata('username'); 
		if($this->session->userdata('user_id')){
			$this->load->view('admin_web_pages',$checked_user);	
		} else {
			redirect(base_url('admin_login'));		
		}
	}
	
	// Delete Pages
	public function delete($id) {
		$result = $this->m_admin_web_pages->delete_pages($id);
		if($result == 'pass'){
			redirect(base_url("admin_web_pages?success=1"));	
		}
		else {
			redirect(base_url("admin_web_pages?error=1"));	
		}
	}
	
	// Edit Pages
	public function edit_page($id) {
		$result = $this->m_admin_web_pages->edit_page($id);
		$checked_pages['user_name'] = $this->session->userdata('username'); 
		$checked_pages['title'] = 'Edit Pages Dashboard';
		$checked_pages['data'] = $result;
		$this->load->view('admin_menu_pages',$checked_pages);
		
//		$checked_pages['petbreeddata'] = $this->m_admin_breed->fetch_breed();
//		$checked_pages['data'] = $this->m_admin_pages->edit_pages($id);
//		$checked_pages['user_name'] = $this->session->userdata('username'); 
//		
//		$checked_pages['title'] = 'Edit Pages Dashboard';
//		$this->load->view('admin_edit_pages',$checked_pages);	
			
	}
	
	// Disable Pages
	public function admin_disable_pages($id) {
		$result = $this->m_admin_web_pages->disable_page($id);
		if($result == 'pass'){
			redirect(base_url("admin_web_pages?disablesuccess=1"));	
		}
		else {
			redirect(base_url("admin_web_pages?disableerror=1"));	
		}
			
	}
	
	//Add pages
	public function add_pages(){
		$checked_pages['user_name'] = $this->session->userdata('username'); 
		$checked_pages['title'] = 'Add Pages Dashboard';
		$checked_pages['data'] = '';
		$this->load->view('admin_menu_pages',$checked_pages);
	}
	
}
