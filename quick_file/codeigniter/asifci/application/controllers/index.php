<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class index extends CI_Controller {
 function __construct() {
       
	parent::__construct();

     $this->load->helper('url');
	 $this->load->library('session');
	 $this->load->library('form_validation');
	$this->load->library("pagination");
	 $this->load->model('insertmodel');
	 $this->load->database();
	 
	}
	public function index()
	{
		 
					$this->form_validation->set_rules('lname', 'NAME', 'required');
		if ($this->form_validation->run() == FALSE)
                {
                        $this->load->view('loginform');
                }

        else
                {
					 $this->insertmodel->user_validation(); 
                     if($_SESSION['admin_id']&&$_SESSION['password'])
		             {	
				      echo "u are wellcome" .$_SESSION['admin_id'];
                    //$data['h']=$this->insertmodel->user_list();
		            //$this->load->view('list',$data);
			
			          redirect('index/user_list');
			        }
					else
					{
						redirect('index');
					}
                }
	}
	function logout()
	{
	
	$this->session->sess_destroy();
	redirect('');
	}
	public function user_add()
	{
		
               
					$this->form_validation->set_rules('fname', 'NAME', 'required');
		if ($this->form_validation->run() == FALSE)
                {
                        $this->load->view('registration');
                }

        else
                {
					 $this->load->model('insertmodel');
                     $this->insertmodel->add_user(); 
                     $data['h']=$this->insertmodel->user_list();
		             $this->load->view('list',$data);
                }
	}
	public function add_user()
	{
		$this->load->model('insertmodel');
        $this->insertmodel->add_user(); 
	}
	public function user_list()
	{
		if(isset($_SESSION['admin_id']))
		{
		
		$this->load->model('insertmodel');
		
		$data['h']=$this->insertmodel->user_list();
		
	
		$this->load->view('list',$data);
		}
		else
		{
			redirect('index');
		}
	}
	
	public function view_user()
	{
		$id = $this->input->get('id', TRUE);
		$data['h']=$this->insertmodel->view_user($id);
		$this->load->view('view',$data);
	}
	
	public function edit_user()
	{
		 if($_SESSION['admin_id'])
		 {
		$id = $this->input->get('id', TRUE);
		//echo $id;exit;
		$data['h']=$this->insertmodel->edit_user($id);
		//echo print_r($data);exit;
		$this->load->view('edit_user',$data);
		 }
		 else{
			
			redirect('index');
		}
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
	public function delete_usercheck()
	{
		
		 $s = $this->input->post('list'); //selected messages
		 //print_r($s);exit;
		 
         $this->insertmodel->delete_usercheck($s);
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
	
	public function generatePdf()
	{
		
		    require_once('generateTicket.php');
			$bgImage = 'C:/xampp/htdocs/asifci/application/controllers/badge.jpg';
			$pdfPhysicalPath = 'C:/xampp/htdocs/asifci/application/controllers/';
			$generateTicket->generatePDF($pdfPhysicalPath,$bgImage,'dfg','fdgfg','dfgfdg','dfgfd','rgr','hfg','78910');
			
	}
	public function generateMail()
	{
		
		    $this->load->view("mailContact");
			
			
	}
	
}
