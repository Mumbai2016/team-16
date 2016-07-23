<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	// Create connection
	$conn = new mysqli($servername, $username, $password,"ivrs");
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
	$status=$_GET["digits"];
	$status_update="";
	if($status==1)
		$status_update="Diploma";
	else if($status==2)
		$status_update="Employed";
	else
		$status_update="Drop out";

	$sql = "update test set `2 Quarter 2015-16`=$status_update where phone_number = (select c.phone_number from tbl_name c where c.CallSid='".$_GET["CallSid"]."')";
	$resultat = $conn->query($sql);
	if ($resultat == TRUE) {
		header( "HTTP/1.1 200 OK" );
	} else {
		header( "HTTP/1.1 302 Found" );
	}
	$conn->close();
?>
