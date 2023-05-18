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
              <span><i class="bi bi-table me-2"></i></span> Supplies
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table id="example" class="table table-hover data-table" style="width: 100%">

                  <div class="m-2">
                    <div class="row">
                      <div class="col">
                        <!-- Button HTML (to Trigger Modal) -->
                        <button type="button" id="myBtn" class="btn btn-outline-success mx-2 mb-2">
                          <span class="me-2"><i class="bi bi-person-plus-fill"></i></span>
                          Add Supply Released
                        </button>

                        <!-- Button HTML (to Trigger Print) -->
                        <a class="btn btn-outline-primary mx-2 mb-2" href="generate_pdf.php" target="_blank" role="button">
                          <span class="me-2"><i class="bi bi-printer"></i></span>
                          Print Sticker
                        </a>
                      </div>
                      <div class="col">
                        <form method="POST">
                          <div class="form-group w-50">
                            <label class="fw-bold">Sort By:</label>
                            <select class="form-control" id="name" name="bname">

                              <option value=""> </option>
                              <?php
                              $sql3 = "SELECT * FROM employees;";
                              $actresult3 = mysqli_query($conn, $sql3);

                              while ($result3 = mysqli_fetch_assoc($actresult3)) { ?>
                                            <option value=<?php echo $result3['id'] ?>> <?php echo $result3['name'] ?></option>
                              <?php } ?>
                            </select>
                          </div>
                          <button class="btn btn-primary mt-2">load</button>
                        </form>
                      </div>
                    </div>

                  </div>

                  <!-- Modal HTML -->
                  <div id="myModal" class="modal fade" data-bs-backdrop="static" tabindex="-1">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title">Add Supply Released</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                          <form class="needs-validation" method="POST">
                            <div class="form-row">
                              <div class="col-md-12 mb-2">
                              <label for="validationCustom01">Property Number: <span class="text-danger">*</span> </label>
                              <input type="text" class="form-control" id="validationCustom01"  name="barcode" placeholder="Enter Property Number" required>
                              </div>
                              <div class="col-md-12 mb-2">
                              <label for="validationCustom01">Classification: <span class="text-danger">*</span> </label>
                              <input type="text" class="form-control" id="validationCustom01"  name="classification" placeholder="Enter Classification" required>
                              </div>
                              <div class="col-md-12 mb-2">
                              <label for="validationCustom01">Article and Description: <span class="text-danger">*</span> </label>
                              <input type="text" class="form-control" id="validationCustom01"  name="article" placeholder="Enter Article and Description" required>
                              </div>
                              <div class="form-group">
                                <label>Item Name:</label>
                                <select id="" name="item_name" class="form-select">
                                  <?php
                                  $sql3 = "SELECT * FROM supplies;";
                                  $actresult3 = mysqli_query($conn, $sql3);

                                  while ($result3 = mysqli_fetch_assoc($actresult3)) { ?>
                                                <option value=<?php echo $result3['id'] ?>> <?php echo $result3['name'] ?></option>
                                  <?php } ?>
                                </select>
                              </div>

                              <!-- subject to change  -->

                              <!-- <div class="col-md-12 mb-2">
                                <label for="validationCustom01">Class Code<span class="text-danger">*</span> </label>
                                <input type="text" class="form-control" id="validationCustom01" name="classcode" placeholder="Enter class code" required>
                              </div> -->
                              <!-- <div class="form-row">
                                <div class="col-md-12 mb-2">
                                  <label for="validationCustom03">Description <span class="text-danger">*</span>
                                  </label>
                                  <input type="text" class="form-control" id="validationCustom03" name="description" placeholder="Enter description" required>
                                </div> -->
                              <!-- <div class="col-md-12 mb-2">
                                  <label for="validationCustom04">Unit Price <span class="text-danger">*</span> </label>
                                  <input type="number" class="form-control" id="validationCustom05" name="unit_price" placeholder="Enter Unit Price" required>
                                </div> -->
                              <div class="col-md-12 mb-2">
                                <label for="validationCustom04">Quantity: <span class="text-danger">*</span> </label>
                                <input type="number" class="form-control" id="validationCustom04" name="quantity" placeholder="Enter quantity" required>
                              </div>
                              <div class="form-group">
                                <label>Property Custodian:</label>
                                <select id="" name="item_custodian" class="form-select">

                                  <?php
                                  $sql3 = "SELECT * FROM employees;";
                                  $actresult3 = mysqli_query($conn, $sql3);

                                  while ($result3 = mysqli_fetch_assoc($actresult3)) { ?>
                                                <option value=<?php echo $result3['id'] ?>> <?php echo $result3['name'] ?></option>
                                  <?php } ?>
                                </select>
                              </div>
                              <div class="col-md-12 mb-2">
                                <label for="validationCustom01">Date Acquired: <span class="text-danger">*</span> </label>
                                <input type="date" class="form-control" id="validationCustom01" name="dateac" required>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                              <button class="btn btn-success">Save</button>
                            </div>
                          </form>
                          <?php
                          include "../dbcon.php";
                          if (isset($_POST['item_name'])) {
                            $sqlcheck = "SELECT COUNT(*) FROM transactions WHERE barcode='" . $_POST['barcode'] . "'";
                            $actcheckresult = mysqli_query($conn, $sqlcheck);
                            $checkresult = mysqli_fetch_assoc($actcheckresult);
                            if ($checkresult["count"] == 0) {
                              $sql1 = "SELECT quantity - borrowed_quantity as quan FROM `supplies` WHERE `id` = '" . $_POST["item_name"] . "'";
                              $actresult1 = mysqli_query($conn, $sql1);
                              $result1 = mysqli_fetch_assoc($actresult1);
                              if ($result1["quan"] >= $_POST['quantity']) {
                                $supplyname = "SELECT `name` FROM `supplies` WHERE id = '" . $_POST["item_name"] . "'";
                                $actsupplyname = mysqli_query($conn, $supplyname);
                                $supplyrow = mysqli_fetch_assoc($actsupplyname);
                                $sqlup = "UPDATE `supplies` set borrowed_quantity = borrowed_quantity + '" . $_POST['quantity'] . "' WHERE `name` = '" . $supplyrow['name'] . "'";
                                $conn->query($sqlup);
                                $sqlname = "SELECT `name` FROM `employees` WHERE id = '" . $_POST["item_custodian"] . "'";
                                $actresultname = mysqli_query($conn, $sqlname);
                                $row = mysqli_fetch_assoc($actresultname);
                                $sql = "INSERT INTO `transactions` (`supply_name`,`borrower_name`,`quantity`,date_released,barcode)
                                                VALUES ('" . $supplyrow['name'] . "','" . $row['name'] . "','" . $_POST['quantity'] . "','" . $_POST['dateac'] . "','" . $_POST['barcode'] . "')";
                                if ($conn->query($sql) === TRUE) {
                                  $_SESSION["barcode"] = $_POST['barcode'];
                                  $_SESSION["quantity"] = $_POST['quantity'];
                                  $_SESSION["classification"] = $_POST['classification'];
                                  $_SESSION["article"] = $_POST['article'];
                                  $_SESSION['cost'] = $_POST['quan'];
                                  $_SESSION['custodian'] = $row['name'];
                                  $_SESSION['dateac'] = $_POST['dateac'];
                                  echo '<script>alert("Supplies Addedd Successfully!") 
                                        window.location.href="supplies.php"</script>';
                                } else {
                                  echo '<script>alert("Adding Supplies Failed!\n Please Check SQL Connection String!") 
                                                    window.location.href="supplies.php"</script>';
                                }
                              } else {
                                echo '<script>alert("Quantity Exceeds Stock Available!") 
                                                  window.location.href="supplies.php"</script>';
                              }
                            } else {
                              echo '<script>alert("Property Number Already Taken!") 
                              window.location.href="supplies.php"</script>';
                            }
                          }
                          ?>
                        </div>

                      </div>
                    </div>
                  </div>
                  <!-- End of add modal -->
              </div>
              <thead class>
                <tr>
                  <th>Barcode</th>
                  <th>Item Name</th>
                  <th>Category</th>
                  <th>Class Code</th>
                  <th>Quantity</th>
                  <th>Unit Price</th>
                  <th>Property Custodian</th>
                  <th>Date Acquired</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                if (isset($_POST['bname'])) {
                  $sqlname = "SELECT `name` FROM `employees` WHERE id = '" . $_POST["bname"] . "'";
                  $actresultname = mysqli_query($conn, $sqlname);
                  $row = mysqli_fetch_assoc($actresultname);
                  $sql = "SELECT t.barcode,c.`description`,s.`id`,s.`name`,t.`quantity` AS supplyquan,s.unit_price,s.`category`,(s.`quantity`-s.`borrowed_quantity`) AS remaining, t.borrower_name,
                  DATE(t.date_released) AS date_released,t.date_returned, t.quantity AS borrwedquan,t.status,t.id AS transid, t.is_updated FROM `supplies` s
                  INNER JOIN transactions t ON t.supply_name = s.name
                  LEFT JOIN categories c ON c.`name` = s.`category`
                  WHERE t.borrower_name = '" . $row['name'] . "'
                  ORDER BY t.barcode ASC;";
                  $actresult = mysqli_query($conn, $sql);

                  while ($result = mysqli_fetch_assoc($actresult)) {
                    ?>
                                            <tr>
                                              <td>
                                                <?php echo $result['barcode']; ?>
                                              </td>
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
                                              <td>
                                                <div class="dropdown">
                                                  <span class="btn bi bi-three-dots-vertical" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></span>
                                                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                      <a class="dropdown-item" href="#" data-target="#edit<?php echo $result['transid']; ?>">Update</a>
                                                      <a class="dropdown-item" href="#" data-target="#ret<?php echo $result['transid']; ?>">Returned</a>
                                                  </div>
                                                </div>
                                              </td>
                                              <!-- <td>
                            <div class="d-grid gap-2 d-md-flex">
                              <?php if ($result['is_updated'] == 0) {
                                if ($result['date_returned'] != NULL) { ?>
                                     <a href="#edit<?php echo $result['transid']; ?>" data-toggle="modal" class="btn btn-primary btn-sm me-md-2"><span class="me-2"><i class="bi bi-pencil"></i></span> sdf</a> ||
                                  <?php
                                } else {
                                  echo '<button type="button" class="btn btn-light">Not yet Returned</button>';
                                }
                              } else {
                                echo '<button type="button" class="btn btn-light">Updated</button>';
                              } ?>


                              <?php if ($result['date_returned'] == NULL) { ?>
                                  <a href="#ret<?php echo $result['transid']; ?>" data-toggle="modal" class="btn btn-primary btn-sm"><span class=""><i></i></span>
                                    Return</a>
                              <?php } else {
                                echo '<button type="button" class="btn btn-light">Returned</button>';
                              } ?>
                            </div>
                          </td> -->
                                            </tr>

                                            <!-- Start of Edit Modal -->
                                            <!-- Edit Modal HTML -->
                                            <div id="edit<?php echo $result['transid']; ?>" class="modal fade">
                                              <div class="modal-dialog">
                                                <div class="modal-content">
                                                  <form id="update_form" method="POST">
                                                    <div class="modal-header">
                                                      <h4 class="modal-title">Edit Employee</h4>
                                                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    </div>
                                                    <div class="modal-body">
                                                      <?php
                                                      $id = $result['id'];
                                                      $edit = mysqli_query($conn, "select * from supplies where id='" . $result['id'] . "'");
                                                      $erow = mysqli_fetch_array($edit);

                                                      $transaction = mysqli_query($conn, "select * from transactions where id='" . $result['transid'] . "'");
                                                      $trow = mysqli_fetch_array($transaction);
                                                      ?>
                                                      <input type="hidden" id="id_u" name="transid" value="<?php echo $trow['id']; ?>" class="form-control" readonly>
                                                      <input type="text" id="id_u" name="transactionquan" value="<?php echo $trow['quantity']; ?>" class="form-control" hidden>
                                                      <div class="form-group">
                                                        <label>Item Name</label>
                                                        <input type="text" id="name_u" name="updateid" value="<?php echo $erow['id']; ?>" class="form-control" hidden>
                                                        <input type="text" id="name_u" name="updatename" value="<?php echo $erow['name']; ?>" class="form-control" readonly>
                                                      </div>
                                                      <div class="form-group form-group-md">
                                                        <label for="category" class="col-sm-2 control-label">Category</label>
                                                        <div class="col-md-12 mb-2">
                                                          <select class="form-control" id="category" name="editcategory" disabled>

                                                            <option selected="selected" >
                                                              <?php echo $erow['category']; ?>
                                                            </option>
                                                            <?php
                                                            $data = "SELECT * FROM categories c WHERE c.name!='" . $erow['category'] . "';";
                                                            $actresult1 = mysqli_query($conn, $data);

                                                            while ($result1 = mysqli_fetch_assoc($actresult1)) { ?>
                                                                          <option value="<?php echo $result1['id']; ?>">
                                                                            <?php echo $result1['name']; ?>
                                                                          </option>
                                                            <?php } ?>
                                                          </select>
                                                        </div>
                                                      </div>
                                                      <div class="form-group">
                                                        <label>Description</label>
                                                        <input type="college" id="desceiption_u" name="uptdesc" value="<?php echo $erow['description']; ?>" class="form-control" readonly>
                                                      </div>
                                                      <div class="form-group">
                                                        <label>Status</label>
                                                        <select id="" name="updatestatus" class="form-select">
                                                          <option>Serviceable</option>
                                                          <option>Unserviceable</option>
                                                          <option>Disposed</option>
                                                        </select>
                                                      </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                      <input type="hidden" value="2" name="type">
                                                      <input type="button" class="btn btn-defaulst" data-dismiss="modal" value="Cancel">
                                                      <button class="btn btn-info" id="update">Update</button>
                                                    </div>
                                                  </form>
                                                  <?php
                                                  if (isset($_POST['updatestatus'])) {
                                                    if ($_POST['updatestatus'] == "Serviceable") {
                                                      $sqlborrowedquan = "UPDATE supplies SET borrowed_quantity = borrowed_quantity - " . $_POST['transactionquan'] . " WHERE  `id` = '" . $_POST['updateid'] . "'";
                                                      $conn->query($sqlborrowedquan);
                                                      $sql = "UPDATE transactions set `status` = 0, is_updated = 1 WHERE id = " . $_POST['transid'] . "";
                                                      if ($conn->query($sql) === TRUE) {
                                                        echo '<script>alert("Supplies Updated Successfully!") 
                                            window.location.href="supplies.php"</script>';
                                                      } else {
                                                        echo '<script>alert("Updating Supply Failed!\n Please Check SQL Connection String!") 
                                            window.location.href="supplies.php"</script>';
                                                      }
                                                    } else if ($_POST['updatestatus'] == "Unserviceable") {
                                                      $sql = "UPDATE transactions set is_updated = 1  WHERE id = " . $_POST['transid'] . "";
                                                      if ($conn->query($sql) === TRUE) {
                                                        echo '<script>alert("Supplies Updated Successfully!") 
                                            window.location.href="supplies.php"</script>';
                                                      } else {
                                                        echo '<script>alert("Updating Supply Failed!\n Please Check SQL Connection String!") 
                                            window.location.href="supplies.php"</script>';
                                                      }
                                                    } else if ($_POST['updatestatus'] == "Disposed") {
                                                      $sql = "UPDATE transactions set `status` = 2, is_updated = 1  WHERE id = " . $_POST['transid'] . "";
                                                      if ($conn->query($sql) === TRUE) {
                                                        echo '<script>alert("Supplies Updated Successfully!") 
                                            window.location.href="supplies.php"</script>';
                                                      } else {
                                                        echo '<script>alert("Updating Supply Failed!\n Please Check SQL Connection String!") 
                                            window.location.href="supplies.php"</script>';
                                                      }
                                                    }
                                                  }
                                                  ?>
                                                </div>
                                              </div>
                                            </div>
                                            <!-- End of Edit Modal -->
                                            <!-- End of Edit Modal -->

                                             <!-- Delete -->
                                             <div class="modal fade" id="ret<?php echo $result['transid']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                              <div class="modal-dialog">
                                                <div class="modal-content">
                                                  <div class="modal-header">
                                                    <center>
                                                      <h4 class="modal-title" id="myModalLabel">Return</h4>
                                                    </center>
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                  </div>
                                                  <div class="modal-body">
                                                    <?php
                                                    $ret = mysqli_query($conn, "select * from transactions where id='" . $result['transid'] . "'");
                                                    $drow = mysqli_fetch_array($ret);
                                                    ?>
                                                    <div class="container-fluid">
                                                      <h5>
                                                        <center>Are you sure to Return item <strong>
                                                            <?php echo ucwords($drow['supply_name']); ?>
                                                          </strong> borrowed by <?php echo ucwords($drow['borrower_name']); ?>?</center>
                                                      </h5>
                                                    </div>
                                                  </div>
                                                  <form method="POST">
                                                    <input type="hidden" id="id_u" name="returnid" value="<?php echo $drow['id']; ?>" class="form-control" required>
                                                    <div class="modal-footer">
                                                      <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                                                      <button class="btn btn-primary"><span class="glyphicon glyphicon-trash"></span>
                                                        Return</button>
                                                    </div>
                                                    <?php
                                                    if (isset($_POST['returnid'])) {
                                                      $sql = "UPDATE transactions set date_returned = NOW(), `status` = 1  WHERE id = " . $_POST['returnid'] . "";
                                                      if ($conn->query($sql) === TRUE) {
                                                        echo '<script>alert("Returned Successfully!") 
                                                window.location.href="supplies.php"</script>';
                                                      } else {
                                                        echo '<script>alert("Returning Transaction Failed!\n Please Check SQL Connection String!") 
                                                window.location.href="supplies.php"</script>';
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
                } else {
                  $sql = "SELECT  t.barcode,c.`description`,s.`id`,s.`name`,t.`quantity` AS supplyquan,s.unit_price,s.`category`,(s.`quantity`-s.`borrowed_quantity`) AS remaining, t.borrower_name,
                  DATE(t.date_released) AS date_released,t.date_returned, t.quantity AS borrwedquan,t.status,t.id AS transid, t.is_updated FROM `supplies` s
                  INNER JOIN transactions t ON t.supply_name = s.name
                  LEFT JOIN categories c ON c.`name` = s.`category`
                  ORDER BY t.barcode ASC;";
                  $actresult = mysqli_query($conn, $sql);

                  while ($result = mysqli_fetch_assoc($actresult)) {
                    ?>
                                            <tr>
                                              <td>
                                                <?php echo $result['barcode']; ?>
                                              </td>
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
                                              <td>
                                                <div class="dropdown">
                                                  <span class="btn bi bi-three-dots-vertical" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></span>
                                                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                      <a class="dropdown-item" href="#" data-toggle="modal" data-target="#edit<?php echo $result['transid']; ?>">Update</a>
                                                      <a class="dropdown-item" href="#" data-toggle="modal" data-target="#ret<?php echo $result['transid']; ?>">Returned</a>
                                                  </div>
                                                </div>
                                              </td>
                                              <!-- <td>
                                <div class="d-grid gap-2 d-md-flex">
                                  <?php if ($result['is_updated'] == 0) {
                                    if ($result['date_returned'] != NULL) { ?>
                                             <a href="#edit<?php echo $result['transid']; ?>" data-toggle="modal" class="btn btn-primary btn-sm me-md-2"><span class="me-2"><i class="bi bi-pencil"></i></span> Update</a> ||
                                          <?php
                                    } else {
                                      echo '<button type="button" class="btn btn-light">Not yet Returned</button>';
                                    }
                                  } else {
                                    echo '<button type="button" class="btn btn-light">Updated</button>';
                                  } ?>
                                  <?php if ($result['date_returned'] == NULL) { ?>
                                        <a href="#ret<?php echo $result['transid']; ?>" data-toggle="modal" class="btn btn-primary btn-sm"><span class=""><i></i></span>
                                          Return</a>
                                  <?php } else {
                                    echo '<button type="button" class="btn btn-light">Returned</button>';
                                  } ?>
                                </div>
                              </td> -->
                                            </tr>

                                            <!-- Start of Edit Modal -->
                                            <!-- Edit Modal HTML -->
                                            <div id="edit<?php echo $result['transid']; ?>" class="modal fade">
                                              <div class="modal-dialog">
                                                <div class="modal-content">
                                                  <form id="update_form" method="POST">
                                                    <div class="modal-header">
                                                      <h4 class="modal-title">Update Supply</h4>
                                                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    </div>
                                                    <div class="modal-body">
                                                      <?php
                                                      $id = $result['id'];
                                                      $edit = mysqli_query($conn, "select * from supplies where id='" . $result['id'] . "'");
                                                      $erow = mysqli_fetch_array($edit);

                                                      $transaction = mysqli_query($conn, "select * from transactions where id='" . $result['transid'] . "'");
                                                      $trow = mysqli_fetch_array($transaction);
                                                      ?>
                                                      <input type="hidden" id="id_u" name="transid" value="<?php echo $trow['id']; ?>" class="form-control" readonly>
                                                      <input type="hidden" id="id_u" name="transactionquan" value="<?php echo $trow['quantity']; ?>" class="form-control" hidden>
                                                      <div class="form-group">
                                                        <label>Item Name</label>
                                                        <input type="text" id="name_u" name="updateid" value="<?php echo $erow['id']; ?>" class="form-control" hidden>
                                                        <input type="text" id="name_u" name="updatename" value="<?php echo $erow['name']; ?>" class="form-control" readonly>
                                                      </div>
                                                      <div class="form-group form-group-md">
                                                        <label for="category" class="col-sm-2 control-label">Category</label>
                                                        <div class="col-md-12 mb-2">
                                                          <select class="form-control" id="category" name="editcategory" disabled>

                                                            <option selected="selected" >
                                                              <?php echo $erow['category']; ?>
                                                            </option>
                                                            <?php
                                                            $data = "SELECT * FROM categories c WHERE c.name!='" . $erow['category'] . "';";
                                                            $actresult1 = mysqli_query($conn, $data);

                                                            while ($result1 = mysqli_fetch_assoc($actresult1)) { ?>
                                                                          <option value="<?php echo $result1['name']; ?>">
                                                                            <?php echo $result1['name']; ?>
                                                                          </option>
                                                            <?php } ?>
                                                          </select>
                                                        </div>
                                                      </div>
                                                      <div class="form-group">
                                                        <label>Description</label>
                                                        <input type="college" id="desceiption_u" name="uptdesc" value="<?php echo $erow['description']; ?>" class="form-control" readonly>
                                                      </div>
                                                      <div class="form-group">
                                                        <label>Status</label>
                                                        <select id="" name="updatestatus" class="form-select">
                                                          <option>Serviceable</option>
                                                          <option>Unserviceable</option>
                                                          <option>Disposed</option>
                                                        </select>
                                                      </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                      <input type="hidden" value="2" name="type">
                                                      <input type="button" class="btn btn-defaulst" data-dismiss="modal" value="Cancel">
                                                      <button class="btn btn-info" id="update">Update</button>
                                                    </div>
                                                  </form>
                                                  <?php
                                                  if (isset($_POST['updatestatus'])) {
                                                    if ($_POST['updatestatus'] == "Serviceable") {
                                                      $sqlborrowedquan = "UPDATE supplies SET borrowed_quantity = borrowed_quantity - " . $_POST['transactionquan'] . " WHERE  `id` = '" . $_POST['updateid'] . "'";
                                                      $conn->query($sqlborrowedquan);
                                                      $sql = "UPDATE transactions set `status` = 0, is_updated = 1 WHERE id = " . $_POST['transid'] . "";
                                                      if ($conn->query($sql) === TRUE) {
                                                        echo '<script>alert("Supplies Updated Successfully!") 
                                            window.location.href="supplies.php"</script>';
                                                      } else {
                                                        echo '<script>alert("Updating Supply Failed!\n Please Check SQL Connection String!") 
                                            window.location.href="supplies.php"</script>';
                                                      }
                                                    } else if ($_POST['updatestatus'] == "Unserviceable") {
                                                      $sql = "UPDATE transactions set is_updated = 1  WHERE id = " . $_POST['transid'] . "";
                                                      if ($conn->query($sql) === TRUE) {
                                                        echo '<script>alert("Supplies Updated Successfully!") 
                                            window.location.href="supplies.php"</script>';
                                                      } else {
                                                        echo '<script>alert("Updating Supply Failed!\n Please Check SQL Connection String!") 
                                            window.location.href="supplies.php"</script>';
                                                      }
                                                    } else if ($_POST['updatestatus'] == "Disposed") {
                                                      $sql = "UPDATE transactions set `status` = 2, is_updated = 1  WHERE id = " . $_POST['transid'] . "";
                                                      if ($conn->query($sql) === TRUE) {
                                                        echo '<script>alert("Supplies Updated Successfully!") 
                                            window.location.href="supplies.php"</script>';
                                                      } else {
                                                        echo '<script>alert("Updating Supply Failed!\n Please Check SQL Connection String!") 
                                            window.location.href="supplies.php"</script>';
                                                      }
                                                    }
                                                  }
                                                  ?>
                                                </div>
                                              </div>
                                            </div>
                                            <!-- End of Edit Modal -->

                                            <!-- Delete -->
                                            <div class="modal fade" id="ret<?php echo $result['transid']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                  <form id="update_form" method="POST">
                                                    <div class="modal-header">
                                                      <h4 class="modal-title">Return Supply</h4>
                                                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    </div>
                                                    <div class="modal-body">
                                                      <?php
                                                      $transaction = mysqli_query($conn, "select * from transactions where id='" . $result['transid'] . "'");
                                                      $trow = mysqli_fetch_array($transaction);
                                                      ?>
                                                      <label>Borrowed Quantity</label>
                                                      <!-- <input type="hidden" id="id_u" name="transid" value="<?php echo $trow['id']; ?>" class="form-control" readonly> -->
                                                      <input type="hidden" id="id_u" name="rbarcode" value="<?php echo $trow['barcode']; ?>" class="form-control" readonly>
                                                      <input type="hidden" id="id_u" name="datereleased" value="<?php echo $trow['date_released']; ?>" class="form-control" readonly>
                                                      <input type="hidden" id="id_u" name="returnsupply" value="<?php echo $trow['supply_name']; ?>" class="form-control" readonly>
                                                      <input type="hidden" id="id_u" name="returnname" value="<?php echo $trow['borrower_name']; ?>" class="form-control" readonly>
                                                      <input type="hidden" id="id_u" name="returnid" value="<?php echo $trow['id']; ?>" class="form-control" readonly>
                                                      <input type="number" id="id_u" name="transactionquan" value="<?php echo $trow['quantity']; ?>" class="form-control" readonly>
                                                      <div class="form-group">
                                                        <label>Quantity</label>
                                                        <input type="number" id="desceiption_u" name="returnquan" value="" class="form-control" required>
                                                      </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                      <input type="hidden" value="2" name="type">
                                                      <input type="button" class="btn btn-defaulst" data-dismiss="modal" value="Cancel">
                                                      <button class="btn btn-info" id="update">Return</button>
                                                    </div>
                                                  </form>
                                                  <?php
                                                  if (isset($_POST['returnquan'])) {
                                                    if ($_POST['returnquan'] > $_POST['transactionquan']) {
                                                      echo '<script>alert("Quantity exceeds transaction quan") 
                              window.location.href="supplies.php"</script>';
                                                    } else {
                                                      if ($_POST['returnquan'] == $_POST['transactionquan']) {
                                                        $sql = "UPDATE transactions set date_returned = NOW(), `status` = 1  WHERE id = " . $_POST['returnid'] . "";
                                                        if ($conn->query($sql) === TRUE) {
                                                          echo '<script>alert("Returned Successfully!") 
                                                  window.location.href="supplies.php"</script>';
                                                        } else {
                                                          echo '<script>alert("Returning Transaction Failed!\n Please Check SQL Connection String!") 
                                                  window.location.href="supplies.php"</script>';
                                                        }
                                                      } else {
                                                        $newquan = $_POST['transactionquan'] - $_POST['returnquan'];
                                                        $sqleditquan = "UPDATE transactions set quantity = " . $newquan . " WHERE id = " . $_POST['returnid'] . "";
                                                        $conn->query($sqleditquan);

                                                        $sqlnew = "INSERT INTO `transactions` (`supply_name`,`borrower_name`,`quantity`,date_released,barcode,date_returned,`status`)
                                      VALUES ('" . $_POST['returnsupply'] . "','" . $_POST['returnname'] . "','" . $_POST['returnquan'] . "','" . $_POST['datereleased'] . "','" . $_POST['rbarcode'] . "',now(),1)";
                                                        if ($conn->query($sqlnew) === TRUE) {
                                                          $_POST["returnquan"] = null;
                                                          echo '<script>alert("Success!") 
                                                  window.location.href="supplies.php"</script>';
                                                        } else {
                                                          echo '<script>alert("Returning Transaction Failed!\n Please Check SQL Connection String!") 
                                                  window.location.href="supplies.php"</script>';
                                                        }
                                                      }
                                                    }

                                                    // $sql = "UPDATE transactions set date_returned = NOW(), `status` = 1  WHERE id = ".$_POST['returnid']."";
                                                    //   if ($conn->query($sql) === TRUE) {
                                                    //     echo '<script>alert("Returned Successfully!") 
                                                    //                     window.location.href="supplies.php"</script>';
                                                    //   } else {
                                                    //     echo '<script>alert("Returning Transaction Failed!\n Please Check SQL Connection String!") 
                                                    //                     window.location.href="supplies.php"</script>';
                                                    //   }
                                                  }
                                                  ?>
                                                </div>
                                              </div>
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
</body>

</html>