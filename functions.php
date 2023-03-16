<?php
require_once("DB/db_connection.php");


function get_movies($start_index, $results_per_page, $order = "title"){
    global $conn;

    $query = "SELECT m.movieId as movieId,m.genres as genres, m.title as title, COALESCE(round(avg(r.rating),2),0)as avg_rating 
                FROM movies m left join ratings r on m.movieId = r.movieId group by movieId
                order by ".(($order == "title") ? "m.title" : "avg_rating desc")." LIMIT ".$start_index.", ".$results_per_page;
    $result = mysqli_query($conn, $query);

    
    while ($row = mysqli_fetch_assoc($result)){
        echo "
        <div class='card border-dark mb-1'>
          <div class='card-body'>
            <h4 class='card-title'>".$row["title"]."</h4>
            <p class='card-text'>Genres: ".$row["genres"]."</p>
            <div class='row'>
                <div class='col'>
                    <p class='card-text'>Rating: ".($row["avg_rating"] != 0 ? $row["avg_rating"] : "---")."</p>
                </div>
                <div class='col text-end'>
                <a name='udate-btn' id='see_movie' class='btn btn-warning' href='movie.php?id=".$row['movieId']."' role='button'>Read more</a>  
                </div>  
            </div>     
          </div>
        </div>";
    }
    
}

function get_movie($id){
    global $conn;

    $query = "SELECT m.movieId as movieId, m.genres as genres, m.title as title, COALESCE(round(avg(r.rating),2),0) as avg_rating 
            FROM movies m left join ratings r on m.movieId = r.movieId group by movieId having m.movieId='$id';";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) < 1){
        echo "<div class='col-8'><h1>No movie with given ID.</h1></div>";
        return;
    }
    $row = mysqli_fetch_assoc($result);

    echo "<div class='col-8'>
        <div class='card border-secondary'>
        <div class='card-body'>
            <h1 class='card-title'>".$row["title"]."</h1>
            <h5 class='card-text'>Rating: ".($row["avg_rating"] != 0 ? $row["avg_rating"] : "---")."</h5>
            <p class='card-text'>Genres: ".$row["genres"]."</p>
            <div class='row'>
                <div class='col'>
                    <a name='udate-btn' id='rate_movie' class='btn btn-warning' href='../addRating.php?id=".$row['movieId']."' role='button'>Rate</a>
                    <a name='udate-btn' id='update_movie' class='btn btn-outline-dark' href='../updateMovie.php?id=".$row['movieId']."' role='button'>Update</a>
                </div>
                <div class='col text-end'>
                    <a name='delete-btn' id='delete_movie' class='btn btn-danger' href='../utils/delete_movie.php?id=".$row['movieId']."' role='button'>Delete</a> 
                </div>
            </div>                
        </div>
        </div>
    </div>";
}

function get_movie_data($id){
    global $conn;

    $query = "SELECT * from movies where movieId='$id';";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    return $row;
}

function get_tags(){
    global $conn;

    $query = "select DISTINCT tag from tags";
    $result = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_assoc($result)){
        echo "<div class='col-sm-3 mb-1'>
        <div class='card text-dark bg-light text-center border-dark'>
          <div class='card-body'>
            <h4 class='card-title'><a class='text-dark' href='tag.php?tag=".$row['tag']."'>#".$row["tag"]."</a></h4>                    
          </div>
        </div>
        </div>";
    }
}

