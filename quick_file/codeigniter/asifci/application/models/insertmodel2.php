<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class insertmodel2 extends CI_Controller {
	function add_user()
	

	{
		
        $this->db->set('name', $this->input->post('fname'));
       // $this->db->set('class', $this->input->post('class'));
        $this->db->set('age', $this->input->post('age'));
		$this->db->set('address', $this->input->post('address'));
		
        $this->db->insert('stureg');
		echo "user added";
		
       
	}
	function user_list()
	{
		$query=$this->db->get('stureg');
		return $query;
		
	}
	function user_list1($a)
	{
		
    
	$this->db->like('name', $a, 'after');
	 //$this->db->where('id', $a);
    $query = $this->db->get("stureg");
	if ($query->num_rows() > 0) 
		{
    
            return $query;
        }
		
		else
		{
			$this->load->view("nodata");
			
		}
        return false;
	
	
	}
	 function edit_user($i)
	{
          $this->db->where('id', $i);
         
         $query=$this->db->get('stureg');
	return $query;
	}
	 function update_user($i)
	{
         
		
		$this->db->set('name', $this->input->post('fname'));
		$this->db->set('age', $this->input->post('age'));
		$this->db->set('address', $this->input->post('address'));
		
		$this->db->where('id', $i);
		$query=$this->db->update('stureg');
		return $query;
	}
	function delete_user($i)
	{
    $this->db->query("DELETE FROM stureg WHERE id='$i'");
	}
}