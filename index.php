<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}


if (!isset($_SESSION['username'])) {
  header("Location: Login.php");
  exit();
}

$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="Grow With Farm helps farmers manage their expenses and sales, offering insights into crop profitability and loss.">
  <meta name="keywords" content="agriculture, farming, farm management, crop expenses, crop sales, profitability, loss calculation">
  <meta name="author" content="Grow With Farm Team">
  <title>Grow With Farm</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="style/style.css" />
  <link rel="apple-touch-icon" sizes="180x180" href="favicon_io/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="favicon_io/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="favicon_io/favicon-16x16.png">
  <link rel="manifest" href="favicon_io/site.webmanifest">
</head>

<body>
  <?php require "Navigation.php" ?>
  <div class="container-fluid">
    <div class="row">
      <div id="carouselExampleIndicators" class="carousel slide py-2" style="background-color: #ddd">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>

        </div>
        <div class="carousel-inner">
          <div class="carousel-item active" style="height: 340px">
            <img src="img/1.webp" class="d-block w-100" style="height: 100%" alt="..." />
          </div>
          <div class="carousel-item" style="height: 340px">
            <img src="img/3.webp" class="d-block w-100" style="height: 100%" alt="..." />
          </div>
          <div class="carousel-item" style="height: 340px">
            <img src="img/4.webp" class="d-block w-100" style="height: 100%" alt="..." />
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </div>

    <div class="row my-2 mx-1 justify-content-center" style="background-color: #ddd; color: black; font-weight: 600">
      <h1 class="col-lg-10 text-center m-3">Welcome to Farm Expenses!</h1>
      <p class="col-lg-12 pb-2 px-3" style="text-align: justify">
        Your comprehensive solution for managing expenses and sales with ease
        and efficiency. Designed for farmers, our platform simplifies the
        process of tracking your farm's financial transactions, empowering you
        to make informed decisions and maximize profitability. Say goodbye to
        cumbersome spreadsheets and paperwork – with our intuitive interface,
        you can conveniently input, organize, and analyze your expenses and
        sales data in one centralized location. Whether you're purchasing
        seeds, fertilizers, or equipment, or selling crops, livestock, or
        other products, our platform streamlines the entire process, saving
        you time and effort. Join our community of farmers dedicated to
        optimizing their operations and achieving financial success. Start
        managing your farm's finances effortlessly today with our farmer's
        portal.
      </p>
      <button type="button" class="col-lg-2 col-md-4 col-6 btn btn-primary mb-3">
        Explore Services
      </button>
    </div>

    <?php
    include 'about.html';
    include 'contact.php';
    include 'footer.html';
    ?>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>