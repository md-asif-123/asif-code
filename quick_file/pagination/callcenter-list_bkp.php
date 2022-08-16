<?php 
	require_once('lib/config.php');
	require_once('lib/header.php');

	if( !$addadmin->isLoggedIn() ):
		header("Location: login.php");
	endif;
	
	if(isset($_GET['pg'])): $pg = $_GET['pg']; else: $pg = 1;endif;
	$dispaly_per_page = 10;
	$start_from = ($pg-1) * $dispaly_per_page;
	
	$sql = "SELECT callcenterreg.id,callcenterreg.code,callcenterreg.city,callcenterreg.fname,callcenterreg.email,callcenterreg.contact_no,callcenterreg.source_id,source.short_url, source.country_code, callcenterreg.country, callcenterreg.addedon FROM `callcenter_registration` as callcenterreg,`source` as source where source.id=callcenterreg.source_id order by callcenterreg.id DESC LIMIT $start_from, $dispaly_per_page";
	$stmt = $dbh->prepare( $sql );
	$stmt->execute();
	 
?>
<div class="container">
	<div class="row">  	
		<div class="col-lg-12 col-md-12 col-sm-12">
			<h3>Call Center Registration List</h3>
			<table class="table table-striped table-hover ">
				<thead>
					<tr>
						<th>#</th> 
						<th>Code</th>
						<th>Name</th>
						<th>Email</th>
						<th>Contact No</th>
						<th>Country</th>
						<th>Source Id</th>
						<th>Short url</th>
						<th>Country Code</th>
						<th>Added On</th>
					</tr>
				</thead>
				<tbody>
				<?php 
				if($stmt->rowCount() > 0):
					$records = $stmt->fetchAll(PDO::FETCH_ASSOC);
					$i=1;
					foreach($records as $record): 
				?>
				<tr>
					<td><?php echo $i; ?></td>
					<td><?php echo $record['code'] ?></td>
					<td><?php echo $record['fname'].' '.$record['lname'].' '.$record['surname'] ?></td>
					<td><?php echo $record['email']; ?></td>
					<td><?php echo $record['contact_no']; ?></td>
					<td><?php echo $record['country']; ?></td>
					<td><?php echo $record['source_id'];?></td>
					<td><?php echo $record['short_url'];?></td>
					<td><?php echo $record['country_code'];?></td>
					<td><?php echo date('M d, Y', strtotime($record['addedon']));?></td>
				</tr>
				<?php 
					$i++;
					endforeach;
				else:
				?>
				<tr>
					<td align="center" colspan="7"><strong>No data found</strong></td>
				</tr>
				<?php
				endif; 
				?>
				</tbody>
			</table> 		
			<?php //Code for Pegination
			$fixedQueryString = 'callcenter-list.php';
			$num_rec_per_page = 10;
			$sql = "SELECT count(id) as total_records FROM `callcenter_registration`";
			$stmt = $dbh->prepare( $sql );
			$stmt->execute();
			$data = $stmt->fetch(PDO::FETCH_ASSOC);
			$total_records = $data['total_records'];
			if($total_records > 0): 
				$block = 10;  
				$total_pages = ceil($total_records / $num_rec_per_page); 
				if($total_pages > 1):
					$return = '';
					if($pg > $block-2):
						// Goto 1st page
						$return .= "<li class=\"first\"><a href='".$_SERVER['PHP_SELF']."?".$fixedQueryString."&pg=1'>".'First'."</a></li>"; 
					endif;
					if($total_pages > $block):     
						if($pg > $block-2):    
							if($pg > $total_pages-3): 
								$prev2 = $total_pages-($block-1); 
								$next2 = $total_pages;
							else:
								$prev2 = $pg-2; 
								$next2 = $pg+2; 
							endif;
						else:    
							$prev2 = 1; 
							$next2 = $block;  
						endif;  
						if($pg > $block-2):   
							$return .= "<li class=\"prev\"><a href='".$_SERVER['PHP_SELF']."?".$fixedQueryString."&pg=".($pg-1)."'>...Prev</a></li>"; 
						endif;
						for ($i=1; $i<=$total_pages; $i++):    
							if($i >= $prev2 and $i <= $next2):
								$i == $pg ? $active = 'class="active"' : $active = ''; 
								$return .= "<li ".$active."><a href='".$_SERVER['PHP_SELF']."?".$fixedQueryString."&pg=".$i."'>".$i."</a></li>"; 
							endif;
						endfor;
						if($total_pages > $block and $pg < $total_pages-2):   
							$return .= "<li class=\"next\"><a href='".$_SERVER['PHP_SELF']."?".$fixedQueryString."&pg=".($pg+1)."'>Next...</a></li>"; 
						endif;
					else: 
						for ($i=1; $i<=$total_pages; $i++):  
							$return .= "<li><a href='".$_SERVER['PHP_SELF']."?".$fixedQueryString."&pg=".$i."'>".$i."</a></li>"; 
						endfor;
					endif;
					if($total_pages > $block and $pg < $total_pages-2):
						// Goto last page
						$return .= "<li class=\"last\"><a href='".$_SERVER['PHP_SELF']."?".$fixedQueryString."&pg=$total_pages'>".'Last'."</a></li>";
					endif;
					echo "<p class='resultCounter'>Showing 1 to ".$num_rec_per_page." of <strong>".$total_records." records </strong></p>".'<nav><ul class="pagination">'.$return.'</ul></nav>';
				endif;
			endif;
			// End Of Pagination 
			?>
		</div>
	</div>
</div>
<?php require_once('lib/footer.php');