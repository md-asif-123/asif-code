<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>List</title>
<link href="<?php echo base_url(); ?>css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>css/font-awesome.min.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>css/style1.css" rel="stylesheet">
</head>
<?php $sess_userdata = $this->session->all_userdata('newdata');?>
<body>


	<table class="table table-striped">
        <thead>
          <tr>
            
            <th>Name</th>
            <th>User ID</th>
            <th>Password</th>
			<th>Registered On</th>
          </tr>
        </thead>
        <tbody>
          
		  <?php
		foreach($h->result() as $row)
		{?>
            <tr><td><a href='viewprofile?id=<?php echo $row->admin_id;?>'><?php echo $row->name;?></a></td><td><?php echo $row->user_id;?></td><td><?php echo $row->password;?></td><td><?php echo $row->registered_on;?></td></tr> 
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
