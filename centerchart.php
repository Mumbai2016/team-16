<html>
<head>
    <title>Gender Tracker</title>
</head>
<body>
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
 $sql = "SELECT SUBSTRING(`CC1 Unique ID#`,1,3) As Center,Count(SUBSTRING(`CC1 Unique ID#`,1,3)) As `No` FROM tbl_name GROUP BY Center";
    $result = mysqli_query($selected, $sql) or die("Error in Selecting " . mysqli_error($connection));
//fetch data
$entry="";
while ($row = mysqli_fetch_array($result,MYSQLI_BOTH)) {
    $entry .= "['".$row{'Center'}."',".$row{'No'}."],";
}
//close the connection
mysqli_close($selected);
?>

<div id="chart_div" style="width: 100%; height: 500px;"></div>

<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
    google.load("visualization", "1", {packages:["corechart"]});
    google.setOnLoadCallback(drawChart);
    function drawChart() {
        var data = google.visualization.arrayToDataTable([
        ['Center',	'No'],
        <?php echo $entry ?>
    ]);
        var options = {
            title: 'Center Tracker',
            curveType: 'function',
            legend: { position: 'bottom' }
        };
		
		 var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, options);
    }
</script>
</body>
</html>