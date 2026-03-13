<?php
$conn = new mysqli("db", "root", "root", "se_topup");

if($conn->connect_error){
  die("DB Connection Failed: ".$conn->connect_error);
}
?>
