
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
<?php
class insertmodel extends CI_Model {

       
	public function __construct()
	{ 
    $this->load->library('session'); 
		
    }

	function user_list()
	{
	$query = $this->db->get('products');  
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
        $this->load->view('pages/login');
                       
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
    $this->load->view('templates/header3');
    $this->load->view('pages/view', $data);//loading success view
    $this->load->view('templates/footer3');
    }
	 
	function update_admin()
	{
                           
    $n = $_POST['tile'];
    $e = $_POST[''];
    $p = $_POST['pass'];
	$this->db->query("UPDATE admin set name='$n',user_id='$e',password='$p' WHERE user_type='s'");
       
	}
	
	
	
//Asif code start
 
	public function record_count() 
	{
    return $this->db->count_all("products");
	
	
    }

    public function fetch_countries($limit, $start,$a) 
	{
		
	$this->db->order_by("id", "desc");
    $this->db->limit($limit, $start);
	$this->db->where('id', $a);
    $query = $this->db->get("products");
	
	$row = $query->row_array();
	
	
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
	
	public function fetch_countries1($limit, $start) 
	{
		
	$this->db->order_by("id", "desc");
    $this->db->limit($limit, $start);
	
    $query = $this->db->get("products");
	
	$row = $query->row_array();
	
	
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
    $this->db->update('products', $data);
	}
	
	
	function delete_user($i)
	{
    $this->db->query("DELETE FROM products WHERE id='$i'");
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
         $this->db->delete('products');

    endforeach;
	}
	
	
	
	
	function Fetch_Category()
		{
		
		$query = $this->db->get('category');
		return $query; 
	
		}	
	
	
	
	
	
	function product_insert($filename)
	

	{
		
        $filename;                
		$this->db->set('title', $this->input->post('title'));
		$this->db->set('image', $filename);
		$this->db->set('category', $this->input->post('category'));
		$this->db->set('description', $this->input->post('description'));
		$this->db->set('ipaddress', $_SERVER['REMOTE_ADDR']);
		$query=$this->db->insert('products');
		
       
	}
	
	
	function product_update($data_field=array(),$id)
	

	{
		$title=$data_field['title'];
		$image=$data_field['image'];
		$category=$data_field['category'];
		$description=$data_field['description'];
		$this->db->set('title', $title);
		$this->db->set('image', $image);
		$this->db->set('category', $category);
		$this->db->set('description', $description);
		$this->db->where('id', $id);
		$query=$this->db->update('products');
       
	}
	
	
	function get_databyid($id)
	{
		$this->db->where('id', $id);
		$query = $this->db->get('products'); //get all data from user_profiles table that belong to the respective user
		return $query->row(); //return the data
	
	}
	 
 }