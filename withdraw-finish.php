<?php require_once 'app/include/header.php';
include('app/controllers/admin.php'); ?>
<section class="lk-user-main">
  <div class="container">
    <div class="left-col">
      <?php require_once 'inc/lk/user-info.php'; ?>
      <?php require_once 'inc/lk/left-menu.php'; ?>
      <div class="calendar-wrapper">
        <button id="btnPrev" type="button">
          <img src="assets/img/calendar-left.svg" alt="prev" />
        </button>
        <button id="btnNext" type="button">
          <img src="assets/img/calendar-right.svg" alt="next" />
        </button>
        <div id="divCal"></div>
      </div>
    </div>

    <div class="right-col">

      <div class="withdraw-request-accepted">
        <h1>Withdrawal request accepted!</h1>
        <h2>Thank you for being with us</h2>
        <p>funds will be received within three working days</p>
        <a href="lk-user.php" class="go-to-dash purple-btn">Go to dashboard</a>
      </div>

    </div>
  </div>

  </div>
</section>
<?php require_once 'app/include/footer.php'; ?>