<?php 
require_once "app/controllers/admin.php";


require_once "app/include/header.php"; 

if (session_status() == PHP_SESSION_NONE) {
    session_start();  // Запускаем сессию только если она еще не была начата
}
if (!$_SESSION['admin']) {
    header('Location: index.php');
    exit();
}
$allAmount = 0;
$count = 1;

?>

<section class="ak-section">
  <div class="container">
    <h1>Кабинет администратора</h1>
    <div class="inf-outer-wrapper">
      <div class="left-inf-wrapper">
        <span>Количество клиентов: <?=count($users)?></span>
        <span>Количество активных клиентов: 0</span>
      </div>
      <div class="right-inf-wrapper">
        <span>Количество заявок на вывод: 0</span>
        <span>Общая сумма вывода: 0 U$DT</span>
      </div>
    </div>

    <?php foreach($users as $key => $user):
        $count = 1;
        $allAmount = 0;
        foreach($strategys as $key => $value) {
            if($user['id'] === $value['id_user']){
                $allAmount+=$value['amount'];
                $allStragysName .= $value['name']  . ', ' . '<br>' ;
            }
        };
        
        
    ?>
    <div class="ak-user">
      <div class="ak-user-header">
        <div class="ak-user-name-wrapper">
          <span class="ak-user-name"><?=$user['first_name'] . ' ' .$user['second_name']?></span>
          <button class="ak-user-btn"><img src="assets/img/ak-arrow-down.svg" alt=""></button>
        </div>

        <div class="ak-wallet-number-wrapper">
          <form action="ak.php" method='post'>
            <span class="ak-wallet-number-wrapper-text">User Wallet</span>
            <input name=' id' type="hidden" value=<?=$user['id']?>>
            <input class="ak-wallet-number-input" name='wal' type="text" value=<?=$user['wallet']?>>
            <span style='margin-left:30px' class="ak-wallet-number-wrapper-text">Corp Wallet</span>
            <input name=' id' type="hidden" value=<?=$user['id']?>>
            <input class="ak-wallet-number-input" name='corp_wal' type="text" value=<?=$user['corp_wallet']?>>
            <button class="ak-wallet-number-save-btn btn-41" type="submit" name="buttonUp">SAVE</button>
          </form>

        </div>

        <img style='display : block' class="chat-img-adm" src="./assets/img/chat.svg"></img>
        <?php
          $notification = false;
          for($i = 0; $i < count($messages); $i++){
                if($messages[$i]['fromwhom'] == $user['id'] && $messages[$i]['whom'] == 0 ):
                $notification = true;
                endif;
          }
          ?>

        <?php if($notification):?>
        <div class='chat_info' style='position: relative; top:-14px ; left:-48px;'>
          <img style=' width : 20px; height : 20px;' src="./assets/img/exclamation-solid.svg" alt="">
        </div>
        <?php endif?>


      </div>
      <div class="chat_modal" style="position : fixed; top : 15% ; left:-0%">
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
                if($messages[$i]['fromwhom'] == $user['id'] && $messages[$i]['whom'] == 0 || $messages[$i]['fromwhom'] == 0 && $messages[$i]['whom'] == $user['id']):
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
              <input name='fromwhom' type="hidden" value="<?=0?>">
              <input name='whom' type="hidden" value="<?=$user['id']?>">
              <button class="button_chat" type="submit" name="button-message-admin">SEND</button>
            </form>
          </div>
        </div>
      </div>
      <div class="ak-user-inner">
        <div class="ak-user-row">
          <span class="ak-user-row-title">Пополнить баланс пользователю</span>
          <form action="ak.php" class="ak-wallet-number-form" method="post">
            <input name=' id' type="hidden" value=<?=$user['id']?>>
            <input class="ak-wallet-number-input" name='new' type="text"
              style='border: 1px solid black; margin-right:100px' placeholder='Enter the amount'>
            <input name='balance' type="hidden" value=<?=$user['balance']?>>
            <button class="ak-wallet-number-save-btn btn-41" type="submit" name="button-topup">Add
              Balance</button>
          </form>
        </div>
        <div class="ak-user-row">
          <span class="ak-user-row-title">Баланс</span>
          <div class="ak-user-sum-vacant-wrapper">
            <span class="ak-user-sum-vacant-title">Общий</span>
            <span class="ak-user-sum-vacant"><?= $user['balance']?> U$DT</span>
          </div>
          <div class="ak-user-sum-vacant-wrapper">
            <span class="ak-user-sum-vacant-title">Свободный</span>
            <span class="ak-user-sum-vacant"><?= $user['balance'] -$allAmount?> U$DT</span>
          </div>
          <div class="ak-user-sum-used-wrapper">
            <span class="ak-user-sum-used-title">Используемый</span>
            <span class="ak-user-sum-used"><?=$allAmount ?> U$DT</span>
          </div>
        </div>

        <?php foreach($replenishment as $key => $value):
        if($value['id_user'] === $user['id']){
        ?>
        <div class="ak-user-row">
          <span class="ak-user-row-title">Пополнение</span>
          <span class="ak-user-deposit-date"><?=$value['created']?></span>
          <span class="ak-user-deposit-sum"><?=$value['sum'] . ' U$DT'?></span>
        </div>

        <?php 
        }
        endforeach?>
        <div class="ak-user-row">
          <span class="ak-user-row-title">Дата регистрации</span>
          <span class="ak-user-registration-date"><?=$user['created']?></span>
        </div>
        <?php
            $view = 1;
            
            for($i = 0; $i < count($passports); $i++){
                if($passports[$i]['id_user'] == $user['id']){
                    $view = 0;
                    break;
                }
            }
            if($view){?>
        <div class="ak-user-row">
          <span class="ak-user-row-title">Паспорт</span>
          <span class="ak-user-passport-num">-</span>
          <span class="ak-user-passport-location">-</span>
        </div>
        <?php
            } else {
                for($i = 0; $i < count($passports); $i++){
                    if($passports[$i]['id_user'] == $user['id']){
                        ?>
        <div class="ak-user-row">
          <span class="ak-user-row-title">Паспорт</span>
          <span class="ak-user-passport-num"><?=$passports[$i]['number']?></span>
          <span class="ak-user-passport-location">УФМС РОССИИ</span>
          <a download href="<?='./upload/' . $passports[$i]['filename']?>"
            class="ak-user-passport-download">PASSPORT</a>
          <?php if(!$passports[$i]['verification']){
                                        ?>
          <form action="ak.php" method='post'>
            <input name='id' type="hidden" value="<?=$passports[$i]['id']?>">
            <button name='button-yes' style='padding:5px; border:1px solid green; color:green'>Confirm</button>
          </form>
          <form action="ak.php" method='post'>
            <input name='id' type="hidden" value="<?=$passports[$i]['id']?>">
            <button name='button-no' style='padding:5px; border:1px solid red; color:red'>Reject</button>
          </form>
          <?php
                                    } else {
                                        echo 'ПОЛЬЗОВАТЕЛЬ ПОДТВЕРЖДЕН';
                                    }
                                    ?>
        </div>
        <?php
                                break;
                            } 
                        ?>

        <?php }
                    }
                     ?>
        <?php foreach($strategys as $key => $value):
        if($value['id_user'] === $user['id']){
        ?>
        <div class="ak-user-row ak-user-row-strategy">
          <div class="ak-user-row-strategy-wrapper-1">
            <span class="ak-user-row-title">Стратегия <?=$count ?></span>
            <span class="ak-user-strategy-name"><?=$value['created'] ?></span>
            <span class="ak-user-strategy-name"><?=$value['name'] ?></span>
          </div>
          <div class="ak-user-row-strategy-wrapper-2">

            <span class="ak-user-strategy-sum"><?=$value['amount'] . ' ' . 'USDT' ?></span>
          </div>
          <div class="ak-user-row-strategy-wrapper-3">
            <!-- <span class="ak-user-strategy-income">+ 234 USDT</span> -->
            <button class="ak-user-row-btn">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none">
                <path
                  d="M15.2322 5.73223L18.7677 9.26777M16.7322 4.23223C17.7085 3.25592 19.2914 3.25592 20.2677 4.23223C21.244 5.20854 21.244 6.79146 20.2677 7.76777L6.5 21.5355H3V17.9644L16.7322 4.23223Z"
                  stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
              </svg>
            </button>
          </div>
        </div>

        <?php 
        $count++;
        }
        endforeach?>
        <div class="ak-user-row">
          <span class="ak-user-row-title">Вывод средств</span>
          <div class="ak-user-sum-vacant-wrapper">
            <span class="ak-user-sum-vacant-title">Откуда: </span>
            <?php if(isset($user['where_wallet'])):?>
            <span id="cryptoId" class="crypto-id"><?=$user['where_wallet']?></span>
            <?php endif?>
            <?php if(!isset($user['where_wallet'])):?>
            <span id="cryptoId" class="crypto-id">-</span>
            <?php endif?>
          </div>
          <div class="ak-user-sum-vacant-wrapper">
            <span class="ak-user-sum-vacant-title">Куда: </span>
            <?php if(isset($user['from_wallet'])):?>
            <span id="cryptoId" class="crypto-id"><?=$user['from_wallet']?></span>
            <?php endif?>
            <?php if(!isset($user['from_wallet'])):?>
            <span id="cryptoId" class="crypto-id">-</span>
            <?php endif?></span>
          </div>
          <div class="ak-user-sum-used-wrapper">
            <span class="ak-user-sum-used-title">Сумма:</span>
            <?php if(isset($user['amount'])):?>
            <span id="cryptoId" class="crypto-id"><?=$user['amount']?></span>
            <?php endif?>
            <?php if(!isset($user['amount'])):?>
            <span id="cryptoId" class="crypto-id">0</span>
            <?php endif?>
          </div>
        </div>
        <div class="ak-user-row">
          <span class="ak-user-row-title">Отправка СМС пользователю</span>
          <div class="ak-user-sum-vacant-wrapper">
            <form action="ak.php" method='post'>
              <input type="text" name='set_tel' id='set_tel' class='set-tel' placeholder='Отправить смс пользователю'>
              <input name='id' type="hidden" value=<?=$user['id']?>>
              <button class="ak-wallet-number-save-btn btn-41" type="submit" name="button-add-tel">Добавить Номер
                Телефона</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
</section>
<?php require_once 'app/include/footer.php'; ?>