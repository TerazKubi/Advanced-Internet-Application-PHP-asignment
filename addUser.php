<?php 
include("header.php");
require_once("functions.php"); 


?>
<div class="container">
    <div class="row justify-content-center align-items-center g-2">
        <h4 class="col-8">Add new user</h4>
        <div class="col-8">
            <form action="utils/add_user.php" method="POST">
                <div class="mb-3">
                    <label for="" class="form-label">User name</label>
                    <input type="text"
                    class="form-control border-dark" name="userName" id="title-form" aria-describedby="helpId">
                </div>
                <div class="form-error">
                        <?php
                            if(isset($_SESSION['user_error_text'])) echo "<p style='color:red;'>".$_SESSION['user_error_text']."</p>";
                            unset($_SESSION['user_error_text']);
                        ?>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>  
    


<?php include("footer.php")?>