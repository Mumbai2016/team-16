<html>
<head>
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <title>Age Tracker</title>
</head>
<body onLoad="filloption();">
<?php
$servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "csv_db";
		//$start=$_GET["start"];
		//$end=$_GET["end"];
		//$chart=$_GET["chart"];
$selected = new mysqli($servername, $username, $password, $dbname);
if ($selected->connect_error) {
            die("Connection failed: " . $selected->connect_error);
        }
//execute query
$sql = "SELECT Age,Count(Age) As `No` FROM tbl_name GROUP BY Age"; /* WHERE YEAR(STR_TO_DATE(`Last Tracking date`, "%d-%M-%yy")) 
BETWEEN $start AND $end";*/
    $result = mysqli_query($selected, $sql) or die("Error in Selecting " . mysqli_error($selected));
//fetch data
$entry="";
while ($row = mysqli_fetch_array($result,MYSQLI_BOTH)) {
    $entry .= "['".$row{'Age'}."',".$row{'No'}."],";
}
//close the connection
mysqli_close($selected);
?>
<script>
var data="";
var options="";
    google.load("visualization", "1", {packages:["corechart"]});
    google.setOnLoadCallback(drawChart);
	    function drawChart() {
       data = google.visualization.arrayToDataTable([
        ['Age','No'],
        <?php echo $entry ?>
    ]);
       options = {
            title: 'Age Tracker',
            curveType: 'function',
            legend: { position: 'bottom' }
        };
		var chart1=document.getElementById("charttype").value;
		chart1=chart1.replace(/ +/g, "");
		var chart="";
        if(chart1=="BarChart")
		chart = new google.visualization.BarChart(document.getElementById('chart_div'));
		else if(chart1=="LineChart")
		chart = new google.visualization.LineChart(document.getElementById('chart_div'));
		else if(chart1=="AreaChart")
		chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
		else if(chart1=="PieChart")
		chart = new google.visualization.PieChart(document.getElementById('chart_div'));
		else if(chart1=="ColumnChart")
		chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
        chart.draw(data, options);
    }

function selection()
{
document.getElementById("chart_div").innerHTML="";
var start=document.getElementById("start").value;
var end=document.getElementById("end").value;
//window.location.href = "chart.php?start=" + start + "&end=" + end+ "&chart=" + chart;
var chart1=document.getElementById("charttype").value;
		chart1=chart1.replace(/ +/g, "");
		var chart="";
        if(chart1=="BarChart")
		chart = new google.visualization.BarChart(document.getElementById('chart_div'));
		else if(chart1=="LineChart")
		chart = new google.visualization.LineChart(document.getElementById('chart_div'));
		else if(chart1=="AreaChart")
		chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
		else if(chart1=="PieChart")
		chart = new google.visualization.PieChart(document.getElementById('chart_div'));
		else if(chart1=="ColumnChart")
		chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
        chart.draw(data, options);
    	chart.draw(data,options);
}

</script>
Year Range:-
<select id="start" name="start">
</select>
<select id="end" name="end">
</select><BR/><BR/>
Chart Type:- <select id="charttype" name="charttype">
<option>Bar Chart</option>
<option>Line Chart</option>
<option>Pie Chart</option>
<option>Area Chart</option>
<option>Column Chart</option>
</select><BR/><BR/>
<input type="button" id="refresh" value="GO" onClick="selection()">


<div id="chart_div" style="width: 100%; height: 500px;"></div>

<script type="text/javascript">
	

function filloption()
{
	var select1=document.getElementById("start");
	var select2=document.getElementById("end");
	var d = new Date();
	var n = d.getFullYear();
	for(i=2007;i<=n;i++)
	{
   		var opt = document.createElement("option");
   		opt.value= i;
   		opt.innerHTML = i; 
   		var opt1 = document.createElement("option");
   		opt1.value= i;
   		opt1.innerHTML = i; 
		
		select1.appendChild(opt1);
   		select2.appendChild(opt);
//		document.getElementById("chart_div").style.visibility="hidden";
	}
}
</script>
</body>
</html>