function get_tag($tag){
    global $conn;

    $query = "SELECT m.movieId as movieId, m.genres as genres, m.title as title, COALESCE(round(avg(r.rating),2),0)as avg_rating 
                FROM movies m left join ratings r on m.movieId = r.movieId join tags t on m.movieId = t.movieId where t.tag='$tag' group by movieId";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) < 1){
        echo "<div class='col-8'><h1>Tag ".$tag." doesn't exist.</h1></div>";
        return;
    }

    while($row = mysqli_fetch_assoc($result)){
        echo "<div class='col-8 mb-1'>
        <div class='card border-dark'>
          <div class='card-body'>
            <h4 class='card-title'>".$row["title"]."</h4>
            <p class='card-text'>Genres: ".$row["genres"]."</p>
            <div class='row'>
                <div class='col'>
                    <p class='card-text'>Rating: ".($row["avg_rating"] != 0 ? $row["avg_rating"] : "---")."</p>
                </div>
                <div class='col text-end'>
                <a name='udate-btn' id='see_movie' class='btn btn-warning' href='movie.php?id=".$row['movieId']."' role='button'>Read more</a>  
                </div>  
            </div>     
          </div>
        </div>
        </div>";
    }
    
}

function get_movie_tags($id){
    global $conn;

    $query = "select * from tags where movieId = '$id'";
    $result = mysqli_query($conn, $query);

    echo "<h4 class='col-8'>Tags:</h4>";
    if (mysqli_num_rows($result) < 1){
        echo "<div class='col-8'><h1>---</h1></div>";
        return;
    }
    echo "<div class='row'>";
    while($row = mysqli_fetch_assoc($result)) {
        echo "<div class='col-sm-3 mb-1'>
            <div class='card text-dark bg-light text-center border-dark'>
                <div class='card-body'>
                    <p class='card-text'><a class='text-dark' href='tag.php?tag=".$row["tag"]."'>#".$row["tag"]."</a></p>                               
                </div>
            </div>
        </div>";
    }
    echo "</div>";

}

function get_movie_ratings($movieId){
    global $conn;

    $query = "SELECT users.name as user_name, ratings.rating as rating, ratings.date
                FROM ratings, users, movies
                WHERE users.userId = ratings.userId and ratings.movieId = movies.movieId
                and movies.movieId = '$movieId'";
    $result = mysqli_query($conn, $query);

    echo "<h4 class='col-8'>Ratings:</h4>";
    if (mysqli_num_rows($result) < 1){
        echo "<div class='col-8'><h1>---</h1></div>";
        return;
    }
    
    while($row = mysqli_fetch_assoc($result)) {
        echo "<div class='col-12'>
            <div class='card text-dark bg-light border-dark mb-1'>
            <div class='card-body'>
                <h3 class='card-title'>".$row["rating"]."</h3>
                <div class='row'>
                    <div class='col'><p class='card-text'>User: ".$row['user_name']."</p></div>
                    <div class='col'><p class='card-text text-end fs-6 fw-light'>".$row['date']."</p></div>
                </div>           
            </div>
            </div>
        </div>";
    }
    
}

function get_movie_tags_update($id){
    global $conn;

    $query = "select * from tags where movieId = '$id'";
    $result = mysqli_query($conn, $query);

    while($row = mysqli_fetch_assoc($result)) {
        echo "<div class='col-sm-4'>
            <div class='card text-dark bg-light text-center border-dark'>
            <div class='card-body'>
                <p class='card-text'><a style='color:red;' href='../utils/delete_tag.php?tag=".$row["tag"]."&movieId=".$id."'>#".$row["tag"]."</a></p>                 
            </div>
            </div>
        </div>";
    }
}

function get_movies_count(){
    global $conn;
    $query = "SELECT COUNT(*) as total FROM movies";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    return $row['total'];
}

function get_ratings($start_index, $results_per_page){
    global $conn;

    $query = "SELECT users.name as user_name, movies.title as title, movies.movieId as movieId, ratings.rating as rating, ratings.date
                FROM ratings, movies, users 
                WHERE users.userId = ratings.userId and ratings.movieId = movies.movieId LIMIT ".$start_index.", ".$results_per_page;
    $result = mysqli_query($conn, $query);

    
    while ($row = mysqli_fetch_assoc($result)){
        echo "<div class='col-8 mb-1'>
        <div class='card border-dark'>
        <div class='card-body'>

            <div class='row'>
                <div class='col'>
                    <h3 class='card-title'>".$row["rating"]." - ".$row["title"]."</h3>
                </div>
                <div class='col text-end'>
                    <p class='card-text'>".$row['date']."</p>
                </div>
            </div>
            
            <hr>

            <div class='row'>
                <div class='col'>
                    <p class='card-text'>".$row['user_name']."</p>
                </div>
                <div class='col text-end'>
                    <a name='udate-btn' id='see_movie' class='btn btn-warning' href='movie.php?id=".$row['movieId']."' role='button'>See movie</a> 
                </div>
            </div>
                      
        </div>
        </div>
        </div>";
    }
}

