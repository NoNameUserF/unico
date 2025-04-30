<?php 
require_once 'app/include/header.php';
require_once "app/controllers/buy-strategy.php";

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['id'])) {
    header('Location: index.php');
    exit();
}

// Ensure that allAmount is properly cast to a float or integer
$allAmount = $allAmount;  // Ensure it's a float
// Ensure balance is treated as a float as well
$balance = $_SESSION['balance']; 
// Ensure reserveAmount is treated as an integer
$reserveAmount = $_SESSION['amount']; 

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
              <img src="assets/img/tether.svg" alt="" class="balance-icon"><?= $_SESSION['balance'] ?>
            </td>
            <td class="used-in-strategies-cell">
              <img src="assets/img/tether.svg" alt="" class="balance-icon">
              <?= $allAmount ?>
            </td>
            <td class="available-cell">
              <img src="assets/img/tether.svg" alt="" class="balance-icon">
<span><?= (int)$_SESSION['balance'] - (int)$allAmount - (int)$reserveAmount ?><b></b></span>            </td>
          </tr>
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

