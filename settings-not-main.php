<?php 
include 'app/include/header.php'; 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['id'])) {
    header('Location: index.php');
    exit();
}

$verification = 0; 
$number = 'NONE';
include ('app/controllers/passport.php');

// Fetch all passports and check for user passport
$passports = selectAll('passports');

foreach ($passports as $passport) {
    if ($passport['id_user'] == $_SESSION['id']) {
        $number = $passport['number'];
        $verification = $passport['verification'] == 1 ? 1 : 0;
        break;
    }
}
?>

<section class="lk-user-main">
  <div class="container">
    <div class="left-col">
      <?php require_once 'inc/lk/left-menu.php'; ?>
      <div class="calendar-wrapper">
        <button id="btnPrev" type="button"><img src="assets/img/calendar-left.svg" alt="prev"></button>
        <button id="btnNext" type="button"><img src="assets/img/calendar-right.svg" alt="next"></button>
        <div id="divCal"></div>
      </div>
    </div>

    <div class="right-col">
      <div class="profile-settings">
        <div class="profile-name">
          <img src="./assets/img/user-info-avatar.png" alt="" class="profile-img">
          <div class="profile-name-outer-wrapper">
            <div class="profile-name-inner-wrapper">
              <div>
                <span><?= $_SESSION['first_name'] ?></span>
                <span><?= $_SESSION['second_name'] ?></span>
              </div>
              <a href="settings-main.php" class="profile-settings-link">Settings</a>
            </div>
            <div class="verification-wrapper">
              <span>Verification:</span>
              <img src="<?= $verification ? 'assets/img/check-circle.svg' : 'assets/img/wrong.svg' ?>" alt="">
              <img src="<?= $_SESSION['conf'] == 1 ? 'assets/img/check-circle.svg' : 'assets/img/wrong.svg' ?>" alt="">
            </div>
          </div>
        </div>
        <div class="profile-info">
          <img src="./assets/img/user-info-avatar-none.png" alt="" class="profile-img">
          <div class="profile-info-warpper">
            <div class="profile-info-inner-wrapper">
              <span>email:</span>
              <span><?= isset($_SESSION['email']) ? $_SESSION['email'] : 'Email not available' ?></span>
            </div>
          </div>
        </div>
      </div>

      <div class="crypto-wallet-short">
        <div class="wallet-name-wrapper">
          <h2>Сrypto wallet</h2>
          <div class="wallet-name-inner-wrapper">
            <span class="wallet-name">Wallet name:</span>
            <span class="wallet-id">NONE</span>
          </div>
        </div>
        <span class="curensly-balance">curensly balance</span>
        <div class="balance-wrapper">
          <div>
            <img src="assets/img/tether.svg" alt="" class="balance-icon">
            <span><?= $_SESSION['balance'] ?></span>
          </div>
          <div>
            <img src="./assets/img/bitcoin.svg" alt="">
            <span>0</span>
          </div>
          <div>
            <img src="assets/img/ethereum.svg" alt="" class="balance-icon">
            <span>0</span>
          </div>
        </div>
      </div>

      <div class="df document-outer-wrapper">
        <div class="document-wrapper">
          <img src="assets/img/passport.svg" alt="">
          <h3>Passport</h3>
          <span><?= $number ?></span>
        </div>

        <div class="document-wrapper">
          <img src="assets/img/contract.svg" alt="">
          <h3>Contract</h3>

          <button onclick="downloadFiles()">Download</button>
          <a download href="#">Download</a>

          <?php if ($_SESSION['conf'] == 0): ?>
          <form action="settings-not-main.php" method="post" style="display:flex; align-items:center; margin-top:30px">
            <input id="confirm" type="checkbox" style="width:20px" name="conf" value="1">
            <input type="hidden" name="id" value="<?= $_SESSION['id'] ?>">
            <label for="confirm" style="font-size:12px">I agree</label>
            <button name="cnf" style="margin-left:auto;" type="submit">Confirm</button>
          </form>
          <?php else: ?>
          <div style="margin-top:20px">
            <a style="color:tomato" href="lk-user.php">Go to personal account</a>
          </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</section>

<?php require_once 'app/include/footer.php'; ?>