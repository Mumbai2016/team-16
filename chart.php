<html>
<head>
    <title>Age Tracker</title>
</head>
<body onLoad="filloption();">
<script>
	function selecion()
{
document.getElementById("chart_div").style.visibility="visible";
var start=document.getElementById("start").value;
var end=document.getElementById("end").value;
var chart=document.getElementById("charttype").value;
}

</script>
Year Range:-
<select id="start" name="start">
</select>
<select id="end" name="end">
</select><BR/><BR/>
Chart Type:- <select id="charttype" name="charttype">
<option>Line Chart</option>
<option>Bar Chart</option>
<option>Pie Chart</option>
<option>Area Chart</option>
<option>Column Chart</option>
</select><BR/><BR/>
<input type="button" value="GO" onClick="selection()">
<?php
$servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "csv_db";
$selected = new mysqli($servername, $username, $password, $dbname);
if ($selected->connect_error) {
            die("Connection failed: " . $selected->connect_error);
        }
//execute query
 $sql = "SELECT Age,Count(Age) As `No` FROM tbl_name GROUP BY Age";
    $result = mysqli_query($selected, $sql) or die("Error in Selecting " . mysqli_error($connection));
//fetch data
$entry="";
while ($row = mysqli_fetch_array($result,MYSQLI_BOTH)) {
    $entry .= "['".$row{'Age'}."',".$row{'No'}."],";
}
//close the connection
mysqli_close($selected);
?>

<div id="chart_div" style="width: 100%; height: 500px; visibility:hidden"></div>

<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
    google.load("visualization", "1", {packages:["corechart"]});
    google.setOnLoadCallback(drawChart);
    function drawChart() {
        var data = google.visualization.arrayToDataTable([
        ['Age',	'No'],
        <?php echo $entry ?>
    ]);
        var options = {
            title: 'Age Tracker',
            curveType: 'function',
            legend: { position: 'bottom' }
        };
        var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
        chart.draw(data, options);
    }
	

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
	}
}
</script>
</body>
</html>