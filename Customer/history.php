<?php include "partials/header.php"; ?>

<!-- PAGE HERO -->
<section class="se-page-hero">
  <div class="se-page-hero-inner">
    <h2 class="se-page-title">History</h2>
    <p class="se-page-breadcrumb">Home > History</p>
  </div>
</section>

<section class="se-section">
  <div class="se-container">

    <div class="se-card p-4">

      <!-- TOOLS -->
      <div class="d-flex justify-content-between flex-wrap mb-4 gap-3">

        <input type="text"
               id="searchInput"
               class="form-control"
               style="max-width:250px"
               placeholder="search">

        <div class="d-flex gap-2">
          <select id="categoryFilter" class="form-select">
            <option value="all">Category</option>
            <option value="valorant">Valorant</option>
            <option value="rov">ROV</option>
          </select>

          <select id="sortBy" class="form-select">
            <option value="date_desc">ล่าสุด</option>
            <option value="date_asc">เก่าสุด</option>
            <option value="price_desc">ราคา สูง → ต่ำ</option>
            <option value="price_asc">ราคา ต่ำ → สูง</option>
          </select>
        </div>

      </div>

      <!-- TABLE -->
      <div class="table-responsive">
        <table class="table align-middle text-center">
          <thead>
            <tr>
              <th>วันที่</th>
              <th>เลขคำสั่งซื้อ</th>
              <th>Game UID</th>
              <th>ประเภท</th>
              <th>สินค้า</th>
              <th>รายละเอียด</th>
              <th>ราคา</th>
              <th>สถานะ</th>
            </tr>
          </thead>
          <tbody id="historyTable"></tbody>
        </table>
      </div>

      <!-- PAGINATION -->
      <div class="se-pagination mt-4 text-center"></div>

    </div>

  </div>
</section>

<script src="assets/js/history.js"></script>

<?php include "partials/footer.php"; ?>