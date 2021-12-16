<?php

$data = [
    'licenseKey' => "KEYABC123",
];

$data = json_encode($data);

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL,"http://localhost/CurrencyConverterAPI/CurrencyConversionService/api/authentication/");
curl_setopt($ch,CURLOPT_POST, true);
curl_setopt($ch,CURLOPT_POSTFIELDS, $data);

curl_setopt($ch,CURLOPT_RETURNTRANSFER, true); 
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type:application/json',
    'Accept:application/json',
    'Content-Length:' . strlen($data),
));
//execute post
$token = curl_exec($ch);

// $token = json_decode($token, true);

var_dump($token);

curl_close($ch);

?>