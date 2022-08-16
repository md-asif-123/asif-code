
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class email extends CI_Controller {

  function __construct() {
       
	parent::__construct();

    // Load url helper
    $this->load->helper('url');
	$this->load->library('session');
	$this->load->library("pagination");
	$this->load->model('email_model');
	 $this->load->database();
	}
	
	
	public function email_list()
	{
		if(!$_SESSION['user_id'])
	{
		redirect('');
		}
	$this->load->model('email_model');
    $config = array();
    $config["base_url"] = base_url() . "index/user_data";
    $config["total_rows"] = $this->email_model->record_count();
	$data["total_rows"] = $this->email_model->record_count();
	
	
    $config["per_page"] = 10;
    $config["uri_segment"] = 3;

    $this->pagination->initialize($config);

    $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
    $data["results"] = $this->email_model->fetch_emails($config["per_page"], $page);
	
    $data["links"] = $this->pagination->create_links();
    $this->load->view('header3');
    $this->load->view("email_list", $data);
    $this->load->view('footer3'); 
	
	
	}
	
	public function email_list1()
	{
		
	//$data['pagetitle']='score list';
    $data['results']=$this->email_model->fetch();  
    //return the data in view  
	$this->load->view('header3');
    $this->load->view('email_list', $data);//loading success view
    $this->load->view('footer3');	
	
	
	}
	
	
	function add_email()
			  {
				   $this->load->helper(array('form', 'url'));
                $this->load->library('form_validation');
                
                $this->form_validation->set_rules('email', 'Email', 'required');
				$this->form_validation->set_rules('email_password', 'Password', 'required');
				$this->form_validation->set_rules('smtp', 'Smtp', 'required');
				$this->form_validation->set_rules('smtp_port', 'Smtp port', 'required');
				
				if ($this->form_validation->run() == FALSE)
                {
					 
						if(!$_SESSION['user_id'])
	{
		               redirect('');
		                  }
                        $this->load->view('header3');
                        $this->load->view("emailform"); 
                         $this->load->view('footer3');
                        
                }
				   else
                {
					if(!$_SESSION['user_id'])
	{
		             redirect('');
		                }
					  $this->load->model('email_model');
						$this->email_model->add_email();
						
                        $config = array();
						$config["base_url"] = base_url() . "email/add_email";
						$config["total_rows"] = $this->email_model->record_count();
						$data["total_rows"] = $this->email_model->record_count();
	
	
						$config["per_page"] = 10;
						$config["uri_segment"] = 3;

						$this->pagination->initialize($config);

						$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
						$data["results"] = $this->email_model->fetch_emails($config["per_page"], $page);
	
						$data["links"] = $this->pagination->create_links();
						$this->load->view('header3');
						$this->load->view("email_list", $data);
						$this->load->view('footer3'); 
                }
				  
			  }
	
	function delete_email()
              { 
                      $id = $this->input->get('id', TRUE);
					  $this->load->model('email_model');
                      $this->email_model->delete_email($id);
					  $data['results']=$this->db->query("SELECT * FROM email_account");
                    if($this->db->affected_rows($data['results'])>0){
						$this->load->view('header3');
						echo $msgfail="data deleted";
                        $this->load->view('email_list', $data);//loading success view
						  $this->load->view('footer3');}
						  else
						  {
							  
							  
							  echo "<h4>not deleted</h4>";
							 
						  }                      
					  

              }
			  
			  
			  function edit_email()
			  {
				     $this->load->helper(array('form', 'url'));
                $this->load->library('form_validation');
                
                $this->form_validation->set_rules('email', 'Email', 'required');
				$this->form_validation->set_rules('email_password', 'Password', 'required');
				$this->form_validation->set_rules('smtp', 'Smtp', 'required');
				$this->form_validation->set_rules('smtp_port', 'Smtp port', 'required');
				
				if ($this->form_validation->run() == FALSE)
                {
					    $id=$this->uri->segment(3);
						//$id = $this->input->get('id', TRUE);
						  $data['h']=$this->db->query("SELECT * FROM email_account WHERE id=$id");
                        $this->load->view('header3');
                        $this->load->view("email_editform",$data); 
                         $this->load->view('footer3');
                        
                }
				   else
                {
					  $id=$this->uri->segment(3);
					  //$id = $this->input->get('id', TRUE);
                      $this->load->model('email_model');
						$this->email_model->edit_email($id);
                        $this->session->set_flashdata('success_message', 'Updated successfully');
						redirect('email/email_list');	
                }
				  
			  }


		
}
		
		
