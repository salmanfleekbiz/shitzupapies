<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_email extends CI_Controller {
	
	public function __construct() {
        parent::__construct();
		//if($this->session->userdata('userid')){} else {redirect(base_url());}
    }
	public function index()
	{
		$alldata['user_name'] = $this->session->userdata('username'); 
		$this->load->model("M_admin_email");
		$alldata['slide'] = $this->M_admin_email->alldata();
		$this->load->view('admin_email_v',$alldata);
	}
	
	public function deletslide($id){
		$this->load->model("M_admin_email");
		$pagesdata = $this->M_admin_email->delete($id);
		redirect(base_url('admin_emailsend'));
	
	}
	
	function logout(){
		$this->session->sess_destroy();
		redirect(base_url());	
	}
	
}
