<?php 
include("header.php");
require_once("functions.php"); 

if(!isset($_GET['id']) || empty($_GET['id'])){
    header("Location: ../index.php");
    die();
}

$movie_row = get_movie_data($_GET['id']);

?>
<div class="container">
    <div class="row justify-content-center align-items-center g-2">
        <h4 class="col-8">Rate movie <?php echo $movie_row['title']?></h4>
        <div class="col-8">
            <form action="utils/add_rating.php" method="POST">
                <input type="hidden" id="id-form" name="movieId" <?php echo "value=".$_GET['id'];?>>
                <input type="hidden" id="id-form" name="title" <?php echo "value='".$movie_row['title']."'";?>>
                <div class="mb-3">
                    <label for="" class="form-label">User Id</label>
                    <select class="form-select form-select-lg border-dark" name="userId" id="user-id-form">
                        <option selected>Select user</option>
                        <?php get_users_form();?>
                    </select>
                </div>
                <div class="mb-3">
                <label for="" class="form-label">Rating</label>
                    <select class="form-select form-select-lg border-dark" name="rating" id="user-id-form">
                        <option selected>Select rating</option>
                        <option value="0">0</option>
                        <option value="0.5">0.5</option>
                        <option value="1">1</option>
                        <option value="1.5">1.5</option>
                        <option value="2">2</option>
                        <option value="2.5">2.5</option>
                        <option value="3">3</option>
                        <option value="3.5">3.5</option>
                        <option value="4">4</option>
                        <option value="4.5">4.5</option>
                        <option value="5">5</option>
                    </select>
                </div>
                <div class="form-error">
                        <?php
                            if(isset($_SESSION['rating_error_text'])) echo "<p style='color:red;'>".$_SESSION['rating_error_text']."</p>";
                            unset($_SESSION['rating_error_text']);
                        ?>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>  
    


<?php include("footer.php")?>