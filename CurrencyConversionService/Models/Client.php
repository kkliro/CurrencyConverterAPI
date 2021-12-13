<?php
	require_once('../Database/ConnectionManager.php');

	class Client{
		public $clientID;
		private $clientName;
		private $licenseNumber;
		private $licenseStartDate;
		private $licenseEndDate;
		private $licenseKey;

		private $connectionManager;
		private $dbConnection;

		function __construct(){
			$this->connectionManager = new ConnectionManager();
			$this->dbConnection = $this->connectionManager->getConnection();
		}

		function findClientID($licenseKey){
			$stmt = $this->dbConnection->prepare("SELECT * FROM client WHERE licenseKey = :licenseKey");
			$stmt->execute(['licenseKey'=>$licenseKey]);
			$stmt->setFetchMode(\PDO::FETCH_GROUP|\PDO::FETCH_CLASS, "Client");
			return $stmt->fetch();
		}

		function getClientID(){
			return $this->clientID;
		}

		function getClientName(){
			return $this->clientName;
		}

		function setClientName($clientName){
			$this->clientName = $clientName;
		}

		function getLicenseNumber(){
			return $this->licenseNumber;
		}

		function setLicenseNumber($licenseNumber){
			$this->licenseNumber = $licenseNumber;
		}

		function getLicenseStartDate(){
			return $this->licenseStartDate;
		}

		function setLicenseStartDate($licenseStartDate){
			$this->licenseStartDate = $licenseStartDate;
		}

		function getLicenseEndDate(){
			return $this->licenseEndDate;
		}

		function setLicenseEndDate($licenseEndDate){
			$this->licenseEndDate = $licenseEndDate;
		}

		function getLicenseKey(){
			return $this->licenseKey;
		}

		function setLicenseKey($licenseKey){
			$this->licenseKey = $licenseKey;
		}

		function getAllClients(){
			$query = "SELECT * FROM client";
			$stmt = $this->dbConnection->prepare($query);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}
	}
?>