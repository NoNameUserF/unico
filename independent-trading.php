<?php require_once 'app/include/header.php'; 
include "app/controllers/buy-strategy.php";
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['id'])) {
    header('Location: index.php');
    exit();
}
?>
<section class="lk-user-main">
  <div class="container">

    <div class="left-col">
      <?php require_once 'inc/lk/user-info.php'; ?>
      <?php require_once 'inc/lk/left-menu.php'; ?>
      <div class="calendar-wrapper">
        <button id="btnPrev" type="button"><img src="assets/img/calendar-left.svg" alt="prev"></button>
        <button id="btnNext" type="button"><img src="assets/img/calendar-right.svg" alt="next"></button>
        <div id="divCal"></div>
      </div>
    </div>

    <div class="right-col">

      <div class="widgets">
        <span>место для виджетов</span>
      </div>

      <div class="independent-trading">
        <h1>Independent trading</h1>
        <h2>In development</h2>
        <p>we are working on the content and functionality so that you increase your income</p>
        <a href="lk-user.php" class="go-to-dash purple-btn">Go to dashboard</a>
      </div>

    </div>

  </div>
</section>
<?php require_once 'app/include/footer.php'; ?>
