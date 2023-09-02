<?php

$oauthRequest = generateRequest('grant_type=authorization_code&client_id=' . _OAUTH_CLIENTID . '&redirect_uri=' . urlencode(_URL . '/oauth.php') . '&code=' . $_GET['code'] . '&code_verifier=' . $sessionData['txtCodeVerifier']);

$response = postRequest('token', $oauthRequest);

	$reply = json_decode($response);


echo reply;

function generateRequest($data) {
	return $data . '&client_secret=' . urlencode(_OAUTH_SECRET);
}

function postRequest($endpoint, $data) {
	$ch = curl_init('https://login.microsoftonline.com/2685ce0d-979a-47d6-839d-a4b8a792138c/oauth2/v2.0/' . $endpoint);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	$response = curl_exec($ch);
	if ($cError = curl_error($ch)) {
		echo $this->errorMessage($cError);
		exit;
	}
	curl_close($ch);
	return $response;

}
