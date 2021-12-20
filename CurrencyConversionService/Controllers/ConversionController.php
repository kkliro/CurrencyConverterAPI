<?php
require_once("../Models/Conversion.php");
require_once("../Models/Client.php");
require_once("../Logs/LogHandler.php");

class ConversionController
{
    function add($licenseKey, $originalCurrency, $convertedCurrency,  $originalAmount)
    {
        $conversion = new Conversion();
        $client = new Client();

        $client = $client->findClientID($licenseKey);

        $date = date('Y-m-d');

        if ($client !== null){
            $conversion->setClientID($client->getClientID());
            $conversion->setRequestDate($date);
            $conversion->setOriginalCurrency($originalCurrency);
            $conversion->setOriginalAmount($originalAmount);
            $conversion->setConvertedCurrency($convertedCurrency);

            $convertedAmount = $this->convert($originalCurrency, $convertedCurrency, $originalAmount);

            $conversion->setConvertedAmount($convertedAmount);

            $date = date('Y-m-d');
            $conversion->setCompletionDate($date);

            $conversion->insert();

            return $convertedAmount;        
        }
        
    }

    function convert($originalCurrency, $convertedCurrency, $originalAmount){
        $endpoint = 'latest';
        $access_key = '22206d1ad17012cbe8f4c2e9a9f0f4b6';

        $ch = curl_init('http://api.exchangeratesapi.io/v1/'.$endpoint.'?access_key='.$access_key.'');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $json = curl_exec($ch);
        curl_close($ch);

        $exchangeRates = json_decode($json, true);

        LogHandler::write("Updated real-time exchanges rates...", "INFO");

        LogHandler::write("Converted {$originalCurrency} -> {$convertedCurrency}", "INFO");

        $originalCurrency = $exchangeRates['rates'][$originalCurrency];
        $convertedCurrency = $exchangeRates['rates'][$convertedCurrency];

    	$convert = ($convertedCurrency / $originalCurrency) * $originalAmount;

    	return $convert = round($convert, 2);
    }

}
?>