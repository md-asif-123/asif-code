



<body>
	<div class="container">
    <?php echo validation_errors(); ?>
	 <?php
		foreach($h->result() as $row)
		{?>
	<form action="<?php echo base_url();?>email/edit_email/<?php echo $row->id;?>" method="post">
  
  
    <div class="form-group">
    <span class=""></span>
    <label for="exampleInputEmail1">Email</label>
    <input type="text" name="email" value="<?php echo $row->email;?>" class="form-control form-paddding" id="exampleInputEmail1" placeholder="Enter email">
  </div>
  
    <div class="form-group">
    <span class=""></span>
    <label for="exampleInputPassword">Password</label>
    <input type="password" name="email_password" value="<?php echo $row->email_password;?>" class="form-control form-paddding" id="exampleInputPassword" placeholder="Password">
  </div>
  <div class="form-group">
    <label for="exampleInputname">Smtp</label>
    <span class=""></span>
    <input type="text" name="smtp" value="<?php echo $row->smtp;?>" class="form-control form-paddding" id="exampleInputEmail1" placeholder="Smtp">
  </div>
  
    <div class="form-group">
    <span class=""></span>
    <label for="exampleInputEmail1">Smtp Port</label>
    <input type="text" name="smtp_port" value="<?php echo $row->smtp_port;?>" class="form-control form-paddding" id="exampleInputEmail1" placeholder="Smtp Port">
  </div>
  <div class="form-group">
    <label for="exampleInputname">Pop</label>
    <span class=""></span>
    <input type="text" name="pop" value="<?php echo $row->pop;?>" class="form-control form-paddding" id="exampleInputEmail1" placeholder="Pop">
  </div>
  
    <div class="form-group">
    <span class=""></span>
    <label for="exampleInputEmail1">Pop Port</label>
    <input type="text" name="pop_port" value="<?php echo $row->pop_port;?>" class="form-control form-paddding" id="exampleInputEmail1" placeholder="Pop Port">
  </div>
  
  <div class="form-group">
    <label for="exampleInputname">Imap</label>
    <span class=""></span>
    <input type="text" name="imap" value="<?php echo $row->imap;?>" class="form-control form-paddding" id="exampleInputEmail1" placeholder="Imap">
  </div>
  
    <div class="form-group">
    <span class=""></span>
    <label for="exampleInputEmail1">Imap Port</label>
    <input type="text" name="imap_port" value="<?php echo $row->imap_port;?>" class="form-control form-paddding" id="exampleInputEmail1" placeholder="Imap Port">
  </div>
    <div class="form-group">
    <span class=""></span>
    <label for="exampleInputPassword">Value</label>
    <input type="password" name="value" value="<?php echo $row->value;?>" class="form-control form-paddding" id="exampleInputPassword" placeholder="Value">
  </div>
  
      <div class="form-group">
    <span class=""></span>
    <label for="">Status</label><br>
     <input type="radio" name="work" value="Y" <?php echo ($row->status=='1')?'checked':'' ?>>Yes
	<input type="radio" name="work" value="N" <?php echo ($row->status=='0')?'checked':'' ?>>No
  </div>
 
  <input type="submit" name="submit" class="btn btn-default" value="Submit"/>
</form>

    
    <?php   
		}
			?>
    </div>
    
	<script src="<?php echo base_url(); ?>js/jquery-1.10.2.js" type="application/javascript"></script>
    <script src="<?php echo base_url(); ?>js/bootstrap.min.js" type="application/javascript"></script>
    
</body>
</html>


















