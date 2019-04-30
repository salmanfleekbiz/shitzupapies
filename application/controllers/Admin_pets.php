<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_pets extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model("m_admin_type");
		$this->load->model("m_admin_breed");
	}
	
	public function index() {
		$page_name = $this->router->class;
		if($page_name = 'type'){
			
			$this->load->type;
		
		} else if($page_name = 'breed'){
			
			$this->load->breed;
		
		}
	}
	
	// Pet tyep 
	public function type() {
		
		$fetch['data'] = $this->m_admin_type->fetch_type();
		$fetch['functionname'] = "type";
		$fetch['title'] = 'Pet type Dashboard';
		$fetch['user_name'] = $this->session->userdata('username'); 
		
		if($this->session->userdata('user_id')){
			$this->load->view('admin_pet_list',$fetch);	
		} else {
			redirect(base_url('admin_login'));		
		}
	}
	
	//Pets Breed 
	public function breed() {
		$fetch['data'] = $this->m_admin_breed->fetch_breed();
		$fetch['functionname'] = "breed";
		$fetch['title'] = 'Pet Breed Dashboard';
		$fetch['user_name'] = $this->session->userdata('username'); 
		
		if($this->session->userdata('user_id')){
			$this->load->view('admin_pet_list',$fetch);	
		} else {
			redirect(base_url('admin_login'));		
		}	
	}
	
	//Add Pet type
	public function admin_addpets() {
		$name = $this->input->post("name");
		$this->admin_addtype($name);
	}
	
	
	//Show Add Pet Type / Breed page
	public function admin_addtype($name) {
		$data['title'] = 'Add pet '.$name.' Dashboard';
		$data['functionname'] = $name;
		$data['user_name'] = $this->session->userdata('username');
		$data['data'] = $this->m_admin_type->fetch_type();
		$data['edit'] = "";
		 
		if($this->session->userdata('user_id')){
			$this->load->view('admin_addpets',$data);	
		} else {
			redirect(base_url('admin_login'));		
		}
	}
	
	
	//Delete Pet Type
	public function deletetype($id) {
		$del = $this->m_admin_type->delete($id);
		if($del == 'pass'){
			redirect(base_url("admin_pets/type?success=1"));	
		}
		else {
			redirect(base_url("admin_pets/type?error=1"));	
		}
	}
	
	//Delete Pet Breed
	public function deletebreed($id) {
		$del = $this->m_admin_breed->delete($id);
		if($del == 'pass'){
			redirect(base_url("admin_pets/breed?success=1"));	
		}
		else {
			redirect(base_url("admin_pets/breed?error=1"));	
		}
	}
	
	//Add Pet type
	public function addtype(){
		$pettype = $this->input->post("admin_pettype");	
		$value = $this->m_admin_type->add_type($pettype);
		echo $value;
	}
	
	//Add breed
	public function addbreed(){
		$petbreed = $this->input->post("petbreed");	
		$pettype = $this->input->post("pettype");
		$desc = $this->input->post("desc");
		$value = $this->m_admin_breed->add_breed($pettype,$petbreed,$desc);
		echo $value;
	}
	
	//Edit Pet Type / Breed
	public function admin_editpets() {
		$name = $this->input->post("name");
		$id = $this->input->post("id");
		$desc = $this->input->post("desc");
		$this->admin_edittype($id, $name,$desc);
	}
	
	//Show Edit Pet Type / Breed page
	public function admin_edittype($id,$name,$desc) {
		$data['title'] = 'Edit pet '.$name.' Dashboard';
		$data['user_name'] = $this->session->userdata('username'); 
		$data['edit'] = "edit";
		$data['functionname'] = $name;
		$data['data'] = $this->m_admin_type->fetch_type();
			
		if($name == 'type'){
			$data['data'] = $this->m_admin_type->edit_type($id);
			if($this->session->userdata('user_id')){
				$this->load->view('admin_addpets',$data);	
			} else {
				redirect(base_url('admin_login'));		
			}
		} else if($name == 'breed'){
			$data['datab'] = $this->m_admin_breed->edit_breed($id);
			if($this->session->userdata('user_id')){
				$this->load->view('admin_addpets',$data);	
			} else {
				redirect(base_url('admin_login'));		
			}
		}
	}
	
	//Update Pet type
	public function update_type(){
		$pet_id = $this->input->post("pet_id");	
		$admin_pettype = $this->input->post("admin_pettype");	
		$value = $this->m_admin_type->update_type($pet_id,$admin_pettype);
		echo $value;
	}
	
	
	//Update Pet Breed
	public function update_breed(){
		$petbreedid = $this->input->post("petbreedid");
		$petbreed = $this->input->post("petbreed");	
		$pettype = $this->input->post("pettype");
		$desc = $this->input->post("desc");
		$value = $this->m_admin_breed->update_breed($petbreedid, $pettype,$petbreed,$desc);
		echo $value;
	}

}
