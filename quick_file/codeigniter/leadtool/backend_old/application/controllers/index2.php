<?php
class index2 extends CI_Controller {

      function __construct() {
       parent::__construct();

       // Load url helper
       $this->load->helper('url');
	   $this->load->database();
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
                        $this->load->model('insertmodel');
                        $this->insertmodel->pass();
                        
                }
				
				

        
       }
        public function front()
       {
        
        $this->load->helper('html');
        $this->load->view('templates/header3');
        $this->load->view('pages/front');
        $this->load->view('templates/footer3');
       }
	    public function getform()
       {
        
         $this->load->helper('html');
        
         $this->load->view('pages/contact');
        
       }
	   function insertdata()
       {
          $this->load->model('insertmodel');
          $this->insertmodel->insertdb();
          $this->load->view('sucess');//loading success view
       }
	   
	   public function validateform() {
                $this->load->helper(array('form', 'url'));

                $this->load->library('form_validation');
                $this->form_validation->set_rules('username', 'Username', 'required');
                $this->form_validation->set_rules('password', 'Password', 'required',
                array('required' => 'You must provide a %s.')
                );
                $this->form_validation->set_rules('passconf', 'Password Confirmation', 'required');
                $this->form_validation->set_rules('email', 'Email', 'required');

                if ($this->form_validation->run() == FALSE)
                {
                        $this->load->view('myform');
                }
                else
                {
                        $this->load->view('sucess');
                }
}
       public function validateform2() {
                $this->load->helper(array('form', 'url'));
                $this->load->library('form_validation');
                $this->form_validation->set_rules('name', 'Username', 'required');
                $this->form_validation->set_rules('phone', 'Phone', 'required');
                $this->form_validation->set_rules('email', 'Email', 'required');
				$this->form_validation->set_rules('companyname', 'companyname', 'required');
                $this->form_validation->set_rules('categories', 'categories', 'required');
                $this->form_validation->set_rules('comments', 'comments', 'required');

                if ($this->form_validation->run() == FALSE)
                {
					     $this->load->library('session'); 
						 $this->session->has_userdata('username');
						 
                        $this->load->view('pages/contact');
                }
                else
                {
                        $this->load->model('insertmodel');
                        $data['h']=$this->insertmodel->insertdb();  
                       //return the data in view  
                          
						$this->load->view('templates/header3');
                        $this->load->view('pages/list', $data);//loading success view
                        $this->load->view('templates/footer3');
                        
                }
}
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
		 public function map() {
            $this->load->helper(array('form', 'url'));
             $this->load->model('insertmodel');
             $this->insertmodel->getgeomap(); 
			 $this->load->view('templates/header3');
			 $this->load->view('pages/front');
             $this->load->view('pages/geochart');
             $this->load->view('templates/footer3');
        }
		
		public function viewprofile() {
                          $id = $this->input->get('id', TRUE);
						  $data['h']=$this->db->query("SELECT * FROM enquires WHERE id=$id");
                          $this->load->view('templates/header3');
                          $this->load->view('pages/view', $data);//loading success view
                          $this->load->view('templates/footer3');
        }
		
		
		
		function logout(){

				$this->load->library('session'); 
				$this->session->sess_destroy();
				redirect('');
}

// code for myaccount

 function myaccount(){
       
        $this->load->helper('html');
        $this->load->view('templates/header3');
        $this->load->view('pages/myaccount');
        $this->load->view('templates/footer3');
       }
		
		public function adminaccount() {
                $this->load->helper(array('form', 'url'));
                $this->load->library('form_validation');
                $this->form_validation->set_rules('name', 'Username', 'required');
               
                $this->form_validation->set_rules('email', 'Email', 'required');
				$this->form_validation->set_rules('pass', 'Password', 'required');
                

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
						$this->insertmodel->insertadmin();
                        
						$data['h']=$this->db->query("SELECT * FROM admin WHERE user_type='s'");
						$this->load->view('templates/header3');
						echo $msgfail="data updated";
                        $this->load->view('pages/myaccount',$data);  
                       $this->load->view('templates/footer3');						
                        
                        
                }
}
		
		
}