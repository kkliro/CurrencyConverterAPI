<?php
	
require_once("../Token/jwt.php");
require_once("ConversionController.php");
require_once("../Logs/LogHandler.php");

class AuthenticationController{

	private $expirationDate = 3600;
	private $secretKey = "E12307821kdr-42=3=d=sa=e223891EEdajsJDias";

	function generateToken($data){
		$token = array();

		if (!isset($data->licenseKey)){
			LogHandler::write("No license key provided.", "ERROR");
			return json_encode(["Token" => null]);
		}

	    $token['id'] = $this->getClientID($data->licenseKey); 
	    $token['exp'] = time() + $this->expirationDate;

	    $tokenHash = JWT::encode($token, $this->secretKey);
	    $tokenResponse = json_encode(["Token" => $tokenHash]);

	    LogHandler::write("Generated Token for [ID: ". $token['id'] . ", License Key: " . $data->licenseKey . "].", "INFO");

	  	return $tokenResponse;
		
	}

	function getClientID($licenseKey){
       $clientController = new ClientController();
       return $clientController->getClientID($licenseKey);
    }

   	function authenticateToken($tokenHash){
   		try {
            $token = JWT::decode($tokenHash, $this->secretKey);
            if ($token->exp >= time()) {
            	LogHandler::write("Authenticated user [ID: $token->id].", "INFO");
            	return true;
            }
            else{
            	LogHandler::write("Unauthenticated user attempted to make a call.", "INFO");
                return false;
            }
        } catch (Exception $e) {
        	LogHandler::write($e, "ERROR");
            return false;
        }
   	}

}

?>