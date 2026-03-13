<?php require_once "auth.php"; ?>
<?php include "partials/header.php"; ?>
<!-- PAGE HERO -->
<section class="se-page-hero">
  <div class="se-page-hero-inner">
    <h2 class="se-page-title">Points</h2>
    <p class="se-page-breadcrumb">Home > Points</p>
  </div>
</section>

<section class="se-section">
  <div class="se-container">

    <!-- POINT SUMMARY -->
    <div class="se-point-box mb-5">
      <!-- กล่องแต้ม -->
      <div class="se-point-left">
        <h2>6769</h2>
        <span>Points</span>
      </div>

      <!-- ฝั่งขวา -->
      <div class="se-point-right">
        ทุกการเติม 10 บาท = 1 Point<br>
        แต้มสามารถใช้แลกคูปองและโบนัสได้
      </div>

    </div>

    <!-- FILTER -->
    <div class="se-filter mb-4">
      <button class="se-filter-btn active" data-category="coupon">คูปองส่วนลด</button>
      <button class="se-filter-btn" data-category="bonus">โบนัสเติมฟรี</button>
      <button class="se-filter-btn" data-category="gift">Gift Cards</button>
    </div>

    <!-- GRID -->
    <div class="row g-4 se-grid">

      <?php
      $rewards = [
        ["Coupon 10฿","coupon"],
        ["Coupon 20฿","coupon"],
        ["Bonus Diamonds +20","bonus"],
        ["Gift Card 100฿","gift"]
      ];

      foreach($rewards as $r):
      ?>

      <div class="col-lg-3 col-md-4 col-6 se-card-item"
           data-category="<?= $r[1] ?>">
        <div class="se-card">
          <div class="se-ph se-ph-wide"></div>
          <div class="se-card-name"><?= $r[0] ?></div>
        </div>
      </div>

      <?php endforeach; ?>

    </div>

    <div class="se-pagination mt-5 text-center"></div>

    <!-- HISTORY -->
    <div class="mt-5">
      <h3 style="font-weight:900;">ประวัติการแลกแต้ม</h3>

      <div class="se-card mt-3 p-3">
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th>วันที่</th>
                <th>รางวัล</th>
                <th>แต้มที่ใช้</th>
                <th>สถานะ</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>12/02/2026</td>
                <td>คูปอง 10฿</td>
                <td>-100</td>
                <td><span class="badge bg-success">สำเร็จ</span></td>
              </tr>
              <tr>
                <td>10/02/2026</td>
                <td>คูปอง 10฿</td>
                <td>-100</td>
                <td><span class="badge bg-danger">ยกเลิก</span></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

    </div>

  </div>
</section>

<?php include "partials/footer.php"; ?>