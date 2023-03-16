<?php
include("header.php"); 
require_once("functions.php");

if(!isset($_GET['id'])) {
    header("Location: ../index.php");
    die();
}

$row = get_movie_data($_GET['id']);

?>
<br>
<div class="container">
    <div class="row justify-content-center align-items-center g-2">
        <div class="col-8">
            <h2 class="col-12">Update movie <?php echo $row['title'];?></h2><hr>
            <form action="utils/update_movie.php" method="POST">
                <input type="hidden" id="id-form" name="id" <?php echo "value=".$row['movieId'];?>>
                <div class="mb-3">
                    <label for="" class="form-label">Movie title</label>
                    <input type="text" class="form-control border-dark" name="title" id="title-form" aria-describedby="helpId" <?php echo "value='".$row['title']."'"; ?>>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Genres</label>
                    <input type="text" class="form-control border-dark" name="genres" id="genre-form" aria-describedby="helpId" <?php echo "value='".$row['genres']."'"; ?>>
                </div>
                <div class="form-error">
                        <?php
                        if(isset($_SESSION['update_movie_error_text'])) {
                            echo "<p style='color:red;'>".$_SESSION['update_movie_error_text']."</p>";
                            unset($_SESSION['update_movie_error_text']);
                        }
                        ?>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div> 
<br>
<div class="container">
    <div class="row justify-content-center align-items-center g-2">
        <div class="col-8">
            <h4 class="col-8">Add new tag</h4>
            <hr>
            <form action="utils/add_tag.php" method="POST">
                <input type="hidden" id="id-form" name="movieId" <?php echo "value=".$row['movieId'];?>>
                
                <div class="mb-3">
                    <label for="" class="form-label">User Id</label>
                    <select class="form-select form-select-lg border-dark" name="userId" id="user-id-form">
                        <option selected>Select user</option>
                        <?php get_users_form();?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Tag</label>
                    <input type="text" class="form-control border-dark" name="tag" id="tag-form" aria-describedby="helpId">
                </div>
                <div class="form-error">
                        <?php
                        if(isset($_SESSION['tag_error_text'])) {
                            echo "<p style='color:red;'>".$_SESSION['tag_error_text']."</p>";
                            unset($_SESSION['tag_error_text']);
                        }
                        ?>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div> 
<br>
<div class="container">
    <div class="row justify-content-center align-items-center g-2">
        <div class="col-8">
            <h4 class="col-8">Delete tag</h4>
            <hr>
            <div class="row">
                <?php get_movie_tags_update($row['movieId'])?>
            </div>
        </div>
    </div>
</div>

<?php include("footer.php");?>