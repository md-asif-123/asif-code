<?php
class Score_model extends CI_Model {
	
	public $table='score';
	public $primary_key='id';

       
	public function __construct()
	{ 
    $this->load->library('session'); 
		
    }

	function fetch()
	{
		$this->db->where('parent_id!=0');
		$query = $this->db->get($this->table);  
		return $query;   
	}
	 
	 
	function get_scorebyid($id)
	{
		$this->db->where('id', $id);
		$query = $this->db->get('score'); //get all data from user_profiles table that belong to the respective user
		return $query->row(); //return the data
	
	}
	 
	function update($id,$score)
	{
	
		//echo ("UPDATE score SET score=$score WHERE id=$id");
	  $re=$this->db->query("UPDATE score SET score=$score WHERE id=$id");
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