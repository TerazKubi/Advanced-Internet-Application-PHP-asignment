<?php
require_once("../functions.php");

if(!isset($_GET['tag']) || !isset($_GET['movieId'])) {
    header("Location: ../index.php");
    die();
}

delete_tag($_GET["movieId"], $_GET['tag']);

header("Location: ../updateMovie.php?id=".$_GET['movieId']);
?>