<?php 
include("header.php");
require_once("functions.php"); 


?>
<div class="container">
    <div class="row justify-content-center align-items-center g-2">
        <h4 class="col-8">Add new movie</h4>
        <div class="col-8">
            <form action="utils/add_movie.php" method="POST">
                <div class="mb-3">
                    <label for="" class="form-label">Movie title</label>
                    <input type="text"
                    class="form-control border-dark" name="title" id="title-form" aria-describedby="helpId" placeholder="Title">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Genres</label>
                    <input type="text"
                    class="form-control border-dark" name="genres" id="genre-form" aria-describedby="helpId" placeholder="Genre1|Genre2|Genre3">
                </div>
                <div class="form-error">
                        <?php
                            if(isset($_SESSION['movie_error_text'])) echo "<p style='color:red;'>".$_SESSION['movie_error_text']."</p>";
                            unset($_SESSION['movie_error_text']);
                        ?>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>  
    


<?php include("footer.php")?>