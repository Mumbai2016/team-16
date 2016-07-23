<?php
if (!empty($_POST)){
	$servername = "localhost";
	$username = "root";
	$password = '';
	// Create connection
	$conn = new mysqli($servername, $username, $password,"ivrs");
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
	$sql = "INSERT INTO test(phone_number) VALUES (".$_POST["number"].")";
	$resultat = $conn->query($sql);
	if ($resultat == TRUE) {
		$exotel_sid = "wsonline"; // Your Exotel SID - Get it from here: http://my.exotel.in/Exotel/settings/site#api-settings
		$exotel_token = "597c6988a1f8668c14fb7979c541595159fe740f"; // Your exotel token - Get it from here: http://my.exotel.in/Exotel/settings/site#api-settings
		//echo $conn->insert_id;
		$url = "https://".$exotel_sid.":".$exotel_token."@twilix.exotel.in/v1/Accounts/".$exotel_sid."/Sms/send";
		 $post_data = array(
			// 'From' doesn't matter; For transactional, this will be replaced with your SenderId;
			// For promotional, this will be ignored by the SMS gateway
			'From'   => '8808891988', //anything
			'To'    => $_POST["number"],
			'Body'  => "Hi, your number ".$_POST["number"]." is now turned on your code is ".$conn->insert_id.".",
			//template Hi, your number 1234 is now turned on your code is 12344.			
		);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_VERBOSE, 1);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_FAILONERROR, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post_data));
		$http_result = curl_exec($ch);
		$error = curl_error($ch);
		$http_code = curl_getinfo($ch ,CURLINFO_HTTP_CODE);
		 
		curl_close($ch);
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
	$conn->close();
}
?>

<html>
<body>
	<h3>Register Phone number</h3>
	<form method="POST">
		Phone number:<input name="number" type="text" />
		<input type="submit" value="Register"/>
	</form>
</body>

</html>