<?php 
require_once "auth.php";
require_once "../config/db.php";
$activePage = "dashboard"; 
/* Orders Today */
$qToday = $conn->query("
SELECT COUNT(*) as total 
FROM orders 
WHERE DATE(created_at) = CURDATE()
");
$ordersToday = $qToday->fetch_assoc()['total'];

/* Pending Orders */
$qPending = $conn->query("
SELECT COUNT(*) as total 
FROM orders 
WHERE status='PENDING'
");
$pendingOrders = $qPending->fetch_assoc()['total'];

/* Total Revenue */
$qRevenue = $conn->query("
SELECT SUM(packages.price) as total
FROM orders
JOIN packages ON orders.package_id = packages.id
WHERE orders.status='SUCCESS'
");
$totalRevenue = $qRevenue->fetch_assoc()['total'] ?? 0;

/* Total Users */
$qUsers = $conn->query("
SELECT COUNT(*) as total 
FROM users
");
$totalUsers = $qUsers->fetch_assoc()['total'];

$latestOrders = $conn->query("
SELECT 
orders.id,
users.username,
packages.name AS package_name,
packages.price,
games.name AS game_name,
orders.status,
orders.created_at
FROM orders
JOIN users ON orders.user_id = users.id
JOIN packages ON orders.package_id = packages.id
JOIN games ON packages.game_id = games.id
ORDER BY orders.created_at DESC
LIMIT 5
");
/* ===== Revenue Last 7 Days ===== */

$revenueData = [];

$query = $conn->query("
SELECT 
DATE(orders.created_at) as day,
SUM(packages.price) as revenue
FROM orders
JOIN packages ON orders.package_id = packages.id
WHERE orders.status='SUCCESS'
AND orders.created_at >= CURDATE() - INTERVAL 7 DAY
GROUP BY DATE(orders.created_at)
ORDER BY DATE(orders.created_at)
");

if($query){
    while($row = $query->fetch_assoc()){
        $revenueData[] = $row;
    }
}

/* ===== Top Revenue Game ===== */

$gameRevenue = [];

$query = $conn->query("
SELECT 
games.name,
SUM(packages.price) as revenue
FROM orders
JOIN packages ON orders.package_id = packages.id
JOIN games ON packages.game_id = games.id
WHERE orders.status='SUCCESS'
GROUP BY games.id
");

while($row = $query->fetch_assoc()){
    $gameRevenue[] = $row;
}
?>

  <?php include "partials/header.php"; ?>
  <?php include("partials/sidebar.php"); ?>

  <!-- Content Wrapper -->
  <div id="content-wrapper" class="d-flex flex-column">

    <div id="content">

      <!-- Main Content -->
      <div class="container-fluid mt-4">

        <!-- Title -->
        <h1 class="h3 mb-4 font-weight-bold text-dark">
          Dashboard
        </h1>

        <!-- Stat Cards -->
        <div class="row">

          <!-- Orders Today -->
          <div class="col-md-3 mb-4">
            <div class="card shadow-sm p-3 text-center">
              <h2 class="font-weight-bold"><?= $ordersToday ?></h2>
              <p class="text-muted mb-0">Orders Today</p>
            </div>
          </div>

          <!-- Pending Orders -->
          <div class="col-md-3 mb-4">
            <div class="card shadow-sm p-3 text-center">
              <h2 class="font-weight-bold"><?= $pendingOrders ?></h2>
              <p class="text-muted mb-0">Pending Orders</p>
            </div>
          </div>

          <!-- Total Revenue -->
          <div class="col-md-3 mb-4">
            <div class="card shadow-sm p-3 text-center">
              <h2 class="font-weight-bold">฿<?= number_format($totalRevenue,2) ?></h2>
              <p class="text-muted mb-0">Total Revenue</p>
            </div>
          </div>

          <!-- Total Users -->
          <div class="col-md-3 mb-4">
            <div class="card shadow-sm p-3 text-center">
              <h2 class="font-weight-bold"><?= $totalUsers ?></h2>
              <p class="text-muted mb-0">Total Users</p>
            </div>
          </div>

        </div>

        <!-- Charts Section -->
        <div class="row">

          <!-- Total Earning Chart -->
          <div class="col-md-7 mb-4">
            <div class="card shadow p-4">
              <h5 class="font-weight-bold mb-3">Total Earning</h5>
              <!-- Placeholder Chart -->
                <div style="height:250px;">
                    <canvas id="earningChart"></canvas>
                </div>
            </div>
          </div>

          <!-- Pie Chart -->
          <div class="col-md-5 mb-4">
            <div class="card shadow p-4">
              <h5 class="font-weight-bold mb-3">
                Highest Revenue Game
              </h5>

              <!-- Placeholder Pie -->
                <div style="height:250px;">
                    <canvas id="gamePieChart"></canvas>
                </div>
            </div>
          </div>

        </div>

        <!-- Latest Order Table -->
        <div class="card shadow p-4 mt-3">

          <div class="d-flex justify-content-between align-items-center mb-4">
              <h4 class="font-weight-bold mb-0">Latest Orders</h4>

              <a href="orders.php" class="btn btn-sm btn-outline-primary">
                  View All
              </a>
          </div>

          <div class="table-responsive">

            <table class="table text-center align-middle">

            <thead class="thead-light">

            <tr>
            <th>Order</th>
            <th>User</th>
            <th>Game</th>
            <th>Package</th>
            <th>Price</th>
            <th>Date</th>
            <th>Status</th>
            <th></th>
            </tr>

            </thead>

            <tbody>

              <?php while($row = $latestOrders->fetch_assoc()): ?>

              <?php
              $statusClass = [
              'pending' => 'warning',
              'success' => 'success',
              'cancel' => 'danger'
              ];

              $badgeColor = $statusClass[strtolower($row['status'])] ?? 'secondary';
              ?>

              <tr>

              <td>
              <a href="orders.php?id=<?= $row['id'] ?>" class="font-weight-bold">
              #<?= $row['id'] ?>
              </a>
              </td>

              <td>
              <?= htmlspecialchars($row['username']) ?>
              </td>

              <td>
              <?= htmlspecialchars($row['game_name']) ?>
              </td>

              <td>
              <?= htmlspecialchars($row['package_name']) ?>
              </td>

              <td>
              ฿<?= number_format($row['price'],2) ?>
              </td>

              <td>
              <?= date("d M Y H:i", strtotime($row['created_at'])) ?>
              </td>

              <td>
              <span class="badge badge-<?= $badgeColor ?> px-3 py-2">
              <?= $row['status'] ?>
              </span>
              </td>
              </tr>

              <?php endwhile; ?>

            </tbody>

          </table>

          </div>

        </div>

      </div>
    </div>
  </div>
<?php include "partials/footer.php"; ?>
