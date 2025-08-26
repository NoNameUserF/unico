<?php
require_once "app/controllers/admin.php";
require_once 'app/include/header.php'; 
require_once "app/database/db.php";

if (!isset($_SESSION['id'])) {
    header('Location: index.php');
    exit();
}
if (!isset($_SESSION['id'])) {
    header('Location: index.php');
    exit();
}

$user = selectOne('users', ['id' => $_SESSION['id']]);
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

      <h1 style='color:black;'>Select a replenishment method</h1>

      <div class="deposit">
        <div class="deposit-title-wrapper">
          <h2>Deposit</h2>
          <div class="wallet-name-inner-wrapper">
            <span class="wallet-name">Wallet name:</span>

            <span id="cryptoId" class="crypto-id"><?=$user['wallet']?></span>
            <!-- <?php if(isset($_SESSION['wallet'])):?>
            <span id="cryptoId" class="crypto-id"><?=$_SESSION['wallet']?></span>
            <?php endif?>
            <?php if(!isset($_SESSION['wallet'])):?>
            <span id="cryptoId" class="crypto-id">pok8341dg200349</span>
            <?php endif?> -->
          </div>
        </div>
        <div class="payment-methods-wrapper">
          <div class="payment-method payment-method-cards">
            <span class="payment-method-title">card</span>
            <div>
              <img src="./assets/img/visa.svg" alt="Visa" />
              <img src="./assets/img/union-pay.svg" alt="UnionPay" />
              <img src="./assets/img/mastercard.svg" alt="Mastercard" />
            </div>
            <p style="color: red;">This is method not available now</p>
          </div>
          <div class="payment-method payment-method-crypto">
            <span class="payment-method-title">Crypto</span>
            <div>
              <img src="./assets/img/bitcoin.svg" alt="bitcoin" />
              <img src="./assets/img/ethereum.svg" alt="ethereum" />
              <img src="./assets/img/tether.svg" alt="tether" />
            </div>
            <button style='color:white; border-radius:20px; padding:15px; margin-top:20px'
              class="addCrypto top-up btn-41">Top up</button>
          </div>
        </div>
      </div>
      <div class="card">
        <h2>Card</h2>
        <form action="deposit.php" class="card-form">
          <label>Cardholder Name<input placeholder="Name" type="text" class="cardholder-name" /></label>
          <label>Cardholder Number<input placeholder="0000 0000 0000 0000" type="text"
              class="cardholder-number num-only" /></label>
          <div class="df">
            <label>Expiry date<input placeholder="MM / YY" type="text" class="expiry-date num-only" /></label>
            <label>CVV/CVC<input placeholder="000" type="text" class="cvv-cvc num-only" /></label>
          </div>
          <button type="button" class="accept">Accept</button>
        </form>
      </div>
      <div class="crypto">
        <h2>Сrypto</h2>
        <div class="crypto-info">
          <div class="crypto-name">
            <img src="./assets/img/tether.svg" alt="#" />Tether
          </div>
          <div class="exchange-wrapper">
            <span class="exchange">Exchange:</span>
            <span class="exchange-gray">7.85$</span>
          </div>
          <div class="comission-wrapper">
            <span class="comission">Сommission:</span>
            <span class="comission-gray">0,3% - 3%</span>
          </div>
        </div>
        <div class="crypto-adress">
          <span>Your address</span>

          <span id="cryptoId" class="crypto-id"><?=$user['corp_wallet']?></span>
          <!-- <?php if(isset($_SESSION['corp_wallet'])):?>
          <span id="cryptoId" class="crypto-id"><?=$_SESSION['corp_wallet']?></span>
          <?php endif?>
          <?php if(!isset($_SESSION['corp_wallet'])):?>
          <span id="cryptoId" class="crypto-id">pok8341dg200349</span>
          <?php endif?> -->
          <button onclick="copytext('#cryptoId')" type="button" class="copy">
            copy <img src="./assets/img/copy.svg" alt="" />
          </button>
        </div>
        <img src="./assets/img/qr-code.png" alt="" class="qr-code" />
        <div class="crypto-links-wrapper">
          <a href="#" class="crypto-email">Email<img src="./assets/img/mail.svg " alt="" /></a>
          <a href="#" class="crypto-blockchain">View on blockchain<img src="./assets/img/chain.svg" alt="" /></a>
        </div>
      </div>
    </div>
  </div>
</section>
<?php require_once 'app/include/footer.php'; ?>