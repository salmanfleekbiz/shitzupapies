<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_websetting extends CI_Controller {
	
	public function __construct() {
        parent::__construct();
    }
	
	public function index()
	{
		$alldata = array();
		$this->load->model("M_adminwebsetting");
		$alldata['user_name'] = $this->session->userdata('username'); 
		$alldata['showall'] = $this->M_adminwebsetting->all_datashow();
		$this->load->view('admin_websetting', $alldata);
	}
	
	public function update()
	{
		$this->load->model("M_adminwebsetting");
		$admin_id = $this->input->post('admin_id');
		$admin_username = $this->input->post('admin_username');
		$admin_password = $this->input->post('admin_password');
		$admin_email = $this->input->post('admin_email');
		$aliymo = $this->input->post('aliymo');
		
		$result = $this->M_adminwebsetting->update($admin_id,$admin_email,$admin_password,$admin_username,$aliymo);
		echo $result;
	}
	
}