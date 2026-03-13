<?php 
require_once "auth.php";
require_once "../config/db.php";
$activePage = "transactions";

$search = $_GET['search'] ?? '';
$type   = $_GET['type'] ?? '';
$sort   = $_GET['sort'] ?? 'newest';

$sql = "
SELECT 
    transactions.id,
    users.username,
    transactions.type,
    transactions.amount,
    transactions.order_id,
    transactions.created_at
FROM transactions
JOIN users ON transactions.user_id = users.id
WHERE 1=1
";

/* ===== Search ===== */
if (!empty($search)) {
    $search = $conn->real_escape_string($search);
    $sql .= " AND (
        users.username LIKE '%$search%'
        OR transactions.id LIKE '%$search%'
        OR transactions.order_id LIKE '%$search%'
    )";
}

/* ===== Filter Type ===== */
if (!empty($type)) {
    $type = $conn->real_escape_string($type);
    $sql .= " AND transactions.type = '$type'";
}

/* ===== Sorting ===== */
switch ($sort) {
    case 'oldest':
        $sql .= " ORDER BY transactions.created_at ASC";
        break;

    case 'amount_high':
        $sql .= " ORDER BY transactions.amount DESC";
        break;

    case 'amount_low':
        $sql .= " ORDER BY transactions.amount ASC";
        break;

    default:
        $sql .= " ORDER BY transactions.created_at DESC";
}

$result = $conn->query($sql);
?>

<?php include "partials/header.php"; ?>
<?php include "partials/sidebar.php"; ?>

<div id="content-wrapper" class="d-flex flex-column">

<div id="content">

<div class="container-fluid mt-4">

<h1 class="h3 mb-4 font-weight-bold text-dark">
Transactions
</h1>

<div class="card shadow p-4">

<!-- Controls -->
<div class="row mb-4">
<div class="col-12">

<form method="GET" class="form-row align-items-center">

<div class="col-md-3 mb-2">
<input type="text"
       name="search"
       class="form-control"
       placeholder="Search..."
       value="<?= htmlspecialchars($search) ?>">
</div>

<div class="col-md-7"></div>

<div class="col-md-1 mb-2">
<select name="type"
        class="form-control"
        onchange="this.form.submit()">

<option value="">All</option>

<option value="topup" <?= ($type == 'topup') ? 'selected' : '' ?>>Topup</option>
<option value="purchase" <?= ($type == 'purchase') ? 'selected' : '' ?>>Purchase</option>
<option value="refund" <?= ($type == 'refund') ? 'selected' : '' ?>>Refund</option>

</select>
</div>

<div class="col-md-1 mb-2">
<select name="sort"
        class="form-control"
        onchange="this.form.submit()">

<option value="newest" <?= ($sort == 'newest') ? 'selected' : '' ?>>Newest</option>
<option value="oldest" <?= ($sort == 'oldest') ? 'selected' : '' ?>>Oldest</option>
<option value="amount_high" <?= ($sort == 'amount_high') ? 'selected' : '' ?>>Amount High</option>
<option value="amount_low" <?= ($sort == 'amount_low') ? 'selected' : '' ?>>Amount Low</option>

</select>
</div>

</form>

</div>
</div>

<!-- Table -->
<div class="table-responsive">

<table class="table text-center">

<thead>
<tr>
<th>ID</th>
<th>User</th>
<th>Type</th>
<th>Amount</th>
<th>Order</th>
<th>Date</th>
</tr>
</thead>

<tbody>

<?php if ($result && $result->num_rows > 0): ?>
<?php while ($row = $result->fetch_assoc()): ?>

<?php
$typeClass = [
    'topup' => 'success',
    'purchase' => 'danger',
    'refund' => 'info'
];

$badgeColor = $typeClass[strtolower($row['type'])] ?? 'secondary';
?>

<tr>

<td>#<?= $row['id'] ?></td>

<td>
<?= htmlspecialchars($row['username']) ?>
</td>

<td>
<span class="badge badge-<?= $badgeColor ?> px-3 py-2 text-capitalize">
<?= $row['type'] ?>
</span>
</td>

<td>

<?php
$amount = $row['amount'];
$class = $amount >= 0 ? "text-success" : "text-danger";
?>

<span class="<?= $class ?>">
<?= number_format($amount,2) ?>
</span>

</td>

<td>

<?php if ($row['order_id']): ?>

#<?= $row['order_id'] ?>

<?php else: ?>

-

<?php endif; ?>

</td>

<td>
<?= date("d M Y H:i", strtotime($row['created_at'])) ?>
</td>

</tr>

<?php endwhile; ?>

<?php else: ?>

<tr>
<td colspan="6" class="text-muted">
No transactions found
</td>
</tr>

<?php endif; ?>

</tbody>

</table>

</div>

</div>
</div>
</div>

<?php include "partials/footer.php"; ?>