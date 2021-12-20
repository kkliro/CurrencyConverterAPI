<?php

date_default_timezone_set("America/New_York");

class LogHandler{

	public static function write($message, $type){
		$date = date("Y-m-d h:i:sa");
		$file = fopen("../Logs/api-logs.log", "a+") or die("Cannot open file.");
		$message = "[$date] - [$type] - $message\n";
		fwrite($file, $message);	
		fclose($file);
	}

}

?>