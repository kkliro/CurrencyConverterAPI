<?php
require_once('Request.php');
require_once('Response.php');
require_once("jwt.php");

spl_autoload_register('autoLoad');

function autoLoad($classname)
{
    if(preg_match('/[a-zA-Z]+Controller$/',$classname))
    {
        require_once('../controllers/'. $classname . '.php');
        return true;
    }
}

$request = new Request();

$request->accept = "application/json";
$response = new Response();
        // Get the target resource controller name
        $keys = array();
        $keys = array_keys($request->urlParameters);

        $className = ucfirst($keys[0]);
        $controllerName = ucfirst($keys[0]).'Controller';

        if(class_exists($controllerName)){
            
            if ($request->accept == "application/json"){
                if($className == "Client")
                {
                    if ($request->verb == "GET"){
                        $controller = new $controllerName();
                        $response->payload = json_encode($controller->getClients());
                    }
                
                }
                else if($className == "Conversion")
                {                          
                    if ($request->verb == "POST"){
                        $controller = new $controllerName();
                        $data = json_decode(file_get_contents("php://input"));

                        $headers = apache_request_headers();

                        $secretKey = "service_key";

                        if (array_key_exists("Authorization", $headers)){
                            // check if token matches and exists
                            $authHeader = $headers["Authorization"];
                            $tokenHash = str_replace("Bearer ", "",$authHeader);
                            try {
                                $token = JWT::decode($tokenHash, $secretKey);
                                if ($token->exp >= time()) {
                                    $convertedAmount = $controller->add($data->licenseKey,$data->originalCurrency,$data->convertedCurrency,$data->originalAmount);
                                    $response->statusCode = 201;
                                    $response->message = "Created";

                                    $responseArgs = array('Status'=>$response->statusCode, 'Message'=>$response->message, 'ConvertedAmount'=>$convertedAmount);

                                    $response->payload = json_encode($responseArgs);
                                }
                                else{
                                    $response->statusCode = 401;
                                    $response->message = 'Unauthorized access';
                                    $responseArgs = array('Status'=>$response->statusCode, 'Message'=>$response->message);
                                    $response->payload = json_encode($responseArgs);
                                }
                            } catch (Exception $e) {
                                var_dump($e);
                                $response->statusCode = 401;
                                $response->message = 'Unauthorized access';
                                $responseArgs = array('Status'=>$response->statusCode, 'Message'=>$response->message);
                                $response->payload = json_encode($responseArgs);
                            }

                        }                        
                    }   
                }
                else if ($className == "Authentication"){
                    if ($request->verb == "POST"){
                        $controller = new $controllerName();
                        $data = json_decode(file_get_contents("php://input"));
                        $token = $controller->generateToken($data);
                        $response->payload = $token; 
                    }
                }
            }
        }
        echo $response->payload;
?>