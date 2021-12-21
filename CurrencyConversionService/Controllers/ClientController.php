<?php
	
	require_once('../Models/Client.php');

	class ClientController{
		
		function getClients(){
			$client = new Client();
			$clients = $client->getAllClients();
			return $clients;
		}

		function getClientID($licenseKey){
			$client = new Client();
	        $client = $client->findClientID($licenseKey);
	        return $client->getClientID();
		}
		
	}

?>