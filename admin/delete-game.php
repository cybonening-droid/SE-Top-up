<?php
require_once "auth.php";
require_once "../config/db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $id = intval($_POST['id']);

    if ($id > 0) {

        $stmt = $conn->prepare("DELETE FROM games WHERE id=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
    }
}

header("Location: games.php");
exit;