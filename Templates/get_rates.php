<?php
// set API Endpoint and API key
$endpoint = 'latest';
$access_key = '22206d1ad17012cbe8f4c2e9a9f0f4b6';


// CAD -> USD; (USD_Rate / CAD_Rate) * amount_specified

// Initialize CURL:
$ch = curl_init('http://api.exchangeratesapi.io/v1/'.$endpoint.'?access_key='.$access_key.'');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Store the data:
$json = curl_exec($ch);
curl_close($ch);

// Decode JSON response:
$exchangeRates = json_decode($json, true);

// Access the exchange rate values, e.g. GBP:
var_dump($exchangeRates['rates']);
?>