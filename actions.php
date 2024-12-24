<?php require_once 'app/include/header.php'; 
include "app/controllers/buy-strategy.php";
session_start();
if (!isset($_SESSION['id'])) {
    header('Location: index.php');
    exit();
}
$reserveAmount = substr($_SESSION['amount'], 0, -3)  ;



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
        <span>place for widgets</span>
      </div>
      <div class="crypto-wallet">
        <div class="wallet-name-wrapper">
          <h2>Сrypto wallet</h2>
          <div class="wallet-name-inner-wrapper">
            <span class="wallet-name">Wallet name:</span>
            <span class="wallet-id">NONE</span>
          </div>
        </div>
        <table class="wallet-table">
          <tr class="rows-names">
            <th class="overall-balance">Overall balance</th>
            <th class="used-in-strategies">Used in strategies</th>
            <th class="available">Available</th>

          </tr>
          <tr class="one-currency">
            <td class="overall-balance-cell">
              <img src="assets/img/tether.svg" alt="" class="balance-icon"><?=$_SESSION['balance']?>
            </td>
            <td class="used-in-strategies-cell">
              <img src="assets/img/tether.svg" alt="" class="balance-icon">
              <?=$allAmount?>
            </td>
            <td class="available-cell">
              <img src="assets/img/tether.svg" alt="" class="balance-icon">
              <?=$_SESSION['balance'] - $allAmount - $reserveAmount?>

            </td>

          </tr>
          <td class="available-cell" style='margin-bottom:30px; display:block;'>
            <p style=' color: #606060;
                display: flex;
                align-items: center;
                gap: 32px;
                font-family: Source Code Pro;
                font-size: 12px;
                font-weight: 700;
                line-height: 140%;
                letter-spacing: 1px;
                text-transform: uppercase;
                text-align: left;
              margin-bottom: 20px;'>
              Res balance</p>
            <img src="assets/img/tether.svg" class="balance-icon" style='margin-right:20px'>
            <?php if(isset($_SESSION['amount'])):?>
            <span style='font-size:26px; font-weight:700'><?=$reserveAmount?></span>
            <?php endif;?>
            <?php if($_SESSION['amount'] == 0 ):?>
            <span style='font-size:26px; font-weight:700'>0
              <?php endif;?>
          </td>
          <!-- <tr class="one-currency">
            <td class="overall-balance-cell">
              <img src="assets/img/bitcoin.svg" alt="" />0
            </td>
            <td class="used-in-strategies-cell">
              <img src="assets/img/bitcoin.svg" alt="" />0
            </td>
            <td class="available-cell">
              <img src="assets/img/bitcoin.svg" alt="" />0
            </td>
          </tr>
          <tr class="one-currency">
            <td class="overall-balance-cell">
              <img src="assets/img/bitcoin.svg" alt="" />0
            </td>
            <td class="used-in-strategies-cell">
              <img src="assets/img/bitcoin.svg" alt="" />0
            </td>
            <td class="available-cell">
              <img src="assets/img/bitcoin.svg" alt="" />0
            </td>
          </tr> -->
        </table>
        <span class="wallet-action-title">Actions</span>
        <div class="actions-wrapper">
          <a href="deposit.php">Deposit<img src="../../assets/img/deposit.svg" alt="" /></a>
          <a href="withdraw.php">Withdraw<img src="../../assets/img/withdraw.svg" alt="" /></a>
        </div>
      </div>
      <?php require_once 'inc/lk/activity.php'; ?>
    </div>
  </div>
</section>
<?php require_once 'app/include/footer.php'; ?>