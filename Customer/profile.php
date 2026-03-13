<?php 
include "partials/header.php";

/* mock data (เดี๋ยวค่อยดึง DB) */
$user = [
  "first_name" => "Punn",
  "last_name" => "InwzA",
  "email" => "Panyawatfaktim@email.com",
  "phone" => "0616742970",
  "username" => "PunnBigD_ata",
  "role" => "Customer",
  "id" => "s123456789"
];
?>

    <!-- PAGE HERO -->
    <section class="se-page-hero">
        <div class="se-page-hero-inner">
                <h2 class="se-page-title">My Profile</h2>
            <p class="se-page-breadcrumb">Home > Profile</p>
        </div>
    </section>

    <section class="se-section">
        <div class="se-container">

        <!-- PROFILE HEADER -->
        <div class="se-card p-4 mb-4 text-center">

        <div class="se-profile-avatar mb-3">
            <div class="se-ph se-ph-square" style="width:120px;margin:auto;"></div>
        </div>

        <h4 style="font-weight:900;">
            <?= $user['username'] ?>
        </h4>

        <p style="color:#666;">
            <?= $user['email'] ?>
        </p>

        </div>


        <div class="row g-4">

        <!-- PERSONAL INFO -->
        <div class="col-lg-6">
        <div class="se-card p-4">

            <h5 class="mb-3" style="font-weight:800;">Personal Information</h5>

            <div class="mb-3">
            <label class="form-label">First Name</label>
            <input class="form-control"
                    value="<?= $user['first_name'] ?>"
                    readonly>
            </div>

            <div class="mb-3">
            <label class="form-label">Last Name</label>
            <input class="form-control"
                    value="<?= $user['last_name'] ?>"
                    readonly>
            </div>

            <button class="se-btn-green w-100">
            Edit Personal Info
            </button>

        </div>
        </div>


        <!-- CONTACT INFO -->
        <div class="col-lg-6">
        <div class="se-card p-4">

            <h5 class="mb-3" style="font-weight:800;">Contact Information</h5>

            <div class="mb-3">
            <label class="form-label">Email</label>
            <input class="form-control"
                    value="<?= $user['email'] ?>"
                    readonly>
            </div>

            <div class="mb-3">
            <label class="form-label">Phone Number</label>
            <input class="form-control"
                    value="<?= $user['phone'] ?>"
                    readonly>
            </div>

            <button class="se-btn-green w-100">
            Edit Contact Info
            </button>

        </div>
        </div>


        <!-- ACCOUNT INFO -->
        <div class="col-lg-6">
        <div class="se-card p-4">

            <h5 class="mb-3" style="font-weight:800;">Account Information</h5>

            <div class="mb-3">
            <label class="form-label">User ID</label>
            <input class="form-control"
                    value="<?= $user['id'] ?>"
                    readonly>
            </div>

            <button class="se-btn-black w-100"
                    data-bs-toggle="modal"
                    data-bs-target="#uidModal">
            Manage Player UID
            </button>

        </div>
        </div>


        <!-- SECURITY -->
        <div class="col-lg-6">
        <div class="se-card p-4">

            <h5 class="mb-3" style="font-weight:800;">Security</h5>

            <button class="se-btn-red w-100">
            Change Password
            </button>

        </div>
        </div>

        </div>

        </div>
    </section>

<?php include "partials/footer.php"; ?>