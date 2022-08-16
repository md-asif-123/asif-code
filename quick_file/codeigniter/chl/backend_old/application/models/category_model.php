<?php
class Category_model extends CI_Model {
	
	public $table='category';
	public $primary_key='id';

       
	public function __construct()
	{ 
    $this->load->library('session'); 
		
    }

	function fetch()
	{
		$this->db->where('parent_id=0');
		$query = $this->db->get($this->table);  
		return $query;   
	}
	 
	 
	 
	function insert_category()
	{
	

	$this->db->set('category_name', $this->input->post('category'));
		
		$query=$this->db->insert('category');
	
		return $query;
		
	}

	 
	function get_categorybyid($id)
	{
		$this->db->where('id', $id);
		$query = $this->db->get('category'); //get all data from user_profiles table that belong to the respective user
		return $query->row(); //return the data
	
	}
	 
	function update($id,$score)
	{
	
		//echo ("UPDATE category SET category_name=$score WHERE id=$id"); 
	  $re=$this->db->query("UPDATE category SET category_name='$score' WHERE id=$id");
	  return $re;
	}

	function count_all_cond()
	{
		
		
		$this->db->select('COUNT(*) AS cnt');
		$query = $this->db->get($this->table);
		$arrcnt = $query->result_array();
		return $arrcnt[0]['cnt'];
	}
	 
 }