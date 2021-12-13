<?php
require_once("../Database/ConnectionManager.php");

class Conversion
{
	private $conversionID;
	private $clientID;
	private $requestDate;
	private $completionDate;
	private $originalCurrency;
	private $convertedCurrency;
	private $originalAmount;
	private $convertedAmount;

	private $dbConnection;
	private $connectionManager;

	function __construct()
	{
		$this->connectionManager = new ConnectionManager();
		$this->dbConnection = $this->connectionManager->getConnection();
	}

	public function getConversionID(){
		return $this->conversionID;
	}

	public function getClientID(){
		return $this->clientID;
	}

	public function setClientID($clientID){
		$this->clientID = $clientID;
	}

	public function getRequestDate(){
		return $this->requestDate;
	}

	public function setRequestDate($requestDate){
		$this->requestDate = $requestDate;
	}

	public function getCompletionDate(){
		return $this->requestCompletionDate;
	}

	public function setCompletionDate($completionDate){
		$this->completionDate = $completionDate;
	}

	public function getOriginalCurrency(){
		return $this->originalCurrency;
	}

	public function setOriginalCurrency($originalCurrency){
		$this->originalCurrency = $originalCurrency;
	}

	public function getConvertedCurrency(){
		return $this->convertedCurrency;
	}

	public function setConvertedCurrency($convertedCurrency){
		$this->convertedCurrency = $convertedCurrency;
	}

	public function getOriginalAmount(){
		return $this->originalAmount;
	}

	public function setOriginalAmount($originalAmount){
		$this->originalAmount = $originalAmount;
	}

	public function getConvertedAmount(){
		return $this->convertedAmount;
	}

	public function setConvertedAmount($convertedAmount){
		$this->convertedAmount = $convertedAmount;
	}
		
	public function insert()
	{
		$query = "INSERT INTO conversion(clientID,requestDate,completionDate,originalCurrency,convertedCurrency,originalAmount,convertedAmount)
		 Values (:clientID,:requestDate,:completionDate,:originalCurrency,:convertedCurrency,:originalAmount,:convertedAmount)";
		$stmt = $this->dbConnection->prepare($query);
		$stmt->execute(['clientID'=>$this->clientID,'requestDate'=>$this->requestDate,'completionDate'=>$this->completionDate,
		'originalCurrency'=>$this->originalCurrency,'convertedCurrency'=>$this->convertedCurrency,'originalAmount'=>$this->originalAmount,'convertedAmount'=>$this->convertedAmount]);

	}
}

?>