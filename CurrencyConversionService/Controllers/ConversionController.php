<?php
require_once("../Models/Conversion.php");
require_once("../Models/Client.php");

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

            $convertedAmount = $this->convert($originalAmount);

            $conversion->setConvertedAmount($convertedAmount);

            $date = date('Y-m-d');
            $conversion->setCompletionDate($date);

            $conversion->insert();

            return $convertedAmount;        

        }
        
    }

    function convert($amount){
    	$conversion = $amount + 20;
    	return $conversion;
    }

}
?>