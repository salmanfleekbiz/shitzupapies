<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contactus extends CI_Controller {
	
	public function __construct() {
        parent::__construct();
		$this->load->model("m_admin_breed");
		$this->load->model("m_admin_type");
		$this->load->model("m_frontend");
		$this->load->model("m_process");
		$this->load->helper(array('form', 'url'));
		$this->load->model("M_adminpages");
		$this->load->model("M_adminwebsetting");
		$this->load->model("m_process");
		/*if($this->session->userdata('userid')){redirect(base_url('dashboard'));} else {}*/
    }
	public function index()
	{
		$alldata['fetch_type'] = $this->m_admin_type->fetch_type();
		$alldata['fetch_breed'] = $this->m_admin_breed->fetch_breed();
		$alldata['footer_pages'] = $this->m_process->menu_fetch();
		$alldata['home_page'] = $this->M_adminpages->homepage_fetch();
		$alldata['all_datashow'] = $this->M_adminwebsetting->all_datashow();
		if($this->session->userdata('userid')){
			$alldata['fetch_user'] = $this->m_process->fetch_user($this->session->userdata('userid'));
		} else {}
		$this->load->view('contactus',$alldata);
	}
}
