
		
<!--Load the Ajax API-->


<script type="text/javascript">

// Load the Visualization API and the piechart package.
google.load('visualization', '1', {'packages':['corechart']});

// Set a callback to run when the Google Visualization API is loaded.
google.setOnLoadCallback(drawChart);

function drawChart() {

  // Create our data table out of JSON data loaded from server.
	var data = new google.visualization.DataTable(<?=$jsonTable?>);
  
	var options_country = {
       title: 'Country Bar Chart',
      is3D: 'true',
	  isStacked:'percentage',
      width: 200,
      height: 200
    };
	var data_industry = new google.visualization.DataTable(<?=$jsonTableind?>);
	var options_industry = {
       title: 'Industry Bar Chart',
      is3D: 'true',
	  isStacked:'percentage',
      width: 200,
      height: 200
    };
	
	var data_language = new google.visualization.DataTable(<?=$jsonTablelanguage?>);
	var options_language = {
       title: 'Language Bar Chart',
      is3D: 'true',
	  isStacked:'percentage',
      width: 200,
      height: 200
    };
	
	var data_btype = new google.visualization.DataTable(<?=$jsonTablebtype?>);
	var options_btype = {
       title: 'Business Type Bar Chart',
      is3D: 'true',
	  isStacked:'percentage',
      width: 200,
      height: 200
    };
	
  // Instantiate and draw our chart, passing in some options.
  // Do not forget to check your div ID
 
    var chart = new google.visualization.BarChart(document.getElementById('barchart_div'));
    chart.draw(data, options_country);
	var chart = new google.visualization.BarChart(document.getElementById('barchart_div1'));
    chart.draw(data_industry, options_industry);
	
	var chart = new google.visualization.BarChart(document.getElementById('barchart_div_language'));
    chart.draw(data_language, options_language);
	
	var chart = new google.visualization.BarChart(document.getElementById('barchart_div_btype'));
    chart.draw(data_btype, options_btype);

	
}


</script>		
		
		
<div class="container">
<section class="home-logos">
<ul>
	<li><a href="../chart/by_country" class="fa fa-user home-user" title="Country Chart">
	
	
	
	<div id="barchart_div" style="width:200px;"></div>
	
	
	</a></li>
	
	<li><a href="../chart/by_industry" class="fa fa-signal home-user" title="Industry Chart">
	
	<div id="barchart_div1" style="width:200px;"></div>
	
	</a></li>
	 <li><a href="../chart/by_language" class="fa fa-inbox home-user" title="Language Chart">
	 <div id="barchart_div_language" style="width:200px;"></div></a></li>
    
	
	 <li><a href="../chart/by_business" class="fa fa-download home-user" title="Business Chart">
	 <div id="barchart_div_btype" style="width:200px;"></div></a></li>
	
	
    
   </ul>
</section> 
</div>    
</body>

</html>
<?php
//require_once('lib/frontend/footer.php') ;

?>
