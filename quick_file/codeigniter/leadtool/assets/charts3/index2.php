<?php
	$con = mysql_connect('localhost','host','');
	mysql_select_db('lead');
?>
<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
	<title>
		Create Google Charts
	</title>
	<script type="text/javascript" src="https://www.google.com/jsapi"></script>
	  <script type="text/javascript">
      google.load("visualization", "1", {packages:["geochart"]});
      google.setOnLoadCallback(drawRegionsMap);

      function drawRegionsMap() {

        var data = google.visualization.arrayToDataTable([

          ['Country', 'Visits'],
           <?php 
	        	$query = "SELECT count(name) AS count, name FROM country GROUP BY name";

	        	$exec = mysql_query($query);
	        	while($row = mysql_fetch_array($exec)){

	        		echo "['".$row['name']."',".$row['count']."],";
	        	}
	   ?>
        ]);

        var options = {
        	
        };

        var chart = new google.visualization.GeoChart(document.getElementById('geochart'));

        chart.draw(data, options);
      }
    </script>
</head>
<body>
    <h3>Geo Chart</h3>
   <div id="geochart" style="width: 900px; height: 500px;"></div>
</body>
</html>