<?php
class insertmodel extends CI_Model {

        public function __construct()
        {
            $this->load->library('session'); 
			$this->load->database();
        }

     function insertdb()
     {
    $n = $_POST['name'];
    $ph = $_POST['phone'];
    $e = $_POST['email'];
	$cn = $_POST['companyname'];
    $cag = $_POST['categories'];
    $c = $_POST['comments'];
     $this->db->query("INSERT INTO enquires(name,phone,email,company_name,categories,comments)VALUES('$n','$ph','$e','$cn','$cag','$c')");
     $query = $this->db->get('enquires');  
         return $query;   
	 }
	 function pass()
     {
    $u = $_POST['username'];
    $p = $_POST['password'];
	$this->session->set_userdata('username', "$u");
	$this->session->set_userdata('pwrd', "$p");
	
	
	
    $res=$this->db->query("SELECT * FROM admin WHERE user_id='$u' AND password='$p'");
	
	
     
	 if($this->db->affected_rows($res))
	 {
		 //$msgsucess="wellcome to admin page";
		 $this->load->view('templates/header3');
                        $this->load->view('pages/front');
                        
	 }
	 else
	 {
		echo $msgfail="invalid username or password";
                        $this->load->view('pages/login');
                        
	 }
		 
     }
	 function getgeomap()
     {
      $result=$this->db->query("SELECT * FROM country");

      
        foreach($result as $r) {

          $temp = array();

          // the following line will be used to slice the Pie chart

          $temp[] = array('v' => (string) $r['name']); 

          // Values of each slice

          $temp[] = array('v' => (int) $r['val']); 
          $rows[] = array('c' => $temp);
        }

    $table['rows'] = $rows;

    // convert data into JSON format
    $jsonTable = json_encode($table);
    //echo $jsonTable;
    


     }
	  function insertadmin()
     {
    $n = $_POST['name'];
    $e = $_POST['email'];
    $p = $_POST['pass'];
	
     $this->db->query("UPDATE admin set name='$n',user_id='$e',password='$p' WHERE user_type='s'");
       
	 }
	 
 }