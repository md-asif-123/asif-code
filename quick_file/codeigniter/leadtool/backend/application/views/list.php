<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>List</title>
<link href="<?php echo base_url(); ?>css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>css/font-awesome.min.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>css/style1.css" rel="stylesheet">
</head>

<body>


	<table class="table table-striped">
        <thead>
          <tr>
            <th>&nbsp;</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Username</th>
          </tr>
        </thead>
        <tbody>
          
		  
		  
		  <?php
		foreach($h->result() as $row)
		{?>
            <tr><td>&nbsp;</td>
			<td><a href='viewuser_profile/<?php echo $row->id;?>'><?php echo $row->name;?></a></td>
			<td><?php echo $row->tele_phone;?></td><td><?php echo $row->email;?></td>
			<td><a href='<?php echo base_url(); ?>index/edit_user/<?php echo $data->id;?>'>
			<img src='<?php echo base_url(); ?>assets/images/btn_edit.gif'></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a href='<?php echo base_url(); ?>index/delete_user?id=<?php echo $data->id;?>' onclick="return doDelete();">
			<img src='<?php echo base_url(); ?>assets/images/btn_remove.gif'></a></td>
			</tr> 
         <?php   
		}
			?>
          
		 
         
        </tbody>
      </table>
      
</div>
      
      <a class="btn btn-default" href="#">Pre</a>
      <a class="btn btn-default" href='pagination?page=1'>1</a>
      <a class="btn btn-default" href='pagination?page=2'>2</a>
      <a class="btn btn-default" href="#">3</a>
      <a class="btn btn-default" href="#">Next</a>
</body>
</html>
<script src="<?php echo base_url(); ?>js/jquery-1.10.2.js" type="application/javascript"></script>
	<script src="<?php echo base_url(); ?>js/bootstrap.min.js" type="application/javascript"></script>
