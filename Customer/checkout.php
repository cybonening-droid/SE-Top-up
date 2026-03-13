<?php require_once "includes/auth.php"; ?>  
<?php
session_start();
require_once "../config/db.php";


$user_id = $_SESSION['user_id'];
$order_id = $_GET['order_id'];

/* ======================
   GET ORDER INFO
====================== */

$stmt = $conn->prepare("
SELECT 
orders.id,
orders.price,
orders.status,
games.name AS game_name,
packages.name AS package_name,
orders.game_uid

FROM orders

JOIN packages 
ON orders.package_id = packages.id

JOIN games
ON packages.game_id = games.id

WHERE orders.id=? AND orders.user_id=?
");

$stmt->bind_param("ii",$order_id,$user_id);
$stmt->execute();

$order = $stmt->get_result()->fetch_assoc();

if(!$order){
die("Order not found");
}

/* ======================
   GET USER BALANCE
====================== */

$stmt = $conn->prepare("
SELECT balance FROM users WHERE id=?
");

$stmt->bind_param("i",$user_id);
$stmt->execute();

$user = $stmt->get_result()->fetch_assoc();

$balance = $user['balance'];


/* ======================
   CONFIRM PURCHASE
====================== */

if(isset($_POST['confirm'])){

if($balance < $order['price']){
$error = "Insufficient balance";
}
else{

$conn->begin_transaction();

try{

/* deduct balance */

$new_balance = $balance - $order['price'];

$stmt = $conn->prepare("
UPDATE users SET balance=? WHERE id=?
");

$stmt->bind_param("di",$new_balance,$user_id);
$stmt->execute();


/* update order */

$stmt = $conn->prepare("
UPDATE orders 
SET status='success' 
WHERE id=?
");

$stmt->bind_param("i",$order_id);
$stmt->execute();


/* insert transaction */

$stmt = $conn->prepare("
INSERT INTO transactions
(user_id,type,amount,order_id)
VALUES (?,?,?,?)
");

$type = "purchase";
$amount = -$order['price'];

$stmt->bind_param(
"isdi",
$user_id,
$type,
$amount,
$order_id
);

$stmt->execute();


$conn->commit();

header("Location: history.php");
exit();

}catch(Exception $e){

$conn->rollback();
$error = "Transaction failed";

}

}

}

?>
<?php require_once "includes/auth.php"; ?>