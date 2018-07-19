<?php

class db {
	public $conn;  //will be used by other classes
	private $host;
	private $user;
	private $password;
	private $database;
	
	function __construct() {
		$this->conn = false;
		$this->host = "localhost";
		$this->user = "root";
		$this->password = "";
		$this->database = "car_inventory_database";
		$this->connect();
	}

	
	function connect() {
		if (!$this->conn) {
			try {
				$this->conn = mysqli_connect($this->host, $this->user, $this->password, $this->database);	
				if (!$this->conn) {
					echo 'Connection failed';
					die();
				} 
			} catch (Exception $e) {
				echo "<script type='text/javascript'>alert('$e');</script>";
			}
		}
		return $this->conn;
	}
	
	// to select all company names
	function selectAll() {
		$sql = "SELECT car_company_name FROM car_company";
		try {
			$result = $this->conn->query($sql);
			if($result->num_rows > 0)
				return $result;
		} catch (Exception $e) {
			echo "<script type='text/javascript'>alert('$e');</script>";
		}
	}

	// will select complete data to display on the table
	function selectCompleteDataToDisplay(){
		$sql = "SELECT car_company.car_company_name , car_model.car_model_name, car_model.car_model_count, car_model.car_model_id 		FROM car_model
				INNER JOIN car_company 
				ON car_model.car_company_id = car_company.car_company_id
				WHERE car_model.car_model_count > 0";
		try {
			$result = $this->conn->query($sql);
			if($result->num_rows > 0)
				return $result;
		} catch (Exception $e) {
			echo "<script type='text/javascript'>alert('$e');</script>";
		} 
	}

	// will check wheather company name already exists else
	// it will enter into the database
	function insert($company_name) {
		try {
			if($this->checkCompany($company_name)){
		        $sql = "INSERT INTO car_company (car_company_id, car_company_name) VALUES (null, '$company_name')";
		        if($this->conn->query($sql))
		        	return true;
			}
		    else{
		    	echo "<script type='text/javascript'>alert('error');</script>";
		    	return false;
		    }
		} catch (Exception $e) {
			echo "<script type='text/javascript'>alert('$e');</script>";
		}
	}

	// will check for the car model if exist in the database
	// if exists, it will increase its count by 1
	// else, will create a new field of the car model name
	function insertCarModel($company_name, $model_name) {
		try {
			$modelExists = $this->checkIfModelExists($model_name);
			if($modelExists != ''){
				$status = $this->incrementModelCount($modelExists);
				if($status) 
					return true;
				else return false;
			}

			$company_id = $this->getCompanyId($company_name);
			$status = $this->insertModel($model_name, $company_id);

			if($status)
				return true;
			else return false;  
		} catch (Exception $e) {
			echo "<script type='text/javascript'>alert('$e');</script>";
		}
	}


	//insert car model in database
	function insertModel($model_name, $company_id){
		$sql = "INSERT INTO car_model (car_model_id, car_company_id, car_model_name, car_model_count) VALUES ('', '$company_id', '$model_name', 1)";
		try {
			$result = $this->conn->query($sql);
			if($result)
				return true;
			else return false;
		} catch (Exception $e) {
			echo "<script type='text/javascript'>alert('$e');</script>";
		}
	}

	// increase car model count by 1
	function incrementModelCount($modelExists){
		$sql = "UPDATE car_model SET car_model_count = car_model_count + 1 WHERE car_model_id = '$modelExists'";
		try {
			$result = $this->conn->query($sql);
			if($result)
				return true;
			else return false;
		} catch (Exception $e) {
			echo "<script type='text/javascript'>alert('$e');</script>";
		}
	}

	//check for the car model in the database
	function checkIfModelExists($model_name){
		$sql = "SELECT car_model_id FROM car_model where car_model_name = '$model_name'";
		try {
			$result = $this->conn->query($sql);
			if($result->num_rows == 1){
				$row = $result->fetch_assoc() ;
	                return $row['car_model_id'];
			}
			else return 0;
		} catch (Exception $e) {
			echo "<script type='text/javascript'>alert('$e');</script>";			
		}
	}

	// give company primary key
	function getCompanyId($company_name){
		$sql = "SELECT car_company_id FROM car_company where car_company_name = '$company_name'";		
		try {
			$result = $this->conn->query($sql);
			if($result->num_rows == 1){
				$row = $result->fetch_assoc() ;
	                return $row['car_company_id'];
			}
		} catch (Exception $e) {
			echo "<script type='text/javascript'>alert('$e');</script>";			
		}
	}

	// check for company name in the database
	function checkCompany($company_name) {
		$sql = "SELECT 1 FROM car_company WHERE car_company_name = '$company_name'";
		try {
			$result = $this->conn->query($sql);

			if($result->num_rows > 0){
				$result->close();
				return false;
			}
			else
				return true;
		} catch (Exception $e) {
			echo "<script type='text/javascript'>alert('$e');</script>";			
		}
	}

	// will decrement car model count by on when sold is clicked
	function updateCount($car_model_count){
		$sql = "UPDATE car_model SET car_model_count = car_model_count - 1 WHERE car_model_id = '$car_model_count'";
		try {
			$result = $this->conn->query($sql);
			if($result)
				return true;
			else return false;
		} catch (Exception $e) {
			echo "<script type='text/javascript'>alert('$e');</script>";			
		}
	}
}