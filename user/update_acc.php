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
        <div class="container">
            <h3 class="fw-bold">Update Account</h3>
            <div class="card border-secondary mb-3">
                <form class="needs-validation" method="POST">
                    <div class="form-row">
                        <div class="col-md-6 m-3">
                            <label for="id">Username <span class="text-danger">*</span> </label>
                            <input type="text" class="form-control" name="newusername" id="id"
                                placeholder="Enter username" required>
                        </div>
                        <div class="col-md-6 m-3">
                            <label for="validationCustom01">New Password <span class="text-danger">*</span> </label>
                            <input type="password" class="form-control" name="newpassword" id="validationCustom01"
                                placeholder="Enter new password" required>
                        </div>
                        <div class="col-md-6 m-3">
                            <label for="validationCustom02">Confirm Password <span class="text-danger">*</span> </label>
                            <input type="password" class="form-control" name="retypepassword" id="validationCustom02"
                                placeholder="Confirm new password" required>
                        </div>
                    </div>
                    <div class="m-3">
                        <button class="btn btn-primary">Update</button>
                        <button class="btn btn-danger">Cancel</button>
                    </div>
                </form>
                <?php
            if (isset($_POST['newusername'])) {
                if ($_POST['newpassword'] != $_POST['retypepassword']) {
                    echo '<script>alert("Passwords do not match!") 
                        window.location.href="update_acc.php"</script>';
                } else {
                    $sql = "UPDATE users u SET u.username='" . $_POST['newusername'] . "', u.password='" . $_POST['newpassword'] . "'
                        WHERE u.employee_id='" . $_SESSION['useridnumber'] . "';";
                    if ($conn->query($sql) === TRUE) {
                        echo '<script>alert("Credentials Changed Successfully!") 
                            window.location.href="borrowed.php"</script>';
                        $_SESSION['username'] = $_POST['newusername'];
                    } else {
                        echo '<script>alert("Changing Credentials Failed!\n Please Check SQL Connection String!") 
                            window.location.href="borrowed.php"</script>';
                    }
                }
            }
            ?>
            </div>
        </div>
    </main>

    <script src="./js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.2/dist/chart.min.js"></script>
    <script src="./js/jquery-3.5.1.js"></script>
    <script src="./js/jquery.dataTables.min.js"></script>
    <script src="./js/dataTables.bootstrap5.min.js"></script>
    <script src="./js/script.js"></script>

</body>

</html>