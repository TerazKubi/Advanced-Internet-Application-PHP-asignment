<?php 
    $server_add = "localhost";
    $db_name = "movielens";
    $username = "root";
    $password = "";

    $conn = mysqli_connect($server_add, $username, $password, $db_name);

    if(!$conn){
        die();
    }

?>