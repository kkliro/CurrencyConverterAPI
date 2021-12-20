<?php

// Include the SDK using the composer autoloader
require 'vendor/autoload.php';

class AWSHandler{
	
	public static function Upload($countryCode){
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
		$key = '../CDN/Images/CCA_' . $countryCode . '.png';

		$result = $s3->putObject([
			'Bucket' => $bucket,
			'Key'    => $key,
			'SourceFile' => $key //-- use this if you want to upload a file from a local location
		]);
	}

	public static function Fetch($countryCode){
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

		$key = '../CDN/Images/CCA_' . $countryCode . '.png';

		try {
		    $cmd = $s3->getCommand('GetObject', [
			    'Bucket' => $bucket,
			    'Key' => $key,
			    'SaveAs' => 'Downloads\\' . 'CCA_' . $countryCode . '.png',
			]);

		    $request = $s3->createPresignedRequest($cmd, '+120 seconds');
			$presignedUrl = (string)$request->getUri();

			// var_dump($presignedUrl);

			// echo "<a href=$presignedUrl>Download File</a><br>";

		   	return $presignedUrl;
		} catch (S3Exception $e) {
		    echo $e->getMessage() . PHP_EOL;
		}
	}

}

?>
