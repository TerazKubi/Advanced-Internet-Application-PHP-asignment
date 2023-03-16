<?php
require_once("../functions.php");

if(!isset($_GET['id'])) {
    header("Location: ../index.php");
    die();
}

$movie_id = $_GET["id"];

delete_movie($movie_id);

header("Location: ../index.php");
?>
