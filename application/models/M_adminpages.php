<?php
/*
* Created By: Salman Raees
* Developer Email: m.salmanprog@gmail.com
* Created On: Mon - Feb 23, 2016
*/

/*
* Some useful return methods:
* return $query->row_array();
* return $query->result_array();
* echo $last_query = $this->db->last_query();
*/

class M_adminpages extends CI_Model
{
    var $page_name;
    var $page_title;
    var $page_content;
    var $metatitle;
    var $metakeyword;
    var $metadescrip;
    var $page_template;
	
	var $tagline;
    var $price;
	var $pagedescp;
	var $box1title;
	var $box1des;
	var $box2title;
	var $box2des;
	var $box3title;
	var $box3des;
	var $box4title;
	var $box4des;
	var $page_meta_title;
	var $page_meta_keyword;
	var $page_meta_description;
	
	
	static $table = "web_pages";
	static $home_page = "home_page";

    function __construct()
    {
        parent::__construct();
    }
	
	function all_datashow(){
		 $result = $this->db->query("SELECT * FROM `web_pages` order by id DESC");	
		 return $result->result_array();
	}
	
	function homepage_fetch() {
		$result = $this->db->query("SELECT * FROM `home_page` order by id DESC");	
		 return $result->result_array();
	}
	
	function get_by_id($id)
    {
        $query = $this->db->get_where(self::$table, array("id" => $id));
        return $query->row_array();
    }
	
    function insert($page_name, $page_title, $page_content, $metatitle, $metakeyword, $metadescrip, $page_template)
    {
        $this->page_name = $page_name;
        $this->page_title = $page_title;
        $this->page_content = $page_content;
        $this->metatitle = $metatitle;
        $this->metakeyword = $metakeyword;
        $this->metadescrip = $metadescrip;
        $this->page_template = $page_template;
        
		$query = "INSERT INTO `web_pages`(`page_name`, `page_title`, `page_content`, `metatitle`, `metakeyword`, `metadescrip`, `page_template`) VALUES ( ? , ? , ? , ? , ? , ? , ?)";
		$pass = $this->db->query($query, array($page_name, $page_title, $page_content, $metatitle, $metakeyword, $metadescrip, $page_template));
	
    }
	
	function update($pageid,$page_name, $page_title, $page_content, $metatitle, $metakeyword, $metadescrip, $page_template)
    {
        $data = array(
            'page_name' => $page_name,
            'page_title' => $page_title,
            'page_content' => $page_content,
            'metatitle' => $metatitle,
            'metakeyword' => $metakeyword,
            'metadescrip' => $metadescrip,
            'page_template' => $page_template,
        );

        $this->db->where("id", $pageid);
        return $this->db->update(self::$table, $data);
    }
	
	function home_update($tagline ,$sub_tagline , $price , $pagedescp , $box1title , $box1des , $box2title , $box2des , $box3title , $box3des , $box4title , $box4des , $page_meta_title , $page_meta_keyword , $page_meta_description) {
			
			$data = array(
            'tagline' => $tagline,
			'sub_tagline' => $sub_tagline,
            'price' => $price,
            'pagedescp' => $pagedescp,
            'box1title' => $box1title,
            'box1des' => $box1des,
            'box2title' => $box2title,
            'box2des' => $box2des,
			'box3title' => $box3title,
            'box3des' => $box3des,
            'box4title' => $box4title,
            'box4des' => $box4des,
			'page_meta_title' => $page_meta_title,
            'page_meta_keyword' => $page_meta_keyword,
            'page_meta_description' => $page_meta_description,
        );

        $this->db->where("id", '1');
        return $this->db->update(self::$home_page, $data);
	}
	
	function delete($id)
    {
        $this->db->where("id", $id);
        return $this->db->delete(self::$table);
    }
}

?>