<?php
session_start();
require 'connection.php';
include 'msg.php';

if (!isset($_SESSION['username'])) {
  header("Location: Login.php");
  exit();
}

$username = $_SESSION['username'];

$totalExpenses = 0;
$totalSales = 0;

function getCropList($conn, $username)
{
  $cropList = [];
  $sql = "SELECT DISTINCT crops FROM expenses_and_sales WHERE username = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $username);
  $stmt->execute();
  $result = $stmt->get_result();
  while ($row = $result->fetch_assoc()) {
    $cropList[] = $row["crops"];
  }
  return $cropList;
}

function getExpensesByCrops($conn, $username, $crop)
{
  $expenses = [];
  $sql = "SELECT * FROM expenses_and_sales WHERE username = ? AND crops = ? AND selectfor = 'expenses'";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ss", $username, $crop);
  $stmt->execute();
  $result = $stmt->get_result();
  while ($row = $result->fetch_assoc()) {
    $expenses[] = $row;
  }
  return $expenses;
}

function getSalesByCrops($conn, $username, $crop)
{
  $sales = [];
  $sql = "SELECT * FROM expenses_and_sales WHERE username = ? AND crops = ? AND selectfor = 'sales'";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ss", $username, $crop);
  $stmt->execute();
  $result = $stmt->get_result();
  while ($row = $result->fetch_assoc()) {
    $sales[] = $row;
  }
  return $sales;
}

if (isset($_POST['searchCrops'])) {
  $selectedCrop = $_POST['selectedCrop'];
  $expenses = getExpensesByCrops($conn, $username, $selectedCrop);
  $sales = getSalesByCrops($conn, $username, $selectedCrop);

  foreach ($expenses as $expense) {
    $totalExpenses += $expense['amount'];
  }

  foreach ($sales as $sale) {
    $totalSales += $sale['amount'];
  }
}

$ProfitLoss = $totalSales - $totalExpenses;

$cropList = getCropList($conn, $username);
$conn->close();

?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Profit and Loss</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="style/style.css">
</head>

<body>

  <?php require "Navigation.php" ?>
  <div class="container">
    <div class="row">
      <form class="d-flex my-4" role="search" action="Profit&Loss.php" method="post">
        <input class="form-control me-2" type="search" placeholder="Search" name="selectedCrop">
        <button class="btn btn-outline-success" type="submit" name="searchCrops">Search</button>
      </form>
      <?php
      if (isset($expenses) && is_array($expenses) && !empty($expenses) || isset($sales) && is_array($sales) && !empty($sales)) {
        echo "<table class='table table-bordered'>
        <thead >
          <tr >
            <th scope='col'  colspan='3' class='fs-4'>Expenses</th>
            <th scope='col' colspan='3' class='fs-4'>Sales</th>
          </tr>
          <tr >
            <th>Date</th>
            <th>Mode</th>
            <th>Amount</th>
            <th>Date</th>
            <th>Mode</th>
            <th>Amount</th>
          </tr>
        </thead>
        <tbody  class='table-group-divider'>";
        $maxRows = max(count($expenses), count($sales));
        for ($i = 0; $i < $maxRows; $i++) {
          echo "<tr>";
          if (isset($expenses[$i])) {
            echo "<td>" . $expenses[$i]['date'] . "</td>";
            echo "<td>" . $expenses[$i]['mode'] . "</td>";
            echo "<td>" . $expenses[$i]['amount'] . "</td>";
          } else {
            echo "<td colspan='3'></td>";
          }

          if (isset($sales[$i])) {
            echo "<td>" . $sales[$i]['date'] . "</td>";
            echo "<td>" . $sales[$i]['mode'] . "</td>";
            echo "<td>" . $sales[$i]['amount'] . "</td>";
          } else {
            echo "<td colspan='3'></td>";
          }
          echo "</tr>";
        }

        echo "<tr>";
        echo "<th colspan='2'>Total Expenses</th>";
        echo "<th>" . $totalExpenses . "</th>";
        echo "<th colspan='2'>Total Sales</th>";
        echo "<th>" . $totalSales . "</th>";
        echo "</tr>";

        echo "<tr>";
        echo "<th colspan='3'>Profit/Loss</th>";
        echo "<th colspan='3'>" . ($ProfitLoss > 0 ? "Profit: ₹ " . $ProfitLoss : "Loss: ₹ " . abs($ProfitLoss)) . "</th>";
        echo "</tr>";
      } else {
        echo "<h4>No expenses and sales found</h4>";
      }
      ?>
      </tbody>
      </table>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>