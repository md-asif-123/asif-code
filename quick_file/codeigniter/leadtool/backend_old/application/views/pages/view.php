<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>View</title>
<link href="<?php echo base_url(); ?>css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>css/font-awesome.min.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>css/style1.css" rel="stylesheet">
</head>

<body>
<h3>Your form is successfully submitted</h3>

	<table class="table table-striped">
        <thead>
          <tr>
            <th>#</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Username</th>
          </tr>
        </thead>
        <tbody>
          
		  <?php
		foreach($h->result() as $row)
		{?>
            <tr><td><?php echo $row->id;?></td><td><a href='viewprofile?id=<?php echo $row->id;?>'><?php echo $row->name;?></a></td><td><?php echo $row->phone;?></td><td><?php echo $row->email;?></td></tr> 
         <?php   
		}
			?>
          
		 
         
        </tbody>
      </table>
      
</div>
      
      <a class="btn btn-default" href="#">Pre</a>
      <a class="btn btn-default" href="#">1</a>
      <a class="btn btn-default" href="#">2</a>
      <a class="btn btn-default" href="#">3</a>
      <a class="btn btn-default" href="#">Next</a>
</body>
</html>
<script src="<?php echo base_url(); ?>js/jquery-1.10.2.js" type="application/javascript"></script>
	<script src="<?php echo base_url(); ?>js/bootstrap.min.js" type="application/javascript"></script>
