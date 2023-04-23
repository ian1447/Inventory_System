<?php
session_start();
include "../dbcon.php";
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
</head>

<body class="fixed-left" style="background-color: #ECB365">

  <!-- Top Bar Start -->
  <?php include('includes/navbar.php'); ?>
  <!-- ========== Left Sidebar Start ========== -->
  <?php include('includes/sidebar.php'); ?>
  <!-- Left Sidebar End -->

  <main class="mt-5 pt-4">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 mb-3">
          <div class="card">
            <div class="card-header">
              <span><i class="bi bi-table me-2"></i></span> Monthly Inventory
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table id="example" class="table table-hover data-table" style="width: 100%">

                  <div class="m-2">
                    <form method="POST">
                      <label for="startDate">Pick a month :</label>
                      <input type="month" id="startDate" name="date" class="date-picker form-control w-25 mb-2" />
                      <button class="btn btn-primary">load</button>
                    </form>
                    <!-- Button HTML (to Trigger Print) -->
                    <!-- <button type="button" id="myBtn" class="btn btn-outline-primary" onclick="Print()">
                      <span class="me-2"><i class="bi bi-printer"></i></span>
                      Print Inventory
                    </button> -->
                  </div>

                  <thead class>
                    <tr>
                      <th>Item Number</th>
                      <th>Category</th>
                      <th>Class Code</th>
                      <th>Quantity</th>  
                      <th>Unit Price</th>
                      <th>Property Custodian</th>
                      <th>Date Acquired</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  
                  <tbody>
                    <?php
                    if (isset($_POST['date'])) {
                      $newdate = $_POST['date'] . "-01";
                      $sql = "SELECT c.`description`,s.`id`,s.`name`,t.`quantity` AS supplyquan,s.unit_price,s.`category`,(s.`quantity`-s.`borrowed_quantity`) AS remaining, t.borrower_name,
                      DATE(t.date_released) AS date_released,t.date_returned, t.quantity AS borrwedquan,t.status,t.id AS transid, t.is_updated FROM `supplies` s
                      INNER JOIN transactions t ON t.supply_name = s.name
                      LEFT JOIN categories c ON c.`name` = s.`category`
                      WHERE MONTH(s.transdate) = MONTH('" . $newdate . "') AND YEAR(s.transdate) = YEAR('" . $newdate . "') ORDER BY t.id DESC;";
                      $actresult = mysqli_query($conn, $sql);
    
                      while ($result = mysqli_fetch_assoc($actresult)) {
                      ?>
                        <tr>
                          <td>
                            <?php echo $result['name']; ?>
                          </td>
                          <td>
                            <?php echo $result['category']; ?>
                          </td>
                          <td>
                            <?php echo $result['description']; ?>
                          </td>
                          <td>
                            <?php echo $result['supplyquan']; ?>
                          </td>
                          <td>
                            <?php echo $result['unit_price'] . ".00"; ?>
                          </td>
                          <td>
                            <?php echo $result['borrower_name']; ?>
                          </td>
                          <td>
                            <?php echo $result['date_released']; ?>
                          </td>
                          <td>
                            <?php if ($result['date_returned'] == NULL) {
                              echo "Not Yet Returned!";
                            } else {
                              if ($result['status'] == 0) { ?>
                                <button class="btn btn-success btn-sm me-md-2" type="button">
                                  <span class="badge badge-secondary">
                                    <?php echo $result['borrwedquan']; ?>
                                  </span>
                                  Serviceable
                                </button>
                              <?php } elseif ($result['status'] == 1) { ?>
                                <button class="btn btn-warning btn-sm me-md-2" type="button">
                                  <span class="badge badge-secondary"></span>
                                  Unserviceable
                                </button>
                              <?php } else { ?>
                                <button class="btn btn-danger btn-sm me-md-2" type="button">
                                  <span class="badge badge-secondary"></span>
                                  Disposed
                                </button>
                            <?php }
                            } ?>
                          </td>
                      <?php
                      }
                    } else {
                      $sql = "SELECT c.`description`,s.`id`,s.`name`,t.`quantity` AS supplyquan,s.unit_price,s.`category`,(s.`quantity`-s.`borrowed_quantity`) AS remaining, t.borrower_name,
                      DATE(t.date_released) AS date_released,t.date_returned, t.quantity AS borrwedquan,t.status,t.id AS transid, t.is_updated FROM `supplies` s
                      INNER JOIN transactions t ON t.supply_name = s.name
                      LEFT JOIN categories c ON c.`name` = s.`category` ORDER BY t.id DESC;";
                      $actresult = mysqli_query($conn, $sql);
    
                      while ($result = mysqli_fetch_assoc($actresult)) {
                      ?>
                        <tr>
                          <td>
                            <?php echo $result['name']; ?>
                          </td>
                          <td>
                            <?php echo $result['category']; ?>
                          </td>
                          <td>
                            <?php echo $result['description']; ?>
                          </td>
                          <td>
                            <?php echo $result['supplyquan']; ?>
                          </td>
                          <td>
                            <?php echo $result['unit_price'] . ".00"; ?>
                          </td>
                          <td>
                            <?php echo $result['borrower_name']; ?>
                          </td>
                          <td>
                            <?php echo $result['date_released']; ?>
                          </td>
                          <td>
                            <?php if ($result['date_returned'] == NULL) {
                              echo "Not Yet Returned!";
                            } else {
                              if ($result['status'] == 0) { ?>
                                <button class="btn btn-success btn-sm me-md-2" type="button">
                                  <span class="badge badge-secondary">
                                    <?php echo $result['borrwedquan']; ?>
                                  </span>
                                  Serviceable
                                </button>
                              <?php } elseif ($result['status'] == 1) { ?>
                                <button class="btn btn-warning btn-sm me-md-2" type="button">
                                  <span class="badge badge-secondary"></span>
                                  Unserviceable
                                </button>
                              <?php } else { ?>
                                <button class="btn btn-danger btn-sm me-md-2" type="button">
                                  <span class="badge badge-secondary"></span>
                                  Disposed
                                </button>
                            <?php }
                            } ?>
                          </td>
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