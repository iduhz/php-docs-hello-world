<?php

$oauthRequest = generateRequest('grant_type=authorization_code&client_id=' . _OAUTH_CLIENTID . '&redirect_uri=' . urlencode(_URL . '/oauth.php') . '&code=' . $_GET['code'] . '&code_verifier=' . $sessionData['txtCodeVerifier']);

$response = postRequest('token', $oauthRequest);

	$reply = json_decode($response);


echo reply;

function generateRequest($data) {
	        if (_OAUTH_METHOD == 'certificate') {
                        // Use the certificate specified
                        //https://docs.microsoft.com/en-us/azure/active-directory/develop/active-directory-certificate-credentials
                        $cert = file_get_contents(_OAUTH_AUTH_CERTFILE);
                        $certKey = openssl_pkey_get_private(file_get_contents(_OAUTH_AUTH_KEYFILE));
                        $certHash = openssl_x509_fingerprint($cert);
                        $certHash = base64_encode(hex2bin($certHash));
                        $caHeader = json_encode(array('alg' => 'RS256', 'typ' => 'JWT', 'x5t' => $certHash));
                        $caPayload = json_encode(array('aud' => 'https://login.microsoftonline.com/' . _OAUTH_TENANTID . '/v2.0',
                                                'exp' => date('U', strtotime('+10 minute')),
                                                'iss' => _OAUTH_CLIENTID,
                                                'jti' => $this->uuid(),
                                                'nbf' => date('U'),
                                                'sub' => _OAUTH_CLIENTID));
                        $caSignature = '';

                        $caData = $this->base64UrlEncode($caHeader) . '.' . $this->base64UrlEncode($caPayload);
                        openssl_sign($caData, $caSignature, $certKey, OPENSSL_ALGO_SHA256);
                        $caSignature = $this->base64UrlEncode($caSignature);
                        $clientAssertion = $caData . '.' . $caSignature;
                        return $data . '&client_assertion=' . $clientAssertion . '&client_assertion_type=urn:ietf:params:oauth:client-assertion-type:jwt-bearer';
                } else {
			// Use the client secret instead
                        return $data . '&client_secret=' . urlencode(_OAUTH_SECRET);
                }

	}

	function postRequest($endpoint, $data) {
		$ch = curl_init('https://login.microsoftonline.com/' . _OAUTH_TENANTID . '/oauth2/v2.0/' . $endpoint);
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
