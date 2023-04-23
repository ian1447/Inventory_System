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
              <span><i class="bi bi-table me-2"></i></span> Users
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table id="example" class="table table-hover data-table" style="width: 100%">

                  <div class="m-2">
                    <!-- Button HTML (to Trigger Modal) -->
                    <button type="button" id="myBtn" class="btn btn-outline-success">
                      <span class="me-2"><i class="bi bi-person-plus-fill"></i></span>
                      Add User
                    </button>

                    <!-- Modal HTML -->
                    <div id="myModal" class="modal fade" data-bs-backdrop="static" tabindex="-1">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title">Add User</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                          </div>
                          <div class="modal-body">

                            <form class="needs-validation" method="POST">
                              <div class="form-row">
                                <div class="col-md-12 mb-2">
                                  <label for="validationCustom01">ID</label>
                                  <input type="text" class="form-control" id="validationCustom01" name="empid"
                                    placeholder="Enter  ID" required>
                                  <div class="valid-feedback">
                                    Looks good!
                                  </div>
                                </div>
                                <div class="form-row">
                                <div class="col-md-12 mb-2">
                                  <label for="validationCustom01">Employee Name</label>
                                  <input type="text" class="form-control" id="validationCustom01" name="empname"
                                    placeholder="Enter Name" required>
                                  <div class="valid-feedback">
                                    Looks good!
                                  </div>
                                </div>
                                <div class="col-md-12 mb-2">
                                  <label for="validationCustom01">Username</label>
                                  <input type="text" class="form-control" id="validationCustom01" name="username"
                                    placeholder="Enter  Username" required>
                                  <div class="valid-feedback">
                                    Looks good!
                                  </div>
                                </div>
                                <div class="col-md-12 mb-2">
                                  <label for="validationCustom02">Password</label>
                                  <input type="password" class="form-control" id="validationCustom02" name="password"
                                    placeholder="Enter Password" required>
                                  <div class="valid-feedback">
                                    Looks good!
                                  </div>
                                </div>
                                <div class="col-md-12 mb-2">
                                  <label for="validationCustom02">Privilege</label>
                                  <select class="form-control" name="privilege" id="privilege">
                                    <option value="admin">Admin</option>
                                    <option value="employee">Employee</option>
                                  </select>
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
                            if (isset($_POST['empid'])) {
                              $sql = "INSERT INTO `users` (employee_id,`username`,`password`,privilege,employee_name)
                                            VALUES ('" . $_POST['empid'] . "','" . $_POST['username'] . "','" . $_POST['password'] . "','employee','".$_POST['empname']."')";
                              if ($conn->query($sql) === TRUE) {
                                echo '<script>alert("User Addedd Successfully!") 
                                                window.location.href="users.php"</script>';
                              } else {
                                echo '<script>alert("Adding User Failed!\n Please Check SQL Connection String!") 
                                                window.location.href="users.php"</script>';
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
                      <th>ID</th>
                      <th>Name</th>
                      <th>Username</th>
                      <th>Password</th>
                      <th>Privilege</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $sql = "SELECT * FROM `users`;";
                    $actresult = mysqli_query($conn, $sql);

                    while ($result = mysqli_fetch_assoc($actresult)) {
                    ?>
                    <tr>
                      <td>
                        <?php echo $result['employee_id']; ?>
                      </td>
                      <td>
                        <?php echo $result['employee_name']; ?>
                      </td>
                      <td>
                        <?php echo $result['username']; ?>
                      </td>
                      <td>
                        <?php echo $result['password']; ?>
                      </td>
                      <td>
                        <?php echo $result['privilege']; ?>
                      </td>
                      <td>
                        <div class="d-grid gap-2 d-md-flex">
                          <a href="#edit<?php echo $result['id']; ?>" data-toggle="modal"
                            class="btn btn-primary btn-sm me-md-2"><span class="me-2"><i
                                class="bi bi-pencil"></i></span> Update</a> ||
                          <a href="#del<?php echo $result['id']; ?>" data-toggle="modal"
                            class="btn btn-danger btn-sm"><span class="me-2"><i class="bi bi-trash"></i></span>
                            Delete</a>
                        </div>
                      </td>
                    </tr>
                    <!-- Start of Edit Modal -->
                    <!-- Edit Modal HTML -->
                    <div id="edit<?php echo $result['id']; ?>" class="modal fade">
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
                      $edit = mysqli_query($conn, "select * from users where id='" . $result['id'] . "'");
                      $erow = mysqli_fetch_array($edit);
                              ?>
                              <input type="hidden" id="id_u" name="editid" value="<?php echo $erow['id']; ?>"
                                class="form-control" required>
                              <div class="form-group">
                                <label>Employee ID</label>
                                <input type="text" id="name_u" name="editempid"
                                  value="<?php echo $erow['employee_id']; ?>" class="form-control" required>
                              </div>
                              <div class="form-group">
                                <label>Username</label>
                                <input type="text" id="username_u" name="editusername"
                                  value="<?php echo $erow['username']; ?>" class="form-control" required>
                              </div>
                              <div class="form-group">
                                <label>Password</label>
                                <input type="password" id="password_u" name="editpassword"
                                  value="<?php echo $erow['password']; ?>" class="form-control" required>
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
                        $sql = "UPDATE users u
                              SET u.employee_id = '" . $_POST['editempid'] . "', u.username = '" . $_POST['editusername'] . "', u.password = '" . $_POST['editpassword'] . "'
                              WHERE u.id='" . $_POST['editid'] . "'";
                        if ($conn->query($sql) === TRUE) {
                          echo '<script>alert("Users Edit Successful!") 
                                  window.location.href="users.php"</script>';
                        } else {
                          echo '<script>alert("Editing User Details Failed!\n Please Check SQL Connection String!") 
                                  window.location.href="users.php"</script>';
                        }
                      }
                          ?>
                        </div>
                      </div>
                    </div>
                    <!-- End of Edit Modal -->

                    <!-- Delete -->
                    <div class="modal fade" id="del<?php echo $result['id']; ?>" tabindex="-1" role="dialog"
                      aria-labelledby="myModalLabel" aria-hidden="true">
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
                      $del = mysqli_query($conn, "select * from users where id='" . $result['id'] . "'");
                      $drow = mysqli_fetch_array($del);
                            ?>
                            <div class="container-fluid">
                              <h5>
                                <center>Are you sure to delete <strong>
                                    <?php echo ucwords($drow['username']); ?>
                                  </strong> from Employee list? This method cannot be undone.</center>
                              </h5>
                            </div>
                          </div>
                          <form method="POST">
                            <input type="hidden" id="id_u" name="deleteid" value="<?php echo $drow['id']; ?>"
                              class="form-control" required>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal"><span
                                  class="glyphicon glyphicon-remove"></span> Cancel</button>
                              <button class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span>
                                Delete</button>
                            </div>
                            <?php
                      if (isset($_POST['deleteid'])) {
                        $sql = "DELETE FROM users  WHERE id='" . $_POST['deleteid'] . "'";
                        if ($conn->query($sql) === TRUE) {
                          echo '<script>alert("Deleted Successfully!") 
                                        window.location.href="users.php"</script>';
                        } else {
                          echo '<script>alert("Deleting Employee Details Failed!\n Please Check SQL Connection String!") 
                                        window.location.href="users.php"</script>';
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
    $(document).ready(function () {
      $("#myBtn").click(function () {
        $("#myModal").modal("toggle");
      });
    });
  </script>
</body>

</html>