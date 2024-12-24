<?php 
include 'app/include/header.php'; 
include ('app/controllers/passport.php');

session_start();


if (!isset($_SESSION['id'])) {
  header('location: ' . 'index.php' );
    exit();
}
if ($user['confirm_tel'] !== $user['admin_tel']) {
  header('location: ' . 'confirm.php' );
    exit();
}

?>


<section class="chat_modal">
  <p style='display : none' class='open_id'>0</p>
  <div class="chat_container">
    <div style='display : flex; align-items:center; justify-content:space-between'>
      <h5 style='color:"black"'>User Chat</h5>
      <div class="chat_close">X</div>
    </div>
    <div class="chat_overfloww">

      <ul class="chat_overflow">
        <?php 
          for($i = 0; $i < count($messages); $i++){
            if($messages[$i]['fromwhom'] == 0 && $messages[$i]['whom'] == $_SESSION['id'] || $messages[$i]['fromwhom'] == $_SESSION['id'] && $messages[$i]['whom'] == 0):
        ?>
        <li>
          <span>Имя пользователя: <?=$messages[$i]['first_name']?></span>
          <br>
          <b>Сообщение: <?=$messages[$i]['message']?></b>
        </li>
        <?php
        endif?>
        <?php  }
        ?>
      </ul>
      <form action="" method="post" class="form_chat">
        <input class="message" placeholder="Введите сообщение" name="message">
        <input name='first_name' type="hidden" value="<?=$_SESSION['first_name']?>">
        <input name='second_name' type="hidden" value="<?=$_SESSION['second_name']?>">
        <input name='fromwhom' type="hidden" value="<?=$_SESSION['id']?>">
        <input name='whom' type="hidden" value="<?=0?>">
        <button class="button_chat" type="submit" name="button-message">SEND</button>
      </form>
    </div>
  </div>
</section>


<section class="lk-user-main">
  <div class="container">

    <div class="left-col">
      <?php include 'inc/lk/user-info.php'; ?>
      <?php include 'inc/lk/left-menu.php'; ?>
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
      <div class="earnings">
        <p style='text-align:center; color:tomato'><?=$strategysMessage ?></p>
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

      <?php include 'inc/lk/activity.php'; ?>

    </div>
  </div>
</section>
<?php if(!$_SESSION['admin'] == 1):?>
<section class="chat">
  <div class='chat_relative'>
    <?php if($messages):?>
    <div class='chat_info'>
      <img style='width : 20px; height : 20px;' src="./assets/img/exclamation-solid.svg" alt="">
    </div>
    <?php endif?>
    <div class="chat_containe">
      <img class="chat_img" src="./assets/img/chat.svg"></img>
    </div>
  </div>
</section>
<?php endif?>

<?php include 'app/include/footer.php'; ?>