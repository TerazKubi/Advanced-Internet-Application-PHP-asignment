<?php 
include("header.php");
require_once("functions.php"); 


if(!isset($_GET['tag']) || empty($_GET['tag'])) {
    header("Location: ../index.php");
    die();
}
$tag = $_GET['tag'];

?>
<br>
<div class="row justify-content-md-center">

    <h2 class="col-8">Movies with tag #<?php echo $tag?></h2>
    <br><br>
    <?php  get_tag($tag) ?>
</div>


<?php include("footer.php")?>