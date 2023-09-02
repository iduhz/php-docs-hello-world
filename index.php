<?php

$oAuth = new modOAuth();

$oauthRequest = $oAuth->generateRequest('grant_type=authorization_code&client_id=' . 'f2924b54-9525-4521-ae9f-a85652060e6f' . '&redirect_uri=' . urlencode('http://localhost:3000'. '/oauth.php') . '&code=' . $_GET['code'] . '&code_verifier=' . $sessionData['txtCodeVerifier']);

$response = $oAuth->postRequest('token', $oauthRequest);

	$reply = json_decode($response);


echo reply;

class modOAuth {

	function generateRequest($data) {
		return $data;
	}

	function postRequest($endpoint, $data) {
		$ch = curl_init('https://login.microsoftonline.com/2685ce0d-979a-47d6-839d-a4b8a792138c/oauth2/v2.0/' . $endpoint);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$response = curl_exec($ch);
		if ($cError = curl_error($ch)) {
			echo $cError;
			exit;
		}
		curl_close($ch);
		return $response;

	}
}
