<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_slider extends CI_Controller {
	
	public function __construct() {
        parent::__construct();
		//if($this->session->userdata('userid')){} else {redirect(base_url());}
    }
	public function index()
	{
		$alldata['user_name'] = $this->session->userdata('username'); 
		$this->load->model("m_admin_slider");
		$alldata['slide'] = $this->m_admin_slider->alldata();
		$this->load->view('admin_slider_v',$alldata);
	}
	
	public function addnew(){
		$alldata['user_name'] = $this->session->userdata('username'); 
		$this->load->view('admin_slider_v',$alldata);
	}
	
	public function editslide($id){
		$alldata['user_name'] = $this->session->userdata('username'); 
		$this->load->model("m_admin_slider");
		$alldata['editslidedata'] = $this->m_admin_slider->edit($id);
		$this->load->view('admin_slider_v',$alldata);
	}

	public function insertData(){
		$uploadDir = 'upload/slider/';
		$fileName = $_FILES['sliderimage']['name'];
		$filesize = $_FILES['sliderimage']['size'];
		$tmpName = $_FILES['sliderimage']['tmp_name'];
		$filePath = $uploadDir . $fileName;
		$result = move_uploaded_file($tmpName, $filePath);
		$this->load->model("m_admin_slider");
		$pagesdata = $this->m_admin_slider->insertslide($fileName);
		redirect(base_url('admin_slider'));
	
	}
	
	public function updateData(){
		
		$id = $this->input->post('id');
		
		$uploadDir = 'upload/slider/';
		$fileName = $_FILES['sliderimage']['name'];
		$filesize = $_FILES['sliderimage']['size'];
		$tmpName = $_FILES['sliderimage']['tmp_name'];
		$filePath = $uploadDir . $fileName;
		$result = move_uploaded_file($tmpName, $filePath);
		$this->load->model("m_admin_slider");
		$pagesdata = $this->m_admin_slider->update($id,$fileName);
		redirect(base_url('admin_slider'));
	
	}
	
	public function deletslide($id){
		$this->load->model("m_admin_slider");
		$pagesdata = $this->m_admin_slider->delete($id);
		redirect(base_url('admin_slider'));
	
	}
	
	function logout(){
		$this->session->sess_destroy();
		redirect(base_url());	
	}
	
}
