<?php
$activePage = "packages";
require_once "auth.php";
require_once "../config/db.php";

$search = $_GET['search'] ?? '';
$gameFilter = $_GET['game'] ?? '';

$sql = "
    SELECT packages.*, games.name AS game_name
    FROM packages
    JOIN games ON packages.game_id = games.id
    WHERE 1=1
";

/* ===== Search ===== */
if (!empty($search)) {
    $search = $conn->real_escape_string($search);
    $sql .= " AND (
        packages.name LIKE '%$search%'
        OR games.name LIKE '%$search%'
    )";
}

/* ===== Filter Game ===== */
if (!empty($gameFilter)) {
    $gameFilter = intval($gameFilter);
    $sql .= " AND packages.game_id = $gameFilter";
}

$sql .= " ORDER BY packages.id DESC";

$result = $conn->query($sql);
?>
  <?php include "partials/header.php"; ?>
  <?php include("partials/sidebar.php"); ?>

  <!-- Content Wrapper -->
  <div id="content-wrapper" class="d-flex flex-column">

    <div id="content">

      <!-- Page Content -->
      <div class="container-fluid mt-4">

        <!-- Title -->
        <h1 class="h3 mb-4 font-weight-bold text-dark">
          Packages
        </h1>

        <!-- Packages Card -->
        <div class="card shadow p-4">

          <form method="GET" class="form-row align-items-center mb-4">

              <!-- Filter Game -->
              <div class="col-md-2">
                  <select name="game"
                          class="form-control"
                          onchange="this.form.submit()">

                      <option value="">All Game</option>

                      <?php
                      $games = $conn->query("SELECT * FROM games");
                      while ($g = $games->fetch_assoc()):
                      ?>
                          <option value="<?= $g['id'] ?>"
                              <?= ($gameFilter == $g['id']) ? 'selected' : '' ?>>
                              <?= $g['name'] ?>
                          </option>
                      <?php endwhile; ?>

                  </select>
              </div>

              <!-- Search -->
              <div class="col-md-4">
                  <input type="text"
                        name="search"
                        class="form-control"
                        placeholder="Search..."
                        value="<?= htmlspecialchars($search) ?>">
              </div>

              <!-- Add Button -->
              <div class="col-md-2">
                  <button type="button"
                          class="btn btn-primary"
                          data-toggle="modal"
                          data-target="#addPackageModal">
                      + Add Package
                  </button>
              </div>

          </form>

          <!-- Packages Table -->
          <table class="table text-center">

              <thead>
                  <tr>
                      <th>Package Name</th>
                      <th>Game</th>
                      <th>Price</th>
                      <th>Status</th>
                      <th>Action</th>
                  </tr>
              </thead>

              <tbody>
              <?php while($row = $result->fetch_assoc()): ?>
                  <tr>
                      <td><?= htmlspecialchars($row['name']) ?></td>
                      <td><?= htmlspecialchars($row['game_name']) ?></td>
                      <td><?= number_format($row['price'],2) ?></td>

                      <td>
                          <?php if($row["status"]=="ON"): ?>
                              <span class="badge badge-success px-4 py-2">ON</span>
                          <?php else: ?>
                              <span class="badge badge-danger px-4 py-2">OFF</span>
                          <?php endif; ?>
                      </td>

                      <td>
                          <button class="btn btn-sm btn-primary"
                                  data-toggle="modal"
                                  data-target="#editPackageModal"
                                  data-id="<?= $row['id'] ?>"
                                  data-name="<?= htmlspecialchars($row['name']) ?>"
                                  data-price="<?= $row['price'] ?>"
                                  data-status="<?= $row['status'] ?>"
                                  data-game="<?= $row['game_id'] ?>">
                              Edit
                          </button>
                      </td>

                  </tr>
              <?php endwhile; ?>
              </tbody>

          </table>

        </div>
      </div>
    </div>
<?php include "partials/footer.php"; ?>