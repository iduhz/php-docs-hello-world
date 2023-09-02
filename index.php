<?php

echo "Hello World!";

$url = 'https://easysignaturefunctionapp.azurewebsites.net/api/HelloWorld2';



$ch = curl_init($url);                                                                      
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                        

$server_output = curl_exec ($ch);

echo  $server_output;
