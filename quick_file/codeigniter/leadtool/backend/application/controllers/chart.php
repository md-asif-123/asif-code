<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Chart extends CI_Controller {

  function __construct() {
       
	parent::__construct();
	
		
    // Load url helper
    $this->load->helper('url');
	$this->load->library('session');
	
	$this->load->model('chart_model');
	
	
	}
	public function by_country()
	{
		
	//$data['pagetitle']='score list';
    $results=$this->chart_model->chart_bycountry(); 
	
	//===========================For Country bar chart start============================================
	$results=$this->chart_model->chart_bycountry(); 
	$table['cols'] = array(
			array('label' => 'Weekly Task', 'type' => 'string'),
			array('label' => 'Percentage', 'type' => 'number')

		);
			/* Extract the information from $result */
			foreach($results->result() as $row){
			
			  $temp = array();

			  // the following line will be used to slice the Pie chart

			  $temp[] = array('v' => (string) $row->country); 

			  // Values of each slice

			  $temp[] = array('v' => (int) $row->val); 
			  $rows[] = array('c' => $temp);
			}

		$table['rows'] = $rows;

		// convert data into JSON format
		$data['jsonTable']=$jsonTable = json_encode($table);
		//echo $jsonTable;
	
	

	


    //return the data in view  
	$this->load->view('header3');
    $this->load->view('country_chart', $data);//loading success view
    $this->load->view('footer3');	
	
	
	}
      //===========================For Industry bar chart start============================================
	public function by_industry()
	{
		
	$result_industry=$this->chart_model->chart_byindustry();
		
		$tableindustry['cols'] = array(

        // Labels for your chart, these represent the column titles.
        /* 
            note that one column is in "string" format and another one is in "number" format 
            as pie chart only required "numbers" for calculating percentage 
            and string will be used for Slice title
        */

        array('label' => 'Weekly Task', 'type' => 'string'),
        array('label' => 'Percentage', 'type' => 'number')

    );
        /* Extract the information from $result */
		foreach($result_industry->result() as $ind){
			
			$id=$ind->industry;
			
			$result_industry=$this->chart_model->get_valuebyid($chk='id',$id,$table='industry');
			
			 $temp = array();
		  // the following line will be used to slice the Pie chart

          $temp[] = array('v' => (string) $result_industry->name); 
		
          // Values of each slice

          $temp[] = array('v' => (int) $ind->val); 
          $rows_industry[] = array('c' => $temp);
        }
		
		

    $tableindustry['rows'] = $rows_industry;

    // convert data into JSON format
    $data['jsonTable'] = json_encode($tableindustry);
	
	
     
	


    //return the data in view  
	$this->load->view('header3');
    $this->load->view('industry_chart', $data);//loading success view
    $this->load->view('footer3');	
	
	
	}
	 //===========================For Language bar chart start============================================
	public function by_language()
	{
		
	$result_language=$this->chart_model->chart_bylanguage();
		
		$tablelanguage['cols'] = array(

        // Labels for your chart, these represent the column titles.
        /* 
            note that one column is in "string" format and another one is in "number" format 
            as pie chart only required "numbers" for calculating percentage 
            and string will be used for Slice title
        */

        array('label' => 'Weekly Task', 'type' => 'string'),
        array('label' => 'Percentage', 'type' => 'number')

    );
        /* Extract the information from $result */
		foreach($result_language->result() as $lang){
			
			$id=$lang->detected_languagecode;
			
			$result_lang=$this->chart_model->get_valuebyid($chk='language_code',$id,$table='languages');
			$temp = array();
		 
          // the following line will be used to slice the Pie chart

          $temp[] = array('v' => (string) $result_lang->language); 
			 
	

          // Values of each slice

          $temp[] = array('v' => (int) $lang->val); 
          $rows_language[] = array('c' => $temp);
        }
	
    $tablelanguage['rows'] = $rows_language;

    // convert data into JSON format
    $data['jsonTable'] = json_encode($tablelanguage);
    //echo $jsonTable;
		
	//For language bar chart end	
	
     
	


    //return the data in view  
	$this->load->view('header3');
    $this->load->view('language_chart', $data);//loading success view
    $this->load->view('footer3');	
	
	
	}
	 //===========================For Language bar chart start============================================
	public function by_business()
	{
		
	$result_business_type=$this->chart_model->chart_bybusinesstype();
		
		$tablebusiness['cols'] = array(

        // Labels for your chart, these represent the column titles.
        /* 
            note that one column is in "string" format and another one is in "number" format 
            as pie chart only required "numbers" for calculating percentage 
            and string will be used for Slice title
        */

        array('label' => 'Weekly Task', 'type' => 'string'),
        array('label' => 'Percentage', 'type' => 'number')

    );
        /* Extract the information from $result */
		foreach($result_business_type->result() as $btype){
			
			 $temp = array();
		 
          // the following line will be used to slice the Pie chart

          $temp[] = array('v' => (string) $btype->business_type); 
		
          // Values of each slice

          $temp[] = array('v' => (int) $btype->val); 
          $rows_btype[] = array('c' => $temp);
        }
	
    $tablebusiness['rows'] = $rows_btype;

    // convert data into JSON format
    $data['jsonTable'] = json_encode($tablebusiness);
    //echo $jsonTable;
	
     
	


    //return the data in view  
	$this->load->view('header3');
    $this->load->view('business_chart', $data);//loading success view
    $this->load->view('footer3');	
	
	
	}
		
}
		
		
