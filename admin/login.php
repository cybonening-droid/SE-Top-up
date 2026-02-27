<?php
session_start();
include("../config/db.php");

if(isset($_POST["login"])){

  $user = $_POST["username"];
  $pass = $_POST["password"];

  $sql = "SELECT * FROM admins 
          WHERE username='$user' 
          AND password='$pass'";

  $result = $conn->query($sql);

  if($result->num_rows > 0){
    $_SESSION["admin"] = $user;
    header("Location: index.php");
    exit();
  } else {
    $error = "❌ Username หรือ Password ไม่ถูกต้อง";
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>SE Admin - Login</title>

<link href="css/sb-admin-2.min.css" rel="stylesheet">
<link href="css/custom.css" rel="stylesheet">
<link href="css/login.css" rel="stylesheet">
</head>

<body>

  <div class="card shadow login-box text-center">

    <!-- Logo -->
    <div class="mb-3">
      <img src="assets/images/LogoBlue.png" width="90" alt="Logo">
    </div>

    <!-- ADMIN PANEL -->
    <h2 class="login-title">
      ADMIN PANEL
    </h2>

    <!-- Control Panel Login -->
    <p class="login-subtitle">
      Control Panel Login
    </p>



    <form method="POST">

      <div class="form-group text-left">
        <label class="font-weight-bold">Username</label>
        <input type="text" class="form-control"
               name="username"
               placeholder="Enter username" required>

      </div>

      <div class="form-group text-left">
        <label class="font-weight-bold">Password</label>
        <input type="password" class="form-control"
               name="password"
               placeholder="Enter password" required>

      </div>

      <button type="submit"
              name="login"
              class="btn btn-primary btn-block mt-4">
        Login
      </button>
      <?php if(isset($error)): ?>
        <p style="color:red; margin-top:15px;">
          <?= $error ?>
        </p>
      <?php endif; ?>

    </form>

  </div>

</body>
</html>
