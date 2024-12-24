<?php require_once 'app/include/header.php';

include ('app/controllers/passport.php'); ?>
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
      <div class="deposit">
        <div class="deposit-title-wrapper">
          <h2>Withdraw</h2>
          <div class="wallet-name-inner-wrapper">
            <span class="wallet-name">Wallet name:</span>

            <?php if(isset($_SESSION['wallet'])):?>
            <span id="cryptoId" class="crypto-id"><?=$_SESSION['wallet']?></span>
            <?php endif?>
            <?php if(!isset($_SESSION['wallet'])):?>
            <span id="cryptoId" class="crypto-id">pok8341dg200349</span>
            <?php endif?>
          </div>
        </div>
        <div class="payment-methods-wrapper">
          <div class="payment-method withdrawCrd payment-method-cards">
            <span class="payment-method-title">card</span>
            <div>
              <img src="assets/img/visa.svg" alt="Visa" />
              <img src="assets/img/union-pay.svg" alt="UnionPay" />
              <img src="assets/img/mastercard.svg" alt="Mastercard" />
            </div>
            <button style='color:white; border-radius:20px; padding:15px' class="top-up withdraw-btn btn-41">Top
              up</button>
          </div>
          <div class="crypto-payment" style='display:block'>
            <span class="payment-method-title">Crypto</span>
            <div>
              <img src="assets/img/bitcoin.svg" alt="bitcoin" />
              <img src="assets/img/ethereum.svg" alt="ethereum" />
              <img src="assets/img/tether.svg" alt="tether" />
            </div>
            <div style=' margin-top:30px; margin-bottom:20px'>
              <a href="withdraw-crypto.php" class="top-up btn-41"
                style='color:white; border-radius:20px; padding:15px;'>Top up</a>
            </div>
          </div>
        </div>
      </div>

    </div>
</section>
<?php require_once 'app/include/footer.php'; ?>