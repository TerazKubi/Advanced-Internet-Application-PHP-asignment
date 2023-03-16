<!doctype html>
<html lang="en">

<head>
  <title>MovieLens</title>
  <!-- Required meta tags -->
  <meta charset="UTF-8">
  <meta name="description" content="AIA lab02">
  <meta name="keywords" content="HTML, CSS, JavaScript, PHP">
  <meta name="author" content="Jakub Cichowicz">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <meta name="robots" content="noindex">
  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body style="background-color:silver;">




<header class="p-3 bg-dark text-white mb-3">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        

        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          <li><a href="index.php" class="nav-link px-2 text-secondary">Movies</a></li>
          <li><a href="ratings.php" class="nav-link px-2 text-white">Ratings</a></li>
          <li><a href="tags.php" class="nav-link px-2 text-white">Tags</a></li>
          <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-white" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Add..</a>
          <ul class="dropdown-menu bg-dark">
            <li><a class="dropdown-item text-white" href="addMovie.php">Movie</a></li>    
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item text-white" href="addUser.php">User</a></li>
          </ul>
        </li>
        </ul>

      </div>
    </div>
</header>


<?php 
    session_start();
?>
  