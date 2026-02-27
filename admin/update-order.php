<?php
require_once "auth.php";
require_once "../config/db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $id = intval($_POST['id']);
    $status = $_POST['status'];

    $allowed = ['pending','success','cancel'];

    if ($id > 0 && in_array($status, $allowed)) {

        $stmt = $conn->prepare("UPDATE orders SET status=? WHERE id=?");
        $stmt->bind_param("si", $status, $id);
        $stmt->execute();
    }
}

header("Location: orders.php");
exit;