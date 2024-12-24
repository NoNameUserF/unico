<?php 
session_start();
unset($_SESSION['id']);
unset($_SESSION['admin']);
unset($_SESSION['first_name']);
unset($_SESSION['second_name']);




header('location: ' .  'index.php');

?>