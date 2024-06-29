<?php
session_start();

if(!isset($_SESSION['username'])){
  header("Location: Login.php");
  exit();
}

$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Grow With Farm</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="style/style.css" />
  </head>
  <body>
   <?php require "Navigation.php" ?>
    <div class="container-fluid">
      <div class="row">
        <div
          id="carouselExampleIndicators"
          class="carousel slide py-2"
          style="background-color: #ddd"
        >
          <div class="carousel-indicators">
            <button
              type="button"
              data-bs-target="#carouselExampleIndicators"
              data-bs-slide-to="0"
              class="active"
              aria-current="true"
              aria-label="Slide 1"
            ></button>
            <button
              type="button"
              data-bs-target="#carouselExampleIndicators"
              data-bs-slide-to="1"
              aria-label="Slide 2"
            ></button>
            <button
              type="button"
              data-bs-target="#carouselExampleIndicators"
              data-bs-slide-to="2"
              aria-label="Slide 3"
            ></button>
            <button
              type="button"
              data-bs-target="#carouselExampleIndicators"
              data-bs-slide-to="3"
              aria-label="Slide 4"
            ></button>
            <button
              type="button"
              data-bs-target="#carouselExampleIndicators"
              data-bs-slide-to="4"
              aria-label="Slide 5"
            ></button>
          </div>
          <div class="carousel-inner">
            <div class="carousel-item active" style="height: 340px">
              <img
                src="img/1.jpg"
                class="d-block w-100"
                style="height: 100%"
                alt="..."
              />
            </div>
            <div class="carousel-item" style="height: 340px">
              <img
                src="img/4.jpg"
                class="d-block w-100"
                style="height: 100%"
                alt="..."
              />
            </div>
            <div class="carousel-item" style="height: 340px">
              <img
                src="img/3.jpg"
                class="d-block w-100"
                style="height: 100%"
                alt="..."
              />
            </div>
            <div class="carousel-item" style="height: 340px">
              <img
                src="img/5.jpg"
                class="d-block w-100"
                style="height: 100%"
                alt="..."
              />
            </div>
            <div class="carousel-item" style="height: 340px">
              <img
                src="img/6.jpg"
                class="d-block w-100"
                style="height: 100%"
                alt="..."
              />
            </div>
          </div>
          <button
            class="carousel-control-prev"
            type="button"
            data-bs-target="#carouselExampleIndicators"
            data-bs-slide="prev"
          >
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button
            class="carousel-control-next"
            type="button"
            data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next"
          >
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
      </div>

      <div
        class="row my-2 mx-1 justify-content-center"
        style="background-color: #ddd; color: black; font-weight: 600"
      >
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
        <button
          type="button"
          class="col-lg-2 col-md-4 col-6 btn btn-primary mb-3"
        >
          Explore Services
        </button>
      </div>

      <div class="row justify-content-evenly" id="about">
        <div class="col-lg-12">
          <h1 class="text-center fw-bold mt-3 mb-4" style="font-size: 4.6rem;">About Us</h1>
        </div>
        <div class="col-lg-7 mb-3"><img class="rounded" width="100%" src="img/about.jpg" alt="" /></div>
        <div class="col-lg-5 my-4 ">
          <p class="px-3" style="text-align: justify; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-weight: 400; font-size: 1.2rem; color: black;">
            Welcome to Farm Expenses System, your go-to platform for efficient
            farm expense management. Our website is dedicated to providing
            farmers with a user-friendly and comprehensive solution for tracking
            expenses, managing sales, and analyzing financial performance. At
            Farm Expenses System, we understand the unique challenges that
            farmers face when it comes to managing their finances. That's why
            we've developed a robust system that allows you to easily record and
            categorize all your farm-related expenses, track sales transactions,
            and gain valuable insights into your farm's profitability. With our
            intuitive interface and powerful features, you can streamline your
            financial record-keeping process, make informed decisions to
            optimize your farm's performance, and ultimately achieve greater
            success in your agricultural endeavors. 
            <h5 class="text-center px-4 my-4" style="font-weight: 700; font-size: 1.3rem;">Join us at Farm Expenses and
              take control of your farm finances today!</h5>
          </p>
        </div>
      </div>
    </div>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
