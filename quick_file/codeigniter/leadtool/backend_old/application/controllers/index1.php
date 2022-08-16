<?php
class index1 extends CI_Controller {

      function __construct() {
       parent::__construct();

       // Load url helper
       $this->load->helper('url');
      }
        public function index()
       {
        
         $this->load->helper('html');
        $this->load->view('templates/header');
        $this->load->view('pages/home');
        $this->load->view('templates/footer');
       }
}