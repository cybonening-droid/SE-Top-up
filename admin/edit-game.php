<?php
include("auth.php");
include("../config/db.php");

$id     = $_POST["id"];
$name   = $_POST["name"];
$status = $_POST["status"];

// ถ้ามีอัปโหลดรูปใหม่
if(!empty($_FILES["image"]["name"])){

  $fileName = time()."_".$_FILES["image"]["name"];
  $target   = "uploads/".$fileName;

  move_uploaded_file($_FILES["image"]["tmp_name"], $target);

  $conn->query("UPDATE games 
                SET name='$name', status='$status', image='$target'
                WHERE id=$id");

} else {

  $conn->query("UPDATE games 
                SET name='$name', status='$status'
                WHERE id=$id");
}

header("Location: games.php");
exit();
?>
