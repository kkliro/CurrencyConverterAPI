<?php
    // A- Reading data as a stream
    $fp = fopen("http://localhost/videoconversionservice/api/client/all", "r");
    $data = stream_get_contents($fp, -1, 0);
    echo $data;
?>