<?php
	class Request{
		public $verb;
		public $urlParameters;
		public $payload;
		public $payloardFormat;
		public $accept;

		function __construct(){
			//NOTE-1 :
			// Apache the web server stores request information in the Global variable $_SERVER
			// as an associative array. 
			$this->verb = $_SERVER['REQUEST_METHOD'];

			//NOTE-2 :
			// URL parameters are passed as what we call a Query String
			// it is the part after the page name separated by a question mark "?"
			// e.g, http://localhost/videoconversionservice/api/index.php?client=1
			$this->urlParameters = array();
			parse_str($_SERVER['QUERY_STRING'], $this->urlParameters);
			// $this->payload;
			// $this->payloardFormat;
		}
	} // END OF CLASS
?>