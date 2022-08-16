<?php
class insertmodel extends CI_Model {

       
	public function __construct()
	{ 
    $this->load->library('session'); 
		
    }

	function user_list()
	{
	$query = $this->db->get('enquires');  
	return $query;   
	}
	 
	 
	function password_check()
	{
	$u = $_POST['username'];
	$p = $_POST['password'];
	$res=$this->db->query("SELECT * FROM admin WHERE user_id='$u' AND password='$p'");
		
		if($this->db->affected_rows($res))
		{
					
			$row = $res->row_array();
			$admin_id=$row['admin_id'];
			$user_id=$row['user_id'];
			$password=$row['password'];
			$newdata = array(
			'admin_id'  => "$admin_id",
            'user_id'     => "$user_id",
            'password'     => "$password");
             $this->session->set_userdata($newdata);
				
		}
				
		else
		{
		echo $msgfail="invalid username or password";
        $this->load->view('login');
                       
		}
		 
	}
	 
	public function valid_allowed()//check user is login or not
    {
    $session = $this->session->userdata('user_id'); //here you can take loginid, email whatever you store in session
        
		if(!$session)
        {
            redirect('login');
        }
    }
	
	public function dashboard() 
	{
                         
	$this->load->helper(array('form', 'url'));
	$this->load->model('insertmodel');
    $this->load->view('header3');
    $this->load->view('view', $data);//loading success view
    $this->load->view('footer3');
    }
	
	function getgeomap()
    {
    $result=$this->db->query("SELECT * FROM country");

		foreach($result as $r) 
		{
		$temp = array();

		// the following line will be used to slice the Pie chart

		$temp[] = array('v' => (string) $r['name']); 

		// Values of each slice
	
		$temp[] = array('v' => (int) $r['val']); 
        $rows[] = array('c' => $temp);
        }

    $table['rows'] = $rows;
	// convert data into JSON format
    $jsonTable = json_encode($table);
    //echo $jsonTable;
   
    }
	 
	function update_admin()
	{
                           
    $n = $_POST['name'];
    $e = $_POST['email'];
    $p = $_POST['pass'];
	$this->db->query("UPDATE admin set name='$n',user_id='$e',password='$p' WHERE user_type='s'");
       
	}
	 
	
//Asif code start
 
	public function record_count() 
	{
    return $this->db->count_all("enquires");
	
	
    }

    public function fetch_countries($limit, $start) 
	{
	$this->db->order_by("id", "desc");
    $this->db->limit($limit, $start);
    $query = $this->db->get("enquires");
	
	$row = $query->row_array();
	$row['detected_languagecode'];
	
	if($row['detected_languagecode']==''){
		
		//echo "hello";exit;
		
		
		
	}


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
   
   
    function edit_user($i)
	{
    $data = array(
    'name' => $this->input->post('name'),
    'tele_phone' => $this->input->post('phone'),
	'email' => $this->input->post('email'),
	'company_name' => $this->input->post('companyname'),
	'industry' => $this->input->post('categories'),
	'manual_languagecode'=>$this->input->post('manual_languagecode'),
	'comments' => $this->input->post('comments'));
    $this->db->where('id', $i);
    $this->db->update('enquires', $data);
	}
	
	
	function delete_user($i)
	{
    $this->db->query("DELETE FROM enquires WHERE id='$i'");
	}
	 
	function userlist_db()
	{
    $this->db->where('user_type !=', 's');
    $query = $this->db->get('admin');
    return $query;
	}
	  
	function delete_usercheck($checked_messages){ 
	
    //$checked_messages = array();
	//print_r($checked_messages);exit;
    foreach ($checked_messages as $msg_id):
         $this->db->where('id', $msg_id);
         //$this->db->where('recipient', $this->users->get_user_id()); //verify if recipient id is equal to logged in user id
         $this->db->delete('enquires');

    endforeach;
	}
	 
 }