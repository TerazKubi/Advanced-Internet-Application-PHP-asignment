<?php 
include("header.php");
require_once("functions.php"); 

$total_rows = get_movies_count();

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
    <h1 class='col-8 mb-1'>Movies</h1>
    <div class="col-8 mb-3">
        Order: 
        <a href="index.php?order=rating">Rating</a>
        <a href="index.php?order=title">Title</a>
    </div>
    <div class="col-8">
        <?php isset($_GET['order']) ? get_movies($start_index, $results_per_page, $_GET['order']) : get_movies($start_index, $results_per_page); ?>
    </div>
</div>

<div class="row justify-content-md-center">
    <div class="col-4">
        <nav aria-label="Page navigation example">
            <ul class="pagination mt-3">
                <?php
                    $href = (isset($_GET['order'])) ? "index.php?order=".$_GET['order']."&page=" : "index.php?page=";
                    echo "<li class='page-item ".($current_page == 1 ? "disabled" : "")."'><a class='page-link' href='".$href."".$current_page-1 ."'>Previous</a></li>";
                    for($i=1; $i <= $total_pages; $i++){
                        echo  "<li class='page-item ".($current_page == $i ? "active" : "")."'><a class='page-link' href='".$href."".$i."'>".$i."</a></li>";
                    }
                    echo "<li class='page-item ".($current_page == $total_pages ? "disabled" : "")."'><a class='page-link' href='".$href."".$current_page+1 ."'>Next</a></li>";
                ?>
            </ul>
        </nav>
    </div>
</div>

<?php include("footer.php")?>