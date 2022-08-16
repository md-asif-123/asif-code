<body>
	<div class="container">
    <div style="color:red;"><?php echo validation_errors(); ?></div>

<form action="<?php echo base_url();?>api/api_enquiry" method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label for="exampleInputname">Name</label>
		<span class="fa fa-user icon"></span>
		<input type="text" name="name" value="<?php echo set_value('name'); ?>" class="form-control form-paddding" id="exampleInputEmail1" placeholder="Name">
	</div>
	
	
	<div class="form-group">
		<span class="fa fa-envelope icon"></span>
		<label for="exampleInputEmail1">Email address</label>
		<input type="text" name="email" value="<?php echo set_value('email'); ?>" class="form-control form-paddding" id="exampleInputEmail1" placeholder="Enter email">
	</div>
	
	
	<div class="form-group">
		<span class="fa fa-envelope icon"></span>
		<label for="exampleInputEmail1">Website </label>
		<input type="text" name="website" value="<?php echo set_value('website'); ?>" class="form-control form-paddding" id="exampleInputEmail1" placeholder="Enter website : http://www.google.com">
	</div>
	
	
    <div class="form-group">
		<span class="fa fa-phone icon"></span>
		<label for="exampleInputname">Telephone</label>
		<input type="text" name="telephone" value="<?php echo set_value('telephone'); ?>" class="form-control form-paddding" id="exampleInputphone" placeholder="Telephone">
	</div>
	
	
	
	<div class="form-group">
		<span class="fa fa-envelope icon"></span>
		<label for="exampleInputEmail1">Fax</label>
		<input type="text" name="fax" value="<?php echo set_value('fax'); ?>" class="form-control form-paddding" id="exampleInputEmail1" placeholder="Enter fax">
	</div>
	
	
	<div class="form-group">
		<span class="fa fa-envelope icon"></span>
		<label for="exampleInputEmail1">Mobile</label>
		<input type="text" name="mobile" value="<?php echo set_value('mobile'); ?>" class="form-control form-paddding" id="exampleInputEmail1" placeholder="Enter mobile">
	</div>
 
   <div class="form-group">
		<label for="exampleInputname">Country</label>
		<span class="fa fa-archive icon"></span>
		<select name="country" class="form-control form-margin">
			<option value="0" class="form-paddding">Select Country</option>
		<?php
		foreach($country->result() as $row)
		{
		?>
			<option value="<?php echo $row->score;?>" class="form-paddding"><?php echo ucfirst($row->name);?> </option>
			
			
			<?php }?>
	
		</select>
    </div>
	
  
    <div class="form-group">
		<span class="fa fa-building icon"></span>
		<label for="exampleInputname">Company Name</label>
		<input type="text" name="companyname" value="<?php echo set_value('companyname'); ?>" class="form-control form-paddding" id="exampleInputEmail1" placeholder="Company Name">
	</div>
  
  
	<div class="form-group">
		<label for="exampleInputname">Select Industry</label>
		<span class="fa fa-archive icon"></span>
		<select name="industry" class="form-control form-margin">
			<option value="0" class="form-paddding">Select Indusry</option>
			<?php
		foreach($industry->result() as $row)
		{
		?>
			<option value="<?php echo $row->score;?>" class="form-paddding"><?php echo ucfirst($row->name);?> </option>
			
			
			<?php }?>
	
		</select>
    </div>

		
	<div class="form-group">
		<label for="exampleInputname">Business Type</label>
		<span class="fa fa-archive icon"></span>
		<select name="businesstype" class="form-control form-margin">
			<option value="0" class="form-paddding">Select Business Type</option>
		<?php
		foreach($results->result() as $row)
		{
		?>
			
			<option value="<?php echo $row->score;?>" class="form-paddding"><?php echo ucfirst($row->name);?> </option>
		<?php }?>
	
		</select>
    </div>
	
	
	<div class="form-group">
		<span class="fa fa-building icon"></span>
		<label for="exampleInputname">Unit Price</label>
		<input type="text" name="unitprice" value="<?php echo set_value('unitprice'); ?>" class="form-control form-paddding" id="exampleInputEmail1" placeholder="Unit price : 10 USD">
	</div>
	
	
	<div class="form-group">
	
	<?php foreach($needsample->result() as $row)
		{
		$end = $row->score;
		$my_value[]=$row->score;
		}
		
		$value1=$my_value[0];
		$value2=$my_value[1];
		
		?>
		
		<label for="exampleInputname">Do you need sample</label>
		
                      <div class="radio">
                        <label>
                          <input type="radio" checked="" value="<?php echo $value1?>" id="optionsRadios1" name="needsample">
                          Yes
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input type="radio" value="<?php echo $value2?>" id="optionsRadios2" name="needsample">
                          No
                        </label>
                      </div>
                   
	</div>
	
	
	<div class="form-group">
		<label for="exampleInputname">Attached</label>
		<input type="file" name="userfile" value=""  id="exampleInputEmail1">
	</div>
	
	<div class="form-group" style="display:none;">
		<span class="fa fa-building icon"></span>
		<label for="exampleInputname">User history</label>
		<input type="hidden" name="userhistory" value="1" class="form-control form-paddding" id="exampleInputEmail1" placeholder="Enter user history">
	</div>
	
	<div class="form-group" style="display:none;">
		<span class="fa fa-building icon"></span>
		<label for="exampleInputname">Data source</label>
		<input type="hidden" name="datasource" value="<?php echo set_value('datasource'); ?>" class="form-control form-paddding" id="exampleInputEmail1" placeholder="Enter data source">
	</div>
	
	<div style="clear:both;"></div>
    
    <div class="form-group">
	<label for="exampleInputname">Comments</label>
		<textarea name="comments" value="" class="form-control" rows="3"></textarea>
	</div>
 
	<input type="submit" name="submit" value="Submit" class="btn btn-default"/>

</form>

