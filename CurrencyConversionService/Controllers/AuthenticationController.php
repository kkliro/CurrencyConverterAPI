<?php
	
require_once("../Token/jwt.php");
require_once("ConversionController.php");

class AuthenticationController{

	private $expirationDate = 3600;
	private $secretKey = "service_key";

	function generateToken($data){
		$token = array();
	    $token['id'] = $this->getClientID($data->licenseKey); 
	    $token['exp'] = time() + $this->expirationDate;

	    $tokenHash = JWT::encode($token, $this->secretKey);
	    $tokenResponse = json_encode(["Token" => $tokenHash]);

	  	return $tokenResponse;
	}

	function getClientID($licenseKey){
        $client = new Client();
        $client = $client->findClientID($licenseKey);
        return $client->getClientID();
    }

   	function authenticateToken($tokenHash){
   		try {
            $token = JWT::decode($tokenHash, $this->secretKey);
            if ($token->exp >= time()) {
               return true;
            }
            else{
                return false;
            }
        } catch (Exception $e) {
            return false;
        }
   	}

}

?>