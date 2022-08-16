<?php
class Chart_model extends CI_Model {
	
	public $table='score';
	public $primary_key='id';

       
	public function __construct()
	{ 
    $this->load->library('session'); 
		
    }

	function chart_bycountry()
	{ 
		$this->db->select('country,COUNT(country) as val');
		$this->db->group_by('country');
		$this->db->order_by('val');
		$query = $this->db->get('enquires');  
		return $query; 
		
	}
	
	
	
	function chart_byindustry()
		{   
			$this->db->select('industry,COUNT(industry) as val');
			$this->db->group_by('industry');
			$this->db->order_by('val');
			$query = $this->db->get('enquires'); 
			return $query; 

		}
	 
	 
	function chart_bylanguage()
	{ 

	
		$this->db->select('detected_languagecode,COUNT(detected_languagecode) as val');
		$this->db->group_by('detected_languagecode');
		$this->db->order_by('val');
		$query = $this->db->get('enquires');  
		return $query; 
		
	}
	
	function chart_bybusinesstype()
	{ 

		$this->db->select('business_type,COUNT(business_type) as val');
		$this->db->group_by('business_type');
		$this->db->order_by('val');
		$query = $this->db->get('enquires');  
		return $query; 
		
	
	}
	
	
	
	 
	function get_valuebyid($chk,$id,$table)
		{
			$this->db->where($chk, $id);
			$this->db->order_by($chk,"desc");
			$query = $this->db->get($table); //get all data from user_profiles table that belong to the respective user
			return $query->row(); //return the data
		
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