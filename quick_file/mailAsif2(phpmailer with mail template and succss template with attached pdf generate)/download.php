<?php

//require_once('config.php');	
	//error_reporting(E_ALL);
require_once('class.chip_download.php');

		$file = 'CIN023597.pdf';
		
		$download_path = "C:/xampp/htdocs/mailAsif2/badge/";
		$args = array(
			'download_path'     =>   $download_path,
			'file'              =>   $file,
			'extension_check'   =>   true,
			'referrer_check'    =>   FALSE,
			'referrer'          =>   NULL
			);
		$download = new chip_download( $args );
		$download_hook = $download->get_download_hook();
		
		//$download_hook['download'] = TRUE ;
		if( $download_hook['download'] == TRUE ):
			$download->get_download();
		endif;
	