<?php
	require_once "vendor/autoload.php";

	use GuzzleHttp\Client;
	use GuzzleHttp\Message\Request;
	use GuzzleHttp\Message\Response;

	$client = new Client();

	$response = $client->get("http://localhost/videoconversionservice/api/client/all");
	$body = $response->getBody();
	$arr_body = json_decode($body);
	print_r($arr_body);
?>