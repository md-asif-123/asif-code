
		
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
	  
      width: 400,
      height: 400
    };
	
	var options_country_line = {
      title: 'Country Line Chart',
      is3D: 'true',
	  
      width: 400,
      height: 400
    };
	
	var options_country_pie = {
      title: 'Country Pie Chart',
      is3D: 'true',
	  
      width: 500,
      height: 400
    };

	var options_country_geo = {
      title: 'Country Geo Chart',
      is3D: 'true',
	  
      width: 500,
      height: 400
    };
	
  // Instantiate and draw our chart, passing in some options.
  // Do not forget to check your div ID
 
    var chart = new google.visualization.BarChart(document.getElementById('barchart_div'));
    chart.draw(data, options_country);
	
	var chart = new google.visualization.LineChart(document.getElementById('linechart_div'));
    chart.draw(data, options_country_line);
	
	var chart = new google.visualization.PieChart(document.getElementById('piechart_div'));
    chart.draw(data, options_country_pie);
	
	var chart = new google.visualization.GeoChart(document.getElementById('geochart_div'));
    chart.draw(data, options_country_geo);
	
}


</script>		
		
		
<div class="container">


<div class="col-lg-4">	

	<div id="barchart_div"></div></div>
<div class="col-lg-4">	
	<div id="linechart_div"></div></div>
<div class="col-lg-4">	
	<div id="piechart_div"></div></div>
	
	
	

</div>   




<div class="container">


<div class="col-lg-4">	

	<div id="geochart_div"></div></div>

	
	
	

</div>    
