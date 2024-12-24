<?php session_start();
    require_once 'app/include/header.php'; 
;?>
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
    <div>
      <div class="right-col">
        <div style='border-radius: 26px;
  background: #efefef;
  height: 85px;
  display: flex;
  align-items: center;
  align-content: center;'>
          <span style='color: #000;
  margin: 0 auto;
  font-size: 24px;
  font-weight: 400;'>The data will be updated after a while</span>
        </div>

      </div>
    </div>
</section>

<?php require_once 'app/include/footer.php'; ?>