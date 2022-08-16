
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class index extends CI_Controller {

  function __construct() {
       
	parent::__construct();

    // Load url helper
    $this->load->helper('url');
	$this->load->library('session');
	$this->load->library("pagination");
	$this->load->model('insertmodel');
	}
	public function index()
	{
	$this->load->helper(array('form', 'url'));
    $this->load->library('form_validation');
    $this->form_validation->set_rules('username', 'Username', 'required');
    $this->form_validation->set_rules('password', 'Password', 'required');
       
    if ($this->form_validation->run() == FALSE) 
        {
		  
          $this->load->view('pages/login');
        }
				
    else
        {      
			 
		$this->insertmodel->password_check();	
		if($_SESSION['user_id']&&$_SESSION['password'])
		{	
			redirect('index/dashboard');
			}
		
		          
        }
			
	}
    
		

	public function dashboard() 
	{
	if($_SESSION['user_id']){
	$this->load->helper(array('form', 'url'));
	$this->load->model('insertmodel');
	$this->load->view('templates/header3');
    $this->load->view('pages/front');
    $this->load->view('templates/footer3');
		
	}

		else{
		redirect('index');	
		}
    
    }
	
	// view profile

	
	

	public function user_list() 
	{
	$this->load->library('pagination');
	$this->load->model('insertmodel');
    $data['h']=$this->insertmodel->user_list();  
    //return the data in view  
    $this->load->view('templates/header3');
    $this->load->view('pages/list', $data);//loading success view
    $this->load->view('templates/footer3');
                        
    }
	

	// code for myaccount


	public function validatepass() {
    $this->load->helper(array('form', 'url'));
    $this->load->library('form_validation');
    $this->form_validation->set_rules('username', 'Username', 'required');
    $this->form_validation->set_rules('password', 'Password', 'required');
                
                if ($this->form_validation->run() == FALSE)
				{
                
                    $this->load->view('pages/login');
                }
                else
                {		
                    $this->load->model('insertmodel');
                    $this->insertmodel->pass();
                    $this->load->view('templates/header3');
                    $this->load->view('pages/front');
                    $this->load->view('templates/footer3');
                }
        }
		
				
				
	public function edit_myaccount() 
	{
    $this->load->helper(array('form', 'url'));
    $this->load->library('form_validation');
    $this->form_validation->set_rules('name', 'Username', 'required');
    $this->form_validation->set_rules('email', 'Email', 'required');
	$this->form_validation->set_rules('pass', 'Password', 'required');
		
	if(!$_SESSION['user_id'])
	{
		redirect('');
		}
	if ($this->form_validation->run() == FALSE)
                {
					  
				$data['h']=$this->db->query("SELECT * FROM admin WHERE user_type='s'");
				$this->load->view('templates/header3');
                $this->load->view('pages/myaccount',$data);
                $this->load->view('templates/footer3');
                }
                else
                {
                $this->load->model('insertmodel');
				$this->insertmodel->update_admin();
                $data['h']=$this->db->query("SELECT * FROM admin WHERE user_type='s'");
				$this->load->view('templates/header3');
				$data['failmessage']="Your data has been succesfully updated...";
                $this->load->view('pages/myaccount',$data);  
                $this->load->view('templates/footer3');						
                    
                }
	}

	// admin user list

	public function admin_list() 
	{
    $this->load->model('insertmodel');
    $data['h']=$this->insertmodel->userlist_db();  
    //return the data in view  
    $this->load->view('templates/header3');
    $this->load->view('pages/user_list', $data);//loading success view
    $this->load->view('templates/footer3');
                        
    }
				
	//Pagination
				
	public function pagination() 
	{
    $this->load->library('pagination');
	$config['base_url'] = 'http://example.com/index.php/test/page/';
	$config['total_rows'] = 200;
	$config['per_page'] = 20;
	$this->pagination->initialize($config);
	$this->pagination->create_links();
    $this->load->view('templates/header3');
    $this->load->view('pages/list', $data);//loading success view
    $this->load->view('templates/footer3');
	}
				
				
	// Logout
		
	function logout()
	{
	$_SESSION['user_id'];
	$newdata = array(
                   'admin_id'  => '',
                   'user_id'     => "$user_id",
                   'password'     => "$password",
               );

	$this->session->set_userdata($newdata);
	//print_r($newdata);
	$aa = $this->session->unset_userdata(array('admin_id'=>'', 'user_id'=>'', 'password'=>''));
	$this->session->set_flashdata('sess_message', '<span style="background-color:#FF0000">You have successfully logout !!!</span>');
	$this->session->sess_destroy();
	redirect('');
	}
	
	public function show_message() 
	{
		
		$key = $this->input->post('key');
		echo $key;
	}
	public function product_list() {
		
	if($_SESSION['user_id'])
		{	
                
    $this->load->model('insertmodel');
    $config = array();
    $config["base_url"] = base_url() . "index/product_list";
    $config["total_rows"] = $this->insertmodel->record_count();
	$data["total_rows"] = $this->insertmodel->record_count();
	$config["per_page"] = 10;
    $config["uri_segment"] = 3;
	$this->pagination->initialize($config);
	$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
	$a = $this->input->post('key');
	if($a)
	{
		
    $data["results"] = $this->insertmodel->fetch_countries($config["per_page"], $page,$a);
	
	$data["links"] = $this->pagination->create_links();
    
    $this->load->view("pages/listadmin", $data);
     
		
	
		}
		elseif($a=='')
			
		{
			echo "asifiqbal";
			$data["results"] = $this->insertmodel->fetch_countries1($config["per_page"], $page);
	
	$data["links"] = $this->pagination->create_links();
    $this->load->view('templates/header3');
    $this->load->view("pages/listadmin", $data);
    $this->load->view('templates/footer3');  
		}
		else
		{
			echo"bye";
		}
		}
		else{
			
			redirect('index');
		}
	
    }
				
		public function product_list1() {
		
	if($_SESSION['user_id'])
		{	
                
    $this->load->model('insertmodel');
    $config = array();
    $config["base_url"] = base_url() . "index/product_list";
    $config["total_rows"] = $this->insertmodel->record_count();
	$data["total_rows"] = $this->insertmodel->record_count();
	$config["per_page"] = 10;
    $config["uri_segment"] = 3;
	$this->pagination->initialize($config);
	$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
	$a = $this->input->post('key');
	if($a)
	{
		
    $data["results"] = $this->insertmodel->fetch_countries($config["per_page"], $page,$a);
	
	$data["links"] = $this->pagination->create_links();
    
    $this->load->view("pages/listadmin", $data);
     
		
	
		}
		else
			
		{
			echo "bye1";
			
		}
		
		}
		else{
			
			redirect('index');
		}
	
    }		
	public function validateform3() 
	{
                
    $this->load->model('insertmodel');
    $config = array();
    $config["base_url"] = base_url() . "index.php/index2/validateform3";
    $config["total_rows"] = $this->insertmodel->record_count();
    $config["per_page"] = 5;
    $config["uri_segment"] = 3;
	$this->pagination->initialize($config);
	$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
    $data["results"] = $this->insertmodel->
    fetch_countries($config["per_page"], $page);
    $data["links"] = $this->pagination->create_links();
    $this->load->view('templates/header4');
    $this->load->view("pages/list", $data);
    $this->load->view('templates/footer3'); 
    }
		
	public function edit_user() 
	{
    $this->load->helper(array('form', 'url'));
    $this->load->library('form_validation');
    $this->form_validation->set_rules('name', 'Username', 'required');
    $this->form_validation->set_rules('phone', 'Phone', 'required');
    $this->form_validation->set_rules('email', 'Email', 'required');
	$this->form_validation->set_rules('companyname', 'companyname', 'required');
    $this->form_validation->set_rules('categories', 'product', 'required');
    $this->form_validation->set_rules('comments', 'comments', 'required');
				
			if ($this->form_validation->run() == FALSE)
                {
					$id1=$this->uri->segment(3);
					$data['h']=$this->db->query("SELECT * FROM enquires WHERE id='$id1'");
					
					$data['l']=$this->db->query("SELECT * FROM languages");
					$this->load->view('templates/header3');
                    $this->load->view('pages/contact',$data);
                    $this->load->view('templates/footer3');
                        
                }
                else
                {	
					
					$this->load->model('insertmodel');
					
					$id1=$this->uri->segment(3);
					$this->insertmodel->edit_user($id1);
					$data['h']=$this->db->query("SELECT * FROM enquires WHERE id=$id1");
					$data['l']=$this->db->query("SELECT * FROM languages");
					$this->load->view('templates/header3');
					$this->session->set_flashdata('success_msg', 'You have successfully updated...');
					$this->load->view('pages/contact',$data);  
                    $this->load->view('templates/footer3');	
                }
	}
	
	public function delete_user() 
	{
    $id = $this->input->get('id', TRUE);
	$this->load->model('insertmodel');
	$this->insertmodel->delete_user($id);
    $config = array();
    $config["base_url"] = base_url() . "index/validateform2";
    $config["total_rows"] = $this->insertmodel->record_count();
    $config["per_page"] = 10;
    $config["uri_segment"] = 3;
    $this->pagination->initialize($config);
    $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
    $data["results"] = $this->insertmodel->
    fetch_countries($config["per_page"], $page);
    $data["links"] = $this->pagination->create_links();
    $this->load->view('templates/header3');
	//echo $msgfail="data deleted";
	$this->session->set_flashdata('successs_msg', 'You have successfully deleted...');
    $this->load->view("pages/listadmin", $data);
    $this->load->view('templates/footer3');
	redirect('index/product_list');	
    }
			  
	function delete_usercheck()
	{ 
    $this->load->helper(array('form', 'url'));
	$this->load->model('insertmodel');
    $checked_messages = $this->input->post('list'); //selected messages
	//print_r($checked_messages);exit;
    $this->insertmodel->delete_usercheck($checked_messages);
    $config = array();
    $config["base_url"] = base_url() . "index/product_list";
    $config["total_rows"] = $this->insertmodel->record_count();
    $config["per_page"] = 10;
    $config["uri_segment"] = 3;
    $this->pagination->initialize($config);

    $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
    $data["results"] = $this->insertmodel->
    fetch_countries($config["per_page"], $page);
    $data["links"] = $this->pagination->create_links();
	
    $this->load->view('templates/header3');
	echo $msgfail="data deleted";
	$this->session->set_flashdata('successs_msg', 'You have successfully deleted...');
    $this->load->view("pages/listadmin", $data);
    $this->load->view('templates/footer3'); 
	redirect('index/product_list');

	}
	
	
	
// Start coding for product	
	
	
	public function add_product() 
	{
    $this->load->helper(array('form', 'url'));
    $this->load->library('form_validation');
    $this->form_validation->set_rules('title', 'Title', 'required');
	
	$this->form_validation->set_rules('description', 'Description', 'required');
   
		
	if(!$_SESSION['user_id'])
	{
		redirect('');
		}
	if ($this->form_validation->run() == FALSE)
                {
					
				$data['category'] = $this->insertmodel->Fetch_Category();	  
				
				$this->load->view('templates/header3');
                $this->load->view('pages/add_product',$data);
                $this->load->view('templates/footer3');
                }
                else
                {
				
					$config['upload_path']   = './uploads/'; 
					$config['allowed_types'] = 'gif|jpg|png'; 
					$config['max_size']      = 1500; 
					$config['max_width']     = 2000; 
					$config['max_height']    = 768;  
					$this->load->library('upload', $config);
					if ($this->upload->do_upload('userfile')) 
					{
					$data = array('upload_data' => $this->upload->data()); 
					$file_name=$data['upload_data']['file_name'];
					$this->load->model('insertmodel');
                    $this->insertmodel->product_insert($file_name); 
					$data['category'] = $this->insertmodel->Fetch_Category();
					$this->session->set_flashdata('success_msg', 'You have successfully product inserted...');
					$this->load->view('templates/header3');
					$this->load->view('pages/add_product',$data);  
                    $this->load->view('templates/footer3');
					} 
						
					else
					{
					$data['category'] = $this->insertmodel->Fetch_Category();	
					$this->session->set_flashdata('success_msg', 'You have Not image file selected...');
					$this->load->view('templates/header3');
					$this->load->view('pages/add_product',$data);  
					$this->load->view('templates/footer3');
					}
				 }
	}
	
	
	public function edit_product($id='') 
	{
    $this->load->helper(array('form', 'url'));
    $this->load->library('form_validation');
    $this->form_validation->set_rules('title', 'Title', 'required');
	
   
				
			if ($this->form_validation->run() == FALSE)
                {
					$id=$this->uri->segment(3);
					$this->load->model('insertmodel');
					$data['row'] = $this->insertmodel->get_databyid($id); //get profile data
					$data['category'] = $this->insertmodel->Fetch_Category();
					$this->load->view('templates/header3');
                    $this->load->view('pages/edit_product',$data);
                    $this->load->view('templates/footer3');
                        
                }
                else
                {	
			
					$config['upload_path']   = './uploads/'; 
					$config['allowed_types'] = 'gif|jpg|png|txt'; 
					$config['max_size']      = 1500; 
					$config['max_width']     = 2000; 
					$config['max_height']    = 768;  
					$this->load->library('upload', $config);
					if ($this->upload->do_upload('userfile')) {
						
						$id=$this->uri->segment(3);
						$data = array('upload_data' => $this->upload->data()); 
						$photo=$data['upload_data']['file_name'];
						$title=$this->input->post('title');
						$category=$this->input->post('category');
						$description=$this->input->post('description');
						$data_field=array(
			                    'id'=>$id,
								'title'=>$title,
								'image'=>$photo,
								'category'=>$category,
								'description'=>$description
							  );	
						$data['h']=$this->insertmodel->product_update($data_field,$id);
						//$this->load->view('upload_success', $data); 
						$this->session->set_flashdata('success_msg', 'You have successfully updated...');
						$data['row']=$this->insertmodel->get_databyid($id);	
						$data['category'] = $this->insertmodel->Fetch_Category();						
						$this->load->view('templates/header3');
						$this->load->view('pages/edit_product',$data);  
						$this->load->view('templates/footer3');
					
						} 
						
					else{
						
						$id=$this->uri->segment(3);
						$photo=$this->input->post('preimage');
						$title=$this->input->post('title');
						$category=$this->input->post('category');
						$description=$this->input->post('description');
						$data_field=array(
			                    'id'=>$id,
								'title'=>$title,
								'image'=>$photo,
								'category'=>$category,
								'description'=>$description
							  );	
						$data['h']=$this->insertmodel->product_update($data_field,$id);
						$data['row']=$this->insertmodel->get_databyid($id);
						//print_r($data['row']=$this->insertmodel->get_databyid($id1));
						$this->session->set_flashdata('success_msg', 'You have successfully updated...');
						$data['category'] = $this->insertmodel->Fetch_Category();
						$this->load->view('templates/header3');
						$this->load->view('pages/edit_product',$data);  
						$this->load->view('templates/footer3');
						}
					
				
                }
	}
	
	
	
	


		
}
		
		
