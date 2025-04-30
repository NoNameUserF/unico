<?php
include "app/database/db.php";

$users = selectAll('users');
$passports = selectAll('passports');
$strategys = selectAll('strategys');
$replenishment = selectAll('replenishment');
$messages = selectAll('messages');

// BALANCE
$allAmount = 0;
$newCount = 0;
$reserveAmount = 0;
$allStragysName = '';

foreach ($strategys as $value) {
    if ($_SESSION['id'] === $value['id_user']) {
        $allAmount += floatval($value['amount']); // Ensure it's a float
        $allStragysName .= htmlspecialchars($value['name'], ENT_QUOTES, 'UTF-8') . ', <br>';
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["button-topup"])) {
    $new = floatval($_POST['new']);
    $balance = floatval($_POST['balance']);
    $id = intval($_POST['id']);

    $newBalance = ['balance' => $new + $balance];

    $replenishment = [
        'id_user' => $id,
        'sum' => $new
    ];

    insert('replenishment', $replenishment);
    update('users', $id, $newBalance);

    $user = selectOne('users', ['id' => $_SESSION['id']]);
    $_SESSION['balance'] = floatval($user['balance']);

    header('Location: ak.php');
    exit;
}

// STRATEGIES
$nameStrategys = [
    'ETF Star' => 0,
    'Crypto 10' => 0,
    'Buy and Buy' => 0,
    'Crypto arbitrage +' => 0
];

foreach ($strategys as $strategy) {
    if ($strategy['id_user'] == $_SESSION['id']) {
        $nameStrategys[$strategy['name']] = true;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["acceptWithdraw"])) {
    $id = intval($_POST['id']);
    $where_wallet = htmlspecialchars($_POST['where_wallet'], ENT_QUOTES, 'UTF-8');
    $from_wallet = htmlspecialchars($_POST['from_wallet'], ENT_QUOTES, 'UTF-8');
    $amount = floatval($_POST['amount']);

    // Ensure balance is numeric
    $_SESSION['balance'] = floatval($_SESSION['balance']);

    if ($_SESSION['balance'] >= $amount) {
        $newBalance = $_SESSION['balance'] - $amount;

        $post = [
            'where_wallet' => $where_wallet,
            'from_wallet' => $from_wallet,
            'amount' => $amount,
            'balance' => $newBalance
        ];

        update('users', $id, $post);

        $user = selectOne('users', ['id' => $_SESSION['id']]);
        $_SESSION['balance'] = floatval($user['balance']);

        header('Location: withdraw-finish.php');
        exit;
    } else {
        $_SESSION['error'] = "Insufficient balance";
        header('Location: withdraw-crypto.php');
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["acceptWithdraw"])) {
    $id = intval($_POST['id']);
    $where_wallet = htmlspecialchars($_POST['where_wallet'], ENT_QUOTES, 'UTF-8');
    $from_wallet = htmlspecialchars($_POST['from_wallet'], ENT_QUOTES, 'UTF-8');
    $amount = floatval($_POST['amount']);

    // Ensure balance is numeric
    $_SESSION['balance'] = floatval($_SESSION['balance']);

    if ($_SESSION['balance'] >= $amount) {
        $newBalance = $_SESSION['balance'] - $amount;

        $post = [
            'where_wallet' => $where_wallet,
            'from_wallet' => $from_wallet,
            'amount' => $amount,
            'balance' => $newBalance
        ];

        update('users', $id, $post);

        $user = selectOne('users', ['id' => $_SESSION['id']]);
        $_SESSION['balance'] = floatval($user['balance']);

        header('Location: withdraw-finish.php');
        exit;
    } else {
        $_SESSION['error'] = "Insufficient balance";
        header('Location: withdraw-crypto.php');
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["button-yes"])) {
    $id = intval($_POST['id']);
    

    $newConf = [
        'verification' => 1,
    ];
    
    update('passports', $id, $newConf);   
}
?>