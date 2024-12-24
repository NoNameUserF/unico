<?php require_once 'app/include/header.php';
include('app/controllers/admin.php');
?>
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

      <div class="widgets">
        <span>место для виджетов</span>
      </div>

      <div class="currency">
        <h2>Сurrency</h2>
        <div class="dropdown">
          <button class="dropbtn">Choose currency <img src="assets/img/withdraw-arrow.svg" alt=""></button>
          <div class="dropdown-content">
            <a href="withdraw-card-doll.php">Dollar</a>
            <a href="#">Ruble</a>
            <a href="#">Euro</a>
            <a href="#">Yuan</a>
          </div>
        </div>
      </div>

    </div>

  </div>
</section>
<?php require_once 'app/include/footer.php'; ?>