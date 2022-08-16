<?php
class index extends CI_Controller {

      function __construct() {
       parent::__construct();

       // Load url helper
       $this->load->helper('url');
	   
      }
	  public function index()
       {      
                $this->load->helper(array('form', 'url'));
		        $this->load->library('form_validation');
                $this->load->helper('html');
				$data['message']='';
				$this->load->model('insertmodel');
				$data['row'] = $this->insertmodel->Get_Scorebyid(15); //get profile data
				$data['results'] = $this->insertmodel->Get_Scorebychildid(15); //get profile data
				$data['comments'] = $this->insertmodel->Get_Scorebychildid(34); //get profile data
				$data['needsample'] = $this->insertmodel->Get_Scorebychildid(49); //get profile data
				$data['country'] = $this->insertmodel->Fetch_Data('country');
				$data['industry'] = $this->insertmodel->Fetch_Data('industry');
				$this->load->view('templates/header');
                $this->load->view('pages/contact',$data);
				$this->load->view('templates/footer');

        
       }
       public function front()
       {
        
        $this->load->helper('html');
        $this->load->view('templates/header');
        $this->load->view('pages/front');
        $this->load->view('templates/footer');
       }
	    public function getform()
       {
        $this->load->helper('html');
        $this->load->view('pages/contact');
       }
	   function insert_data()
       {
          $this->load->model('insertmodel');
          $this->insertmodel->insert_db();
          $this->load->view('sucess');//loading success view
       }
	   
	    public function Api_Getcountry() {
			
			$this->load->model('insertmodel');
			$country = $this->insertmodel->Fetch_Data('country');
			$results = array();
			
			foreach($country->result() as $row)
				{
		
			$score = $row->score;
			$name = $row->name;
			
			$results[]=array('country'=>$name, 'score' => $score);
			

			 }
			echo json_encode($results);
		}
		
		
		
		public function getIndustry() {
			
			$this->load->model('insertmodel');
			$industry = $this->insertmodel->Fetch_Data('industry');
			
			
		foreach($industry->result() as $row)
		{
		
			$score = $row->score;
			$name = $row->name;
			$results = array();
			$results[]=array('industrytype'=>$name, 'score' => $score);
			echo json_encode($results);
			
			
			 }
		
		}
		
		
		
		
		public function Api_Getbusinesstype() {
			
			$this->load->model('insertmodel');
			$businesstype = $this->insertmodel->Get_Scorebychildid(15);
			
			
			
		foreach($businesstype->result() as $row)
		{
		
			$score = $row->score;
			$name = $row->name;
			$results = array();
			$results[]=array('businesstype'=>$name, 'score' => $score);
			echo json_encode($results);
			
			
			 }
		
		}
		
		
		
	
	  
	   
	    public function api_enquiry() {
		   
                $this->load->helper(array('form', 'url'));
                $this->load->library('form_validation');
				if($this->input->post('name')==''){
				$message="Name field is blank";
				echo json_encode(array('status'=>0, 'message' => "$message"));
				}
				else if($this->input->post('email')==''){
				$message="Email field is blank";
				echo json_encode(array('status'=>0, 'message' => "$message"));
				}
				else if($this->input->post('website')==''){
				$message="Website field is blank";
				echo json_encode(array('status'=>0, 'message' => "$message"));
				}
				else if($this->input->post('telephone')==''){
				$message="Telephone number field is blank";
				echo json_encode(array('status'=>0, 'message' => "$message"));
				}
				else if($this->input->post('fax')==''){
				$message="Fax field is blank";
				echo json_encode(array('status'=>0, 'message' => "$message"));
				}
				else if($this->input->post('mobile')==''){
				$message="Mobile number field is blank";
				echo json_encode(array('status'=>0, 'message' => "$message"));
				}
				else if($this->input->post('country')=='0'){
				$message="Country field is not selected";
				echo json_encode(array('status'=>0, 'message' => "$message"));
				}
				else if($this->input->post('companyname')==''){
				$message="Company field is blank";
				echo json_encode(array('status'=>0, 'message' => "$message"));
				
				}
				else if($this->input->post('industry')=='0'){
				$message="Industry field is not selected";
				echo json_encode(array('status'=>0, 'message' => "$message"));
				}
				else if($this->input->post('businesstype')=='0'){
				$message="Business type field is not selected";
				echo json_encode(array('status'=>0, 'message' => "$message"));
				}
				else if($this->input->post('unitprice')==''){
				$message="Unit price field is blank";
				echo json_encode(array('status'=>0, 'message' => "$message"));
				}
				else if($this->input->post('comments')==''){
				$message="Comments field is blank";
				echo json_encode(array('status'=>0, 'message' => "$message"));
				}
				
				//$this->form_validation->set_rules('email', 'Email', 'required');
				//$this->form_validation->set_rules('telephone', 'Telephone', 'required');
				//$this->form_validation->set_rules('country', 'Country', 'required');
				//$this->form_validation->set_rules('industry', 'Industry', 'required');
				//$this->form_validation->set_rules('businesstype', 'Business Type', 'required');
				//$this->form_validation->set_rules('comments', 'Comments', 'required');
				
                else
                {		

					$config['upload_path']   = './uploads/'; 
					$config['allowed_types'] = 'gif|jpg|png|txt'; 
					$config['max_size']      = 100; 
					$config['max_width']     = 1024; 
					$config['max_height']    = 768;  
					$this->load->library('upload', $config);
					if ($this->upload->do_upload('userfile')) {
						$data = array('upload_data' => $this->upload->data()); 
						$file_name=$data['upload_data']['file_name'];
						$this->load->model('insertmodel');
                        $data['h']=$this->insertmodel->insert_db($file_name); 
						//$this->load->view('upload_success', $data); 
						} 
						
						else{
							
						$file_name = 'N';	
						$this->load->model('insertmodel');
                        $data['h']=$this->insertmodel->insert_db($file_name); 
							
						}
						header('Content-Type: application/json; charset=utf-8');
						
						$results = array();
						$results[]=array('status'=>1, 'message' => 'Successfully Submiited');
						echo json_encode($results);
                  					
						//redirect('');	
						
						//return the data in view 
					
                        
                }
}

		// for sending message code

		public function send_message(){
			
						$this->load->model('insertmodel');
                        $data['fetch_data']=$this->insertmodel->send_message(); 
		}
		
	
		
}