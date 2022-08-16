<html>
        <head>
                <title>CodeIgniter Tutorial</title>
				<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/style.css">
        </head>
        <body>
                
                <div id='c'><h1>simple header</h1></div>
				<img src="<?php echo base_url(); ?>pic/grape.jpg">
				<?php
				echo heading('Welcome!', 3);
				echo img('application/views/templates/grape.jpg');
				$image_properties = array(
        'src'   => 'application/views/templates/grape.jpg',
        
        'width' => '200',
        'height'=> '200',
        
);

echo img($image_properties);
                ?>				
				</body>
				</html>