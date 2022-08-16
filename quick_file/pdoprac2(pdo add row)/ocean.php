<?php
/**
 * The template for displaying pages
 * Template Name: Ocean Freight Form
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Lsr_Design
 * @since Lsr Design 1.0
 */
get_header(); 
if($_POST['sub'])
{		
		foreach($_POST['unittype'] as $key => $value)
		{
		  $unittype .= '<p>'.$value.'</p>';
		  $unittype.= "\n";
		}
		
		$ofunits='';
		foreach($_POST['ofunits'] as $key => $value)
		{
		   $ofunits .= '<p>'.$value.'</p>';
		   $ofunits .= "\n";
		}
		$descriptioncommodity='';
		foreach($_POST['descriptioncommodity'] as $key => $value)
		{
		  $descriptioncommodity .= '<p>'.$value.'</p>';
		  $descriptioncommodity .= "\n";
		}
		
		$class='';
		foreach($_POST['class'] as $key => $value)
		{
		  $class .= '<p>'.$value.'</p>';
		  $class .= "\n";
		}
		$ofpieces='';
		foreach($_POST['ofpieces'] as $key => $value)
		{
		  $ofpieces .= '<p>'.$value.'</p>';
		  $ofpieces .= "\n";
		}

		foreach($_POST['weight_unit'] as $key => $value)
		{
		  $weightunit .= '<p>'.$value.'&nbsp;</p>';
		  $weightunit .= "\n";
		}
		
				
		foreach($_POST['weight'] as  $value)
		{
		  $weight .= '<p>'.$value.'&nbsp;</p/>';
		  $weight .= "\n";
		  
		 
		}
		
		foreach($_POST['l'] as $key => $value)
		{
		  $length.= '<p>'.$value.'&nbsp;*</p>';
		  $length.= "\n";
		}
		foreach($_POST['ww'] as $key => $value)
		{
		  $width.= '<p>'.$value.'&nbsp;*</p>';
		  $width.= "\n";
		}
		
		foreach($_POST['h'] as $key => $value)
		{
		  $height.= '<p>'.$value.'&nbsp;</p>';
		  $height.= "\n";
		}
		
		foreach($_POST['de_unit'] as $key => $value)
		{
		  $deunit.= '<p>'.$value.'&nbsp;</p>';
		  $deunit.= "\n";
		}
		
		foreach($_POST['stackable_unit'] as $key => $value)
		{
		  $stackable.= '<p>'.$value.'&nbsp;</p>';
		  $stackable.= "\n";
		}
		foreach($_POST['hazmat_unit'] as $key => $value)
		{
		  $hazmat.= '<p>'.$value.'&nbsp;</p>';
		  $hazmat.= "\n";
		}
		  
		
		
		$weight="<table>
		<tr>
		<td>$weight</td>
		<td>$weightunit</td>
		</tr>
		</table>";
		
		$dim="<table>
		<tr>
		<td>$length</td>
		<td>$width</td>
		<td>$height</td>
		<td>$deunit</td>
		</tr>
		</table>";
		
		
		
		$unittypes="<table border='1px' style='font-size:13px; border:1px solid #000; color:#000;'>
		<tr>
		
		<td>Unit Type</td>
		<td># Of Unit </td>
		<td>Description/Comodity  </td>
		<td>Class</td>
		<td># Of pieces </td>
		<td>Weight</td>
		<td>Dimension </td>
		<td>Stackable </td>
		<td>Hazmat </td>
		</tr>
		<tr>
		
		<td>$unittype</td>
		<td>$ofunits</td>
		<td>$descriptioncommodity</td>
		<td>$class</td>
		<td>$ofpieces</td>
		<td>$weight</td>
		<td>$dim</td>
		<td>$stackable </td>
		<td>$hazmat</td>
		
		</tr>
		</table>";
		
		
		$to = 'freight@lowshiprate.com';
		$subject = 'Mail From Lowshiprate Ground Freight Form';
		$from = 'freight@lowshiprate.com';

		// To send HTML mail, the Content-type header must be set

		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

		// Create email headers

		$headers .= 'From: '.$from."\r\n".

			'Reply-To: '.$from."\r\n" .

			'X-Mailer: PHP/' . phpversion();

		
		// Compose a simple HTML email message

		$message = '<html><body>';
		$message .= '<h3><p style="color:#000;">Name : '.$_POST['fname'].'</p>';
		$message .= '<p style="color:#000;">Telephone : '.$_POST['mobile'].'</p>';
		$message .= '<p style="color:#000;">Email : '.$_POST['email'].'</p>';
		$message .= '<h3 style="color:#f40;">ORIGIN</h1>';
		$message .= '<p style="color:#000;">City zip : '.$_POST['cityzip'].'</p>';
		$message .= '<p style="color:#000;"><b>Site Type</b> : '.$_POST['st1'].','.$_POST['st2'].'</p>';
		$message .= '<p style="color:#000;"><b>Pick Date</b> : '.$_POST['date'].'</p>';
		$message .= '<p style="color:#000;"><b>Non commercial pickup site</b> : '.$_POST['originnonecomm'].'</p>';
		$message .= '<p style="color:#000;"><b>Accessorials</b> : '.$_POST['originaccessional1'].','.$_POST['originaccessional2'].'</p>';
	$message .= '<p style="color:#000;"><b>Origin Country</b> : '.$_POST['country1'].'</p>';		
	
		

                 $message .= '<h3 style="color:#f40;">DESTINAION</h1>';
		$message .= '<p style="color:#000;"><b>City zip</b> : '.$_POST['destinycityzip'].'</p>';
		$message .= '<p style="color:#000;"><b>Site Type</b> : '.$_POST['std1'].','.$_POST['std2'].'</p>';
		$message .= '<p style="color:#000;"><b>Date Pickup</b> : '.$_POST['destinationpickdate'].'</p>';
		$message .= '<p style="color:#000;"><b>None commercial delivery site</b> : '.$_POST['nonecommercialdeliverysite'].'</p>';
		$message .= '<p style="color:#000;"><b>Accessorials</b> : '.$_POST['originaccessional_dest1'].','.$_POST['originaccessional_dest2'].'</p>';
                $message .= '<p style="color:#000;"><b>Destination Country</b> : '.$_POST['country2'].'</p>';		
                $message .= '<p style="color:#000;">'.$_POST['port'].'</p>';		

		$message .= '<h3 style="color:#f40;">LCL Details</h1>';
                $message .= '<p style="color:#000;">'.$unittypes.'</p>';
		$message .= '<h3 style="color:#f40;">ADDITIONAL</h1>';
		$message .= '<p style="color:#000;"><b>Insurance</b> : '.$_POST['neworused'].'</p>';
		$message .= '<p style="color:#000;"><b>Value of goods</b> : '.$_POST['valueof'].'</p>';
		$message .= '<p style="color:#000;"><b>Extreme Length</b> : '.$_POST['length'].'</p>';
		$message .= '<p style="color:#000;"><b>#Bundles</b> : '.$_POST['boundles'].'</p>';
                $message .= '<h3 style="color:#f40;">FCL Details</h1>';
                $message .= '<p style="color:#000;"><b>Class</b> : '.$_POST['standard'].'</p>';
                $message .= '<p style="color:#000;"><b>Description/Commodity</b> : '.$_POST['descriptioncommodity2'].'</p>';
                $message .= '<p style="color:#000;">'.$_POST['haz_unit'].'</p>';
                $message .= '<p style="color:#000;"><b>Insurance</b> :'.$_POST['neworuse'].'</p>';
                $message .= '<p style="color:#000;">'.$_POST['valueof1'].'</p>';
		
		$message .= '</body></html>';

	 
		// Sending email

		if(mail($to, $subject, $message, $headers)){

			$msg='Your mail has been sent successfully.';

		} else{

			$msg='Unable to send email. Please try again.';

		}
}
?>
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/jquery-ui.css">
<script src="<?php bloginfo('template_directory'); ?>/js/jquery-1.10.2.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/jquery-ui.js"></script>	
<script>

