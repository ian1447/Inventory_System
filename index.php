<?php
session_start();

if (isset($_SESSION['username']))
{
    if($_SESSION['privilege']==="admin")
    {
        header("Location: admin/index.php");
    }
    else
    {
        header("Location: user/borrowed.php");
    }
}
?><!DOCTYPE html>
<html lang="en">
<head>
    <script language="javascript" type="text/javascript">
      window.history.forward();
    </script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Management System | Login</title>
    <link rel="stylesheet" href="style.css" >
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css">

</head>
<body style="background-color: #E0B0FF">
        
    <div class="d-flex flex-row" style="position: relative; left: 0px;">
        <div>
            <img src="./images/logo.png" width="800px" height="640px" alt="">
        </div>
        <form class=" col-md-12 col-lg-4 form card justify-content-center" action="Login.php" method="POST">
            <div class="field px-4 ">
                <label class="text-dark" style="font-weight: bold"> Username </label>
                <input class="input" name="username" type="text" placeholder="Username" id="username" required>
            </div>
            <div class="field mt-4 mb-7 px-4 py-2">
            <label class="text-dark" style="font-weight: bold"> Password </label>
                <input class="input px-2" name="user_password" type="password" placeholder="Password" id="password" required>
            </div> 
            <br/>
                <button class="text-white btn-lg px-5 py-2" style="background-color: #041C32; border-radius:26px; width: 100%">Login</button>
        </form>
    </div>
</body>
</html>