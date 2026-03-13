<?php require_once "includes/auth.php"; ?>
<?php
session_start();
require_once "../config/db.php";


$user_id = $_SESSION['user_id'];
$order_id = $_GET['order_id'] ?? 0;
/* ===== ดึงข้อมูล order ===== */

$stmt = $conn->prepare("
SELECT 
orders.id,
orders.price,
orders.game_uid,
games.name AS game_name,
packages.name AS package_name

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
?>
<?php include "partials/header.php"; ?>

<section class="se-page-hero">
<div class="se-page-hero-inner">
<h2 class="se-page-title">Checkout</h2>
<p class="se-page-breadcrumb">
Home > Checkout
</p>
</div>
</section>


<section class="se-section">
<div class="se-container">

<div class="row justify-content-center">
<div class="col-lg-6">

<div class="se-card p-4">

<h4 class="text-center mb-4">
Order #<?= $order['id'] ?>
</h4>

<hr>

<h6 class="fw-bold mb-3">
Purchase Information
</h6>


<div class="d-flex justify-content-between mb-2">
<span>Game</span>
<span><?= $order['game_name'] ?></span>
</div>

<div class="d-flex justify-content-between mb-2">
<span>Package</span>
<span><?= $order['package_name'] ?></span>
</div>

<div class="d-flex justify-content-between mb-3">
<span>UID</span>
<span><?= $order['game_uid'] ?></span>
</div>


<hr>


<div class="d-flex justify-content-between mb-2">
<span>Price</span>
<span><?= $order['price'] ?> ฿</span>
</div>

<div class="d-flex justify-content-between mb-2">
<span>Discount</span>
<span>0 ฿</span>
</div>


<div class="d-flex justify-content-between fw-bold fs-5 mb-4">
<span>Total</span>
<span><?= $order['price'] ?> ฿</span>
</div>


<form method="POST" action="confirm_order.php?order_id=<?= $order['id'] ?>">

<button class="se-btn-green w-100 mb-3">
Confirm Purchase
</button>

</form>


<div class="row g-2">

<div class="col-6">
<a href="topup.php" class="se-btn-gray w-100 text-center d-block">
Back
</a>
</div>

<div class="col-6">
<a href="cancel_order.php?order_id=<?= $order['id'] ?>" 
class="se-btn-red w-100 text-center d-block">
Cancel Order
</a>
</div>

</div>

</div>
</div>
</div>

</div>
</section>

<?php include "partials/footer.php"; ?>