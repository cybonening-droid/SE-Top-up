<?php
$conn = new mysqli("localhost","root","","se_topup");

if($conn->connect_error){
  die("DB Connection Failed: ".$conn->connect_error);
}
?>
