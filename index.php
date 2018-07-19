<?php 
include_once 'database_crud.php';
include 'header.php';

class Manufacture{
  private $database;

  function __construct() {   
    $this->database = new Database();    
  }

  //will get the company name and send it to write in database
  function getPostValues(){
    if(isset($_POST['manufacturer_name']) && !empty($_POST['manufacturer_name'])){
      $status = $this->database -> insertCompanyName($_POST['manufacturer_name']);
      if($status){
        echo "<script type='text/javascript'>alert('This company was already present!');</script>";
      }
      header('Location: model.php');
    }
  }
}

$manufacturer = new Manufacture();
$manufacturer->getPostValues();

?>


<!DOCTYPE html>
<html>
<body>
  <div class="content-wrapper">
    <div class="container">
      <div class="card card-login mx-auto mt-5">
        <div class="card-header" style="text-align: center;">Add Manufacture</div>
        <div class="card-body">
          <form action="index.php" method="post">
            <div class="form-group">
              <input class="form-control" name="manufacturer_name" type="text" placeholder="Enter Manufacturer Name" style="text-align: center;" required>
            </div>
            <input type="submit" class="btn btn-primary btn-block" name="next" value="Next" />
          </form>
        </div>
    </div>
  </div>
</body>
</html>