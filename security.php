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
      <!-- <div class="widgets">
                    <span>место для виджетов</span>
                </div> -->
      <div class="security">
        <h1>Security</h1>
        <div class="two-factor-info">
          <h2>Тwo-factor authentication</h2>
          <p>
            Two-factor authentication is a security method that requires two different ways of confirming a user's
            identity
            before allowing access to a system. This may involve entering a password and sending a confirmation code to
            a
            pre-registered phone or email address.
          </p>
        </div>
        <div class="df">
          <div class="google-auth">
            <h2>authentication</h2>
            <p>
              "When this option is enabled, you can log in to your account using your email address. Each time you sign
              in, a unique one-time code will be
              sent directly to your inbox. By entering this code, you confirm your identity and gain secure access to
              your personal account. This method is
              simple and convenient, as it removes the need to remember a password. You may also enable SMS
              authentication to add an extra layer of
              protection, or use email as your primary login method."
            </p>
            <div class="switch-btn switch-on"></div>
          </div>
          <div class="sms-auth">
            <h2>SMS</h2>
            <p style="color : red;">
              This authentication method will be available in 30 days
            </p>
            <div class="switch-btn"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php require_once 'app/include/footer.php'; ?>