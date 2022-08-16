<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Category extends CI_Controller {

  function __construct() {
       
	parent::__construct();
	
		
    // Load url helper
    $this->load->helper('url');
	$this->load->library('session');
	$this->load->library("pagination");
	$this->load->model('category_model');
	$this->load->library('form_validation');
	
	}
	public function category_list()
	{
		
	//$data['pagetitle']='score list';
    $data['results']=$this->category_model->fetch();  
    //return the data in view  
	$this->load->view('templates/header3');
    $this->load->view('pages/category_list', $data);//loading success view
    $this->load->view('templates/footer3');	
	
	
	}
	
	public function add_category()
	{
		

    //return the data in view  
	$this->load->view('templates/header3');
    $this->load->view('pages/add_category');//loading success view
    $this->load->view('templates/footer3');	
	
	
	}
	
	
	public function add()
	{
		
	//$data['pagetitle']='score list';
	$this->load->model('category_model');
	$this->category_model->insert_category();  
    //return the data in view  
	$this->load->view('templates/header3');
    $this->load->view('pages/add_category');//loading success view
    $this->load->view('templates/footer3');	
	
	
	}
	
	
	
	
	
	
      
	public function edit()
	{	


 
			$this->form_validation->set_rules('category', 'Category', 'required');
			$score=$this->input->post('category');
				
			if ($this->form_validation->run() == FALSE){
				
					$id=$this->uri->segment(3);
					$this->load->model('category_model');
					$data['row'] = $this->category_model->get_categorybyid($id); //get profile data
					$this->load->view('templates/header3');
					//$this->session->set_flashdata('success_msg', 'You have successfully updated...');
					$this->load->view('pages/category_edit',$data);  
                    $this->load->view('templates/footer3');	

					
			}

			else{
				
				
				$id=$this->uri->segment(3);
				$this->category_model->update($id,$score);
                $this->load->model('category_model');
				$data['row'] = $this->category_model->get_categorybyid($id); //get profile data
				
				$this->load->view('templates/header3');
				$this->session->set_flashdata('sess_message', '<span style="color:#green">You have successfully Updated !!!</span>');
                $this->load->view('pages/category_edit',$data);  
                $this->load->view('templates/footer3');	
				
			}
				
					
						
					

	
	}
	
	
		
}
		
		
