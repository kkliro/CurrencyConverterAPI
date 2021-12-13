<?php
	
	require_once('../Models/Client.php');

	class ClientController{
		
		function getClients(){
			$client = new Client();
			$clients = $client->getAllClients();
			return $clients;
		}
		
	}

?>