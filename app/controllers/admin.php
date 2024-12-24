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

$reserveAmount = 0 ;
$allStragysName = '';

foreach($strategys as $key => $value) {
    if($_SESSION['id'] === $value['id_user']){
        $allAmount+=$value['amount'];
        $allStragysName .= $value['name']  . ', ' . '<br>' ;
    }
};

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["button-topup"])){
    $new = $_POST['new'];
    $balance = $_POST['balance'];
    $id = $_POST['id'];
    $newCount = $newCount + 1;
    $newBalance = [
        'balance' => $new + $balance,
    ];

    $replenishment = [
        'id_user' => $id,
        'sum' => $new
    ];
    
    insert('replenishment', $replenishment);

    update('users', $id, $newBalance);
    $user = selectOne('users', ['id' => $_SESSION['id']] );
    
    $_SESSION['balance'] = $user['balance'];
    header('Location: ak.php');
    
}

// STRATEGYS

$strategys = selectAll('strategys');

$nameStrategys = [
    'ETF Star' => 0,
    'Crypto 10' => 0,
    'Buy and Buy' => 0,
    'Crypto arbitrage +' => 0
];

for ($i = 0; $i < count($strategys); $i++) {
    if($strategys[$i]['id_user'] == $_SESSION['id']){
        $nameStrategys[$strategys[$i]['name']] = true;
    }
}

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["button-strategys"])){

    $id_user = $_POST['id_user'];
    $income = $_POST['income'];
    $amount = $_POST['amount'];
    $date = $_POST['date'];
    $name = $_POST['name'];

    $post = [
        'id_user' => $id_user,
        'income' => $income,
        'amount' => $amount,
        'date' => $date,
        'name' => $name
    ];

    
    insert('strategys', $post);

    header('Location: strategys.php');
}

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["button-yes"])){

    $id = $_POST['id'];
    $verification = $_POST['verification'];
    $post = [
        'verification' => 1,
    ];

    update('passports', $id, $post);

    header('Location: ak.php');
    
}

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["button-no"])){

    $id = $_POST['id'];

    delete('passports', $id);

    header('Location: ak.php');
    
}

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["buttonUp"])){

    $id = $_POST['id'];
    $wallet = $_POST['wal'];
    $corp_wal=  $_POST['corp_wal'];
    
    $post = [
        'wallet' => $wallet,
        'corp_wallet' => $corp_wal
    ];

    update('users', $id, $post);

    $user = selectOne('users', ['id' => $_SESSION['id']] );
    
    $_SESSION['wallet'] = $user['wallet'];
    $_SESSION['corp_wallet'] = $user['corp_wallet'];
    header('Location: ak.php');
    
}
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["acceptWithdraw"])){

    $id = $_POST['id'];
    $where_wallet = $_POST['where_wallet'];
    $from_wallet = $_POST['from_wallet'];
    $amount = $_POST['amount'];

    
    $post = [ 
        'where_wallet' => $where_wallet,
        'from_wallet' => $from_wallet,
        'amount' => $amount,
        'balance' => $_SESSION['balance'] - $amount
    ];

    update('users', $id, $post);
    $user = selectOne('users', ['id' => $_SESSION['id']] );
    
    $_SESSION['amount'] = $user['amount'];
    header('Location: withdraw-finish.php');

    
}

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["button-add-tel"])){

    $tel = $_POST['set_tel'];
    $id = $_POST['id'];

    
    $post = [ 
        'admin_tel' => $tel,
    ];

    update('users', $id, $post);
    $user = selectOne('users', ['id' => $_SESSION['id']] );   
    
}

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["button-message-admin"])){

    $second_name = $_POST['second_name'];
    $first_name = $_POST['first_name'];
    $message = $_POST['message'];
    $whom = $_POST['whom'];
    $fromwhom = $_POST['fromwhom'];

    $post = [
        'first_name' => $first_name,
        'second_name' => $second_name,
        'message' => $message,
        'whom' => $whom,
        'fromwhom' => $fromwhom
    ];
    insert('messages', $post);
    header('Location: ak.php');
    
}
?>