function get_ratings_count(){
    global $conn;
    $query = "SELECT COUNT(*) as total FROM ratings";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    return $row['total'];
}

function get_users_form(){
    global $conn;

    $query = "select * from users";
    $result = mysqli_query($conn, $query);

    while($row = mysqli_fetch_assoc($result)) {
        echo "<option value='".$row['userId']."'>".$row['name']."</option>";
    }
}

function insert_movie($title, $genres){
    global $conn;

    $query = "insert into movies(title, genres) values ('$title','$genres')";
    $result = mysqli_query($conn, $query);
}

function add_tag($userId, $movieId, $tag){
    global $conn;

    $query = "INSERT INTO tags(userId, movieId, tag) VALUES ('$userId','$movieId','$tag')";
    $result = mysqli_query($conn, $query);
}

function add_rating($movieId, $userId, $rating){
    global $conn;

    $query = "INSERT INTO ratings(userId, movieId, rating, date) VALUES ('$userId','$movieId','$rating', '".date('Y-m-d')."')";
    $result = mysqli_query($conn, $query);
}

function insert_user($name){
    global $conn;

    $query = "insert into users(name) values ('$name')";
    $result = mysqli_query($conn, $query);
}

function update_movie($id, $title, $genres){
    global $conn;

    $query = "update movies set title='$title', genres='$genres' where movieId='$id'";
    $result = mysqli_query($conn, $query);
}

function delete_movie($id){
    global $conn;

    $query = "delete from movies where movieId='$id'";
    $result = mysqli_query($conn, $query);    
}

function delete_tag($movieId, $tag){
    global $conn;

    $query = "delete from tags where movieId='$movieId' and tag='$tag'";
    $result = mysqli_query($conn, $query);
}

function validate_movie($title, $genres){
    $res['status'] = true;
    if(!isset($title) || empty($title) || empty($genres) || !isset($genres)){
        $res['error-msg'] = "Fields can't by empty";
        $res['status'] = false;
    }
    return $res;
}

function validate_tag($userId, $tag, $movieId){
    $res['status'] = true;
    if(!isset($tag) || empty($tag) || empty($userId) || !isset($userId)){
        $res['error-msg'] = "Fields can't by empty.";
        $res['status'] = false;
        return $res;
    }

    global $conn;

    $query = "select * from tags where tag='$tag' and movieId='$movieId'";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) > 0){
        $res['error-msg'] = "Movie already tagged with #".$tag.".";
        $res['status'] = false;
    }


    return $res;
}

function validate_user($userName){
    $res['status'] = true;
    if(!isset($userName) || empty($userName)){
        $res['error-msg'] = "Name can't by empty.";
        $res['status'] = false;
        return $res;
    }

    global $conn;

    $query = "select * from users where name='$userName'";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) > 0){
        $res['error-msg'] = "Name already taken.";
        $res['status'] = false;
    }

    return $res;
}

function validate_rating($userId, $rating, $movieId){
    $res['status'] = true;
    if(!isset($userId) || empty($userId) || !isset($rating) || empty($rating) || $rating == "Select rating" || $userId == "Select user"){
        $res['error-msg'] = "Fields can't by empty.";
        $res['status'] = false;
        return $res;
    }

    global $conn;

    $query = "select * from ratings where userId='$userId' and movieId='$movieId'";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) > 0){
        $res['error-msg'] = "This user has already rated this movie.";
        $res['status'] = false;
    }

    return $res;
}



?>