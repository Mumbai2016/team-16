<html>
<head>
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
 <link rel="stylesheet" href="mm/css/demo.css">
  <link rel="stylesheet" href="mm/css/footer-distributed-with-address-and-phones.css"> 
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
  <link href="http://fonts.googleapis.com/css?family=Cookie" rel="stylesheet" type="text/css">
  
  <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <link rel="stylesheet" type="text/css" href="mm/css/materialize.css">
  <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <script src="mm/js/materialize.min.js"></script>
     <title>Centre Tracker</title>
</head>

<style type="text/css">
  	#coo{
  		background-color: #67AECA;
  	}
  	</style>
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
$sql =  "SELECT SUBSTRING(`CC1 Unique ID#`,1,3) As Center,Count(SUBSTRING(`CC1 Unique ID#`,1,3)) As `No` FROM tbl_name GROUP BY Center";
    $result = mysqli_query($selected, $sql) or die("Error in Selecting " . mysqli_error($selected));
//fetch data
$entry="";
while ($row = mysqli_fetch_array($result,MYSQLI_BOTH)) {
    $entry .= "['".$row{'Center'}."',".$row{'No'}."],";
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
        ['Centre','No of Enrollments'],
        <?php echo $entry ?>
    ]);
       options = {
            title: 'Centre Tracker',
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
}

</script>



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

<nav id="coo">
    <div class="nav-wrapper">
      <a href="#!" class="brand-logo"><img src="logo-header.png" class="hide-on-small-only hide-on-med-only" width="40%" height="40%"></a>
      <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
      <ul class="right hide-on-med-and-down">
         <li><a href="dashboard.html">Dashboard</a></li>
        <li><a href="badges.html">Search Student Details</a></li>
        <li><a href="collapsible.html">Add Student Details</a></li>
        <li><a href="mobile.html">Add Event</a></li>
      </ul>
      <ul class="side-nav" id="mobile-demo">
        <li><a href="dashboard.html">Dashboard</a></li>
        <li><a href="badges.html">Search Student Details</a></li>
        <li><a href="collapsible.html">Add Student Details</a></li>
        <li><a href="mobile.html">Add Event</a></li>>
      </ul>
    </div>
  </nav>

  Year Range:-
<select id="start" name="start">
</select>
<select id="end" name="end">
</select><BR/><BR/>
Chart Type:- <select id="charttype" name="charttype" onChange="selection()">
<option>Bar Chart</option>
<option>Line Chart</option>
<option>Pie Chart</option>
<option>Area Chart</option>
<option>Column Chart</option>
</select><BR/><BR/>

<div id="chart_div" style="width: 100%; height: 500px;"></div>

<footer class="footer-distributed">

      <div class="footer-left">

        <h3>Dream A<span>Dream</span></h3>

        <p class="footer-links">
      <a href="http://dreamadream.org/">Home</a>
        </p>

        <p class="footer-company-name">DreamADream &copy; 2015</p>
      </div>

      <div class="footer-center">

        <div>
          <i class="fa fa-map-marker"></i>
          <p><span>No. 398/E, 17th Cross</span> 3rd Block, Bangalore - 560011, India</p>
        </div>

        <div>
          <i class="fa fa-phone"></i>
          <p>+91 8040951084</p>
        </div>

        <div>
          <i class="fa fa-envelope"></i>
          <p><a href="mailto:info@dreamadream.org">info@dreamadream.org
 
</a></p>
        </div>

      </div>

      <div class="footer-right">

        <p class="footer-company-about">
          <span>About the company</span>
          We have been working with young people from vulnerable backgrounds since 1999. Ours is an entirely collaborative approach with 60 partners, 3000 volunteers, impacting over 60,000 young people each year
        </p>

        <div class="footer-icons">

          <a href="http://dreamadream.org/"><i class="fa fa-facebook"></i></a>
          <a href="http://dreamadream.org/"><i class="fa fa-twitter"></i></a>
          <a href="http://dreamadream.org/"><i class="fa fa-linkedin"></i></a>
          <a href="http://dreamadream.org/"><i class="fa fa-github"></i></a>

        </div>

      </div>

    </footer>
<script>
  $( document ).ready(function(){
    $(".button-collapse").sideNav();});
	
 
  </script>
</body>
</html>