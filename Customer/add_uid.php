<?php
session_start();
require_once "../config/db.php";

$user_id = $_SESSION['user_id'];
$game_id = $_POST['game_id'];
$uid = $_POST['uid'];

$stmt = $conn->prepare("
INSERT INTO game_uids (user_id,game_id,uid)
VALUES (?,?,?)
");

$stmt->bind_param("iis",$user_id,$game_id,$uid);
$stmt->execute();

header("Location: profile.php");