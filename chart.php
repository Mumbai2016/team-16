<html>
<head>
    <title>Weight Tracker</title>
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

<div id="chart_div" style="width: 100%; height: 500px;"></div>

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
        var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
        chart.draw(data, options);
    }
</script>
</body>
</html>