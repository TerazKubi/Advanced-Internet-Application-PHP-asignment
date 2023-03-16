<?php
require_once("../functions.php"); 

session_start();

if(!isset($_POST['id'])) {
    header("Location: ../index.php");
    die();
}

$update_movie_res = validate_movie($_POST['title'], $_POST['genres']);

$update_movie_form_valid = true;
if(!$update_movie_res['status']){
    $update_movie_form_valid = false;
    $_SESSION['update_movie_error_text'] = $update_movie_res['error-msg'];
} else {
    unset($_SESSION['update_movie_error_text']);
}


if(!$update_movie_form_valid){
    header("Location: ../updateMovie.php?id=".$_POST['id']);
    die();
} else {
    unset($_SESSION['update_movie_error_text']);
    
    update_movie($_POST['id'], $_POST['title'], $_POST['genres']);  
    header("Location: ../movie.php?id=".$_POST['id']);
    die();
}

?>



