<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>List</title>
<link href="<?php echo base_url(); ?>css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>css/font-awesome.min.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>css/style1.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>assets/js/validation.js" type="application/javascript"></script>
</head>
<?php $sess_userdata = $this->session->all_userdata('newdata');?>
<body>


	<table class="table table-striped">
        <thead>
		<p style="color:green"><?php echo $this->session->flashdata('success_message'); ?></p>
          <tr>
            
            
            <th>Email</th>
            <th>Password</th>
			<th>Smtp</th>
            <th>Smtp Port</th>
			<th>Pop</th>
            <th>Pop Port</th>
			<th>Imap</th>
            <th>Imap Port</th>
			<th>Registered On</th>
			<th>Action</th>
          </tr>
        </thead>
        <tbody>
          
		  <?php
		foreach($results as $row)
		{?>
            <tr><td><?php echo $row->email;?></td><td><?php echo $row->email_password;?></td><td><?php echo $row->smtp;?></td>
			<td><?php echo $row->smtp_port;?></td><td><?php echo $row->pop;?></td>
			<td><?php echo $row->pop_port;?></td><td><?php echo $row->imap;?></td>
			<td><?php echo $row->imap_port;?></td><td><?php echo $row->added_on;?></td>
			<td><a href='<?php echo base_url(); ?>email/edit_email/<?php echo $row->id;?>'>
			<img src='<?php echo base_url(); ?>assets/images/btn_edit.gif'></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a href='<?php echo base_url(); ?>email/delete_email?id=<?php echo $row->id;?>' onclick="return doDelete();">
			<img src='<?php echo base_url(); ?>assets/images/btn_remove.gif'></a></td>
			</tr> 
         <?php   
		}
			?>
          
		 
         
        </tbody>
      </table>
      
</div>
      
     <br><br>
      <center><h4><?php echo $links; ?></h4></center>
</body>
</html>
<script src="<?php echo base_url(); ?>js/jquery-1.10.2.js" type="application/javascript"></script>
<script src="<?php echo base_url(); ?>js/bootstrap.min.js" type="application/javascript"></script>
