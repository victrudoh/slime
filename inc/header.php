<?php include './config/database.php'; ?>

<?php

session_start();

if (isset($_SESSION['username'])) {
  $nav =
    '<ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link" href="/slime/feed">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/slime/add">Add Post</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/slime/about">About Us</a>
          </li>
          <li class="nav-item">
            <a class="nav-link btn btn-danger btn-outline-warning text-white mx-3" href="logout.php">Logout</a>
          </li>
        </ul>';
} else {
  $nav =
    '<ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link btn btn-info btn-outline-success text-white mx-3" href="/slime/login">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link btn btn-success btn-outline-info text-white" href="/slime/register">Register</a>
          </li>
        </ul>';;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <title>slime</title>
</head>

<body>
  <nav class="navbar navbar-expand-sm navbar-light bg-light mb-4">
    <div class="container">
      <!-- <a class="navbar-brand text-success" href="/slime/feed"> -->
      <a class="navbar-brand text-success" href="#">
        <h3>slime</h3>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <?php echo $nav; ?>
      </div>
    </div>
  </nav>

  <main>
    <div class="container d-flex flex-column align-items-center">