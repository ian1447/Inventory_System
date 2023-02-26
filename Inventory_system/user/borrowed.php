<?php
session_start();
include "../dbcon.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <script language="javascript" type="text/javascript">
    window.history.forward();
  </script>
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
              <span><i class="bi bi-table me-2"></i></span> Items Borrowed
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table id="example" class="table table-hover data-table" style="width: 100%">
                <a class="btn btn-outline-primary" role="button" href="./UmReport.php"  target="_blank">
                      <span class="me-2"><i class="bi bi-printer"></i></span> 
                      Print Report
                      </a>

                  <!-- <div class="m-2">
                    Button HTML (to Trigger Modal)
                    <button type="button" id="myBtn" class="btn btn-outline-primary" onclick="functionPrint()">
                      <span class="me-2"><i class="bi bi-printer"></i></span>
                      Print Report
                    </button>
                  </div> -->

                  <thead class>
                    <tr>
                      <th>Item Name</th>
                      <th>Category</th>
                      <th>Class Code</th>
                      <th>Quantity</th>
                      <th>Unit Price</th>
                      <th>Date Acquired</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                     $sql = "SELECT c.`description`,s.`id`,s.`name`,t.`quantity` AS supplyquan,s.unit_price,s.`category`,(s.`quantity`-s.`borrowed_quantity`) AS remaining, t.borrower_name,
                     DATE(t.date_released) AS date_released,t.date_returned, t.quantity AS borrwedquan,t.status,t.id AS transid, t.is_updated FROM `supplies` s
                     INNER JOIN transactions t ON t.supply_name = s.name
                     LEFT JOIN categories c ON c.`name` = s.`category`
                     WHERE t.borrower_name = '" . $_SESSION['useridname'] . "';";
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
                           <?php echo $result['unit_price'] .".00"; ?>
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
                      <!-- Delete -->
                      <div class="modal fade" id="return<?php echo $result['barcode']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <center>
                                <h4 class="modal-title" id="myModalLabel">Return</h4>
                              </center>
                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            </div>
                            <div class="modal-body">
                              <div class="container-fluid">
                                <h5>
                                  <center>Are you sure you want to return item? This method cannot be undone.</center>
                                </h5>
                              </div>
                            </div>
                            <form method="POST">
                              <input type="hidden" id="id_u" name="returnitem" value="<?php echo $result['barcode']; ?>" class="form-control" required>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                                <button class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span>
                                  Return</button>
                              </div>
                              <?php
                              if (isset($_POST['returnitem'])) {
                                $sql = "UPDATE transactions set date_returned = NOW() WHERE barcode='".$_POST['returnitem']."'";
                                if ($conn->query($sql) === TRUE) {
                                  echo '<script>alert("Returned Successfully!") 
                                                window.location.href="borrowed.php"</script>';
                                } else {
                                  echo '<script>alert("Returning Supply Details Failed!\n Please Check SQL Connection String!") 
                                                window.location.href="borrowed.php"</script>';
                                }
                              }
                              ?>
                            </form>
                          </div>
                        </div>
                      </div>
                      <!-- /.modal -->
              </div>
            <?php
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
  </main>

  <script src="./js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.2/dist/chart.min.js"></script>
  <script src="./js/jquery-3.5.1.js"></script>
  <script src="./js/jquery.dataTables.min.js"></script>
  <script src="./js/dataTables.bootstrap5.min.js"></script>
  <script src="./js/script.js"></script>

  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <!-- Popper JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <!-- Bootstrap JS -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script>
    $(document).ready(function() {
      $("#myBtn").click(function() {
        $("#myModal").modal("toggle");
      });
    });
  </script>
  <script>
    function functionPrint() {
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