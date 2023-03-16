<?php 
require_once("../functions.php");

if(!isset($_POST['tag'])) {
    header("Location: ../index.php");
    die();
}

session_start();

$tag_res = validate_tag($_POST['userId'], $_POST['tag'], $_POST['movieId']);


$_SESSION['tag_form_valid'] = true;
if(!$tag_res['status']){
    $_SESSION['tag_form_valid'] = false;
    $_SESSION['tag_error_text'] = $tag_res['error-msg'];
} else {
    unset($_SESSION['tag_error_text']);
}


if(!$_SESSION['tag_form_valid']){
    header("Location: ../updateMovie.php?id=".$_POST['movieId']);
    die();
} else {
    unset($_SESSION['tag_error_text']);
    
    add_tag($_POST['userId'],$_POST['movieId'], $_POST['tag']);  
    unset($_SESSION['tag_form_valid']);
    header("Location: ../movie.php?id=".$_POST['movieId']);
    die();
}

?>