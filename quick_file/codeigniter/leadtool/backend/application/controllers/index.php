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
		  
          $this->load->view('login');
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
    
		
	public function map()
	{
			
	$this->load->helper(array('form', 'url'));
	$this->load->model('insertmodel');
	$this->insertmodel->getgeomap(); 
	$this->load->view('header3');
	$this->load->view('front');
	$this->load->view('geochart');
	$this->load->view('footer3');
			 
    }
		
	public function dashboard() 
	{
		
		
	if($_SESSION['user_id']){
		
	$this->load->helper(array('form', 'url'));
	$this->load->model('insertmodel');
	$this->load->model('chart_model');
	
	//===========================For Country bar chart start============================================
	$results=$this->chart_model->chart_bycountry(); 
	$table['cols'] = array(
			array('label' => 'Weekly Task', 'type' => 'string'),
			array('label' => 'Percentage', 'type' => 'number')

		);
			/* Extract the information from $result */
			foreach($results->result() as $row){
			
			  $temp = array();

			  // the following line will be used to slice the Pie chart

			  $temp[] = array('v' => (string) $row->country); 

			  // Values of each slice

			  $temp[] = array('v' => (int) $row->val); 
			  $rows[] = array('c' => $temp);
			}

		$table['rows'] = $rows;

		// convert data into JSON format
		$data['jsonTable']=$jsonTable = json_encode($table);
		//echo $jsonTable;
	
	
	//===========================For Industry bar chart start============================================
	
	$result_industry=$this->chart_model->chart_byindustry();
		
		$tableindustry['cols'] = array(

        // Labels for your chart, these represent the column titles.
        /* 
            note that one column is in "string" format and another one is in "number" format 
            as pie chart only required "numbers" for calculating percentage 
            and string will be used for Slice title
        */

        array('label' => 'Weekly Task', 'type' => 'string'),
        array('label' => 'Percentage', 'type' => 'number')

    );
        /* Extract the information from $result */
		foreach($result_industry->result() as $ind){
			
			$id=$ind->industry;
			
			$result_industry=$this->chart_model->get_valuebyid($chk='id',$id,$table='industry');
			
			 $temp = array();
		  // the following line will be used to slice the Pie chart

          $temp[] = array('v' => (string) $result_industry->name); 
		
          // Values of each slice

          $temp[] = array('v' => (int) $ind->val); 
          $rows_industry[] = array('c' => $temp);
        }
		
		

    $tableindustry['rows'] = $rows_industry;

    // convert data into JSON format
    $data['jsonTableind'] = json_encode($tableindustry);
    //echo $jsonTable;
		
	//For accounting bar chart end	
	
	//===========================For language bar chart start============================================


	$result_language=$this->chart_model->chart_bylanguage();
		
		$tablelanguage['cols'] = array(

        // Labels for your chart, these represent the column titles.
        /* 
            note that one column is in "string" format and another one is in "number" format 
            as pie chart only required "numbers" for calculating percentage 
            and string will be used for Slice title
        */

        array('label' => 'Weekly Task', 'type' => 'string'),
        array('label' => 'Percentage', 'type' => 'number')

    );
        /* Extract the information from $result */
		foreach($result_language->result() as $lang){
			
			$id=$lang->detected_languagecode;
			
			$result_lang=$this->chart_model->get_valuebyid($chk='language_code',$id,$table='languages');
			$temp = array();
		 
          // the following line will be used to slice the Pie chart

          $temp[] = array('v' => (string) $result_lang->language); 
			 
	

          // Values of each slice

          $temp[] = array('v' => (int) $lang->val); 
          $rows_language[] = array('c' => $temp);
        }
	
    $tablelanguage['rows'] = $rows_language;

    // convert data into JSON format
    $data['jsonTablelanguage'] = json_encode($tablelanguage);
    //echo $jsonTable;
		
	//For language bar chart end	

//===========================For business type chart start============================================
	
	
	$result_business_type=$this->chart_model->chart_bybusinesstype();
		
		$tablebusiness['cols'] = array(

        // Labels for your chart, these represent the column titles.
        /* 
            note that one column is in "string" format and another one is in "number" format 
            as pie chart only required "numbers" for calculating percentage 
            and string will be used for Slice title
        */

        array('label' => 'Weekly Task', 'type' => 'string'),
        array('label' => 'Percentage', 'type' => 'number')

    );
        /* Extract the information from $result */
		foreach($result_business_type->result() as $btype){
			
			 $temp = array();
		 
          // the following line will be used to slice the Pie chart

          $temp[] = array('v' => (string) $btype->business_type); 
		
          // Values of each slice

          $temp[] = array('v' => (int) $btype->val); 
          $rows_btype[] = array('c' => $temp);
        }
	
    $tablebusiness['rows'] = $rows_btype;

    // convert data into JSON format
    $data['jsonTablebtype'] = json_encode($tablebusiness);
    //echo $jsonTable;
		
	//===========================For business type chart end============================================
	
	$this->load->view('header3');
    $this->load->view('front',$data);
    $this->load->view('footer3');
	
		
	}

		else{
			
		redirect('index');	
		}
    
	
    }
	
	// view profile

	public function viewuser_profile() 
	{
    $id = $this->input->get('id', TRUE);
	$id = $this->uri->segment('3');
	$data['h']=$this->db->query("SELECT * FROM enquires WHERE id=$id");
    $this->load->view('header3');
    $this->load->view('view', $data);//loading success view
    $this->load->view('footer3');
    }
		
	

	public function user_list() 
	{
	$this->load->library('pagination');
	$this->load->model('insertmodel');
    $data['h']=$this->insertmodel->user_list();  
    //return the data in view  
    $this->load->view('header3');
    $this->load->view('list', $data);//loading success view
    $this->load->view('footer3');
                        
    }
	

	// code for myaccount


	public function validatepass() {
    $this->load->helper(array('form', 'url'));
    $this->load->library('form_validation');
    $this->form_validation->set_rules('username', 'Username', 'required');
    $this->form_validation->set_rules('password', 'Password', 'required');
                
                if ($this->form_validation->run() == FALSE)
				{
                
                    $this->load->view('login');
                }
                else
                {		
                    $this->load->model('insertmodel');
                    $this->insertmodel->pass();
                    $this->load->view('header3');
                    $this->load->view('front');
                    $this->load->view('footer3');
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
				$this->load->view('header3');
                $this->load->view('myaccount',$data);
                $this->load->view('footer3');
                }
                else
                {
                $this->load->model('insertmodel');
				$this->insertmodel->update_admin();
                $data['h']=$this->db->query("SELECT * FROM admin WHERE user_type='s'");
				$this->load->view('header3');
				$data['failmessage']="Your data has been succesfully updated...";
                $this->load->view('myaccount',$data);  
                $this->load->view('footer3');						
                    
                }
	}

	// admin user list

	public function admin_list() 
	{
                
    $this->load->model('insertmodel');
    $data['h']=$this->insertmodel->userlist_db();  
    //return the data in view  
                          
	$this->load->view('header3');
    $this->load->view('user_list', $data);//loading success view
    $this->load->view('footer3');
                        
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
    $this->load->view('header3');
    $this->load->view('list', $data);//loading success view
    $this->load->view('footer3');
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
	
	
	public function user_data() {
		
	if($_SESSION['user_id'])
		{	
                
    $this->load->model('insertmodel');
    $config = array();
    $config["base_url"] = base_url() . "index/user_data";
    $config["total_rows"] = $this->insertmodel->record_count();
	$data["total_rows"] = $this->insertmodel->record_count();
	
	
    $config["per_page"] = 10;
    $config["uri_segment"] = 3;

    $this->pagination->initialize($config);

    $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
    $data["results"] = $this->insertmodel->fetch_countries($config["per_page"], $page);
	
    $data["links"] = $this->pagination->create_links();
    $this->load->view('header3');
    $this->load->view("listadmin", $data);
    $this->load->view('footer3'); 
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
    $this->load->view('header4');
    $this->load->view("list", $data);
    $this->load->view('footer3'); 
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
					$d=$this->db->query("SELECT * FROM enquires WHERE id='$id1'");
					foreach($d->result() as $row)
					{
						$i=$row->industry;
					}
					//$i=$this->db->query("SELECT industry FROM enquires WHERE id='$id1'");
					$data['getindustry']=$this->db->query("SELECT * FROM industry WHERE id=$i");
					$data['industry']=$this->db->query("SELECT * FROM industry");
					$data['country']=$this->db->query("SELECT * FROM country");
					$data['l']=$this->db->query("SELECT * FROM languages");
					$this->load->view('header3');
                    $this->load->view('contact',$data);
                    $this->load->view('footer3');
                        
                }
                else
                {	
					
					$this->load->model('insertmodel');
					
					$id1=$this->uri->segment(3);
					$this->insertmodel->edit_user($id1);
					$data['h']=$this->db->query("SELECT * FROM enquires WHERE id=$id1");
					$data['l']=$this->db->query("SELECT * FROM languages");
					$this->load->view('header3');
					$this->session->set_flashdata('success_msg', 'You have successfully updated...');
					$this->load->view('contact',$data);  
                    $this->load->view('footer3');	
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
    $this->load->view('header3');
	//echo $msgfail="data deleted";
	$this->session->set_flashdata('success_msg', 'You have successfully deleted...');
    $this->load->view("listadmin", $data);
    $this->load->view('footer3');
	redirect('index/user_data');	
    }
			  
	function delete_usercheck()
	{ 
    $this->load->helper(array('form', 'url'));
	$this->load->model('insertmodel');
    $checked_messages = $this->input->post('list'); //selected messages
	//print_r($checked_messages);exit;
    $this->insertmodel->delete_usercheck($checked_messages);
    $config = array();
    $config["base_url"] = base_url() . "index/user_data";
    $config["total_rows"] = $this->insertmodel->record_count();
    $config["per_page"] = 10;
    $config["uri_segment"] = 3;
    $this->pagination->initialize($config);

    $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
    $data["results"] = $this->insertmodel->
    fetch_countries($config["per_page"], $page);
    $data["links"] = $this->pagination->create_links();
	
    $this->load->view('header3');
	echo $msgfail="data deleted";
	$this->session->set_flashdata('success_msg', 'You have successfully deleted...');
    $this->load->view("listadmin", $data);
    $this->load->view('footer3'); 
	redirect('index/user_data');

	}
		
}
		
		
