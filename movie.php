<?php 
include("header.php");
require_once("functions.php"); 


if(!isset($_GET['id'])) {
    header("Location: ../index.php");
    die();
}
$movieId = $_GET['id'];

?>
<br>
<div class="row justify-content-md-center">
    <?php get_movie($movieId); ?>
</div>
<br>
<div class="row justify-content-md-center">
    <div class="col-8">
        <?php get_movie_tags($movieId); ?>
    </div>
</div>
<br>
<div class="row justify-content-md-center">
    <div class="col-8">
        <?php get_movie_ratings($movieId); ?>
    </div>
</div>


<?php include("footer.php")?>