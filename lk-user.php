<?php 
include 'app/include/header.php'; 
require_once 'app/controllers/passport.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Проверяем наличие сессии и ID пользователя
if (!isset($_SESSION['id'])) {
  header('location: index.php');
  exit();
}

if ($user['confirm_tel'] !== $user['admin_tel']) {
  header('location: ' . 'confirm.php' );
  exit();
}

// Получаем данные пользователя
$user = selectOne('users', ['id' => $_SESSION['id']]);

// Make sure that $_SESSION['balance'] is numeric
if (isset($_SESSION['balance'])) {
    $_SESSION['balance'] = (float)$_SESSION['balance'];  // Cast to float
}

// Make sure that $_SESSION['amount'] is numeric
if (isset($_SESSION['amount'])) {
    $_SESSION['amount'] = (float)$_SESSION['amount'];  // Cast to float
}

// Сообщения
$messages = selectAll('messages');

?>

<!-- Your HTML content here -->

<section class="lk-user-main">
  <div class="container">
    <div class="left-col">
      <?php include $_SERVER['DOCUMENT_ROOT'] . '/inc/lk/user-info.php'; ?>
      <?php include $_SERVER['DOCUMENT_ROOT'] . '/inc/lk/left-menu.php'; ?>
      <div class="calendar-wrapper">
        <button id="btnPrev" type="button"><img src="assets/img/calendar-left.svg" alt="prev"></button>
        <button id="btnNext" type="button"><img src="assets/img/calendar-right.svg" alt="next"></button>
        <div id="divCal"></div>
      </div>
    </div>

    <div class="right-col">
      <div class="earnings">
        <p style="text-align: center; color: tomato;"><?= htmlspecialchars($strategysMessage) ?></p>
        <img src="assets/img/lk-user-graph-1.png" alt="">
      </div>
    <div class="diver-graph-wrapper">
        <div class="diversification">
          <p style='text-align:center; color:tomato'><?=$strategysMessage ?></p>
          <h2>Diversification</h2>
          <div class="diversification-outer-wrapper">
            <div class="diversification-inner-wrapper cotango-wrapper">
              <span class="strategy-name">Contango</span>
              <div>
                <span class="strategy-percents">0 %</span>
                <span class="strategy-sum">0</span>
                <span class="strategy-currency">hc$</span>
              </div>
            </div>
            <div class="diversification-inner-wrapper etf-wrapper">
              <span class="strategy-name">ETF star</span>
              <div>
                <span class="strategy-percents">0 %</span>
                <span class="strategy-sum">0</span>
                <span class="strategy-currency">hc$</span>
              </div>
            </div>
            <div class="diversification-inner-wrapper crypto-10-wrapper">
              <span class="strategy-name">Crypto 10</span>
              <div>
                <span class="strategy-percents">0 %</span>
                <span class="strategy-sum">0</span>
                <span class="strategy-currency">hc$</span>
              </div>
            </div>
            <div class="diversification-inner-wrapper buy-n-buy-wrapper">
              <span class="strategy-name">Buy and buy</span>
              <div>
                <span class="strategy-percents">0 %</span>
                <span class="strategy-sum">0</span>
                <span class="strategy-currency">hc$</span>
              </div>
            </div>
            <div class="diversification-inner-wrapper crypto-arbit-wrapper">
              <span class="strategy-name">Crypto arbitrage +</span>
              <div>
                <span class="strategy-percents">0 %</span>
                <span class="strategy-sum">0</span>
                <span class="strategy-currency">hc$</span>
              </div>
            </div>
          </div>
        </div>
        <div class="diver-graph">
          <p style='text-align:center; color:tomato'><?=$strategysMessage ?></p>
          <img src="assets/img/lk-user-graph-2.png" alt="">
        </div>
      </div>
      <?php include $_SERVER['DOCUMENT_ROOT'] . '/inc/lk/activity.php'; ?>
    </div>
  </div>
</section>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/app/include/footer.php'; ?>
