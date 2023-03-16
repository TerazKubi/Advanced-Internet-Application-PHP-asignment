<?php 
include("header.php");
require_once("functions.php"); 
?>

<div class="row justify-content-md-center">
    <div class="col-8">
        <div class='col-12 mb-3'><h1>Tags</h1></div>
        <div class="row">
            <?php get_tags(); ?>
        </div>
    </div>
</div>

<?php include("footer.php")?>