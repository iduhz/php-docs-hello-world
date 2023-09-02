<?php

echo "Hello World!";

try {
    $guzzle = new \GuzzleHttp\Client();
    $url = 'https://login.microsoftonline.com/2685ce0d-979a-47d6-839d-a4b8a792138c/oauth2/v2.0/token';
    $token = json_decode($guzzle->post($url, [
    'form_params' => [
        'grant_type'    => 'password',
        'client_id'     => 'f2924b54-9525-4521-ae9f-a85652060e6f'
    ],
])->getBody()->getContents());


  echo $token
