	<table class="table table-striped" style="font-size:14px;">
        <thead>
          <tr>
           
            <th></th>
            <th>Name</th>
            <th>Score</th>
			<th>Action</th>
          </tr>
        </thead>
        <tbody>
		
		<?php
		foreach($results->result() as $row)
		{?>
          <tr>
           
            <td></td>
            <td><?php echo $row->name;?></td>
            <td><?php echo $row->score;?></td>
			<td><a href='<?php echo base_url(); ?>score/edit/<?php echo $row->id;?>'>
			
			<img src='<?php echo base_url(); ?>assets/images/btn_edit.gif'></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			</td>
          </tr>
         
		<?php }?>
		  
         
        </tbody>
      </table>
         
</div>
      
