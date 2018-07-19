<?php
include_once 'header.php';
include 'database_crud.php';


class View{

  var $database;
  public $result;

  function __construct() {   
    $this->database = new Database();    
  }

  //Will get the complete database if the car model count is > 0
  function getEntireData(){
    try {
      $this->result = $this->database->selectCompleteDataToDisplay();
    } 
    catch (Exception $e) {
      echo "<script type='text/javascript'>alert('$e');</script>";
    }
  }
}

$object = new View();
$object->getEntireData();

?>


<!DOCTYPE html>
<html lang="en">
<body>
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Data Table Example</div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Sr. No.</th>
                  <th>Company</th>
                  <th>Model</th>
                  <th>Quantity</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Sr. No.</th>
                  <th>Company</th>
                  <th>Model</th>
                  <th>Quantity</th>
                  <th>Status</th>
                </tr>
              </tfoot>
              <tbody>

                <?php
                  $i=0;
                  while($row = $object->result->fetch_assoc()) {
                    echo "
                      <tr id='tr".$row['car_model_id']."'>
                        <td>".++$i."</td>
                        <td>".$row['car_company_name']."</td>
                        <td>".$row['car_model_name']."</td>
                        <td id='count".$row['car_model_id']."'>".$row['car_model_count']."</td>
                        <td><a href='#' onclick='return false;' id='".$row['car_model_id']."'>sold</a></td>
                      </tr>";
                    }
                    $object->result->close();
                ?>  
              </tbody>
            </table>
          </div>
        </div>
        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
      </div>
    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
    <footer class="sticky-footer">
      <div class="container">
        <div class="text-center">
          <small>Copyright © Your Website 2018</small>
        </div>
      </div>
    </footer>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>
  </div>
</body>
</html>
