<?php

include 'app/config.php';

$random_subdomain = uniqid();

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.digitalocean.com/v2/domains/stuu.space/records",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "\n{   \n            \"type\": \"CNAME\",\n            \"name\": \"$random_subdomain\",\n            \"data\": \"@\",\n            \"ttl\": 100\n        }",
  CURLOPT_HTTPHEADER => array(
    "Authorization: Bearer $config[application_token]",
    "Cache-Control: no-cache",
    "Content-Type: application/json"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
    echo "cURL Error #:" . $err;
} else {
    echo $response;
}
