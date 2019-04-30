<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	
	public function __construct() {
        parent::__construct();
		$this->load->model("m_process");
		$this->load->model("m_admin_breed");
		$this->load->model("m_admin_type");
		$this->load->model("m_frontend");
		$this->load->model("M_adminpages");
		if($this->session->userdata('userid')){} else {redirect(base_url());}
    }
	public function index()
	{
		$userid = $this->session->userdata('userid');
		$alldata['fetch_dashboard'] = $this->m_process->fetch_dashboard($userid);
		$alldata['footer_pages'] = $this->m_process->menu_fetch();
		$this->m_process->remain_date_update();
		//$alldata['fetch_breed'] = $this->m_admin_breed->fetch_breed();
		$this->load->view('dashboard',$alldata);
	}
	
	function logout(){
		$this->session->sess_destroy();
		redirect(base_url());	
	}
	
	function delete($pageid) {
		$userid = $this->session->userdata('userid');
		$result = $this->m_process->delete($pageid,$userid);
		if($result == 'payoutfirst') {
			redirect(base_url('dashboard')."?payment=1");	
		} else if($result == '0') {
			redirect(base_url('dashboard')."?unpublish=0");		
		} else if($result == '1') {
			redirect(base_url('dashboard')."?publish=1");		
		} else {
			redirect(base_url('dashboard'));
		}
	}
	
	function page() {
		$userid = $this->session->userdata('userid');
		$get_page = $this->uri->segment(3);
		$alldata['fetch_type'] = $this->m_admin_type->fetch_type();
		$alldata['fetch_breed'] = $this->m_admin_breed->fetch_breed();
		$alldata['footer_pages'] = $this->m_process->menu_fetch();
		$alldata['home_page'] = $this->M_adminpages->homepage_fetch();
		$alldata['userdata'] = $this->m_process->fetch_user($userid);
		if($get_page == 'add'){
			$this->load->view('page',$alldata);	
		} else if($get_page == 'edit'){
			$id = $this->uri->segment(4);
			$alldata['edit_page'] = $this->m_process->editpage($id,$userid);
			$typeid = $alldata['edit_page'][0]['type_id'];
			$alldata['fetch_cat_breed'] = $this->m_process->fetch_cat_breed($typeid);
			//print_r($alldata['fetch_cat_breed']);
			$this->load->view('page',$alldata);	
		}  else if($get_page == 'renewpage'){
			$id = $this->uri->segment(4);
			$alldata['edit_page'] = $this->m_process->editpage($id,$userid);
			$typeid = $alldata['edit_page'][0]['type_id'];
			$alldata['fetch_cat_breed'] = $this->m_process->fetch_cat_breed($typeid);
			
			//print_r($alldata['edit_page']);
			
			//print_r($alldata['fetch_cat_breed']);
			$this->load->view('page',$alldata);	
		} 
		else {
			redirect(base_url('dashboard'));	
		}
	}
	
	function createnewpage() {
		$pagename = str_replace(" ","-",$this->input->post('pagename'));
		$pageurl = str_replace(" ","-",$this->input->post('pageurl'));
		$petstype = str_replace(" ","-",$this->input->post('petstype'));
		
		$tel = str_replace(" ","-",$this->input->post('tel'));
		$email = str_replace(" ","-",$this->input->post('email'));
		$sociallink = str_replace(" ","-",$this->input->post('sociallink'));
		
		$breed = str_replace(" ","-",$this->input->post('breed'));
		$url = str_replace(" ","-",$this->input->post('url'));
		$sex = str_replace(" ","-",$this->input->post('sex'));
		$age = str_replace(" ","-",$this->input->post('age'));
		$ref = str_replace(" ","-",$this->input->post('ref'));
		$keynotes = str_replace(" ","-",$this->input->post('keynotes'));
		$desc = str_replace(" ","-",$this->input->post('desc'));
		$userid = $this->session->userdata('userid');
		$filetype = '0';
		$filesize = '0';
		$uploadDir = 'upload/';
		
		//$ImgUpdateName = array();
		foreach($_FILES['banner']['name'] as $key=>$val){
			$imageFileType = pathinfo($_FILES['banner']['name'][$key],PATHINFO_EXTENSION);
			$imagesize = getimagesize($_FILES['banner']['tmp_name'][$key]);
			$width  = $imagesize[0];
			$height = $imagesize[1];
			
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
				$filetype = '1';
				break;
			} /*else if($width != '1150' && $height != '360'){
				$filesize = '1';
				break;	
			}*/ else {
				$fileName = explode(".", $val);
				$filesize = $_FILES['banner']['size'][$key];
				$tmpName = $_FILES['banner']['tmp_name'][$key];
				$ImgUpdateName[] = round(microtime(true)).rand(5, 200).'.' . end($fileName);  //File Rename and concatinate with current time
				$filePath = $uploadDir . $ImgUpdateName[$key];
				$result = move_uploaded_file($tmpName, $filePath);	
			}
			/*$fileName = explode(".", $val);
			$filesize = $_FILES['banner']['size'][$key];
			$tmpName = $_FILES['banner']['tmp_name'][$key];
			$ImgUpdateName[] = round(microtime(true)).rand(5, 200).'.' . end($fileName);  //File Rename and concatinate with current time
			$filePath = $uploadDir . $ImgUpdateName[$key];
			$result = move_uploaded_file($tmpName, $filePath);*/
		}
		if($filetype == '1') {
			echo "filetypeerror";	
		} else if($filesize == '1') {
			echo "filesizeerror";	
		} else {
			$bannername = implode(",",$ImgUpdateName);
			$this->m_frontend->newpage($userid,$tel,$email,$sociallink,$pagename,$pageurl,$petstype,$breed,$bannername,$url,$sex,$age,$ref,$keynotes,$desc);
		}
	}	
	
	
	
	function editnewpage() {
		$url = str_replace(" ","-",$this->input->post('url'));
		$sex = str_replace(" ","-",$this->input->post('sex'));
		$age = str_replace(" ","-",$this->input->post('age'));
		$ref = str_replace(" ","-",$this->input->post('ref'));
		
		$tel = str_replace(" ","-",$this->input->post('tel'));
		$email = str_replace(" ","-",$this->input->post('email'));
		$sociallink = str_replace(" ","-",$this->input->post('sociallink'));
		
		$keynotes = str_replace(" ","-",$this->input->post('keynotes'));
		$desc = str_replace(" ","-",$this->input->post('desc'));
		$userid = $this->session->userdata('userid');
		$pageid = str_replace(" ","-",$this->input->post('pageid'));
		$updatebanner = $this->input->post('oldbanner');
		$allimagesarray = $this->input->post('allimagesarray');
		$allimagesarray = explode(',',$allimagesarray);
		$new_allimagesarray = array();
		
		
		
		
		$filetype = '0';
		$filesize = '0';
		
		if(!empty($_FILES['banner']['name'])) {
		$uploadDir = 'upload/';
		foreach($_FILES['banner']['name'] as $key => $val){
			
			$imageFileType = pathinfo($_FILES['banner']['name'][$key],PATHINFO_EXTENSION);
			$imagesize = getimagesize($_FILES['banner']['tmp_name'][$key]);
			$width  = $imagesize[0];
			$height = $imagesize[1];
			
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
				$filetype = '1';
				break;
			} /*else if($width != '1150' && $height != '360'){
				$filesize = '1';
				break;	
			} */else {
				$fileName = explode(".", $val);
				$filesize = $_FILES['banner']['size'][$key];
				$tmpName = $_FILES['banner']['tmp_name'][$key];
				$ImgUpdateName = round(microtime(true)).rand(5, 200).'.' . end($fileName);  //File Rename and concatinate with current time
				$filePath = $uploadDir . $ImgUpdateName;
				$result = move_uploaded_file($tmpName, $filePath);
				
				$replacements = array($key => $ImgUpdateName);
				$allimagesarray = array_replace($allimagesarray,$replacements);	
			}
			
		}
			$bannername = implode(",",$allimagesarray);
		} else {
			$bannername = '';	
		}
		if($filetype == '1') {
			echo "filetypeerror";	
		} else if($filesize == '1') {
			echo "filesizeerror";	
		} else {
			$this->m_frontend->updatepage($pageid,$userid,$tel,$email,$sociallink,$bannername,$url,$sex,$age,$ref,$keynotes,$desc);
		}
		
		/*if(!empty($_FILES['banner']['name'])) {
		$uploadDir = 'upload/';
		foreach($_FILES['banner']['name'] as $key => $val){
			
			$fileName = explode(".", $val);
			$filesize = $_FILES['banner']['size'][$key];
			$tmpName = $_FILES['banner']['tmp_name'][$key];
			$ImgUpdateName = round(microtime(true)).rand(5, 200).'.' . end($fileName);  //File Rename and concatinate with current time
			$filePath = $uploadDir . $ImgUpdateName;
			$result = move_uploaded_file($tmpName, $filePath);
			
			$replacements = array($key => $ImgUpdateName);
			$allimagesarray = array_replace($allimagesarray,$replacements);
		}
			$bannername = implode(",",$allimagesarray);
		} else {
			$bannername = '';	
		}
			$this->m_frontend->updatepage($pageid,$userid,$bannername,$url,$sex,$age,$ref,$keynotes,$desc);*/
	}	
	
	//Thanks Page 
	public function paymentcomplete() {
		$userid = $this->session->userdata('userid');
		$url = $_GET['url'];
		$this->m_frontend->editpaymentcomplate($url,$userid);
		redirect(base_url('dashboard'));
		//$this->load->view('usersignup',$alldata);		
	}
	
	//Renew Page 
	public function renewpayment() {
		$pageid = $_GET['pageid'];
		$remaindate = $_GET['remaindate'];
		$this->m_frontend->renewpayment($pageid,$remaindate);
		redirect(base_url('dashboard'));
		//$this->load->view('usersignup',$alldata);		
	}
	
	// Delete Keynotes
	public function deletekeynotes() {
		$keynotedelete = str_replace(" ","-",$this->input->post('keynotedelete'));
		$keynotevalue = str_replace(" ","-",$this->input->post('keynotevalue'));
		$pageid = str_replace(" ","-",$this->input->post('pageid'));
		$this->m_frontend->deletekeynotes($keynotedelete,$pageid,$keynotevalue);
	}
	
	// Delete Url
	public function deleteurl() {
		$deleteurl = $this->input->post('deleteurl');
		$pageid = $this->input->post('pageid');
		$urlvalue = $this->input->post('urlvalue');
		$sexvalue = $this->input->post('sexvalue');
		$agevalue = $this->input->post('agevalue');
		$refvalue = $this->input->post('refvalue');
		$this->m_frontend->deleteurl($deleteurl,$pageid,$urlvalue,$sexvalue,$agevalue,$refvalue);
	}
	
	// Delete Image
	public function deleteimage() {
		$deleteimage = $this->input->post('deleteimage');
		$imagename = $this->input->post('imagename');
		$pageid = $this->input->post('pageid');
		$this->m_frontend->deleteimage($deleteimage,$imagename,$pageid);
	}
	
	public function viewvideo($vId) {
		$userid = $this->session->userdata('userid');
		$video['fetch_dashboard'] = $this->m_process->fetch_dashboard($userid);
		$video['footer_pages'] = $this->m_process->menu_fetch();
		$this->m_process->remain_date_update();
		$video['vid'] = $vId;
		$this->load->view('viewvideo',$video);
	}
	
}
