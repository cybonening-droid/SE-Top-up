<?php include "partials/header.php"; ?>

<!-- PAGE HERO -->
<section class="se-page-hero">
  <div class="se-page-hero-inner">
    <h2 class="se-page-title">Product Name</h2>
    <p class="se-page-breadcrumb">Home > Top-Up > Product Name</p>
  </div>
</section>

<section class="se-section">
  <div class="se-container">

    <div class="row g-5">

      <!-- ================= LEFT ================= -->
      <div class="col-lg-4">

        <div class="se-card p-4">
          <div class="se-ph se-ph-wide mb-3"></div>

          <h4 style="font-weight:900;">Product Name</h4>

          <p style="font-size:14px; line-height:1.7;">
            เติม Credit เกม <br>
            ขั้นตอนการเติมเกม:
            <br>1. เลือกแพ็คเกจ
            <br>2. กรอก UID
            <br>3. เลือกช่องทางชำระเงิน
          </p>
        </div>

      </div>

      <!-- ================= RIGHT ================= -->
      <div class="col-lg-8">

        <!-- GAME ID -->
        <div class="se-card p-4 mb-4">
          <h5 class="mb-3" style="font-weight:800;">Game ID</h5>

          <input type="text"
                 class="form-control mb-3"
                 placeholder="กรอก User ID / UID">

          <button class="se-btn-green w-100 mb-2">
            บันทึก ID นี้เป็น ID หลัก
          </button>

          <button class="se-btn-gray w-100">
            จัดการ ID หลัก
          </button>
        </div>

        <!-- PRODUCT BOX -->
        <div class="se-card p-4 mb-4">
    
        <div class="se-product-box">

          <!-- PAYMENT -->
    

            <h5 style="font-weight:800;">เลือกช่องทางการชำระเงิน</h5>
            <section class="se-payment mt-4">
            <div class="se-container">
                <div class="row g-3">

                <div class="col-6 col-lg-4">
                    <div class="se-payment-card" data-payment="promptpay">
                    <div class="se-payment-logo"><div class="se-ph se-ph-wide mb-3"></div></div>
                    <div class="se-payment-name">PromptPay</div>
                    </div>
                </div>

                <div class="col-6 col-lg-4">
                    <div class="se-payment-card" data-payment="truemoney">
                    <div class="se-payment-logo"><div class="se-ph se-ph-wide mb-3"></div></div>
                    <div class="se-payment-name">TrueMoney</div>
                    </div>
                </div>

                <div class="col-6 col-lg-4">
                    <div class="se-payment-card" data-payment="wallet">
                    <div class="se-payment-logo"><div class="se-ph se-ph-wide mb-3"></div></div>
                    <div class="se-payment-name">Wallet</div>
                    </div>
                </div>

                </div>
            </div>
            </section>


          <!-- PACKAGE -->
            <h5 class="mt-5 mb-3 fw-bold">เลือกแพ็กเกจ</h5>

            <div class="row g-3">

            <div class="col-6 col-lg-4">
                <div class="se-package-card" data-price="50">
                <div class="se-package-name">Package Name</div>
                <div class="se-package-price">฿50</div>
                </div>
            </div>

            <div class="col-6 col-lg-4">
                <div class="se-package-card" data-price="100">
                <div class="se-package-name">Package Name</div>
                <div class="se-package-price">฿100</div>
                </div>
            </div>

            <div class="col-6 col-lg-4">
                <div class="se-package-card" data-price="200">
                <div class="se-package-name">Package Name</div>
                <div class="se-package-price">฿200</div>
                </div>
            </div>

            </div>

          <!-- DISCOUNT -->
            <div class="se-product-section">
            <h5 class="se-section-title">ส่วนลด</h5>

            <div class="se-discount-row">
                <input type="text"
                    id="discountInput"
                    class="se-discount-input"
                    placeholder="กรอกโค้ดส่วนลด">

                <button type="button"
                        id="applyDiscount"
                        class="se-btn-green se-discount-btn">
                ใช้งาน
                </button>
            </div>
            </div>

          <!-- SUMMARY -->
          <div class="se-summary-box">

            <div class="se-summary-row">
              <span>ราคาสินค้า</span>
              <span>฿<span id="productPrice">0</span></span>
            </div>

            <div class="se-summary-row">
              <span>ส่วนลด</span>
              <span>-฿0</span>
            </div>

            <div class="se-total">
              สรุปยอดชำระเงิน ฿<span id="totalPrice">0</span>
            </div>

            <button id="continueBtn" class="se-btn-green" disabled>
            ดำเนินการต่อ
            </button>

          </div>

        </div>

      </div>
      

    </div>

  </div>
</section>

<script src="assets/js/product.js"></script>
<?php include "partials/footer.php"; ?>