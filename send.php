<?php
define('SERVER_API_KEY','AIzaSyBqs9JUdwMc-vJhIGt3-132TNzeumFhnpM');
$tokens = ['eYaQusLLvaQ:APA91bGxdV4xVzUmpGtnzSVe6YFUjTBmlun5j93mMYQj_ts83FXtq_-C_FCx5SM-ZMQ6obsA4d1cfoRyNB4DZGDg9WJF0AEybH-JwelaNuEXC399CWKNhWyGfRp6-k6HYsUlcTNWgCLh'];

$header = [
	'Authorization: key='.SERVER_API_KEY,
	'Content-Type: Application/json'
];

$msg =[
	'title' => '¿Ya viste la hora?',
	'body' => 'Cierra el Facebook y ponte a trabajar',
	'icon' => 'IMG/man.png'
];

$payload = array('registration_ids' => $tokens, 'data' => $msg);
$curl = curl_init();

curl_setopt_array($curl, array(
	CURLOPT_URL => "https://fcm.googleapis.com/fcm/send",
	CURLOPT_RETURNTRANSFER => true,  
	CURLOPT_CUSTOMREQUEST => "POST",
	CURLOPT_POSTFIELDS => json_encode( $payload ),
	CURLOPT_SSL_VERIFYHOST => 0,
	CURLOPT_SSL_VERIFYPEER => 0,
	CURLOPT_HTTPHEADER => $header)
);

$response = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);

if ($err) {
	echo "cURL Error #:" . $err;
} else {
	echo $response;
}

?>