<?php 
require_once "auth.php";
$activePage = "dashboard"; ?>
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
              <h2 class="font-weight-bold">12</h2>
              <p class="text-muted mb-0">Orders Today</p>
            </div>
          </div>

          <!-- Pending Orders -->
          <div class="col-md-3 mb-4">
            <div class="card shadow-sm p-3 text-center">
              <h2 class="font-weight-bold">5</h2>
              <p class="text-muted mb-0">Pending Orders</p>
            </div>
          </div>

          <!-- Total Revenue -->
          <div class="col-md-3 mb-4">
            <div class="card shadow-sm p-3 text-center">
              <h2 class="font-weight-bold">฿6767</h2>
              <p class="text-muted mb-0">Total Revenue</p>
            </div>
          </div>

          <!-- Total Users -->
          <div class="col-md-3 mb-4">
            <div class="card shadow-sm p-3 text-center">
              <h2 class="font-weight-bold">102</h2>
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

          <h4 class="font-weight-bold mb-4">Latest Order</h4>

          <table class="table text-center">
            <thead>
              <tr>
                <th>order ID</th>
                <th>User</th>
                <th>Game</th>
                <th>Package</th>
                <th>Price</th>
                <th>Status</th>
                <th></th>
              </tr>
            </thead>

            <tbody>
              <tr>
                <td>#1234</td>
                <td>Tool</td>
                <td>Valorant</td>
                <td>1000 VP</td>
                <td>245</td>
                <td>
                  <span class="badge badge-warning px-4 py-2">
                    รอดำเนินการ
                  </span>
                </td>
                <td>
                  <button class="btn btn-primary btn-sm px-4">
                    View
                  </button>
                </td>
              </tr>

              <tr>
                <td>#1235</td>
                <td>Team</td>
                <td>Free Fire</td>
                <td>700 Diamonds</td>
                <td>199</td>
                <td>
                  <span class="badge badge-danger px-4 py-2">
                    ยกเลิก
                  </span>
                </td>
                <td>
                  <button class="btn btn-primary btn-sm px-4">
                    View
                  </button>
                </td>
              </tr>

              <tr>
                <td>#1236</td>
                <td>M</td>
                <td>RoV</td>
                <td>300 Coupon</td>
                <td>250</td>
                <td>
                  <span class="badge badge-success px-4 py-2">
                    สำเร็จ
                  </span>
                </td>
                <td>
                  <button class="btn btn-primary btn-sm px-4">
                    View
                  </button>
                </td>
              </tr>

              <tr>
                <td>#1237</td>
                <td>Soup</td>
                <td>Valorant</td>
                <td>500 VP</td>
                <td>120</td>
                <td>
                  <span class="badge badge-success px-4 py-2">
                    สำเร็จ
                  </span>
                </td>
                <td>
                  <button class="btn btn-primary btn-sm px-4">
                    View
                  </button>
                </td>
              </tr>

            </tbody>
          </table>

        </div>

      </div>
    </div>
  </div>
<?php include "partials/footer.php"; ?>
