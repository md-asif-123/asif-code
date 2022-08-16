
<script src="<?php echo base_url(); ?>assets/js/validation.js" type="application/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery-1.10.2.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
<script>
	$(document).ready(function(){
	  

   // Document is ready

   $("#search").keyup(function()
   
   {
		
		var isTyping = $('#search').val();
		$.ajax({
          type: "post",
          url: "http://192.168.0.74/chl/backend/index/product_list",
		  
          data:{key:isTyping},
          dataType: "text",
		  
		
		  
          success: function(result)
          {
			  
			 $('#tdiv').hide();
			  $('#tdiv1').html(result);
          }
		   
       });
	  

   });

   $("#save_value").click(function (e) 
   {
	
		 var final = [];
    $('#chk:checked').each(function(){
        
      
			
             final.push($(this).val());
                        
	
		
    });
   
	
	$.ajax({
          type: "post",
          url: "http://192.168.0.74/chl/backend/index/code_generate",
		  
          data:{id:final},
          dataType: "text",
		  
		
		  
          success: function(result)
          {
			  
			 
           $('#tdiv').show();
           $('#tdiv').html(result);
			  
          }
		   
       });
	  

   });

	});
</script>

    
   
    







<table class="table table-striped" style="font-size:14px;">
	
	<p style="color:green;text-align:center;"><?php echo $this->session->flashdata('successs_msg'); ?></p>
      <thead>
          <tr>
		  <th></th>
		  
		  <th>ID</th>
          <th>Title</th>
		 
            <th>Image</th>
			<th>Description</th>
			<th>Category</th>
			
			
			<th>Action</th>
			</tr>
        </thead>
        <tbody>
          
		
        </tbody>
		
</table>
      <h1><center>No data found!Sorry...</center></h1>
	  <?php
	   exit;
	  ?>
