<?php

//set POST variables
$url = 'https://service.xirsys.com/getIceServers';
$fields_string = '';
$fields = array(
	'domain' => $_POST["domain"],
	'application' => $_POST["application"],
	'room' => $_POST["room"],
	'username' => $_POST["username"],
	'ident' => urlencode("<ident>"),
	'secret' => urlencode("<secret_key>"),
	"secure" => "1" 
);

//url-ify the data for the POST
foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
rtrim($fields_string, '&');

//open connection
$ch = curl_init();

//set the url, number of POST vars, POST data
curl_setopt($ch,CURLOPT_URL, $url);
curl_setopt($ch,CURLOPT_POST, count($fields));
curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch,CURLOPT_TIMEOUT, 0);
curl_setopt($ch,CURLOPT_CONNECTTIMEOUT, 0);

//execute post
$result = curl_exec($ch);

// Check for errors
if($result === FALSE){
    die(curl_error($ch));
}

//close connection
curl_close($ch);

?>
