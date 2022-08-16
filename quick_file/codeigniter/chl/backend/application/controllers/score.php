<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Score extends CI_Controller {

  function __construct() {
       
	parent::__construct();
	
		
    // Load url helper
    $this->load->helper('url');
	$this->load->library('session');
	$this->load->library("pagination");
	$this->load->model('score_model');
	$this->load->library('form_validation');
	
	}
	public function score_list()
	{
		
	//$data['pagetitle']='score list';
    $data['results']=$this->score_model->fetch();  
    //return the data in view  
	$this->load->view('templates/header3');
    $this->load->view('pages/score_list', $data);//loading success view
    $this->load->view('templates/footer3');	
	
	
	}
      
	public function edit()
	{	


 
			$this->form_validation->set_rules('score', 'Score', 'required');
			$score=$this->input->post('score');
				
			if ($this->form_validation->run() == FALSE){
				
					$id=$this->uri->segment(3);
					$this->load->model('score_model');
					$data['row'] = $this->score_model->get_scorebyid($id); //get profile data
					$this->load->view('templates/header3');
					//$this->session->set_flashdata('success_msg', 'You have successfully updated...');
					$this->load->view('pages/score_edit',$data);  
                    $this->load->view('templates/footer3');	

					
			}

			else{
				
				
				$id=$this->uri->segment(3);
				$this->score_model->update($id,$score);
                $this->load->model('score_model');
				$data['row'] = $this->score_model->get_scorebyid($id); //get profile data
				
				$this->load->view('templates/header3');
				$this->session->set_flashdata('sess_message', '<span style="color:#green">You have successfully Updated !!!</span>');
                $this->load->view('pages/score_edit',$data);  
                $this->load->view('templates/footer3');	
				
			}
				
					
						
					

	
	}
	
	
		
}
		
		
