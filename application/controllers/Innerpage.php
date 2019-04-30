<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Innerpage extends CI_Controller {
	
	public function __construct() {
        parent::__construct();
		$this->load->model("m_process");
    }
	public function index()
	{
		$this->m_process->remain_date_update();
		//$userid = $this->session->userdata('userid');
		$footer_menu_found = 0;
		$get_page = $this->uri->segment(1);
		$alldata['fetch_url'] = $this->m_process->fetch_url($get_page);
		$alldata['footer_pages'] = $this->m_process->menu_fetch();
		foreach($alldata['footer_pages'] as $footerurl) {
			$menu_url = strtolower(str_replace(' ','-',$footerurl['page_name']));
			if($get_page == $menu_url) {
				$menu_name = $footerurl['page_name'];
				$footer_menu_found = 1;	
			}
		}
		$alldata['footer_menu_found'] = $footer_menu_found;
		if($footer_menu_found == 1) {
			$alldata['page_data'] = $this->m_process->menu_show($menu_name);
			$this->load->view('innerpage',$alldata);
		} else if(!empty($alldata['fetch_url']) and ($alldata['fetch_url'][0]['status'] == '1') and ($alldata['fetch_url'][0]['admin_status'] == '0') ) {
			$uid = $alldata['fetch_url'][0]['uid'];
			$breed = $alldata['fetch_url'][0]['breed_id'];
			$type = $alldata['fetch_url'][0]['type_id'];
			$alldata['fetch_user'] = $this->m_process->fetch_user($uid);
			$alldata['fetch_breed'] = $this->m_process->fetch_breed($breed);
			$alldata['fetch_type'] = $this->m_process->fetch_type($type);
			$this->m_process->updateview($get_page,$uid);
			
			$buydate = new DateTime($alldata['fetch_url'][0]['payment_date']);  //current date or any date
			$current_date = new DateTime(date('d-m-Y'));   //Future date
			$diff = $current_date->diff($buydate)->format("%a");  //find difference
			$total_day = intval($diff);   //rounding days
			$remain_day = (30 - $total_day);
			
			if($remain_day == '0') {
				redirect(base_url());
			} else {
				$this->load->view('innerpage',$alldata);	
			}
		} else if(($alldata['fetch_url'][0]['status'] == '0') || $alldata['fetch_url'][0]['admin_status'] == '1') {
			redirect(base_url());
		}else {
			redirect(base_url());
		}
	} 
}
