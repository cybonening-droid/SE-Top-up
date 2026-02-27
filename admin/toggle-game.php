<?php
include("auth.php");
include("../config/db.php");

$id = $_GET["id"];

$row = $conn->query("SELECT status FROM games WHERE id=$id")->fetch_assoc();

$newStatus = ($row["status"]=="ON") ? "OFF" : "ON";

$conn->query("UPDATE games SET status='$newStatus' WHERE id=$id");

header("Location: games.php");
exit();
?>
