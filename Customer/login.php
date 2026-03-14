<?php
session_start();
require_once "../config/db.php";

$error = "";

/* ================= LOGIN ================= */

if(isset($_POST['login'])){

$username = $_POST['username'];
$password = $_POST['password'];

$stmt = $conn->prepare(
"SELECT * FROM users WHERE username=?"
);

$stmt->bind_param("s",$username);
$stmt->execute();

$result = $stmt->get_result();

if($result->num_rows == 1){

$user = $result->fetch_assoc();

if($password == $user['password']){

$_SESSION['user_id'] = $user['id'];
$_SESSION['username'] = $user['username'];

header("Location:index.php");
exit();

}else{
$error = "Wrong password";
}

}else{
$error = "User not found";
}

}


/* ================= REGISTER ================= */

if(isset($_POST['register'])){

$username = $_POST['reg_username'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$password = $_POST['reg_password'];
$email = $_POST['email'];
$phone = $_POST['phone'];

$stmt = $conn->prepare(
"INSERT INTO users (username, firstname, lastname, password, email, phone)
VALUES (?,?,?,?,?,?)"
);

$stmt->bind_param(
"ssssss",
$username,
$firstname,
$lastname,
$password,
$email,
$phone
);

if($stmt->execute()){
$error = "Register success. Please login.";
}else{
$error = "Username already exists";
}

}

?>

<?php if(isset($_SESSION['error'])): ?>

<div class="alert alert-danger">
<?= $_SESSION['error'] ?>
</div>

<?php unset($_SESSION['error']); ?>
<?php endif; ?>

<?php include "partials/header.php"; ?>

<section class="se-section">
    <div class="se-container">

        <?php if($error): ?>
            <div class="alert alert-danger mb-4"><?= $error ?></div>
        <?php endif; ?>

        <div class="row g-4">

        <!-- LOGIN -->
        <div class="col-lg-6">

            <div class="se-card p-4">

                <h4 class="mb-2">Login to our site</h4>
                <p class="text-muted mb-4">
                    Enter username and password to log on:
                </p>

                <form method="POST" action="login_process.php">

                    <input
                    type="text"
                    name="username"
                    class="form-control mb-3"
                    placeholder="Username"
                    required
                    >

                    <input
                    type="password"
                    name="password"
                    class="form-control mb-3"
                    placeholder="Password"
                    required
                    >

                    <button
                    name="login"
                    class="se-btn-green w-100">
                    Sign in
                    </button>

                </form>

            </div>
        </div>


        <!-- REGISTER -->
        <div class="col-lg-6">

            <div class="se-card p-4">

            <h4 class="mb-2">Sign up now</h4>

            <p class="text-muted mb-4">
                Fill in the form below to get instant access:
            </p>

            <form method="POST">

                <input
                type="text"
                name="reg_username"
                class="form-control mb-3"
                placeholder="Username"
                required
                >
                <input
                type="text"
                name="firstname"
                class="form-control mb-3"
                placeholder="First Name"
                required
                >

                <input
                type="text"
                name="lastname"
                class="form-control mb-3"
                placeholder="Last Name"
                required
                >
                <input
                type="email"
                name="email"
                class="form-control mb-3"
                placeholder="E-Mail Address"
                required
                >

                <input
                type="password"
                name="reg_password"
                class="form-control mb-3"
                placeholder="Password"
                required
                >

                <input
                type="text"
                name="phone"
                class="form-control mb-4"
                placeholder="Phone"
                >
                
                <button
                name="register"
                class="se-btn-green w-100">
                Register
                </button>

            </form>

            </div>
        </div>

        </div>

    </div>
</section>

<?php include "partials/footer.php"; ?>