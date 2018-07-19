<?php

include_once 'db.php';

class Database {   

	var $conn;

	function __construct() {   
		$this->conn = new db();    
	}

    function insertCompanyName($company_name) {
        return $this->conn -> insert(mysqli_real_escape_string($this->conn -> conn ,$company_name));
    }

    function insertModelName($company_name, $model_name) {
        return $this->conn -> insertCarModel(mysqli_real_escape_string($this->conn -> conn ,$company_name), mysqli_real_escape_string($this->conn -> conn ,$model_name));
    }

    function selectAllCompanyName(){
    	return $this->conn -> selectAll();
    }

    function selectCompleteDataToDisplay(){
    	return $this->conn -> selectCompleteDataToDisplay();
    }

    function updateCount($car_model_id){
    	return $this->conn -> updateCount(mysqli_real_escape_string($this->conn -> conn ,$car_model_id));
    }
}
?>
