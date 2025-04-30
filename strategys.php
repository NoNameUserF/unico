<?php 
include 'app/include/header.php'; 
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
      <?php include 'inc/lk/user-info.php'; ?>
      <?php include 'inc/lk/left-menu.php'; ?>
      <div class="calendar-wrapper">
        <button id="btnPrev" type="button"><img src="assets/img/calendar-left.svg" alt="prev"></button>
        <button id="btnNext" type="button"><img src="assets/img/calendar-right.svg" alt="next"></button>
        <div id="divCal"></div>
      </div>
    </div>
    <div class="right-col">
      <?php 
            for($i = 0; $i < count($strategys); $i++){
                if($strategys[$i]['id_user'] == $_SESSION['id']){
                    ?>
      <div class="strategy active-strategy">
        <div class="strategy-status-wrapper">
          <span class="strategy-status">Active strategy</span>
          <p style='color:tomato'>You can complete the strategy ahead of schedule only after
            <?=$minimumTerm[$strategys[$i]['name']]?></p>
          <div class="strategy-time-wrapper">
            <div class="strategy-time-inner-wrapper">
              <span><?=$strategys[$i]['created']?></span>
            </div>
          </div>
        </div>
        <h2><?=$strategys[$i]['name']?></h2>
        <div class="strategy-info-wrapper">
          <div class="strategy-info info-pre-seed">
            <span class="strategy-info-title">Pre-seed</span>
            <span class="strategy-info-value"><?=$strategys[$i]['amount'] . ' USDT'?></span>
          </div>
          <div class="strategy-info info-monthly-income">
            <span class="strategy-info-title">Monthly income</span>
            <span class="strategy-info-value">+0%</span>
            <span class="strategy-info-value-gray">+ 0 ₮</span>
          </div>
          <div class="strategy-info info-current-amount">
            <span class="strategy-info-title">Сurrent amount</span>
            <span class="strategy-info-value">+0 ₮</span>
          </div>
          <form method="post" action="strategys.php">
            <input name='id' type="hidden" value="<?=$strategys[$i]['id']?>">
            <input name='verification' type="hidden" value="<?=true?>">
            <button disabled type="submit" name="button-finish" class="strategy-btn finish-early btn-41">Finish
              early</button>
          </form>
        </div>
      </div>
      <?php
                }
            }
            ?>

      <?php 
                if(!$nameStrategys['ETF Star']){
                    ?>
      <div class="strategy not-active-strategy">
        <form action="strategys.php" method="post">
          <div class="strategy-status-wrapper">
            <span class="strategy-status">Not active strategy</span>
          </div>
          <h2>ETF Star</h2>
          <div class="slider-wrapper">
            <div>
              <div class="strategy-value">
                <span>
                  1Y
                </span>
                <span>
                  2Y
                </span>
                <span>
                  3Y
                </span>
              </div>
              <input class="strategy-range" type="range" name="date" min="1" max="3" value="1" step="1" />
            </div>
            <div>
              <input placeholder="₮ 0.00" required type="text" class="slider-input num-only" name="amount">
              <span class='errorBalance'><?=$errorBalance ?></span>
            </div>
          </div>
          <div class="strategy-info-wrapper">
            <div class="strategy-info info-minimum-capital">
              <span class="strategy-info-title">Minimum capital</span>
              <span class="strategy-info-value">25k USDT</span>
            </div>
            <div class="strategy-info info-minimum-term">
              <span class="strategy-info-title">Minimum term</span>
              <span class="strategy-info-value"><?=$minimumTerm['ETF Star'] ?></span>
            </div>
            <div class="strategy-info info-income-per-year">
              <span class="strategy-info-title">Income per year</span>
              <span class="strategy-info-value">10 %</span>
            </div>
            <input name='id_user' type="hidden" value=<?=$_SESSION['id']?>>
            <input name='name' type="hidden" value="ETF Star">
            <input name='income' type="hidden" value="10">

            <?php if(($_SESSION['conf'] == 0) || ($_SESSION['verification'] == 0)): ?>
            <div>
              <p style='color:red; font-size:18px;'>Confirm your consent!</p>
              <div style='margin-top:12px;'><a href="settings-not-main.php">Сonfirm</a></div>
            </div>
            <?php else : ?>
            <button name="button-strategys" class="strategy-btn use-now purple-btn">Use now</button>
            <?php endif?>

          </div>

        </form>
      </div>
      <?php
                }
            ?>
      <?php 
                if(!$nameStrategys['Crypto 10']){
                    ?>
      <div class="strategy not-active-strategy">
        <form action="strategys.php" method="post">
          <div class="strategy-status-wrapper">
            <span class="strategy-status">Not active strategy</span>
          </div>
          <h2>Crypto 10</h2>
          <div class="slider-wrapper">
            <div>
              <div class="strategy-value">
                <span>
                  3M
                </span>
                <span>
                  6M
                </span>
                <span>
                  12M
                </span>
              </div>
              <input class="strategy-range" type="range" name="date" min="1" max="3" value="1" step="1" />
            </div>
            <div>
              <input placeholder="₮ 0.00" required type="text" class="slider-input num-only" name="amount">
              <span class='errorBalance'><?=$errorBalance ?></span>
            </div>
          </div>
          <div class="strategy-info-wrapper">
            <div class="strategy-info info-minimum-capital">
              <span class="strategy-info-title">Minimum capital</span>
              <span class="strategy-info-value">25k USDT</span>
            </div>
            <div class="strategy-info info-minimum-term">
              <span class="strategy-info-title">Minimum term</span>
              <span class="strategy-info-value"><?=$minimumTerm['Crypto 10'] ?></span>
            </div>
            <div class="strategy-info info-income-per-year">
              <span class="strategy-info-title">Income per year</span>
              <span class="strategy-info-value">25 %</span>
            </div>
            <input name='id_user' type="hidden" value=<?=$_SESSION['id']?>>
            <input name='name' type="hidden" value="Crypto 10">
            <input name='income' type="hidden" value="34">
            <?php if(($_SESSION['conf'] == 0) || $_SESSION['verification'] == 0): ?>
            <div>
              <p style='color:red; font-size:18px;'>Confirm your consent!</p>
              <div style='margin-top:12px;'><a href="settings-not-main.php">Сonfirm</a></div>
            </div>
            <?php else : ?>
            <button name="button-strategys" class="strategy-btn use-now purple-btn">Use now</button>
            <?php endif?>
          </div>

        </form>
      </div>
      <?php
                }
            ?>
      <?php 
                if(!$nameStrategys['Buy and Buy']){
                    ?>
      <div class="strategy not-active-strategy">
        <form action="strategys.php" method="post">
          <div class="strategy-status-wrapper">
            <span class="strategy-status">Not active strategy</span>
          </div>
          <h2>Buy and Buy</h2>
          <div class="slider-wrapper">
            <div>
              <div class="strategy-value">
                <span>
                  6M
                </span>
                <span>
                  12M
                </span>
                <span>
                  18M
                </span>
              </div>
              <input class="strategy-range" type="range" name="date" min="1" max="3" value="1" step="1" />
            </div>
            <div>
              <input required placeholder="₮ 0.00" type="text" class="slider-input num-only" name="amount">
              <span class='errorBalance'><?=$errorBalance ?></span>
            </div>
          </div>
          <div class="strategy-info-wrapper">
            <div class="strategy-info info-minimum-capital">
              <span class="strategy-info-title">Minimum capital</span>
              <span class="strategy-info-value">25k USDT</span>
            </div>
            <div class="strategy-info info-minimum-term">
              <span class="strategy-info-title">Minimum term</span>
              <span class="strategy-info-value"><?=$minimumTerm['Buy and Buy']?></span>
            </div>
            <div class="strategy-info info-income-per-year">
              <span class="strategy-info-title">Income per year</span>
              <span class="strategy-info-value">19 %</span>
            </div>
            <input name='id_user' type="hidden" value=<?=$_SESSION['id']?>>
            <input name='name' type="hidden" value="Buy and Buy">
            <input name='income' type="hidden" value="10">
            <?php if(($_SESSION['conf'] == 0) || $_SESSION['verification'] == 0): ?>
            <div>
              <p style='color:red; font-size:18px;'>Confirm your consent!</p>
              <div style='margin-top:12px;'><a href="settings-not-main.php">Сonfirm</a></div>
            </div>
            <?php else : ?>
            <button name="button-strategys" class="strategy-btn use-now purple-btn">Use now</button>
            <?php endif?>
          </div>

        </form>
      </div>
      <?php
                }
            ?>
      <?php 
                if(!$nameStrategys['Crypto arbitrage +']){
                    ?>
      <div class="strategy not-active-strategy">
        <form action="strategys.php" method="post">
          <div class="strategy-status-wrapper">
            <span class="strategy-status">Not active strategy</span>
          </div>
          <h2>Crypto arbitrage +</h2>
          <div class="slider-wrapper">
            <div>
              <div class="strategy-value">
                <span>
                  3M
                </span>
                <span>
                  6M
                </span>
                <span>
                  12M
                </span>
              </div>
              <input class="strategy-range" type="range" name="date" min="1" max="3" value="1" step="1" />
            </div>
            <div>
              <input required placeholder="₮ 0.00" type="text" class="slider-input num-only" name="amount">
              <span class='errorBalance'><?=$errorBalance ?></span>
            </div>
          </div>
          <div class="strategy-info-wrapper">
            <div class="strategy-info info-minimum-capital">
              <span class="strategy-info-title">Minimum capital</span>
              <span class="strategy-info-value">25k USDT</span>
            </div>
            <div class="strategy-info info-minimum-term">
              <span class="strategy-info-title">Minimum term</span>
              <span class="strategy-info-value"><?=$minimumTerm['Crypto arbitrage +']?></span>
            </div>
            <div class="strategy-info info-income-per-year">
              <span class="strategy-info-title">Income per month</span>
              <span class="strategy-info-value">3 %</span>
            </div>
            <input name='id_user' type="hidden" value=<?=$_SESSION['id']?>>
            <input name='name' type="hidden" value="Crypto arbitrage +">
            <input name='income' type="hidden" value="10">
            <?php if(($_SESSION['conf'] == 0) || $_SESSION['verification'] == 0): ?>
            <div>
              <p style='color:red; font-size:18px;'>Confirm your consent!</p>
              <div style='margin-top:12px;'><a href="settings-not-main.php">Сonfirm</a></div>
            </div>
            <?php else : ?>
            <button name="button-strategys" class="strategy-btn use-now purple-btn">Use now</button>
            <?php endif?>
          </div>

        </form>
      </div>
      <?php
                }
            ?>
    </div>

  </div>
</section>
<?php include 'app/include/footer.php'; ?>
