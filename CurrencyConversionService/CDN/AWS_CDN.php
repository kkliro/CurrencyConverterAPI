<?php

// Include the SDK using the composer autoloader
require 'vendor/autoload.php';

$config = simplexml_load_file(dirname(__DIR__).'/CDN/aws_config.xml');

$bucket = $config->bucket;

$s3 = new Aws\S3\S3Client([
	'region'  => 'us-east-1',
	'version' => 'latest',
	'credentials' => [
	    'key'    => $config->key,
	    'secret' => $config->secret,
	]
]);

// Send a PutObject request and get the result object.
$key = 'circle.mp4';

$result = $s3->putObject([
	'Bucket' => $bucket,
	'Key'    => $key,
	// 'Body'   => 'this is the body!',
	'SourceFile' => $key //-- use this if you want to upload a file from a local location
]);

// Print the body of the result by indexing into the result object.
//var_dump($result);

try {
    $cmd = $s3->getCommand('GetObject', [
	    'Bucket' => $bucket,
	    'Key' => $key,
	    'SaveAs' => 'Downloads\\downloaded_circle.mp4',
	]);

    $request = $s3->createPresignedRequest($cmd, '+15 seconds');
	$presignedUrl = (string)$request->getUri();

    echo "<a href=$presignedUrl>Download File</a><br>";
    // Display the object in the browser.
    // header("Content-Type: {$result['ContentType']}");
    // echo $result['Body'];
    //var_dump($response['ObjectURL']);

} catch (S3Exception $e) {
    echo $e->getMessage() . PHP_EOL;
}
