<?php
$post_data = array(
    // 'From' doesn't matter; For transactional, this will be replaced with your SenderId;
    // For promotional, this will be ignored by the SMS gateway
    'From'   => '8808891988',
    'To'    => $_POST["phone"] ,
    'Body'  => 'Hey,We are from Dream a Dream!Hope you are doing well! Please call us on 09243422233 if you are still working.', //Incase you are wondering who Dr. Rajasekhar is http://en.wikipedia.org/wiki/Dr._Rajasekhar_(actor)
);
 
 // Your exotel token - Get it from here: http://my.exotel.in/Exotel/settings/site#api-settings
$exotel_sid = "test555"; // Your Exotel SID - Get it from here: http://my.exotel.in/Exotel/settings/site#api-settings
$exotel_token = "69affb784da49df78c21d2a14dd6908b758a9255"; // Your exotel token - Get it from here: http://my.exotel.in/Exotel/settings/site#api-settings
 
$url = "https://".$exotel_sid.":".$exotel_token."@twilix.exotel.in/v1/Accounts/".$exotel_sid."/Sms/send";
 
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
 
print "Response = ".print_r($http_result);
?>