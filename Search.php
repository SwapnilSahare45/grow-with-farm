<?php
session_start();

require "connection.php";
include "msg.php";

if (!isset($_SESSION['username'])) {
    header("Location: Login.php");
    exit();
}

$username = $_SESSION['username'];

function searchRecords($conn, $username, $searchTerm)
{
    $searchTerm = "%$searchTerm%";

    $sql = "SELECT * FROM expenses_and_sales WHERE username = ? AND (selectfor LIKE ? OR crops LIKE ? OR amount LIKE ? OR mode LIKE ? OR date LIKE ? OR expenses LIKE ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssss", $username, $searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}

if (isset($_POST['search'])) {
    $searchTerm = $_POST['search'];
    $searchResults = searchRecords($conn, $username, $searchTerm);
    $conn->close();
}

function deleteRecord($conn, $id)
{
    $sql = "DELETE FROM expenses_and_sales WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
}

if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    deleteRecord($conn, $id);
    msg("Record deleted successfully");
    echo "<script>setTimeout(function(){ window.location.href = '" . $_SERVER['PHP_SELF'] . "'; }, 2000);</script>";
    $conn->close();
}

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Grow With Farm - Search</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <?php require "Navigation.php" ?>
    <div class="container">

        <div class="d-flex justify-content-center mt-4">
            <form method="post" class="col-9">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="search" placeholder="Search...">
                    <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Search</button>
                </div>
            </form>
        </div>

        <?php

        if (isset($searchResults) && !empty($searchResults)) :
            echo "<div class='row row-cols-1 row-cols-md-4 mt-4'>";
            foreach ($searchResults as $result) :
                echo "<div class='col'>";
                echo "<div class='card border-success mb-3' style='max-width: 18rem;'>";
                echo "<h4 class='card-header text-success'>" . $result['selectfor'] . " : <span class='fs-5'>" .  $result['expenses'] . "</span> </h4>";
                echo "<div class='card-body'>";
                echo "<h5 class='card-title'>" . $result['crops'] . "</h5>";
                echo "<p class='card-text'>Date : " .  $result['date'] . "</p>";
                echo "<p class='card-text'>Amount : " .  $result['amount'] . "</p>";
                echo "<p class='card-text'>Payment mode : " .  $result['mode'] . "</p>";
                echo "<form action='' method='post'>";
                echo "<input type='hidden' name='id' value='" . $result['id'] . "'>";
                echo "<button class='btn btn-danger' type='submit' name='delete'>Delete</button>";
                echo "</form>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
            endforeach;
            echo "</div>";
        elseif (isset($searchResults) && empty($searchResults)) :
            echo "<h3 class ='col-12 text-center mt-4'>No results found</h3>";
        endif;
        ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>