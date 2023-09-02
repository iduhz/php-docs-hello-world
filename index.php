<?php

$data = 'grant_type=authorization_code&client_id=' . 'f2924b54-9525-4521-ae9f-a85652060e6f' . '&redirect_uri=' . urlencode('https://easysignatureportal.azurewebsites.net'. '/oauth.php') . '&code=' . $_GET['code'] . '&code_verifier=' . $sessionData['txtCodeVerifier'];

$ch = curl_init('https://login.microsoftonline.com/2685ce0d-979a-47d6-839d-a4b8a792138c/oauth2/v2.0/token');
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
if ($cError = curl_error($ch)) {
	echo $cError;
	exit;
}
curl_close($ch);
		
$reply = json_decode($response);


echo reply;
