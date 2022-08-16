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
		
	if($_SESSION['user_id'])
		{	
                
    $this->load->model('score_model');
    $config = array();
    $config["base_url"] = base_url() . "score/score_list";
    $config["total_rows"] = $this->score_model->record_count();
	$data["total_rows"] = $this->score_model->record_count();
	
	
    $config["per_page"] = 10;
    $config["uri_segment"] = 3;

    $this->pagination->initialize($config);

    $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
    $data["results"] = $this->score_model->fetch_score($config["per_page"], $page);
	
    $data["links"] = $this->pagination->create_links();
    $this->load->view('header3');
    $this->load->view("score_list", $data);
    $this->load->view('footer3'); 
		}
		else{
			
			redirect('index');
		}
	
	
	}
	
	public function score_list1()
	{
		
	//$data['pagetitle']='score list';
    $data['results']=$this->score_model->fetch();  
    //return the data in view  
	$this->load->view('header3');
    $this->load->view('score_list', $data);//loading success view
    $this->load->view('footer3');	
	
	
	}
      
	public function edit()
	{	


 
			$this->form_validation->set_rules('score', 'Score', 'required');
			$score=$this->input->post('score');
				
			if ($this->form_validation->run() == FALSE){
				
					$id=$this->uri->segment(3);
					$this->load->model('score_model');
					$data['row'] = $this->score_model->get_scorebyid($id); //get profile data
					$this->load->view('header3');
					//$this->session->set_flashdata('success_msg', 'You have successfully updated...');
					$this->load->view('score_edit',$data);  
                    $this->load->view('footer3');	

					
			}

			else{
				
				
				$id=$this->uri->segment(3);
				$this->score_model->update($id,$score);
                $this->load->model('score_model');
				$data['row'] = $this->score_model->get_scorebyid($id); //get profile data
				
				$this->load->view('header3');
				$this->session->set_flashdata('sess_message', '<span style="color:#green">You have successfully Updated !!!</span>');
                $this->load->view('score_edit',$data);  
                $this->load->view('footer3');	
				
			}
				
					
						
					

	
	}
	
	
		
}
		
		
