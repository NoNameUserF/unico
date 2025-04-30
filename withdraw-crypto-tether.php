
<?php
require_once 'app/include/header.php';
include('app/controllers/admin.php');
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
                    <?php if (isset($_SESSION['wallet'])): ?>
                        <span id="cryptoId" class="crypto-id"><?= htmlspecialchars($_SESSION['wallet'], ENT_QUOTES, 'UTF-8') ?></span>
                    <?php else: ?>
                        <span id="cryptoId" class="crypto-id">pok8341dg200349</span>
                    <?php endif ?>
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
                        <span><b>Balance: </b><?= floatval($_SESSION['balance']) - floatval($allAmount) - floatval($reserveAmount) ?> ₮</span>
                    </div>
                    <div class="withdraw-bitcoin-comission">
                        <span><b>Сommission: </b>0.1%</span>
                    </div>
                </div>
                <form action="withdraw-crypto-tether.php" method="post" class="withdraw-bitcoin-where-from-form">
                    <label>
                        <span>From</span>
                        <input class='where' name="from_wallet" required placeholder="pok8341dg200349" type="text">
                    </label>
                    <label>
                        <span>Where</span>
                        <input class='from' name="where_wallet" required placeholder="pok8341dg200349" type="text">
                    </label>
                    <label>
                        <span>Amount</span>
                        <input class='amountValue' name="amount" required placeholder="0.00" type="number" step="0.01" min="0">
                    </label>
                    <button name="acceptWithdraw" class="purple-btn" style="color:white; border-radius:20px; padding:15px; width:200px;" type="submit">Accept</button>
                </form>
                <?php if (isset($_SESSION['error'])): ?>
                    <p style="color: red;"><?= htmlspecialchars($_SESSION['error'], ENT_QUOTES, 'UTF-8') ?></p>
                    <?php unset($_SESSION['error']); ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php require_once 'app/include/footer.php'; ?>

