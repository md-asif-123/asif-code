<?php
class  MY_Controller  extends  CI_Controller  
{
	public $view_dir='frontend/';
	public $header='';
	public $banner='';
	public $footer='';
	public $data=array();

	function __construct () 
	{
		parent::__construct();
		$this->data['req']=$_REQUEST;
		//code here
		
		// Setting CSS, JS, Images, Upload Path
		$base_url = base_url();
		$this->data['base_url'] = $base_url;
		$this->data['site_url'] = $base_url;
		$this->data['css_path'] = $base_url.$this->config->item('css_path');
		$this->data['js_path'] = $base_url.$this->config->item('js_path');
		$this->data['images_path'] = $base_url.$this->config->item('images_path');	
		$this->data['upload_path'] = $base_url.$this->config->item('upload_path');
		$this->data['email_template_path'] = $base_url.$this->config->item('email_template_path');
		
		$this->data['ck_base_url'] = $base_url.$this->config->item('ckeditor_base_url');
		$this->data['ck_base_path'] = $this->config->item('ckeditor_base_path_front');
		
		// Default Email Setting
		$this->data['admin_to_email'] = $this->config->item('admin_to_email');
		$this->data['noreply_email'] = $this->config->item('noreply_email');
		$this->data['noreply_name'] = $this->config->item('noreply_name');
		
		$this->data['req']=$_REQUEST;
		$this->data['bc']='<a href="'.$base_url.'" class="bc">Home</a>';
		// Page Settings
		$this->data['txt_no_record']='There is no record!!!';
		$this->data['meta_title']='News, Gallery at JAYITA (JAYITA)';
		$this->data['meta_description'] = 'News, Gallery, JAYITA (JAYITA)';
		$this->data['meta_keyword'] = 'News, Gallery, at JAYITA (JAYITA)';
		//$this->get_static_id();
		$this->get_commonpage_data();
		// Controller, Method Name
		$this->data['controller_name'] = $this->uri->segment('1');
		$this->data['method_name'] = $this->uri->segment('2')?$this->uri->segment('2'):'index';
		$this->data['limit'] = 10;
		 
	}
	
	function get_meta($param='')
	{
		$site_meta=' | JAYATI (JAYATI)';
		$cmn_meta_title='News, Gallery'.$site_meta;
		$cmn_meta_description='News, Gallery'.$site_meta;
		$cmn_meta_keyword='News, Gallery'.$site_meta;
		
		if(count($this->data['set_meta'])>0)
		{
			$this->data['meta']['title']=$this->data['set_meta']['title'].$site_meta;
			$this->data['meta']['description']=$this->data['set_meta']['title'].$site_meta;
			$this->data['meta']['keyword']=$this->data['set_meta']['title'].$site_meta;
		}
		else
		{
			$this->data['meta']['title']=$cmn_meta_title;
			$this->data['meta']['description']=$cmn_meta_description;
			$this->data['meta']['keyword']=$cmn_meta_keyword;
		}
		
		
		
	}
	//added on 12/01/2012
	function get_commonpage_data()
	{
		/*$this->load->model('content_model');
		//pre-primary school
		$cond=" AND status=1 AND url_mask = 'pre-primary-school'";
		$pre_primary=$this->content_model->fetch($cond);
		$this->data['pre_primary1']=$pre_primary[0];*/	
		
		
	}
	
	function get_include()
	{
		//echo $this->data['bc'];
		$this->get_ongoingEvent();
		$this->get_upcomingEvent();
		
		$this->data['header'] = $this->load->view($this->view_dir.'header', $this->data, true);
		$this->data['footer'] = $this->load->view($this->view_dir.'footer', $this->data, true);
		$this->data['pulnine'] = $this->load->view($this->view_dir.'pulnine', $this->data, true);
		$this->data['bannersec'] = $this->load->view($this->view_dir.'bannersec', $this->data, true);
		$this->data['logosearch'] = $this->load->view($this->view_dir.'logosearch', $this->data, true);
		
	}
	