$(function() {
	$( "#datepicker" ).datepicker({
		showOn: "button",
		buttonImage: "<?php bloginfo('template_directory'); ?>/img/date.jpg",
		buttonImageOnly: true
	});
	 $( "#datepicker1" ).datepicker({
		showOn: "button",
		buttonImage: "<?php bloginfo('template_directory'); ?>/img/date.jpg",
		buttonImageOnly: true
	});
});

$(document).ready(function(){
	var i=3;
	var j=4;
	$('.plusbtn').click(function() {
	
$("#test").append('<tr><td><select class="form-control border-none arrow-img" name="unittype[]"><option value="0">SELECT</option><option value="Pallets(40*48)">Pallets(40*48)</option><option value="Pallets(non-standard)">Pallets(non-standard)</option><option value="Bags">Bags</option><option value="Bales">Bales</option><option value="Boxes">Boxes</option><option value="Bunches">Bunches</option><option value="Carpet">Carpet</option><option value="Coils">Coils</option><option value="Crates">Crates</option><option value="Cylinders">Cylinders</option><option value="Drums">Drums</option><option value="Pails">Pails</option><option value="Reels">Reels</option><option value="Rolls">Rolls</option><option value="Tubes/Pipes">Tubes/Pipes</option><option value="(loose)">(loose)</option><option value="Bundles">Bundles</option><option value="Tote(4*4)">Tote(4*4)</option></select></td><td><input type="text" class="form-control border-none" name="ofunits[]" id="exampleInputEmail1" placeholder="Of Units"></td><td><input type="text" class="form-control border-none" id="exampleInputEmail1" placeholder="Description" name="descriptioncommodity[]"></td><td style="width:8%"><select class="form-control border-none arrow-img" name="class[]"><option value="">SELECT</option><option value="00">00</option><option value="50">50</option><option value="55">55</option><option value="60">60</option><option value="65">65</option><option value="70">70</option><option value="77">77</option><option value="85">85</option><option value="92">92</option><option value="100">100</option><option value="110">110</option><option value="125">125</option><option value="150">150</option><option value="175">175</option><option value="200">200</option><option value="250">250</option><option value="300">300</option><option value="400">400</option><option value="500">500</option></select></td><td><input type="text" name="ofpieces[]" class="form-control border-none" id="exampleInputEmail1" placeholder="Of Pieces"></td><td><input class="form-control border-none" id="exampleInputEmail1" name="weight[]" placeholder="Weigh" style="width: 60%;float: left;" type="text"><input id="'+i+'WEIGHT_unit_text" type="hidden" name="weight_unit[]" /><ul><li id="de-li"><button class="butt" id="'+i+'WEIGHT_unit1" onClick=\'selectedButtonS("'+i+'WEIGHT_unit1","LB","'+i+'WEIGHT_unit",2); return false\'>LB</button></li><li id="de-li"><button class="butt" id="'+i+'WEIGHT_unit2" onClick=\'selectedButtonS("'+i+'WEIGHT_unit2","KG","'+i+'WEIGHT_unit",2); return false\'>KG</button></li></ul></td><td style="width:12%;"><input id="'+i+'DE_unit_text" type="hidden" name="de_unit[]" /><ul><li id="de-li"><input type="text" id="" name="l[]" class="form-control border-none" placeholder="L" ></li><li id="de-li"><input type="text" id="" name="ww[]" class="form-control border-none" placeholder="W" ></li><li id="de-li"><input type="text" id="" name="h[]" class="form-control border-none" placeholder="H"></li><li id="de-li"><button class="butt" id="'+i+'DE_unit1" onClick=\'selectedButtonS("'+i+'DE_unit1","IN","'+i+'DE_unit",2); return false\'>IN</button></li><li id="de-li"><button class="butt" id="'+i+'DE_unit2" onClick=\'selectedButtonS("'+i+'DE_unit2","CM","'+i+'DE_unit",2); return false\'>CM</button></li></ul></td><td><input id="'+i+'STACKABLE_unit_text" type="hidden" name="stackable_unit[]" /><ul><li id="one-li" style="width:100%"><button class="butt" id="'+i+'STACKABLE_unit1" onClick=\'selectedButton("'+i+'STACKABLE_unit1","STACKABLE","'+i+'STACKABLE_unit",1); return false\'>STACKABLE</button></li></ul></td><td><input id="'+i+'HAZMAT_unit_text" type="hidden" name="hazmat_unit[]" /><ul><li id="one-li" style="width:100%"><button class="butt" id="'+i+'HAZMAT_unit1" onClick=\'selectedButton("'+i+'HAZMAT_unit1","HAZMAT","'+i+'HAZMAT_unit",1); return false\'>HAZMAT</button></li></ul></td></tr>');
i++;j++;
	});
$('.minusbtn').click(function() {
if($("#test tr").length > 1)
	{
		$("#test tr:last-child").remove();
	}

});

$("#extreme_length22").click(function() {
   $("#sub6").show();
   $("#sub5").hide();
});

$("#extreme_length11").click(function() {
   $("#sub6").hide();
   $("#sub5").show();
});
});

