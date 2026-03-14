<?php
session_start();
require_once "../config/db.php";

$id = $_GET['id'];

$stmt = $conn->prepare("
DELETE FROM game_uids
WHERE id=?
");

$stmt->bind_param("i",$id);
$stmt->execute();

header("Location: profile.php");