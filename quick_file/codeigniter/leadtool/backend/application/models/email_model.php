<?php
class email_model extends CI_Model {
	
	public $table='email_account';
	public $primary_key='id';

       
	public function __construct()
	{ 
    $this->load->library('session'); 
		
    }

	public function record_count() 
	{
    return $this->db->count_all("email_account");
	
	
    }
	
	public function fetch_emails($limit, $start) 
	{
	$this->db->order_by("id", "desc");
    $this->db->limit($limit, $start);
    $query = $this->db->get("email_account");
	
	
    if ($query->num_rows() > 0) 
		{
    foreach ($query->result() as $row) 
			{
			$data[] = $row;
			}
            return $data;
        }
        return false;
    }
	
	function fetch()
	{
		
     $query = $this->db->get($this->table);
	 
	
         return $query;
	
	}
	
	 function add_email()
     {
    $data = array(
        
        'email' => $this->input->post('email'),
		'email_password' => $this->input->post('email_password'),
		'smtp' => $this->input->post('smtp'),
		'smtp_port' => $this->input->post('smtp_port'),
		'pop' => $this->input->post('pop'),
		'pop_port' => $this->input->post('pop_port'),
		'imap' => $this->input->post('imap'),
		'imap_port' => $this->input->post('imap_port'),
		'value' => $this->input->post('value'),
		
		'status' => $this->input->post('work')
		
		
        
);
	
     $this->db->insert('email_account', $data);
       echo "data inserted";
	 }
	
	 function email_list()
     {
     
     $query = $this->db->get('email_account');
	 
         return $query;
	  
		  
	 }
	 
	 
	 function delete_email($i)
     {
		 
      $this->db->where('id', $i);
     $this->db->delete('email_account');
         
	 }
	 
	 function edit_email($i)
     {
    
        
        $data = array(
        
        'email' => $this->input->post('email'),
		'email_password' => $this->input->post('email_password'),
		'smtp' => $this->input->post('smtp'),
		'smtp_port' => $this->input->post('smtp_port'),
		'pop' => $this->input->post('pop'),
		'pop_port' => $this->input->post('pop_port'),
		'imap' => $this->input->post('imap'),
		'imap_port' => $this->input->post('imap_port'),
		'value' => $this->input->post('value'),
		
		'status' => $this->input->post('work')
		
		
        
     );

       $this->db->where('id', $i);
       $this->db->update('email_account', $data);
	 }
	
	 
 }