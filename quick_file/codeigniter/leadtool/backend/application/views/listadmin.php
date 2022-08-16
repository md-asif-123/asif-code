<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>List</title>
<link href="<?php echo base_url(); ?>css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>css/font-awesome.min.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>css/style1.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>assets/js/validation.js" type="application/javascript"></script>
</head>
<body>

<table class="table table-striped" style="font-size:14px;">
	<form name="regForm" id="regForm" action="<?php echo base_url();?>index/delete_usercheck" method="post">
	<p style="color:green"><?php echo $this->session->flashdata('success_msg'); ?></p>
      <thead>
          <tr>
		  <th></th>
		  <th><input type='checkbox' name='check' onclick="checkedAll(regForm);" /></th>
          <th>Name</th>
            <th>Email</th>
			<th>Phone</th>
			<th>Country</th>
			<th>Detected language</th>
			<th>Message</th>
			<th>Score</th>
			<th>Action</th>
			</tr>
        </thead>
        <tbody>
          
		<?php
		
		if($total_rows!='0'){
		foreach($results as $data)
		{
			?>
			<tr>
			<td></td>
			<td><input type="checkbox" name="list[]" value="<?php echo $data->id; ?>" /></td>
			<td><?php echo $data->name;?></td>
			<td><?php echo $data->email;?></td>
			<td><?php echo $data->tele_phone;?></td>
			<td><?php echo $data->country;?></td>
			<td><span class="label label-danger">
			
			<?php  
			$dl=$data->detected_languagecode;
			if($dl==''){
				echo "ND";}
			else{
			echo $dl;
			}
			?>
			</span>
			&nbsp;&nbsp;&nbsp;<span class="label label-success"><?php echo $data->manual_languagecode;?></span>
			</td>
			<td>
			<?php $com=$data->comments;?>
			<?php echo substr("$com",0,35);?>...</td>
			<td>
			<?php 
			
			 $a1 = $data->score_country;
			 $a2= $data->score_industry;
			 $a3 = $data->score_companyname;
			 $a4 = $data->score_businesstype;
			 $a5 = $data->score_contactinformation;
			 $a6 = $data->score_enquiredescription;
			 $a7 = $data->score_unitprice;
			 $a8 = $data->score_sample;
			 $a9 = $data->score_attachedment;
			 $a10 = $data->score_userhistory;
			 $a11 = $data->score_datasource;
			echo $total=$a1+$a2+$a3+$a4+$a5+$a6+$a7+$a8+$a9+$a10+$a11;
			
			?>
			</td>
			<td><a href='<?php echo base_url(); ?>index/edit_user/<?php echo $data->id;?>'>
			<img src='<?php echo base_url(); ?>assets/images/btn_edit.gif'></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a href='<?php echo base_url(); ?>index/delete_user?id=<?php echo $data->id;?>' onclick="return doDelete();">
			<img src='<?php echo base_url(); ?>assets/images/btn_remove.gif'></a></td>
			</tr> 
         <?php   
		}
		
		}
		else {
			echo "No data found";
		}
		?>
        </tbody>
		
</table>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="submit" value='Delete' onclick="return checkboxes();" class="btn btn-default" />
	  </form> 
	</div>
      
       <br><br>
      <center><h4><?php echo $links; ?></h4></center>
   </body>
</html>
<script src="<?php echo base_url(); ?>js/jquery-1.10.2.js" type="application/javascript"></script>
<script src="<?php echo base_url(); ?>js/bootstrap.min.js" type="application/javascript"></script>
