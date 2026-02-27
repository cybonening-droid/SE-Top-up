<?php
include("auth.php");
include("../config/db.php");

$name   = $_POST["name"];
$status = $_POST["status"];

// Upload Image
$fileName = time() . "_" . $_FILES["image"]["name"];
$target = "uploads/" . $fileName;

move_uploaded_file($_FILES["image"]["tmp_name"], $target);

// Insert DB
$conn->query("INSERT INTO games(name,image,status)
              VALUES('$name','$target','$status')");

header("Location: games.php");
exit();
?>