function selectedButton(id,value,group_name,total_element){
	var i = 1;
	for(i=1;i<=total_element;i++){
		document.getElementById(group_name+i).style.backgroundColor='#ffffff';
		
		if(id == group_name+i){	
			
			
			if(document.getElementById(group_name+'_text').value != ""){
			document.getElementById(group_name+'_text').value = '';
			document.getElementById(id).style.backgroundColor='#fff';}
			
			else{document.getElementById(group_name+'_text').value = value;
			document.getElementById(id).style.backgroundColor='#2e3192';}
			
		}
	}
	return false;
}

function selectedButtonS(id,value,group_name,total_element){
	var i = 1;
	for(i=1;i<=total_element;i++){
		document.getElementById(group_name+i).style.backgroundColor='#ffffff';
		if(id == group_name+i){	
			document.getElementById(group_name+'_text').value = value;
			document.getElementById(id).style.backgroundColor='#2e3192';
		}
	}
	return false;
}


function setVisibilityel(id, visibility) {
	document.getElementById(id).style.display = visibility;
}

</script>
 <style type="text/css">
.divshow {
display: none;
padding-left:0;
}
.divshow1 {
display: none;
padding-left:0;
}

::-webkit-input-placeholder {
   color: #d6de1f !important; font-weight:bold; text-transform:uppercase;
}

