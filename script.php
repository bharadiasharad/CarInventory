<?php
include 'database_crud.php';

class Script{
    function postValues(){
    if(isset($_POST['car_model_id']) && !empty($_POST['car_model_id'])){
      $database = new Database();
      $database -> updateCount($_POST['car_model_id']);
    }
  }
}

$script = new Script();
$script -> postValues();

?>


