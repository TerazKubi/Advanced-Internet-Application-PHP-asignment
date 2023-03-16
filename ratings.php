<?php 
include("header.php");
require_once("functions.php"); 

$total_rows = get_ratings_count();

$results_per_page = 10;
$total_pages = ceil($total_rows / $results_per_page);

if (isset($_GET['page'])) {
    $current_page = $_GET['page'];
} else {
    $current_page = 1;
}

$start_index = ($current_page - 1) * $results_per_page;
$end_index = $start_index + $results_per_page - 1;

?>

<div class="row justify-content-md-center">
    <div class='col-8 mb-3'><h1>Ratings</h1></div>
    <?php get_ratings($start_index, $results_per_page);?>
</div>

<div class="row justify-content-md-center">
    <div class="col-4">
        <nav aria-label="Page navigation example">
            <ul class="pagination mt-3">
                <?php
                    echo "<li class='page-item ".($current_page == 1 ? "disabled" : "")."'><a class='page-link' href='ratings.php?page=".$current_page-1 ."'>Previous</a></li>";
                    for($i=1; $i <= $total_pages; $i++){
                        echo  "<li class='page-item ".($current_page == $i ? "active" : "")."'><a class='page-link' href='ratings.php?page=".$i."'>".$i."</a></li>";
                    }
                    echo "<li class='page-item ".($current_page == $total_pages ? "disabled" : "")."'><a class='page-link' href='ratings.php?page=".$current_page+1 ."'>Next</a></li>";
                ?>
            </ul>
        </nav>
    </div>
</div>

<?php include("footer.php")?>