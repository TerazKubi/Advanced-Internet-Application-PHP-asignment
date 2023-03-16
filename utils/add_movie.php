<?php 
require_once("../functions.php");

if(!isset($_POST['title'])) {
    header("Location: ../index.php");
    die();
}

session_start();

$movie_res = validate_movie($_POST['title'], $_POST['genres']);


$_SESSION['movie_form_valid'] = true;
if(!$movie_res['status']){
    $_SESSION['movie_form_valid'] = false;
    $_SESSION['movie_error_text'] = $movie_res['error-msg'];
} else {
    unset($_SESSION['movie_error_text']);
}


if(!$_SESSION['movie_form_valid']){
    header("Location: ../addMovie.php");
    die();
} else {
    unset($_SESSION['movie_error_text']);
    
    insert_movie($_POST['title'], $_POST['genres']);  
    unset($_SESSION['movie_form_valid']);
    header("Location: ../index.php");
    die();
}

?>