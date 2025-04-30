<?php 
    
    
    
    $verification = 0; 
$buyStrategyPath = realpath(__DIR__ . '/../../app/controllers/buy-strategy.php');

if ($buyStrategyPath && file_exists($buyStrategyPath)) {
    include($buyStrategyPath);
} else {
    echo 'Файл buy-strategy.php не найден.';
}
    $reserveAmount = substr($_SESSION['amount'], 0, -3)  ;
?>
<div class="user-info">
  <div class="user-info-status">
    <img src="assets/img/user-info-avatar.png" alt="user" class="user-info-avatar">
    <div class="user-info-inner-wrapper">
      <div class="user-info-name">
        <span><?= $_SESSION['first_name'] ?></span>
        <span><?= $_SESSION['second_name'] ?></span>
      </div>
      <div class="verification-wrapper">
        <span>Verification:</span>
        <?php foreach($passports as $key => $passport):
                if($passport['id_user'] == $_SESSION['id']) { 
                    if($passport['verification'] == 1) { 

                        $verification = 1;
                        break;
                    }else {
                        $verification = 0;
                        break;
                    }
        }else {
            $verification = 0;
        }

        ?>

        <?php endforeach; ?>
        <?php if($verification == 1){
            ?><img src="assets/img/check-circle.svg" alt=""> <?php
        }else{
            ?><img src="assets/img/wrong.svg" alt=""> <?php
        }?>
        <?php if($_SESSION['conf'] == 1){
            ?><img src="assets/img/check-circle.svg" alt=""> <?php
        }else{
            ?><img src="assets/img/wrong.svg" alt=""> <?php
        }?>
      </div>
      <div class="strategy-wrapper">
        <span class='s_name'>Strategy:<?=$allStragysName?></span>
        <!-- <span>cotango+</span> -->
      </div>
    </div>
    <a href="settings-not-main.php" class="settings-link">
      <img src="assets/img/cog.svg" alt="" class="user-info-cog">
    </a>
  </div>
  <div class="user-info-balance">
    <h3>balance</h3>
    <div class="balance-wrapper">
      <div class="balance">
        <img src="assets/img/tether.svg" alt="" class="balance-icon">

<span><?= (int)$_SESSION['balance'] - (int)$allAmount - (int)$reserveAmount ?><b></b></span>

      </div>
      <div class="balance">
        <img src="assets/img/bitcoin.svg" alt="" class="balance-icon">
        <span>0<b></b></span>
      </div>
      <div class="balance">
        <img src="assets/img/ethereum.svg" alt="" class="balance-icon">
        <span>0<b></b></span>
      </div>
    </div>
  </div>
</div>