:-moz-placeholder { /* Firefox 18- */
   color: #d6de1f !important; font-weight:bold; text-transform:uppercase;
}

::-moz-placeholder {  /* Firefox 19+ */
   color: #d6de1f !important;  font-weight:bold;text-transform:uppercase;
}

:-ms-input-placeholder {  
   color: #d6de1f !important;  font-weight:bold;text-transform:uppercase;
}

.arrow-img {
    background: #fff url(<?php bloginfo('template_directory'); ?>/img/arrow.jpg) 98% center no-repeat;
}

</style>
<form name="req" id="req" method="post">
	<section class="req">
	<div class="container">
    	<div class="row">        
        <div class="origin-groups"> 
		<div class="origin-groups"> 
                   <div class="col-sm-4 col-xs-12">
				   <p style="color:#fff;"><?php echo $msg;?></p>
                         
                	<span>NAME</span>
                    <div class="form-group">
                        <input type="text" name="fname" class="form-control border-none" id="name1" placeholder="NAME">
                    </div>
                

            </div>  
                      <div class="orign">
                <div class="col-sm-4 col-xs-12">
                         
                	<span>#TELEPHONE</span>
                    <div class="form-group">
                        <input type="text" name="mobile" class="form-control border-none" id="mobile1" placeholder="TELEPHONE">
                    </div>
                </div>

            </div> 
                        <div class="col-sm-4 col-xs-12">
            <span>EMAIL ADDRESS</span>
            	<input type="text" name="email" class="form-control border-none" id="email1" placeholder="EMAIL">
             </div>  
			 </div>
			<div class="orign">
			
			               
                <div class="col-sm-4 col-xs-12">
				
                         
                	<h3>ORIGIN</h3>
                    <div class="form-group">
                        <input type="text" name="cityzip" class="form-control border-none" id="zip" placeholder="CITY, STATE, ZIP OR SHIPPER">
                    </div>
                </div>
            </div>            
            <div class="col-sm-4 col-xs-12">
			<input id="B_unit_text" type="HIDDEN" name="st1" />
					<input id="R_unit_text" type="HIDDEN" name="st2" />
					
					<span>SITE TYPE</span>
					<ul>
					<li id="business"><button class="butt" id="B_unit1" onClick='selectedButton("B_unit1","Business","B_unit",1); return false'>BUSINESS</button></li>
					<li id="residence"><button class="butt" id="R_unit1" onClick='selectedButton("R_unit1","Residence","R_unit",1); return false'>RESIDENCE</button></li>
					<ul>
             </div>             
			 <div class="col-sm-3 col-xs-12">
			 <span>PICKUP DATE</span>
					<div class="form-group">
					<input type="text" id="datepicker" name="date" class="form-control border-none"  placeholder="Date" style="float:left; width:80%;">
				  </div>
			 </div>             
             <div class="orign">
             	<div class="col-sm-4 col-xs-12">
                	<span>NON-COMMERCIAL PICKUP SITE</span>
                      <select class="form-control border-none arrow-img" name="originnonecomm">
                      <option value="0">SELECT</option>
                      <option value="Airport Pickup">Airport Pickup</option>
                      <option value="Church Pickup">Church Pickup</option>
                      <option value="Transportation/Utility Pickup">Transportation/Utility Pickup</option>
                      <option value="Container Freight Station Pickup">Container Freight Station Pickup</option>
                      <option value="Correctional Facility Pickup">Correctional Facility Pickup</option>
                      <option value="Country Club Pickup">Country Club Pickup</option>
                      <option value="Firm Pickup">Firm Pickup</option>
                      <option value="Golf Course Pickup">Golf Course Pickup</option>
                       <option value="Government Site Pickup">Government Site Pickup</option>
					   <option value="Hotel Pickup">Hotel Pickup</option>
					   <option value="Limited Access Pickup">Limited Access Pickup</option>
					   <option value="Military Base Pickup">Military Base Pickup</option>
					   <option value="Mines/Quaries Pickup">Mines/Quaries Pickup</option>
					   <option value="Nursing/Homes Pickup">Nursing/Homes Pickup</option>
					   <option value="Piers/Wharves Pickup">Piers/Wharves Pickup</option>
					   <option value="Ranch Pickup">Ranch Pickup</option>
					   <option value="School Pickup">School Pickup</option>
					   <option value="Shopping Mall Pickup">Shopping Mall Pickup</option>
					   <option value="Storage Facility Pickup">Storage Facility Pickup</option>
                    </select>
                </div>
             </div>             
			<div class="orign">
            	<div class="col-sm-4 col-xs-12">
					<input id="LG_unit_text" type="HIDDEN" name="originaccessional1" />
					<input id="IP_unit_text" type="HIDDEN" name="originaccessional2" />
					
					<span>ACCESSORIALS</span>
					<ul>
					<li id="business"><button class="butt" id="LG_unit1" onClick='selectedButton("LG_unit1","Lift Gate","LG_unit",1); return false'>LIFT GATE</button></li>
					<li id="residence"><button class="butt" id="IP_unit1" onClick='selectedButton("IP_unit1","Inside Pickup","IP_unit",1); return false'>INSIDE PICKUP</button></li>
					<ul>
                </div>
                 <div style="clear:both;height:20px;"></div>
				<div class="orign">
            	<div class="col-sm-4 col-xs-12">
                         
                	<span>COUNTRY</span>
                    <div class="form-group">
                        <input type="text" name="country1" class="form-control border-none" id="zip" placeholder="COUNTRY">
                    </div>
                </div>
            </div>
            </div>
			</div>
            
            
            <div class="origin-groups">        
			<div class="orign">
                <div class="col-sm-4 col-xs-12">
                	<h3>DESTINATION</h3>
                    <div class="form-group">
                        <input type="text" name="destinycityzip" class="form-control border-none" id="zip" placeholder="CITY, STATE, ZIP OR SHIPPER">
                    </div>
                </div>
            </div>            
            <div class="col-sm-4 col-xs-12">			
				<input id="BD_unit_text" type="HIDDEN" name="std1" />
				<input id="RD_unit_text" type="HIDDEN" name="std2" />
				<span>SITE TYPE</span>
            	<ul>
					<li id="business"><button class="butt" id="BD_unit1" onClick='selectedButton("BD_unit1","Business","BD_unit",1); return false'>BUSINESS</button></li>
					<li id="residence"><button class="butt" id="RD_unit1" onClick='selectedButton("RD_unit1","Residence","RD_unit",1); return false'>RESIDENCE</button></li>
					<ul>
             </div>             
                 <div class="col-sm-3 col-xs-12">
                 <span>GUARANTEED DELIVERY DATE</span>
					<div class="form-group">
                        <input type="text" id="datepicker1" name="destinationpickdate" class="form-control border-none"  placeholder="Date" style="float:left; width:80%;">
					</div>
                 </div>
             <div class="orign">
             	<div class="col-sm-4 col-xs-12">
                	<span>NON-COMMERCIAL DELIVERY SITE</span>
                      <select class="form-control border-none arrow-img" name="nonecommercialdeliverysite">
                      <option value="0">SELECT</option>
                      <option value="Airport Delivery">Airport Delivery</option>
                      <option value="Church Delivery">Church Delivery</option>
                      <option value="Transportation/Utility Delivery">Transportation/Utility Delivery</option>
                      <option value="Container Freight Station Delivery">Container Freight Station Delivery</option>
                      <option value="Correctional Facility Delivery">Correctional Facility Delivery</option>
                      <option value="Country Club Delivery">Country Club Delivery</option>
                      <option value="Firm Delivery">Firm Delivery</option>
                      <option value="Golf Course Delivery">Golf Course Delivery</option>
                       <option value="Government Site Delivery">Government Site Delivery</option>
					   <option value="Hotel Delivery">Hotel Delivery</option>
					   <option value="Limited Access Delivery">Limited Access Delivery</option>
					   <option value="Military Base Delivery">Military Base Delivery</option>
					   <option value="Mines/Quaries Delivery">Mines/Quaries Delivery</option>
					   <option value="Nursing/Homes Delivery">Nursing/Homes Delivery</option>
					   <option value="Piers/Wharves Delivery">Piers/Wharves Delivery</option>
					   <option value="Ranch Delivery">Ranch Delivery</option>
					   <option value="School Delivery">School Delivery</option>
					   <option value="Shoping Mall Delivery">Shoping Mall Delivery</option>
					   <option value="Storage Facility Delivery">Storage Facility Delivery</option>
                    </select>
                </div>
             </div>             
			<div class="orign">
            	<div class="col-sm-4 col-xs-12">
					<input id="LGD_unit_text" type="HIDDEN" name="originaccessional_dest1" />
					<input id="IPD_unit_text" type="HIDDEN" name="originaccessional_dest2" />
					
					<span>ACCESSORIALS</span>
					<ul>
					<li id="business"><button class="butt" id="LGD_unit1" onClick='selectedButton("LGD_unit1","Lift Gate","LGD_unit",1); return false'>LIFT GATE</button></li>
					<li id="residence"><button class="butt" id="IPD_unit1" onClick='selectedButton("IPD_unit1","Inside Pickup","IPD_unit",1); return false'>INSIDE PICKUP</button></li>
					<ul>
                 </div>
                 <div style="clear:both;height:20px;"></div>
				 <div class="orign">
            	<div class="col-sm-4 col-xs-12">
                         
                	<span>COUNTRY</span>
                    <div class="form-group">
                        <input type="text" name="country2" class="form-control border-none" id="zip" placeholder="COUNTRY">
                    </div>
                </div>
            </div>
            </div>
			</div>
            <div class="origin-groups">
            
			<span><input type="radio" name="port" value="Port to Port" class="rd">&nbspPort&nbspto&nbspPort</span>
            <span><input type="radio" name="port" value="Port to Door" class="rd">&nbspPort&nbspto&nbspDoor</span>
            <span><input type="radio" name="port" value="Door to Port" class="rd">&nbspDoor&nbspto&nbspPort</span>
            <span><input type="radio" name="port" value="Door to Door" class="rd">&nbspDoor&nbspto&nbspDoor</span></div>
                    <div class="origin-groups">

			<span><input type="radio" id="extreme_length11" name="container" class="rd" >&nbspLCL&nbsp( Less Than Container )</span>
			<span><input type="radio" id="extreme_length22" name="container" class="rd">&nbspFCL&nbsp( Full Container )</span>                        
            <input id="extreme_length_text" type="hidden" name="extreme_length" /></div>
                 
            
			 <div class="col-sm-12 col-xs-12 divshow" id="sub5" >
			<!--------to show value in text box it will be hidden---------->		
              <div class="origin-groups" >
                    <div style="clear:both;height:20px;"></div>
            	<table id="test">
					<tr>
                	<td>
                    	<span>UNIT TYPE</span>
                        <select class="form-control border-none arrow-img" name="unittype[]">
                          <option value="0">SELECT</option>
                          <option value="Pallets(40*48)">Pallets(40*48)</option>
                          <option value="Pallets(non-standard)">Pallets(non-standard)</option>
                          <option value="Bags">Bags</option>
                          <option value="Bales">Bales</option>
						  <option value="Boxes">Boxes</option>
						  <option value="Bunches">Bunches</option>
						  <option value="Carpet">Carpet</option>
						  <option value="Coils">Coils</option>
						  <option value="Crates">Crates</option>
						  <option value="Cylinders">Cylinders</option>
						  <option value="Drums">Drums</option>
						  <option value="Pails">Pails</option>
						  <option value="Reels">Reels</option>
						  <option value="Rolls">Rolls</option>
						  <option value="Tubes/Pipes">Tubes/Pipes</option>
						  <option value="(loose)">(loose)</option>
						  <option value="Bundles">Bundles</option>
						  <option value="Tote(4*4)">Tote(4*4)</option>
                        </select>
                    </td>                    
                    
                          <td style="width:8%">
                   	 <span># OF UNITS</span>
                     <input type="text" class="form-control border-none" name="ofunits[]" id="exampleInputEmail1" placeholder="Of Units">
                    </td>                    
                    <td>
                   	 <span>DESCRIPTION/COMMODITY</span>
                     <input type="text" class="form-control border-none" id="exampleInputEmail1" placeholder="Description" name="descriptioncommodity[]">
                    </td>                    
                    <td style="width:8%">
                   	 <span>CLASS</span>
                     <select class="form-control border-none arrow-img" name="class[]">
                          <option value="">SELECT</option>
                          <option value="00">00</option>
                          <option value="50">50</option>
                          <option value="55">55</option>
                          <option value="60">60</option>
						  <option value="65">65</option>
						  <option value="70">70</option>
						  <option value="77">77</option>
						  <option value="85">85</option>
						  <option value="92">92</option>
						  <option value="100">100</option>
						  <option value="110">110</option>
						  <option value="125">125</option>
						  <option value="150">150</option>
						  <option value="175">175</option>
						  <option value="200">200</option>
						  <option value="250">250</option>
						  <option value="300">300</option>
						  <option value="400">400</option>
						  <option value="500">500</option>
						  
                        </select>
                    </td>                    
                    <td style="width:9%">
                   	 <span># OF PIECES</span>
                     <input type="text" name="ofpieces[]" class="form-control border-none" id="exampleInputEmail1" placeholder="Of Pieces">
                    </td>
                    
                    <td>
                   	 <span>WEIGHT</span>
                    <input class="form-control border-none" id="exampleInputEmail1" name="weight[]" placeholder="Weigh" style="width: 60%;float: left;" type="text">
					
					<input id="WEIGHT_unit_text" type="hidden" name="weight_unit[]" />
					
					<ul>						
						<li id="de-li"><button class="butt" id="WEIGHT_unit1" onClick='selectedButtonS("WEIGHT_unit1","LB","WEIGHT_unit",2); return false'>LB</button></li>
						<li id="de-li"><button class="butt" id="WEIGHT_unit2" onClick='selectedButtonS("WEIGHT_unit2","KG","WEIGHT_unit",2); return false'>KG</button></li>                        
					</ul>
					
					
                    </td>
                    
                    <td style="width:18%;">
                   	 <span>DIMENSION</span>
                    <input id="DE_unit_text" type="hidden" name="de_unit[]" />
					
					<ul>						
					<li id="de-li"><input class="form-control border-none" name="l[]" type="text" id="DE_unit1"  placeholder="L" /></li>
						<li id="de-li"><input class="form-control border-none" name="ww[]" type="text" id="DE_unit2"  placeholder="W" /></li>                        
						<li id="de-li"><input class="form-control border-none" name="h[]" type="text" id="DE_unit3"  placeholder="H" /></li>                        
                        
						<li id="de-li"><button class="butt" id="DE_unit4" onClick='selectedButtonS("DE_unit4","IN","DE_unit",5); return false'>IN</button></li>                        
						<li id="de-li"><button class="butt" id="DE_unit5" onClick='selectedButtonS("DE_unit5","CM","DE_unit",5); return false'>CM</button></li>                        
					</ul>
                    </td>
                    
                    <td>
					<input id="STACKABLE_unit_text" type="hidden" name="stackable_unit[]" />
                   	 <span>STACKABLE</span>
                     <ul>
                  <li id="one-li"style="width:100%"><button class="butt" id="STACKABLE_unit1" onClick='selectedButton("STACKABLE_unit1","STACKABLE","STACKABLE_unit",1); return false'>STACKABLE</button></li></ul>
                    </td>
                    
                     <td>
					<input id="HAZMAT_unit_text" type="hidden" name="hazmat_unit[]" />
                   	 <span>HAZMAT</span>
                      <ul>
                   <li id="one-li" style="width:100%"><button class="butt" id="HAZMAT_unit1" onClick='selectedButton("HAZMAT_unit1","HAZMAT","HAZMAT_unit",1); return false'>HAZMAT</button></li></ul>
                    </td>
                    </tr>
                </table>
				<ul class="add-row">				
					<li> <input type="button" value="ADD ROW" class="plusbtn" /></li>				 
					<li><input type="button" value="REMOVE ROW" class="minusbtn" /></li>                	
				</ul>
			<!-----</div>-->     
	  
             			<div class="orign">
            	<div class="col-sm-4 col-xs-12">
                	<h3>ADDITIONAL DETAILS</h3>
                    <span>INSURANCE</span>															
					<ul>
                        <li id="business"><button class="butt" id="insurance1" onclick='setVisibilityel("sub3", "inline");selectedButtonS("insurance1","Yes","insurance",2);return false;';>YES</button></li>
						<li id="residence"><button class="butt" id="insurance2" onclick='setVisibilityel("sub3", "none");selectedButtonS("insurance2","No","insurance",2);return false;';>NO</button></li>                        
                    </ul>
					<input id="insurance_text" type="hidden" name="insurance" />
                 </div>
            </div>
			 <div class="col-sm-12 col-xs-12 divshow1" id="sub3">
			 <div class="col-sm-4 col-xs-12">			
			<!--------to show value in text box it will be hidden---------->			
			<input id="new_used_text" name="neworused" type="hidden" name="tags" />
            <span>SELECT NEW OR USED</span>
            	<ul>
                	<li id="business" class="active"><button class="butt" id="new_used1" onClick='selectedButtonS("new_used1","New","new_used",2); return false'>NEW</button></li>
                    <li id="residence"><button class="butt" id="new_used2" onClick='selectedButtonS("new_used2","Used","new_used",2); return false'>USED</button></li>
                </ul>
             </div>             
                 <div class="col-sm-2 col-xs-12">
					<span>VALUE OF GOODS</span>
                    <div class="form-group">
                    <input type="text" name="valueof" class="form-control border-none" id="exampleInputEmail1" placeholder="Value of goods">
                    </div>
                 </div>			
			</div>
			<div class="orign">
            	<div class="col-sm-4 col-xs-12">                	
                    <span>EXTREME LENGTH</span>					
					<ul>
                        <li id="business"><button class="butt" id="extreme_length1" onclick='setVisibilityel("sub4", "inline");selectedButtonS("extreme_length1","Yes","extreme_length",2);return false;';>YES</button></li>
						<li id="residence"><button class="butt" id="extreme_length2" onclick='setVisibilityel("sub4", "none");selectedButtonS("extreme_length2","No","extreme_length",2);return false;';>NO</button></li>                        
                    </ul>
					<input id="extreme_length_text" type="hidden" name="extreme_length" />
                 </div>
            </div>
			 <div class="col-sm-12 col-xs-12 divshow" id="sub4">
			<!--------to show value in text box it will be hidden---------->			
             <div class="col-sm-4 col-xs-12">
                 <span>LENGTH</span>
                        <div class="form-group">
                        <input type="text" name="length" class="form-control border-none" id="exampleInputEmail1" placeholder="Length">
                      </div>
                 </div>             
                 <div class="col-sm-2 col-xs-12">
                 <span># of BUNDLES</span>
                        <div class="form-group">
                        <input type="text" name="boundles" class="form-control border-none" id="exampleInputEmail1" placeholder="# of bundles">
                      </div>
                 </div>
			</div>
			</div>
			</div>
			<div class="origin-groups" id="sub6" style="display:none">
			
			 
                    <div style="clear:both;height:20px;"></div>
            	<table id="test1">
					<tr>
                	  <td>
				 				
					<span>CLASS</span>
                     <select class="form-control border-none arrow-img"  name="standard">
                          <option value="">SELECT</option>
                          <option value="20">20'Standard</option>
                          <option value="40">40'Standard</option>
                          <option value="40H">40'High Cube</option>
                          <option value="45">45'</option>
						  <option value="20R">20'Refrigerated</option>
						  <option value="40RS">40'Refrigerated Standard</option>
						  <option value="40RSH">40'Refrigerated Standard High Cube</option>
						  
						  
						  
                        </select>
						</td>     
                    <td>
                   	 <span>DESCRIPTION/COMMODITY</span>
                     <input type="text" class="form-control border-none" id="exampleInputEmail1" placeholder="Description" name="descriptioncommodity2">
                    </td>                    
                       <td>
                       
                     
					 <input id="HAZ_unit_text" type="hidden" name="haz_unit" />
                   	 <span>HAZMAT</span>
                      <ul><li id="one-li"style="width:100%"><button class="butt" id="HAZ_unit1" onClick='selectedButton("HAZ_unit1","HAZMAT","HAZ_unit",1); return false'>HAZMAT</button></li></ul>
                                       
				   </td>           
                    
                    </tr>
                </table>
				
			<!-----</div>-->     
	  
             			<div class="orign">
            	<div class="col-sm-4 col-xs-12">
                	<h3>ADDITIONAL DETAILS</h3>
                    <span>INSURANCE</span>															
					<ul>
                        <li id="busi"><button class="butt" id="insu1" onclick='setVisibilityel("sub55", "inline");selectedButtonS("insu1","Yes","insu",2);return false;';>YES</button></li>
						<li id="resi"><button class="butt" id="insu2" onclick='setVisibilityel("sub55", "none");selectedButtonS("insu2","No","insu",2);return false;';>NO</button></li>                        
                    </ul>
					<input id="insu_text" type="hidden" name="insu" />
                 </div>
            </div>
			 <div class="col-sm-12 col-xs-12 divshow1" id="sub55">
			 <div class="col-sm-4 col-xs-12">			
			<!--------to show value in text box it will be hidden---------->			
			<input id="ne_used_text" name="neworuse" type="hidden" name="tags" />
            <span>SELECT NEW OR USED</span>
            	<ul>
                	<li id="business" class="active"><button class="butt" id="ne_used1" onClick='selectedButtonS("ne_used1","New","ne_used",2); return false'>NEW</button></li>
                    <li id="residence"><button class="butt" id="ne_used2" onClick='selectedButtonS("ne_used2","Used","ne_used",2); return false'>USED</button></li>
                </ul>
             </div>             
                 <div class="col-sm-2 col-xs-12">
					<span>VALUE OF GOODS</span>
                    <div class="form-group">
                    <input type="text" name="valueof1" class="form-control border-none" id="exampleInputEmail1" placeholder="Value of goods">
                    </div>
                 </div>			
			</div>
			
			</div>
                          <input type="submit" name="sub" class="req-button" value="SUBMIT">
                          <input type="reset" class="cl-button" value="CLEAR FORM" />
                       
			</div>
			  
			</div>
			
			 
            

			
			
            	                	
                    
			
          

	
</section>
</form>
<?php get_footer();