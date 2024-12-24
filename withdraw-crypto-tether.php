<?php require_once 'app/include/header.php';
  include('app/controllers/admin.php')

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

      <div class="withdraw-bitcoin-wrapper">
        <h2>From where and where</h2>
        <div class="withdraw-bitcoin-info">
          <div class="withdraw-bitcoin-logo">
            <img src="assets/img/tether.svg" alt="">
            <span>Tether</span>
          </div>
          <div class="withdraw-bitcoin-balance">
            <span><b>Balance: </b><?= $_SESSION['balance'] -  $allAmount - $reserveAmount ?> ₮</span>
          </div>
          <div class="withdraw-bitcoin-comission">
            <span><b>Сommission: </b>0,1%</span>
          </div>
        </div>
        <form action="#" class="withdraw-bitcoin-where-from-form">
          <label><span>From</span><input class='where' placeholder="pok8341dg200349" type="text"></label>
          <label><span>Where</span><input class='from' placeholder="pok8341dg200349" type="text"></label>
          <button class='acceptWallets purple-btn' style='color:white; border-radius:20px;  padding:15px; width:200px '
            type='button'>Accept</button>
        </form>
      </div>

      <div class="withdraw-bitcoin-wrapper">
        <h2>Enter amount</h2>
        <div class="withdraw-bitcoin-info">
          <div class="withdraw-bitcoin-logo">
            <img src="assets/img/tether.svg" alt="">
            <span>Tether</span>
          </div>
          <div class="withdraw-bitcoin-balance">
            <span class='balanceww'><b>Balance: </b><?= $_SESSION['balance'] -  $allAmount - $reserveAmount ?> ₮</span>
          </div>
          <div class="withdraw-bitcoin-comission">
            <span><b>Сommission: </b>0,1%</span>
          </div>
        </div>
        <form action="#" class="withdraw-bitcoin-amount-form">
          <label><span>Amount</span><input placeholder="6897" class='amountValue' type="text"></label>
          <span class='errorBalance'></span>
          <button style='color:white; border-radius:20px; padding:15px; width:200px ' class="purple-btn acceptOperation"
            type="button">Accept</button>
        </form>
      </div>

      <div class="withdraw-bitcoin-wrapper operation_details">
        <h2>Operation details</h2>
        <div class="withdraw-bitcoin-info">
          <div class="withdraw-bitcoin-logo">
            <img src="assets/img/tether.svg" alt="">
            <span>Tether</span>
          </div>
          <div class="withdraw-bitcoin-comission">
            <span><b>Сommission: </b>0,1%</span>
          </div>
        </div>
        <form action="withdraw-crypto-tether.php" class="withdraw-bitcoin-where-from-form" method='post'>
          <input name='id' type="hidden" value=<?=$_SESSION['id']?> />
          <span>Where: <input name='where_wallet' style='border:none' class='whereEndOperation' /></span>
          <span>From: <input name='from_wallet' style='border:none' class='fromEndOperation' /></span>
          <span class="withdraw-bitcoin-details-amount">
            Amount: <input name='amount' class='amount' style='border:none; fontSize:26px; font-weight:600' />
          </span>
          <button name='acceptWithdraw' style='color:white; border-radius:20px;  padding:15px; width:200px '
            class="purple-btn acceptWithdraw" type="submit">Accept</button>
        </form>
      </div>


    </div>
</section>
<?php require_once 'app/include/footer.php'; ?>