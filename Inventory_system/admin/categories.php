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
  <?php include('./includes/navbar.php'); ?>
  <!-- ========== Left Sidebar Start ========== -->
  <?php include('./includes/sidebar.php'); ?>
  <!-- Left Sidebar End -->

  <main class="mt-5 pt-4">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 mb-3">
          <div class="card">
            <div class="card-header">
              <span><i class="bi bi-table me-2"></i></span> Categories
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table id="example" class="table table-hover data-table" style="width: 100%">

                  <div class="m-2">
                    <!-- Button HTML (to Trigger Modal) -->
                    <button type="button" id="myBtn" class="btn btn-outline-success">
                      <span class="me-2"><i class="bi bi-file-earmark-plus"></i></span>
                      Add Category
                    </button>

                    <!-- Modal HTML -->
                    <div id="myModal" class="modal fade" data-bs-backdrop="static" tabindex="-1">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title">Add Category</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                          </div>
                          <div class="modal-body">

                            <form class="needs-validation" method="POST">
                              <div class="form-row">
                                <div class="col-md-12 mb-2">
                                  <label for="validationCustom01">Category name</label>
                                  <input type="text" class="form-control" id="validationCustom01" name="catname" placeholder="Enter Category name" required>
                                  <div class="valid-feedback">
                                    Looks good!
                                  </div>
                                </div>
                                <div class="col-md-12 mb-2">
                                  <label for="validationCustom02">Class Code</label>
                                  <input type="text" class="form-control" id="validationCustom02" name="description" placeholder="Enter Description" required>
                                  <div class="valid-feedback">
                                    Looks good!
                                  </div>
                                </div>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                                <button class="btn btn-success">Save</button>
                              </div>
                            </form>
                            <?php
                            if (isset($_POST['catname'])) {
                              $sql = "INSERT INTO `categories` (`name`,`description`)
                                            VALUES ('" . $_POST['catname'] . "','" . $_POST['description'] . "')";
                              if ($conn->query($sql) === TRUE) {
                                echo '<script>alert("Category Addedd Successfully!") 
                                                window.location.href="categories.php"</script>';
                              } else {
                                echo '<script>alert("Adding Category Failed!\n Please Check SQL Connection String!") 
                                                window.location.href="categories.php"</script>';
                              }
                            }
                            ?>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>


                  <thead class>
                    <tr>
                      <th>Category Name</th>
                      <th>Class Code</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $sql = "SELECT * FROM categories;";
                    $actresult = mysqli_query($conn, $sql);

                    while ($result = mysqli_fetch_assoc($actresult)) {
                    ?>
                      <tr>
                        <td>
                          <?php echo $result['name']; ?>
                        </td>
                        <td>
                          <?php echo $result['description']; ?>
                        </td>
                        <td>
                          <div class="d-grid gap-2 d-md-flex">
                            <a href="#view<?php echo $result['id']; ?>" data-toggle="modal" class="btn btn-success btn-sm me-md-2"><span class="me-2"><i class="bi bi-eye"></i></span> View</a> ||
                            <a href="#edits<?php echo $result['id']; ?>" data-toggle="modal" class="btn btn-info btn-sm me-md-2"><span class="me-2"><i class="bi bi-pencil"></i></span> Edit Supplies</a> ||
                            <a href="#edit<?php echo $result['id']; ?>" data-toggle="modal" class="btn btn-primary btn-sm me-md-2"><span class="me-2"><i class="bi bi-pencil"></i></span> Update Category</a> ||
                            <a href="#del<?php echo $result['id']; ?>" data-toggle="modal" class="btn btn-danger btn-sm"><span class="me-2"><i class="bi bi-trash"></i></span>
                              Delete</a>
                          </div>
                        </td>
                      </tr>
                      <!-- trial -->

                      <!-- trial -->


                      <!-- Start of Edit Modal -->
                      <!-- Edit Modal HTML -->
                      <div id="edit<?php echo $result['id']; ?>" class="modal fade">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <form id="update_form" method="POST">
                              <div class="modal-header">
                                <h4 class="modal-title">Edit Category</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                              </div>
                              <div class="modal-body">
                                <?php
                                $id = $result['id'];
                                $edit = mysqli_query($conn, "select * from categories where id='" . $result['id'] . "'");
                                $erow = mysqli_fetch_array($edit);
                                ?>
                                <input type="hidden" id="id_u" name="beforename" value="<?php echo $erow['name']; ?>" class="form-control" required>
                                <input type="hidden" id="id_u" name="editid" value="<?php echo $erow['id']; ?>" class="form-control" required>
                                <div class="form-group">
                                  <label>Category</label>
                                  <input type="text" id="name_u" name="editname" value="<?php echo $erow['name']; ?>" class="form-control" required>
                                </div>
                                <div class="form-group">
                                  <label>Class Code</label>
                                  <input type="text" id="description_u" name="editdescription" value="<?php echo $erow['description']; ?>" class="form-control" required>
                                </div>
                              </div>
                              <div class="modal-footer">
                                <input type="hidden" value="2" name="type">
                                <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                                <button class="btn btn-info" id="update">Update</button>
                              </div>
                            </form>
                            <?php
                            if (isset($_POST['editid'])) {
                              $sql1 = "UPDATE categories c 
                                      SET c.name='" . $_POST['editname'] . "', c.description='" . $_POST['editdescription'] . "'
                                      WHERE c.id='" . $_POST['editid'] . "'";
                              $conn->query($sql1);
                              $sqlall = "UPDATE supplies SET category = '" . $_POST['editname'] . "'
                                      WHERE category ='" . $_POST['beforename'] . "'";
                              if ($conn->query($sqlall) === TRUE) {
                                echo '<script>alert("Category Edit Successful!") 
                                          window.location.href="categories.php"</script>';
                              } else {
                                echo '<script>alert("Editing Category Details Failed!\n Please Check SQL Connection String!") 
                                          window.location.href="categories.php"</script>';
                              }
                            }
                            ?>
                          </div>
                        </div>
                      </div>
                      <!-- End of Edit Modal -->

                       <!-- Edit supply Modal HTML -->
                       <div id="edits<?php echo $result['id']; ?>" class="modal fade">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <form id="update_form" method="POST">
                              <div class="modal-header">
                                <h4 class="modal-title">Edit Supplies</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                              </div>
                              <div class="modal-body">
                                
                              <div class="form-group">
                                <label>Supply Names</label>
                                <?php
                                $id = $result['id'];
                                $edit = mysqli_query($conn, "select * from categories where id='" . $result['id'] . "'");
                                $erow = mysqli_fetch_array($edit);
                                ?>
                                <select class="form-control" id="name" name="supplyname">
                                <option value=""> </option>
                                <?php
                                $sql3 = "SELECT * FROM supplies where category = '".$result['name']."';";
                                $actresult3 = mysqli_query($conn, $sql3);

                                while ($result3 = mysqli_fetch_assoc($actresult3)) { ?>
                                  <option value=<?php echo $result3['id'] ?>> <?php echo $result3['name'] ?></option>
                                <?php } ?>
                                </select>
                                </div>
                                <div class="form-group">
                                    <label>Item Description:</label>
                                    <input type="text" id="item_description" name="edit_description" class="form-control mb-2" required>
                                  </div>
                                  <div class="form-group">
                                    <label>Quantity:</label>
                                    <input type="number" id="quantity" name="edit_quantity" class="form-control mb-2" required>
                                  </div>
                                  <div class="form-group">
                                    <label>Unit Price:</label>
                                    <input type="number" id="price" name="edit_price" class="form-control mb-2" required>
                                </div>
                              </div>
                              <div class="modal-footer">
                                <input type="hidden" value="2" name="type">
                                <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                                <button class="btn btn-info" id="update">Update</button>
                              </div>
                            </form>
                            <?php
                            if (isset($_POST['supplyname'])) {
                              $sql1 = "SELECT quantity - borrowed_quantity as quantity from supplies where `id` = '".$_POST['supplyname']."' ";
                              $editrow = $conn->query($sql1);
                              $srow = mysqli_fetch_array($editrow);
                              if ($_POST['edit_quantity'] < $srow['quantity'])
                              {
                                echo '<script>alert("Invalid Quantity!") 
                                          window.location.href="categories.php"</script>';
                              }
                              else
                              {
                                $sqlupdate = "UPDATE supplies SET `description` = '".$_POST['edit_description']."',
                                 `unit_price` = '".$_POST['edit_price']."',
                                 `quantity` = '".$_POST['edit_quantity']."'
                                 WHERE `id` = ".$_POST['supplyname']."";
                                if ($conn->query($sqlupdate) === TRUE) {
                                    echo '<script>alert("Supply Edit Successful!") 
                                              window.location.href="categories.php"</script>';
                                  } else {
                                    echo '<script>alert("Editing Supply Details Failed!\n Please Check SQL Connection String!") 
                                              window.location.href="categories.php"</script>';
                                  }
                              }
                            }
                            ?>
                          </div>
                        </div>
                      </div>
                      <!-- End of Edit supply Modal -->

                      <!-- Delete -->
                      <div class="modal fade" id="del<?php echo $result['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <center>
                                <h4 class="modal-title" id="myModalLabel">Delete</h4>
                              </center>
                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            </div>
                            <div class="modal-body">
                              <?php
                              $del = mysqli_query($conn, "select * from categories where id='" . $result['id'] . "'");
                              $drow = mysqli_fetch_array($del);
                              ?>
                              <div class="container-fluid">
                                <h5>
                                  <center>Are you sure to delete <strong>
                                      <?php echo ucwords($drow['name']); ?>
                                    </strong> from Category list? This method cannot be undone.</center>
                                </h5>
                              </div>
                            </div>
                            <form method="POST">
                              <input type="hidden" id="id_u" name="deletename" value="<?php echo $drow['name']; ?>" class="form-control" required>
                              <input type="hidden" id="id_u" name="deleteid" value="<?php echo $drow['id']; ?>" class="form-control" required>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                                <button class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span>
                                  Delete</button>
                              </div>
                              <?php
                              if (isset($_POST['deleteid'])) {
                                $sql2 = "DELETE FROM categories  WHERE id='" . $_POST['deleteid'] . "'";
                                $conn->query($sql2);
                                $sqlall = "DELETE FROM supplies WHERE category = '" . $_POST['deletename'] . "'";
                                if ($conn->query($sqlall) === TRUE) {
                                  echo '<script>alert("Deleted Successfully!") 
                                                window.location.href="categories.php"</script>';
                                } else {
                                  echo '<script>alert("Deleting Supply Details Failed!\n Please Check SQL Connection String!") 
                                                window.location.href="categories.php"</script>';
                                }
                              }
                              ?>
                            </form>
                          </div>
                        </div>
                      </div>
                      <!-- /.modal -->

                      <!-- Start of View Modal -->
                      <!-- View Modal HTML -->

                      <div id="view<?php echo $result['id']; ?>" class="modal fade">

                        <?php
                        $str = strtoupper($result['name']);
                        ?>
                        <div class="modal-dialog modal-xl">
                          <div class="modal-content">
                            <form id="update_form" method="POST">
                              <div class="modal-header">
                                <h4 class="modal-title"><?php echo $str ?></h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                              </div>
                              <div class="modal-body">

                                <div class="row">

                                  <?php
                                  $id = $result['id'];
                                  $catname = $result["name"];
                                  $edit = mysqli_query($conn, "select * from categories where id='" . $result['id'] . "'");
                                  $erow = mysqli_fetch_array($edit);
                                  ?>

                                  <div class="col">
                                    Supply Names
                                    <input type="hidden" id="id_u" name="category_name" value="<?php echo $result["name"]; ?>" class="form-control" required>
                                    <ol class="list-group list-group-numbered">
                                      <?php
                                      $show = mysqli_query($conn, "select name, quantity-borrowed_quantity as quantity from supplies where category='" . $result['name'] . "'");
                                      while ($result = mysqli_fetch_assoc($show)) {
                                        echo '<button type="button" class="list-group-item d-flex justify-content-between align-items-start"><div class="fw-bold ms-2 me-auto">' . $result["name"] . 
                                        '</div><span class="badge bg-primary rounded-pill">' . $result["quantity"] . '</span></button>';
                                        ?>
                                        <?php
                                      }
                                      ?>
                                    </ol>
                                  </div>
                                  
                                    <div class="col">
                                      <div class="form-group">
                                        <label>Item Name:</label>
                                        <input type="text" id="item_name" name="item_name" class="form-control mb-2" required>
                                      </div>
                                      <div class="form-group">
                                        <label>Item Description:</label>
                                        <input type="text" id="item_description" name="item_description" class="form-control mb-2" required>
                                      </div>
                                      <div class="form-group">
                                        <label>Quantity:</label>
                                        <input type="number" id="quantity" name="quantity" class="form-control mb-2" required>
                                      </div>
                                      <div class="form-group">
                                        <label>Unit Price:</label>
                                        <input type="number" id="price" name="price" class="form-control mb-2" required>
                                      </div>
                                      <button class="btn btn-success" id="update">Add Item</button>
                                    </div>
                                </div>
                            </form>
                            <?php
                            if (isset($_POST['item_name'])) {
                              $sql = "INSERT INTO `supplies` (`name`,`description`,`quantity`,`category`,`borrowed_quantity`,`transdate`,`unit_price`)
                                    VALUES ('" . $_POST['item_name'] . "','" . $_POST['item_description'] . "',
                                    '" . $_POST['quantity'] . "','" . $_POST['category_name'] . "',0,NOW(),'" . $_POST['price'] . "')";
                              if ($conn->query($sql) === TRUE) {
                                $_POST["item_name"] = null;
                                echo '<script>alert("Supply Addedd Successfully!") 
                                              window.location.href="categories.php"</script>';
                              } else {
                                echo '<script>alert("Adding Supply Failed!\n Please Check SQL Connection String!") 
                                              window.location.href="categories.php"</script>';
                              }
                            }
                            ?>
                          </div>
                        </div>
                      </div>
                      <!-- End of View Modal -->
                  
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
      $("#myBtn").click(function() {
        $("#myModal").modal("toggle");
      });
    });
  </script>
  <script>
function alert() {
  alert("I am an alert box!");
}
</script>
  </script>
</body>

</html>