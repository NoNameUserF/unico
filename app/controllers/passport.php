<?php

// Start the session if it's not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();  // Start session if not already started
}

require_once "app/database/db.php";
$passports = selectAll('passports');

$strategysMessage = '';
$activityMessage = '';
$allStragysName = '';
$allAmount = 0;
$loading = 0;
// Ensure that the functions are only declared once



if (!function_exists('uploadPassport')) {
    function uploadPassport() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["button-download"])) {
            $fileName = $_FILES['file']['name'];
            $fileSize = $_FILES['file']['size'];
            $fileTmpName = $_FILES['file']['tmp_name'];

            // File upload restrictions
            $allowedTypes = ['image/jpeg', 'image/png', 'application/pdf']; // MIME types
            $maxFileSize = 5 * 1024 * 1024; // Maximum 5MB

            if (in_array($_FILES['file']['type'], $allowedTypes) && $fileSize <= $maxFileSize) {
                $id = $_SESSION['id'];
                $first_name = $_POST['first_name'];
                $second_name = $_POST['second_name'];
                $number = $_POST['number'];

                // Generate a unique file name
                $uniqueFileName = uniqid() . '-' . $fileName;

                $post = [
                    'id_user' => $id,
                    'first_name' => $first_name,
                    'second_name' => $second_name,
                    'filename' => $uniqueFileName,
                    'number' => $number,
                ];

                $upload_dir = "/";
                 $rm = dirname(__DIR__, 2) . '/upload'; // Path to the upload directory

                // Move the uploaded file
                if (move_uploaded_file($_FILES['file']['tmp_name'], $rm . $upload_dir . $uniqueFileName)) {
                    insert('passports', $post); // Insert the record into the database
                    $_SESSION['verification'] = 0;
                    header('Location: settings-main.php');
                    exit();
                } else {
                    echo "Error uploading the file";
                }
            } else {
                echo "Invalid file type or the file is too large";
            }
        }
    }
}

if (!function_exists('updateUser')) {
    function updateUser($id, $status) {
        $post = ['conf' => $status];
        update('users', $id, $post);
        $_SESSION['conf'] = $status;
    }
}

if (!function_exists('sendMessage')) {
    function sendMessage() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["button-message"])) {
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
            exit();
        }
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

// Function calls for handling requests
uploadPassport();
sendMessage();

// Additional session management and database fetch for user data
if (!isset($_SESSION['id'])) {
    header('Location: login.php');
    exit();
}

// Get user data from the database
$user = selectOne('users', ['id' => $_SESSION['id']]);
$strategys = selectAll('strategys');
$messages = selectAll('messages');

// Message handling based on strategies
foreach ($strategys as $key => $value) {
    if ($_SESSION['id'] === $value['id_user']) {
        $allAmount += $value['amount'];
        $allStragysName .= $value['name'] . ', ' . '<br>';
        $strategysMessage = 'The charts will be updated in 29 days';
        $activityMessage = 'The data will be updated in 29 days';
    }
}

?>