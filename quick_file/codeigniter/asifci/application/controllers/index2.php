<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class index2 extends CI_Controller {
 function __construct() {
       
	parent::__construct();

    
	 $this->load->database();
	 //$this->load->model('insertmodel');
	 
	}
	
	public function index()
	{
		
                $this->load->helper(array('form', 'url'));

                $this->load->library('form_validation');
					$this->form_validation->set_rules('fname', 'NAME', 'required');
		if ($this->form_validation->run() == FALSE)
                {
                        $this->load->view('registration');
                }

        else
                {
                        echo "success";
                }
	}
	public function add_user()
	{
		$this->load->model('insertmodel');
        $this->insertmodel->add_user(); 
	}
	public function user_list()
	{
		//$data['h']=$this->db->query("SELECT * FROM stureg");
		//$this->load->model('insertmodel');
		$data['h']=$this->insertmodel->user_list();
		$this->load->view('list',$data);
	}
	
	public function edit_user()
	{
		$id = $this->input->get('id', TRUE);
		//echo $id;exit;
		$data['h']=$this->insertmodel->edit_user($id);
		//echo print_r($data);exit;
		$this->load->view('edit_user',$data);
	}
	public function update_user()
	{
		$id = $this->input->get('id', TRUE);
		$this->insertmodel->update_user($id);
		$data['h']=$this->insertmodel->user_list();
		$this->load->view('list',$data);
	}
	public function delete_user()
	{
		$id = $this->input->get('id', TRUE);
		$this->insertmodel->delete_user($id);
		$data['h']=$this->insertmodel->user_list();
		$this->load->view('list',$data);
	}
	public function user_list1() {
		
	
                
    $this->load->model('insertmodel');
    
	$a = $this->input->post('key');
	//echo $a;
	if($a)
	{
	
    $data['h'] = $this->insertmodel->user_list1($a);
	
	
    $this->load->view('list', $data);
     
		
	
		}
		
  
	else
			
		{
			$this->load->view("nodata");
		}
		
		
	
    }
}
