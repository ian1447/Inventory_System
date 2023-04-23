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

<body class="fixed-left">

  <!-- Top Bar Start -->
  <?php include('includes/navbar.php'); ?>
  <!-- ========== Left Sidebar Start ========== -->
  <?php include('includes/sidebar.php'); ?>
  <!-- Left Sidebar End -->

  <main class="mt-5 pt-3">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 mb-3">
          <div class="card">
            <div class="card-header">
              <span><i class="bi bi-table me-2"></i></span> Returned
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table id="example" class="table table-hover data-table" style="width: 100%">

                  <thead class>
                    <tr>
                      <th>Barcode Number</th>
                      <th>Borrower Name</th>
                      <th>Supply Name</th>
                      <th>Quantity</th>
                      <th>Date Returned</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $sql = "SELECT * FROM transactions WHERE date_returned IS NOT NULL and `status`=0;";
                    $actresult = mysqli_query($conn, $sql);

                    while ($result = mysqli_fetch_assoc($actresult)) {
                    ?>
                      <tr>
                        <td>
                          <?php echo $result['barcode']; ?>
                        </td>
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
                          <?php echo $result['date_returned']; ?>
                        </td>
                        <td>
                          <a href="#ser<?php echo $result['barcode']; ?>" data-toggle="modal" class="btn btn-primary btn-sm me-md-2"><span class="me-2"><i class="bi bi-pencil"></i></span> Serviceable</a> ||
                          <a href="#unser<?php echo $result['barcode']; ?>" data-toggle="modal" class="btn btn-danger btn-sm"><span class="me-2"><i class="bi bi-trash"></i></span>
                            Unserviceable</a>
                        </td>
                      </tr>
                      <!-- unserviceable -->
                      <div class="modal fade" id="unser<?php echo $result['barcode']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <center>
                                <h4 class="modal-title" id="myModalLabel">Unserviceable</h4>
                              </center>
                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            </div>
                            <div class="modal-body">

                              <?php
                              $sql1 = "SELECT * FROM transactions WHERE barcode='" . $result['barcode'] . "'";
                              $actresult1 = mysqli_query($conn, $sql1);
                              $drow = mysqli_fetch_array($actresult1);
                              ?>
                              <div class="container-fluid">
                                <h5>
                                  <center>Set <?php echo $drow['supply_name']; ?> as Unserviceable <strong>

                                    </strong> This method cannot be undone.</center>
                                </h5>
                              </div>
                            </div>
                            <form method="POST">
                              <input type="hidden" id="id_u" name="unserid" value="<?php echo $drow['id']; ?>" class="form-control" required>
                              <input type="hidden" id="id_u" name="unsername" value="<?php echo $drow['supply_name']; ?>" class="form-control" required>
                              <input type="hidden" id="id_u" name="unserquan" value="<?php echo $drow['quantity']; ?>" class="form-control" required>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                                <button class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span>
                                  Delete</button>
                              </div>
                              <?php
                              if (isset($_POST['unsername'])) {
                                $sql = "UPDATE transactions set `status`=1 WHERE `id`=" . $_POST['unserid'] . "";
                                $conn->query($sql);
                                $sql1 = "UPDATE supplies set `borrowed_quantity`=borrowed_quantity-".$_POST['unserquan'].", `quantity`=quantity-".$_POST['unserquan']." WHERE `name`='" . $_POST['unsername'] . "'";
                                if ($conn->query($sql1) === TRUE) {
                                  unset($_POST['unserid']);
                                  unset($_POST['unsername']);
                                  unset($_POST['unserquan']);
                                  echo '<script>alert("Supply Set to Unserviceable") 
                                                window.location.href="Treturned.php"</script>';
                                } else {
                                  unset($_POST['unserid']);
                                  unset($_POST['unsername']);
                                  unset($_POST['unserquan']);
                                  echo '<script>alert("Supply Update Failed!\n Please Check SQL Connection String!") 
                                                window.location.href="Treturned.php"</script>';
                                }
                              }
                              ?>
                            </form>
                          </div>
                        </div>
                      </div>
                      <!-- /.modal -->

                      <!-- Serviceable -->
                      <div class="modal fade" id="ser<?php echo $result['barcode']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <center>
                                <h4 class="modal-title" id="myModalLabel">Serviceable</h4>
                              </center>
                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            </div>
                            <div class="modal-body">

                              <?php
                              $sql1 = "SELECT * FROM transactions WHERE barcode='" . $result['barcode'] . "'";
                              $actresult1 = mysqli_query($conn, $sql1);
                              $drow = mysqli_fetch_array($actresult1);
                              ?>
                              <div class="container-fluid">
                                <h5>
                                  <center>Set <?php echo $drow['supply_name']; ?> as Serviceable <strong>

                                    </strong> This method cannot be undone.</center>
                                </h5>
                              </div>
                            </div>
                            <form method="POST">
                              <input type="hidden" id="id_u" name="serid" value="<?php echo $drow['id']; ?>" class="form-control" required>
                              <input type="hidden" id="id_u" name="sername" value="<?php echo $drow['supply_name']; ?>" class="form-control" required>
                              <input type="hidden" id="id_u" name="serquan" value="<?php echo $drow['quantity']; ?>" class="form-control" required>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                                <button class="btn btn-primary"><span class="glyphicon glyphicon-trash"></span>
                                  Serviceable</button>
                              </div>
                              <?php
                              if (isset($_POST['serid'])) {
                                $sql = "UPDATE transactions set `status`=1 WHERE `id`=" . $_POST['serid'] . "";
                                $sql1 = "UPDATE supplies set `borrowed_quantity`=borrowed_quantity-".$_POST['serquan']." WHERE `name`='" . $_POST['sername'] . "'";
                                $conn->query($sql1);
                                if ($conn->query($sql) === TRUE) {
                                  unset($_POST['serid']);
                                  unset($_POST['sername']);
                                  unset($_POST['serquan']);
                                  echo '<script>alert("Supply Added to Available") 
                                                window.location.href="Treturned.php"</script>';
                                } else {
                                  unset($_POST['serid']);
                                  unset($_POST['sername']);
                                  unset($_POST['serquan']);
                                  echo '<script>alert("Supply Update Failed!\n Please Check SQL Connection String!") 
                                                window.location.href="Treturned.php"</script>';
                                }
                              }
                              ?>
                            </form>
                          </div>
                        </div>
                      </div>
                      <!-- /.modal -->
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
      $("#editBtn").click(function() {
        $("#editModal").modal("toggle");
      });
    });
  </script>
</body>

</html>