<?php
include 'header.php';
include_once 'database_crud.php';

class Model{
  private $database;
  public $result;

  function __construct() {   
    $this->database = new Database();    
  }

  function getResult(){
    return $this->result;
  }

  // will take the data passed and send to copy it in database
  function getPosedValues(){
    if(isset($_POST['manufacturer_name']) && !empty($_POST['manufacturer_name']) 
      && isset($_POST['model_name']) && !empty($_POST['model_name'])){
        if($this->database->insertModelName($_POST['manufacturer_name'], $_POST['model_name'])){
            //header("Location : model.php");
            echo "<script type='text/javascript'>location.href = 'model.php'</script>";
        }
        exit();
    }
  }

  // will get all the car company names present in the database
  function getCompanyName(){
    try {
      $this->result = $this->database->selectAllCompanyName();
    } 
    catch (Exception $e) {
      echo "<script type='text/javascript'>alert('$e');</script>";
    }
  }
}

$model = new Model();
$model->getCompanyName();
$model->getPosedValues();

?>




<!DOCTYPE html>
<html>
<body>
  <div class="content-wrapper">
    <div class="container">
      <div class="card card-register mx-auto mt-5">
        <div class="card-header" style="text-align: center;">Add Model</div>
        <div class="card-body">
          <form action="model.php" method="post">
            <div class="row">
              <div class="form-group col-md-6">
                <input class="form-control" name="model_name" type="text" placeholder="Enter Model Name" style="text-align: center;" required>
              </div>
              <div class="form-group col-md-6">
                <select class="form-control form-group" name="manufacturer_name">
                  <?php
                    while($row = $model->result->fetch_assoc()) {
                      echo '<option value="'.$row['car_company_name'].'"selected>'.$row['car_company_name'].'</option>';
                    }
                  ?>
                </select>
              </div>
            </div>
            <input type="submit" class="btn btn-primary btn-block" name="next" value="Submit" />
          </form>
        </div>
    </div>
  </div>
</body>
</html>