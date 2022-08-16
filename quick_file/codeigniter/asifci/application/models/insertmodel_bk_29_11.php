<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class insertmodel extends CI_Model {
	function add_user()
	

	{
		
        $this->db->set('name', $this->input->post('fname'));
       // $this->db->set('class', $this->input->post('class'));
        $this->db->set('age', $this->input->post('age'));
		$this->db->set('address', $this->input->post('address'));
		
        $this->db->insert('stureg');
		
		$uid=$this->db->insert_id();
		
		$hobby=$this->input->post('hobby');
		
		//$this->db->set('hobby', $hobby);
		//print_r($hobby);exit;
		
		foreach($hobby as $h)
			  {
			     
				 //echo $h;exit;
				
				
				 $this->db->set('hobby', $h);
				 $this->db->set('uid', $uid);
			     $this->db->insert('hobby');
			
			  }
		
       
	}
	function user_validation()
	{
		$u = $_POST['lname'];
        $p = $_POST['pass'];
		$this->db->where('name', $u);
        $this->db->where('age', $p);
        
        $res = $this->db->get('stureg');
		
		if($this->db->affected_rows($res))
	 {
		    $row = $res->row_array();
			$admin_id=$row['name'];
			
			$password=$row['age'];
			$newdata = array(
			'admin_id'  => "$admin_id",
            
            'password'     => "$password");
             $this->session->set_userdata($newdata);
		 //$msgsucess="wellcome to admin page";
		  
                        
	 }
	 else
	 {
		//echo $msgfail="invalid username or password";
		//echo "asif";
         $this->load->view('loginform');
                        
	 }
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
	
	 function view_user($i)
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
	function delete_usercheck($s) 
       {
	
    //$checked_messages = array();
	//print_r($checked_messages);exit;
    foreach ($s as $msg_id):
         $this->db->where('id', $msg_id);
            //$this->db->where('recipient', $this->users->get_user_id()); //verify if recipient id is equal to logged in user id
            $this->db->delete('stureg');

    endforeach;
       }
}