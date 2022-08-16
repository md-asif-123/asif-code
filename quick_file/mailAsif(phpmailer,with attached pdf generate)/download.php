<?php

require_once('config.php');	
require_once('function.php');	
require_once('class.chip_download.php');

		$file = 'asif.pdf';
		
		$download_path = "mailAsif/";
		$args = array(
			'download_path'     =>   $download_path,
			'file'              =>   $file,
			'extension_check'   =>   true,
			'referrer_check'    =>   FALSE,
			'referrer'          =>   NULL
			);
		$download = new chip_download( $args );
		$download_hook = $download->get_download_hook();
		if( $download_hook['download'] == TRUE ):
			$download->get_download();
		endif;
