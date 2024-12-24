<?php 
include "app/database/db.php";

$strategys = selectAll('strategys');
$passports = selectAll('passports');

$allAmount = 0;
$allStragysName = '';
$activityMessage = '';
$passport = selectOne('passports' , ['id_user' => $_SESSION['id']]); 

if($passport['verification']){
  $_SESSION['verification'] = $passport['verification'];
} else {
  $_SESSION['verification'] = 0;
}


foreach($strategys as $key => $value) {
    if($_SESSION['id'] === $value['id_user']){
        $allAmount+=$value['amount'];
        $allStragysName .= $value['name']  . ', ' . '<br>' ;
        $activityMessage = 'The data will be updated in 29 days';
    }
};

$minimumTerm = [
    'ETF Star' => '1 year',
    'Crypto 10' => '3 month',
    'Buy and Buy' => '6 month',
    'Crypto arbitrage +' => '3 month'
];

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
$errorBalance = '';

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["button-strategys"])){

    
    $id_user = $_POST['id_user'];
    $income = $_POST['income'];
    $amount = $_POST['amount'];
    $date = $_POST['date'];
    $name = $_POST['name'];

    if($amount > $_SESSION['balance'] - $allAmount ){
        $errorBalance = 'Insufficient funds';
        
    }else{
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

 
}

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["button-finish"])){

    $id = $_POST['id'];

    delete('strategys', $id);

    header('Location: strategys.php');
}





?>