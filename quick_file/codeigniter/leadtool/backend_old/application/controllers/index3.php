<?php
class index3 extends CI_Controller {

      function __construct() {
       parent::__construct();

       // Load url helper
       $this->load->helper('url');
	   $this->load->model('m1');
	   $this->load->database();
	   
      }
        public function index()
       {
        
       $data['news'] = $this->m1->selectdata();
       }
}
