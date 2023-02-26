<?php
session_start();
include "../dbcon.php";
if (isset($_POST['date'])) {
  $newdate = $_POST['date'] . "-01";
  $_SESSION['printdate'] =$newdate;
}
else
{
  $_SESSION['printdate'] ="";
}

if (isset($_POST['empname']))
{
  if ($_POST['empname'] != "")
  {
    $sqlname = "SELECT `name` FROM `employees` WHERE id = '" . $_POST["empname"] . "'";
    $actresultname = mysqli_query($conn, $sqlname);
    $row = mysqli_fetch_assoc($actresultname);
    $_SESSION['printname'] = $row['name'];
  }
  else
  {
    $_SESSION['printname'] = "null";
  }
}
else
{
  $_SESSION['printname'] = "";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" />
  <link rel="stylesheet" href="css/dataTables.bootstrap5.min.css" />
  <link rel="stylesheet" href="css/style.css" />

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script>
    $(function() {
      $("#country").select2();
    });
  </script>
</head>

<body class="fixed-left" style="background-color: #ECB365">

  <!-- Top Bar Start -->
  <?php include('includes/navbar.php'); ?>
  <!-- ========== Left Sidebar Start ========== -->
  <?php include('includes/sidebar.php'); ?>
  <!-- Left Sidebar End -->
  
  <!-- Print Pdf End -->

  <main class="mt-5 pt-4">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 mb-3">
          <div class="card">
            <div class="card-header">
              <span><i class="bi bi-table me-2"></i></span> Monthly Report
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table id="example" class="table table-hover data-table" style="width: 100%">

                  <div class="m-2 row">
                    <div class="col">
                      <form method="POST">
                        <label for="startDate">Pick a month :</label>
                        <input type="month" id="startDate" name="date" class="date-picker form-control w-25 mb-2" />
                        <button class="btn btn-primary">load</button>
                      </form>

                      <!-- Button HTML (to Trigger Print) -->
                      <a class="btn btn-outline-primary" role="button" href="./mReport.php"  target="_blank">
                      <span class="me-2"><i class="bi bi-printer"></i></span> 
                      Print Report
                      </a>
                    </div>
                    <div class="col">
                    
                      <form method="POST">
                        <div class="form-group w-50">
                          <label>Choose Employee:</label>
                          <select class="form-control" id="name" name="empname">
                            
                            <option value=""> </option>
                            <?php
                            $sql3 = "SELECT * FROM employees;";
                            $actresult3 = mysqli_query($conn, $sql3);

                            while ($result3 = mysqli_fetch_assoc($actresult3)) { ?>
                              <option value=<?php echo $result3['id'] ?>> <?php echo $result3['name'] ?></option>
                            <?php } ?>
                          </select>
                          <button class="btn btn-primary mt-2">load</button>
                        </div>
                      </form>
                    </div>
                  </div>

                  <thead class>
                    <tr>
                      <th>Borrower Name</th>
                      <th>Supply Name</th>
                      <th>Quantity</th>
                      <th>Unit Price</th>
                      <th>Date Borrowed</th>
                      <th>Date Returned</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    if (isset($_POST['date'])) {
                      $newdate = $_POST['date'] . "-01";
                      $sql = "SELECT * FROM `transactions` WHERE MONTH(date_released) = MONTH('" . $newdate . "') AND YEAR(date_released) = YEAR('" . $newdate . "');";
                      $actresult = mysqli_query($conn, $sql);

                      while ($result = mysqli_fetch_assoc($actresult)) {
                    ?>
                        <tr>
                          <td>
                            <?php echo $result['borrower_name']; ?>
                          </td>
                          <td>
                            <?php echo $result['supply_name']; ?>
                          </td>
                          <td>
                            <?php echo $result['quantity']; ?>
                          </td>
                          <td>
                            <?php
                            $sql1 = "SELECT s.unit_price FROM `supplies` s WHERE s.name='" . $result['supply_name'] . "';";
                            $actresult1 = mysqli_query($conn, $sql1);
                            $result1 = mysqli_fetch_assoc($actresult1);
                            echo $result1['unit_price'].".00";
                            ?>
                          <td>
                            <?php echo $result['date_released']; ?>
                          </td>
                          <?php
                          if ($result['date_returned'] === NULL) {
                          ?>
                            <td>
                              <?php echo "Not Yet Returned"; ?>
                            </td>
                          <?php } else { ?>
                            <td>
                              <?php echo $result['date_returned']; ?>
                            </td>
                          <?php } ?>
                        </tr>
                      <?php
                      }
                    } else 
                    if (isset($_POST['empname'])) {
                      $sqlname = "SELECT `name` FROM `employees` WHERE id = '" . $_POST["empname"] . "'";
                      $actresultname = mysqli_query($conn, $sqlname);
                      $row = mysqli_fetch_assoc($actresultname);
                      $sql = "SELECT * FROM transactions WHERE `borrower_name`='" . $row['name'] . "';";
                      $actresult = mysqli_query($conn, $sql);

                      while ($result = mysqli_fetch_assoc($actresult)) {
                      ?>
                        <tr>
                          <td>
                            <?php echo $result['borrower_name']; ?>
                          </td>
                          <td>
                            <?php echo $result['supply_name']; ?>
                          </td>
                          <td>
                            <?php echo $result['quantity']; ?>
                          </td>
                          <td>
                            <?php
                            $sql1 = "SELECT s.unit_price FROM `supplies` s WHERE s.name='" . $result['supply_name'] . "';";
                            $actresult1 = mysqli_query($conn, $sql1);
                            $result1 = mysqli_fetch_assoc($actresult1);
                            echo $result1['unit_price'].".00";
                            ?>
                          </td>
                          <td>
                            <?php echo $result['date_released']; ?>
                          </td>
                          <?php
                          if ($result['date_returned'] === NULL) {
                          ?>
                            <td>
                              <?php echo "Not Yet Returned"; ?>
                            </td>
                          <?php } else { ?>
                            <td>
                              <?php echo $result['date_returned']; ?>
                            </td>
                          <?php } ?>
                        </tr>
                      <?php
                      }
                    } else {
                      $sql = "SELECT * FROM transactions;";
                      $actresult = mysqli_query($conn, $sql);

                      while ($result = mysqli_fetch_assoc($actresult)) {
                      ?>
                        <tr>
                          <td>
                            <?php echo $result['borrower_name']; ?>
                          </td>
                          <td>
                            <?php echo $result['supply_name']; ?>
                          </td>
                          <td>
                            <?php echo $result['quantity']; ?>
                          </td>
                          <td>
                            <?php
                              $sql1 = "SELECT s.unit_price FROM `supplies` s WHERE s.name='" . $result['supply_name'] . "';";
                              $actresult1 = mysqli_query($conn, $sql1);
                              $result1 = mysqli_fetch_assoc($actresult1);
                            echo $result1['unit_price'].".00";
                            ?>
                          </td>
                          <td>
                            <?php echo $result['date_released']; ?>
                          </td>
                          <?php
                          if ($result['date_returned'] === NULL) {
                          ?>
                            <td>
                              <?php echo "Not Yet Returned"; ?>
                            </td>
                          <?php } else { ?>
                            <td>
                              <?php echo $result['date_returned']; ?>
                            </td>
                          <?php } ?>
                        </tr>
                    <?php
                      }
                    }
                    ?>
                  </tbody>
                  <tfoot></tfoot>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <script src="./js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.2/dist/chart.min.js"></script>
  <script src="./js/jquery-3.5.1.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script src="./js/jquery.dataTables.min.js"></script>
  <script src="./js/dataTables.bootstrap5.min.js"></script>
  <script src="./js/script.js"></script>
  <script>
    $(document).ready(function() {
      $("#myBtn").click(function() {
        $("#myModal").modal("toggle");
      });
    });
  </script>
  <script>
    function Print() {
      var print = document.getElementById('example');
      var wme = window.open("", "", "width=900,height=700");
      wme.document.write(print.outerHTML);
      wme.document.close();
      wme.focus();
      wme.print();
      wme.close();
    }
  </script>

</body>

</html>