	// Function For Email Configuration
	function email_config($param=array())
	{
		$this->load->library('email');
		
		$config['protocol'] = 'smtp';
		$config['smtp_host'] = 'localhost';
		$config['smtp_port'] = '25';
		$config['smtp_timeout'] = '7';
		$config['charset'] = 'utf-8';
		$config['newline'] = "\r\n";
		$config['mailtype'] = 'html'; // text or html
		$config['validation'] = TRUE; // bool whether to validate email or not      
		#$config['smtp_user'] = 'mygmail@gmail.com';
		#$config['smtp_pass'] = '*******';
		$this->email->initialize($config);
		//echo $this->email->print_debugger();
	}
	
	
	
	public function check_auth()
	{
		if($this->session->userdata('user_id') > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	

	//for all song	
function get_ongoingEvent()
  {
	 $curdate=date("Y-m-d"); 
	$sql ="Select * from `cgator_news` where 1 AND status=1 AND type='Event'AND DATE(end_date)>='$curdate' order by `start_date` desc LIMIT 3";
		$query = $this->db->query($sql);
		$inc_ongong=array();
		foreach ($query->result_array() as $row)
		{
		  $inc_ongong[]=$row;
		}		
		$this->data['inc_ongongE']=$inc_ongong;	
		
	}
	
function get_upcomingEvent()
  {
	
	 $curdate=date("Y-m-d"); 
	$sql ="Select * from `cgator_news` where 1 AND status=1 AND type='Event'AND DATE(start_date)>='$curdate' order by `start_date` desc LIMIT 3";
		$query = $this->db->query($sql);
		$inc_upcoming=array();
		foreach ($query->result_array() as $row)
		{
		  $inc_upcoming[]=$row;
		}		
		$this->data['inc_upcomingE']=$inc_upcoming;	
		
	}	

	

	// Function For Pagination Configuration
	function pagination_config($param=array())
	{
		$this->arrpagination['first_link'] = $this->config->item('first_link');
		$this->arrpagination['first_tag_open'] = $this->config->item('first_tag_open');
		$this->arrpagination['first_tag_close'] = $this->config->item('first_tag_close');
		$this->arrpagination['display_first_link'] = $this->config->item('display_first_link');
		$this->arrpagination['last_link'] = $this->config->item('last_link');
		$this->arrpagination['last_tag_open'] = $this->config->item('last_tag_open');
		$this->arrpagination['last_tag_close'] = $this->config->item('last_tag_close');
		$this->arrpagination['display_last_link'] = $this->config->item('display_last_link');
		$this->arrpagination['next_link'] = $this->config->item('next_link');
		$this->arrpagination['next_tag_open'] = $this->config->item('next_tag_open');
		$this->arrpagination['next_tag_close'] = $this->config->item('next_tag_close');
		$this->arrpagination['display_next_link'] = $this->config->item('display_next_link');
		$this->arrpagination['prev_link'] = $this->config->item('prev_link');
		$this->arrpagination['prev_tag_open'] = $this->config->item('prev_tag_open');
		$this->arrpagination['prev_tag_close'] = $this->config->item('prev_tag_close');
		$this->arrpagination['display_prev_link'] = $this->config->item('display_prev_link');
		$this->arrpagination['cur_tag_open'] = $this->config->item('cur_tag_open');
		$this->arrpagination['cur_tag_close'] = $this->config->item('cur_tag_close');
		$this->arrpagination['num_tag_open'] = $this->config->item('num_tag_open');
		$this->arrpagination['num_tag_close'] = $this->config->item('num_tag_close');
		//$this->arrpagination['base_url'] = $this->data['base_url'] . $this->data['controller_name'] ."/". $this->data['method_name'] ."/";
		$this->arrpagination['base_url'] = $this->data['base_url'] . $this->data['controller_name'] ."/index/";
		$this->arrpagination['total_rows'] = 0;
		$this->arrpagination['per_page'] = 20;
		$this->arrpagination['uri_segment'] = 3;
		
		if($param && is_array($param) && count($param) > 0)
		{

			foreach($param as $key=>$val)
			{
				$this->arrpagination[$key] = $val;
			}
		}
	}
	
	
	public function get_date($time_stamp)
	{
		return date('d/m/Y',$time_stamp);
	}
	
	public function get_timestamp($date_str)
	{
		//d/m/y
		//echo "kkkk>>".$date_str;
		//die();
		if($date_str=="" || $date_str==NULL || $date_str<=0 )
		{
			return '---';
		}
		else if($date_str!="")
		{
			$date_arr=explode("/",$date_str);
			$year=$date_arr[2];
			$month=$date_arr[1];
			$day=$date_arr[0];
			return mktime(0,0,0,$month,$day,$year);
		}
		
		
	}

	

} 

//admin
class  Admin_Controller  extends  CI_Controller
{
	public $view_dir='admin/';
	public $header='';
	public $banner='';
	public $footer='';
	public $data=array();

	function __construct () 
	{
		parent::__construct();
		//code here
		$base_url=base_url();
		if($this->uri->segment(1)=='admin' && $this->uri->segment(2)!='login' && $this->uri->segment(2)!='')
		{
			if(!$this->check_auth())
			{
				redirect('admin/login');
			}
		}
		
		// Setting CSS, JS, Images, Upload Path
		$base_url=base_url();

		$this->data['base_url'] = $base_url;
		$this->data['admin_base_url'] = $base_url.'admin/';
		$this->data['css_path'] = $base_url.$this->config->item('css_path').'admin/';
		$this->data['js_path'] = $base_url.$this->config->item('js_path').'admin/';
		$this->data['jquery_js_path'] = $base_url.$this->config->item('js_path').'jquery/';
		$this->data['images_path'] = $base_url.$this->config->item('images_path').'admin/';
		$this->data['upload_path'] = $base_url.$this->config->item('upload_path');
		
		$this->data['ck_base_url'] = $base_url.$this->config->item('ckeditor_base_url');
		$this->data['ck_base_path'] = $this->config->item('ckeditor_base_path_admin');
		
		$this->data['js_calender_path'] = $base_url.$this->config->item('js_path').'thirdparty/calendar/';
		$this->data['controller_name']=$this->uri->segment('2');
		$this->data['method_name']=$this->uri->segment('3')?$this->uri->segment('3'):'index';
		$this->data['limit'] = 30;
		//
		$arr_st_title['0']='Pending';
		$arr_st_title['1']='Approved';
		$arr_st_title['5']='Deleted';
		$this->data['arr_st_title']=$arr_st_title;

		$this->data['ex_date_format']='&nbsp;(dd/mm/yyyy)';
		
		// Default Email Setting
		$this->data['admin_to_email'] = $this->config->item('admin_to_email');
		$this->data['noreply_email'] = $this->config->item('noreply_email');
		$this->data['noreply_name'] = $this->config->item('noreply_name');
		
		// Loading Header
		$this->data['txt_no_record']='There is no record!!!';
		$this->data['page_title']='Codegator-Backend';
		// Loading Header, Banner, Footer View File
		$this->data['req']=$_REQUEST;
		$this->header = $this->load->view($this->view_dir.'header', $this->data, true);
		$this->footer = $this->load->view($this->view_dir.'footer', $this->data, true);
		$this->data['header'] = $this->header;
		$this->data['footer'] = $this->footer;
	}
	
	public function check_auth()
	{
		if($this->session->userdata('admin_id') > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	
	
		// Function For Pagination Configuration
	function pagination_config($param=array())
	{
		$this->arrpagination['first_link'] = $this->config->item('first_link');
		$this->arrpagination['first_tag_open'] = $this->config->item('first_tag_open');
		$this->arrpagination['first_tag_close'] = $this->config->item('first_tag_close');
		$this->arrpagination['display_first_link'] = $this->config->item('display_first_link');
		$this->arrpagination['last_link'] = $this->config->item('last_link');
		$this->arrpagination['last_tag_open'] = $this->config->item('last_tag_open');
		$this->arrpagination['last_tag_close'] = $this->config->item('last_tag_close');
		$this->arrpagination['display_last_link'] = $this->config->item('display_last_link');
		$this->arrpagination['next_link'] = $this->config->item('next_link');
		$this->arrpagination['next_tag_open'] = $this->config->item('next_tag_open');
		$this->arrpagination['next_tag_close'] = $this->config->item('next_tag_close');
		$this->arrpagination['display_next_link'] = $this->config->item('display_next_link');
		$this->arrpagination['prev_link'] = $this->config->item('prev_link');
		$this->arrpagination['prev_tag_open'] = $this->config->item('prev_tag_open');
		$this->arrpagination['prev_tag_close'] = $this->config->item('prev_tag_close');
		$this->arrpagination['display_prev_link'] = $this->config->item('display_prev_link');
		$this->arrpagination['cur_tag_open'] = $this->config->item('cur_tag_open');
		$this->arrpagination['cur_tag_close'] = $this->config->item('cur_tag_close');
		$this->arrpagination['num_tag_open'] = $this->config->item('num_tag_open');
		$this->arrpagination['num_tag_close'] = $this->config->item('num_tag_close');
		$this->arrpagination['base_url'] = $this->data['base_url'] . $this->data['controller_name'] ."/". $this->data['method_name'] ."/";
		$this->arrpagination['total_rows'] = 0;
		$this->arrpagination['per_page'] = 20;
		$this->arrpagination['uri_segment'] = 3;
		
		if($param && is_array($param) && count($param) > 0)
		{
			foreach($param as $key=>$val)
			{
				$this->arrpagination[$key] = $val;
			}
		}
	}
	
	
	
	
	public function get_date($time_stamp)
	{
		return date('d/m/Y',$time_stamp);
	}
	
	public function get_timestamp($date_str)
	{
		//d/m/y
		//echo "kkkk>>".$date_str;
		//die();
		if($date_str=="" || $date_str==NULL || $date_str<=0 )
		{
			return '---';
		}
		else if($date_str!="")
		{
			$date_arr=explode("/",$date_str);
			$year=$date_arr[2];
			$month=$date_arr[1];
			$day=$date_arr[0];
			return mktime(0,0,0,$month,$day,$year);
		}
		
		
	}

	/*function rec_cat($model_name='dircat_model',$id=0,$sub_cond='AND status<5 order by id asc')
	{
		//before call this functn need to load this model 
		
		$cond=" AND parent_id='$id' $sub_cond ";
		$arr=$this->$model_name->fetch($cond);
		
		if(count($arr)>0)
		{
			foreach($arr as $key=>$val)
			{
				$arr[$key]['sub']=$this->rec_cat($model_name,$val['id'],$sub_cond);
			}
		}
		
		return $arr;
	}


	function multi2single_array($arr)
	{
		
		
		
		$ret_arr=array();
		
		if($arr>0)
		{
			foreach($arr as $key=>$val)
			{
				$temp=$val;
				unset($temp['sub']);
				$temp['pre']='';//for root level
				$ret_arr[]=$temp;
				
				//start- 2
				if(count($val['sub'])>0)
				{
					
					foreach($val['sub'] as $key2=>$val2)
					{
						
						$temp=$val2;
						unset($temp['sub']);
						$temp['pre']='----';//for root level
						$ret_arr[]=$temp;
						
						//start- 3
						if(count($val2['sub'])>0)
						{
							
							foreach($val2['sub'] as $key3=>$val3)
							{
								
								$temp=$val3;
								unset($temp['sub']);
								$temp['pre']='------';//for root level
								$ret_arr[]=$temp;
								
								//start- 4
								if(count($val3['sub'])>0)
								{
									
									foreach($val3['sub'] as $key4=>$val4)
									{
										
										$temp=$val4;
										unset($temp['sub']);
										$temp['pre']='--------';//for root level
										$ret_arr[]=$temp;
										
										//start- 5
										if(count($val4['sub'])>0)
										{
											
											foreach($val4['sub'] as $key4=>$val5)
											{
												
												$temp=$val5;
												unset($temp['sub']);
												$temp['pre']='--------';//for root level
												$ret_arr[]=$temp;
												
														
												//start- 6
												if(count($val5['sub'])>0)
												{
													
													foreach($val5['sub'] as $key6=>$val6)
													{
														
														$temp=$val6;
														unset($temp['sub']);
														$temp['pre']='--------';//for root level
														$ret_arr[]=$temp;
														
														
														
														
													}
												}
												//end- 5
												
												
												
											}
										}
										//end- 5
								
										
										
									}
								}
								//end- 4
								
								
							}
						}
						//end- 3
						
						
					}
				}
				
				//end- 2
					
					
			}
		}
		
		
	
		
			return $ret_arr;
		
		
	}*/


}  
 


