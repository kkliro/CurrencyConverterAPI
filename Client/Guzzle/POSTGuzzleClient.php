<?php
require "vendor/autoload.php";

use GuzzleHttp\Client;
use GuzzleHttp\Message\Request;
use GuzzleHttp\Message\Response;

$client = new \GuzzleHttp\Client();
$response = $client->post("http://localhost/videoconversionservice/api/conversion/", [
    'form_params' => [
        'licenseKey' => "KEYABC123",
        'originalFormat' => 'MP4',
        'targetFormat' => 'AVI',
        'file'   => "video_file",
    ]
]);
$body = $response->getBody();
$arr_body = json_decode($body);
// var_dump($arr_body->Status);
print_r($arr_body);
?>