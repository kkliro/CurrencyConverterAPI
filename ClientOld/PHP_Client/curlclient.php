<?php
// $fields = [
//     'clientID' => 1,
//     'requestDate' => '2021-10-24',
//     'requestCompletionDate' => '2021-10-31',
//     'originalFormat' => 'MP4',
//     'targetFormat' => 'AVI',
//     'file'   => "videoExamplePath",
// ];

$fields = [
    'licenseKey' => "KEYABC123",
    'originalFormat' => 'MP4',
    'targetFormat' => 'AVI',
    'file'   => "video_path_example",
];

$fields_string = http_build_query($fields);

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL,"http://localhost/videoconversionservice/api/conversion/");
curl_setopt($ch,CURLOPT_POST, true);
curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);

//So that curl_exec returns the contents of the cURL; rather than echoing it
curl_setopt($ch,CURLOPT_RETURNTRANSFER, true); 
//execute post
$result = curl_exec($ch);
echo $result;
curl_close($ch);

?>