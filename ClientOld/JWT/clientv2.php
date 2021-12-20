<?php
$data = [
    'licenseKey' => "KEYABC123",
    'originalCurrency' => 'USD',
    'convertedCurrency' => 'CAD',
    'originalAmount'   => 11,
];

$data = json_encode($data);

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL,"http://localhost/CurrencyConverterAPI/CurrencyConversionService/api/authentication/");
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
curl_setopt($ch,CURLOPT_POSTFIELDS, $data);

curl_setopt($ch,CURLOPT_RETURNTRANSFER, true); 
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type:application/json',
    'Accept:application/json',
    'Content-Length:' . strlen($data),
));

$token = curl_exec($ch);

var_dump($token);

try{
    $token = json_decode($token, true);
} catch (Exception $e) {
    return;
}

if (!array_key_exists("Token", $token)){
    return;
}

curl_setopt($ch, CURLOPT_URL,"http://localhost/CurrencyConverterAPI/CurrencyConversionService/api/conversion/");
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type:application/json',
    'Accept:application/json',
    'Content-Length:' . strlen($data),
    "Authorization: Bearer {$token['Token']}"
));

$result = curl_exec($ch);
echo $result;

curl_close($ch);

?>