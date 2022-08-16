<html>
        <head>
                <title>CodeIgniter Tutorial</title>
				<?php
				echo link_tag('application/views/templates/style.css');
				?>
        </head>
        <body>
                
                <div id='c'><h1>simple header</h1></div>
				<img src='pic\grape.jpg'>
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