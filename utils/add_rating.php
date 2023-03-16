<?php 
require_once("../functions.php");

if(!isset($_POST['movieId'])) {
    header("Location: ../index.php");
    die();
}
session_start();

$rating_res = validate_rating($_POST['userId'], $_POST['rating'], $_POST['movieId']);


$rating_form_valid = true;
if(!$rating_res['status']){
    $rating_form_valid = false;
    $_SESSION['rating_error_text'] = $rating_res['error-msg'];
} else {
    unset($_SESSION['rating_error_text']);
}


if(!$rating_form_valid){
    header("Location: ../addRating.php?id=".$_POST['movieId']);
    die();
} else {
    unset($_SESSION['rating_error_text']);
    
    add_rating($_POST['movieId'], $_POST['userId'], $_POST['rating']);  
    header("Location: ../movie.php?id=".$_POST['movieId']);
    die();
}

?>