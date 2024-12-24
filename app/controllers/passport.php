<?php
include "app/database/db.php";

$passports = selectAll('passports');
$loading = 0;

session_start();
$strategysMessage = '';
$activityMessage = '';
$messages = selectAll('messages');
$strategys = selectAll('strategys');

$users = selectAll('users');
$user = selectOne('users', ['id' => $_SESSION['id']] );
// if(count($strategys) > 0) { 
//     $strategysMessage = 'Графики обнованятся через некоторое время';
// }else { 
//     $strategysMessage ='';
// }

$allStragysName = '';

$allAmount = 0;

foreach($strategys as $key => $value) {
    if($_SESSION['id'] === $value['id_user']){
        $allAmount+=$value['amount'];
        $allStragysName .= $value['name']  . ', ' . '<br>' ;
            $strategysMessage = 'The charts will be updated in 29 days';
            $activityMessage = 'The data will be updated in 29 days';
    }
};

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["button-download"])){


    $fileName = $_FILES['file']['name'];
    $fileSize = $_FILES['file']['size'];
    $fileTmpName = $_FILES['file']['tmp_name'];

    $id = $_SESSION['id'];
    $first_name = $_POST['first_name'];
    $second_name = $_POST['second_name'];
    $number = $_POST['number'];
    

    $post = [
        'id_user' => $id,
        'first_name' => $first_name,
        'second_name' => $second_name,
        'filename' => $fileName,
        'number' => $number,
    ];


    $upload_dir = "/";
    $rm = dirname(__DIR__  , 2) . './upload';
        
    if (move_uploaded_file($_FILES['file']['tmp_name'], $rm . $upload_dir . $fileName )) {
        insert('passports', $post);    

        $_SESSION['verification'] = 0;
         header('location: ' . 'settings-main.php')   ;
        
    } else {
        echo "";
    }
}
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["cnf"])){
    
    $conf =1;
    $id = $_POST['id'];  
    $post = [
        'conf' =>$conf 
    ];
    
    update('users', $id ,$post);
    $user = selectOne('users', ['id' => $id] );
    $_SESSION['conf'] = $user['conf'];
    
    
}


if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["button-message"])){

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
    header('Location: lk-user.php');
    
}
?>