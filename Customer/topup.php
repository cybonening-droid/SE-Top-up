<?php include "partials/header.php"; ?>
<!-- ===== PAGE HERO ===== -->
<section class="se-page-hero">
  <div class="se-page-hero-inner">
    <h2 class="se-page-title">TOP UP</h2>
    <p class="se-page-breadcrumb">Home > Top-Up</p>
  </div>
</section>

<section class="se-section">
  <div class="se-container">

    <!-- CATEGORIES -->
    <div class="se-filter mb-4">
      <button class="se-filter-btn active" data-category="game">ALL</button>
      <button class="se-filter-btn" data-category="mobile">MOBILE</button>
      <button class="se-filter-btn" data-category="pc">PC</button>
      <button class="se-filter-btn" data-category="gift">GIFT</button>
      <button class="se-filter-btn" data-category="sub">SUBSCRIPTIONS</button>
    </div>

    <!-- GRID -->
    <div class="row g-4 se-grid">

      <?php
      $games = [
        ["Free Fire","mobile"],
        ["Roblox","gift"],
        ["Realm of Valor","mobile"],
        ["Valorant","pc"],
        ["Ragnarok Origin","pc"],
        ["Efootball PES","pc"],
        ["Seiya EX","mobile"],
        ["Dota Plus","sub"],
        ["Steam Points","pc"]
      ];

      foreach($games as $game):
      ?>
      <div class="col-lg-3 col-md-4 col-6 se-card-item" data-category="game <?= $game[1] ?>">
        <div class="se-card">
          <div class="se-ph se-ph-wide"></div>
          <div class="se-card-name"><?= $game[0] ?></div>
        </div>
      </div>
      <?php endforeach; ?>

    </div>

    <!-- PAGINATION -->
    <div class="se-pagination mt-5 text-center"></div>

  </div>
</section>

<?php include "partials/footer.php"; ?>