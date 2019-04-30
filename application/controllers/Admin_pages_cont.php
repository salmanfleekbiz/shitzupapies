<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_pages_cont extends CI_Controller {
	
	public function __construct() {
        parent::__construct();
    }
	
	public function index()
	{
		$alldata = array();
		$this->load->model("M_adminpages");
		$alldata['user_name'] = $this->session->userdata('username'); 
		$alldata['showall'] = $this->M_adminpages->all_datashow();
		$this->load->view('adminpages', $alldata);
	}
	
	public function addnew(){
		$pagedata['user_name'] = $this->session->userdata('username'); 
		$this->load->view('adminpages',$pagedata);
	}
	
	public function pageview($id){
		$pageId = $id;
		$pagedata = array();
		$pagedata['user_name'] = $this->session->userdata('username'); 
		$this->load->model("M_adminpages");
		$pagedata['datapage'] = $this->M_adminpages->get_by_id($pageId);
		$this->load->view('adminpages', $pagedata);
	}
	
	public function create_newpage(){
		$pagename = $this->input->post('pagename');
		$pagedescp = $this->input->post('pagedescp');
		$page_meta_title = $this->input->post('page_meta_title');
		$page_meta_keyword = $this->input->post('page_meta_keyword');
		$page_meta_description = $this->input->post('page_meta_description');
		
		$this->load->model("M_adminpages");
        $create = $this->M_adminpages->insert($pagename,$pagename,$pagedescp,$page_meta_title,$page_meta_keyword,$page_meta_description,'simple');
		redirect(base_url('admin_pages_cont'));
	}
	
	public function updatepage(){
		$pageid = $this->input->post('pageid');
		$pagename = $this->input->post('pagename');
		$pagedescp = $this->input->post('pagedescp');
		$page_meta_title = $this->input->post('page_meta_title');
		$page_meta_keyword = $this->input->post('page_meta_keyword');
		$page_meta_description = $this->input->post('page_meta_description');
		
		$this->load->model("M_adminpages");
        $create = $this->M_adminpages->update($pageid,$pagename,$pagename,$pagedescp,$page_meta_title,$page_meta_keyword,$page_meta_description,'simple');
		redirect(base_url('admin_pages_cont/pageview/'.$pageid));
	}
	
	public function deletepage($id){
		$pageId = $id;
		$this->load->model("M_adminpages");
		$this->M_adminpages->delete($pageId);
		redirect(base_url('admin_pages_cont'));
	}
	
	public function homepage()
	{
		$alldata = array();
		$this->load->model("M_adminpages");
		$alldata['user_name'] = $this->session->userdata('username'); 
		$alldata['showall'] = $this->M_adminpages->all_datashow();
		$alldata['home_page'] = $this->M_adminpages->homepage_fetch();
		$this->load->view('adminpages', $alldata);
	}
	
	public function contactus()
	{
		$alldata = array();
		$this->load->model("M_adminpages");
		$alldata['user_name'] = $this->session->userdata('username'); 
		$alldata['showall'] = $this->M_adminpages->all_datashow();
		$this->load->view('adminpages', $alldata);
	}
	
	public function homepage_update() {
		$tagline = htmlentities($this->input->post('tagline'),ENT_QUOTES);
		$sub_tagline = htmlentities($this->input->post('sub_tagline'),ENT_QUOTES);
		$price = htmlentities($this->input->post('price'),ENT_QUOTES);
		$pagedescp = htmlentities($this->input->post('pagedescp'),ENT_QUOTES);
		
		$box1title = htmlentities($this->input->post('box1title'),ENT_QUOTES);
		$box1des = htmlentities($this->input->post('box1des'),ENT_QUOTES);
		
		$box2title = htmlentities($this->input->post('box2title'),ENT_QUOTES);
		$box2des = htmlentities($this->input->post('box2des'),ENT_QUOTES);
		
		$box3title = htmlentities($this->input->post('box3title'),ENT_QUOTES);
		$box3des = htmlentities($this->input->post('box3des'),ENT_QUOTES);
		
		$box4title = htmlentities($this->input->post('box4title'),ENT_QUOTES);
		$box4des = htmlentities($this->input->post('box4des'),ENT_QUOTES);
		
		$page_meta_title = htmlentities($this->input->post('page_meta_title'),ENT_QUOTES);
		$page_meta_keyword = htmlentities($this->input->post('page_meta_keyword'),ENT_QUOTES);
		$page_meta_description = htmlentities($this->input->post('page_meta_description'),ENT_QUOTES);
		
		$this->load->model("M_adminpages");
        $create = $this->M_adminpages->home_update($tagline ,$sub_tagline , $price , $pagedescp , $box1title , $box1des , $box2title , $box2des , $box3title , $box3des , $box4title , $box4des , $page_meta_title , $page_meta_keyword , $page_meta_description);
		redirect(base_url('admin_pages_cont/homepage'));	
	}
}