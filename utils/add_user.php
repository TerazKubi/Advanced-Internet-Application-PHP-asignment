<?php 
require_once("../functions.php");

if(!isset($_POST['userName'])) {
    header("Location: ../index.php");
    die();
}

session_start();

$user_res = validate_user($_POST['userName']);


$_SESSION['user_form_valid'] = true;
if(!$user_res['status']){
    $_SESSION['user_form_valid'] = false;
    $_SESSION['user_error_text'] = $user_res['error-msg'];
} else {
    unset($_SESSION['user_error_text']);
}


if(!$_SESSION['user_form_valid']){
    header("Location: ../addUser.php");
    die();
} else {
    unset($_SESSION['user_error_text']);
    
    insert_user($_POST['userName']);  
    unset($_SESSION['user_form_valid']);
    header("Location: ../index.php");
    die();
}

?>