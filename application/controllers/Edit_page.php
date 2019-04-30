<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Edit_page extends CI_Controller {
	
	public function __construct() {
        parent::__construct();
		$this->load->model("m_admin_breed");
		$this->load->model("m_admin_type");
		$this->load->model("m_frontend");
		$this->load->model("m_process");
		if($this->session->userdata('userid')){} else {redirect(base_url());}
    }
	public function index()
	{
		$userid = $this->session->userdata('userid');
		$alldata['fetch_dashboard'] = $this->m_process->fetch_dashboard($userid);
		$alldata['fetch_type'] = $this->m_admin_type->fetch_type();
		$alldata['fetch_breed'] = $this->m_admin_breed->fetch_breed();
		$alldata['footer_pages'] = $this->m_process->menu_fetch();
		$this->load->view('edit_page',$alldata);
	}
	
	function logout(){
		$this->session->sess_destroy();
		redirect(base_url());	
	}
	
	function delete($pageid) {
		$userid = $this->session->userdata('userid');
		$result = $this->m_process->delete($pageid,$userid);
		redirect(base_url('dashboard'));
	}
	
}
