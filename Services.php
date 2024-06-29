<?php
session_start();

require "connection.php";
include "msg.php";

if (!isset($_SESSION['username'])) {
  header("Location: Login.php");
  exit();
}

$username = $_SESSION['username'];
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $SelectFor = $_POST['SelectFor'];
  $SelectCrops = $_POST['SelectCrops'];
  $SelectExpenses = $_POST['SelectExpenses'];
  $SelectDate = $_POST['SelectDate'];
  $SelectAmount = $_POST['SelectAmount'];
  $SelectMode = $_POST['SelectMode'];
  $AddRemark = $_POST['AddRemark'];

  $sql = "INSERT INTO expenses_and_sales (selectfor, crops, expenses, date, amount, mode, remark, username) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ssssssss", $SelectFor, $SelectCrops, $SelectExpenses, $SelectDate, $SelectAmount, $SelectMode, $AddRemark, $username);

  if ($stmt->execute() === TRUE) {
    msg("Record inserted successfully");
    echo "<script>setTimeout(function(){ window.location.href = '" . $_SERVER['PHP_SELF'] . "'; }, 2000);</script>";

  } else {
    echo "Error: " . $stmt->error;
  }
  $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Grow With Farm - Services</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
  <link rel="stylesheet" href="style/style.css" />
</head>

<body>
  <?php require "Navigation.php" ?>

  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center my-4">
        <h1>Add Expenses And Sales</h1>
      </div>
      <hr class="mb-4" />
      <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <div class="input-group mb-4">
          <label class="input-group-text" for="SelectFor">Select For</label>
          <select class="form-select" id="SelectFor" name="SelectFor" required>
            <option value="" selected disabled>Choose...</option>
            <option value="expenses">Expenses</option>
            <option value="sales">Sales</option>
          </select>
        </div>

        <div class="input-group mb-4">
          <label class="input-group-text" for="SelectCrops">Crops</label>
          <select class="form-select" id="SelectCrops" name="SelectCrops" required>
            <option value="" disabled selected>Select Crop</option>
            <option value="cotton">Cotton</option>
            <option value="soybeans">Soybeans</option>
            <option value="wheat">Wheat</option>
            <option value="rice">Rice</option>
            <option value="sugarcane">Sugarcane</option>
            <option value="sorghum">Sorghum</option>
            <option value="maize">Maize</option>
            <option value="chickpeas">Chickpeas</option>
            <option value="groundnut">Groundnut</option>
            <option value="sunflower">Sunflower</option>
            <option value="tea">Tea</option>
            <option value="rubber">Rubber</option>
            <option value="onion">Onion</option>
            <option value="tomato">Tomato</option>
            <option value="potato">Potato</option>
            <option value="garlic">Garlic</option>
            <option value="termeric">Termeric</option>
            <option value="betalLeaves">Betal leaves</option>
            <option value="betalNuts">Betal nuts</option>
            <option value="pumpkin">Pumpkin</option>
          </select>
        </div>

        <div class="input-group mb-4">
          <label class="input-group-text" for="SelectExpenses">Expenses For</label>
          <select class="form-select" id="SelectExpenses" name="SelectExpenses" required>
            <option value="" disabled selected>Select Expenses</option>
            <option value="seeds">Seeds</option>
            <option value="fertilizers">Fertilizers</option>
            <option value="pesticides">Pesticides</option>
            <option value="irrigation">Irrigation</option>
            <option value="labor">Labor</option>
            <option value="landRent">Land rent/lease</option>
            <option value="transportation">Transportation</option>
            <option value="electricity">Electricity cost</option>
            <option value="storage">Storage</option>
            <option value="fuel">Fuel</option>
            <option value="packaging">Packaging</option>
            <option value="machinery">Machinery</option>
            <option value="landPreparation">Land preparation</option>
            <option value="cropInsurence">Crop insurence</option>
            <option value="loanInterest">Loan Interest</option>
          </select>
        </div>

        <div class="input-group mb-4">
          <span class="input-group-text">Date</span>
          <input type="date" class="form-control" name="SelectDate" required />
          <span class="input-group-text">Amount</span>
          <input type="number" class="form-control" placeholder="Amount" name="SelectAmount" required />
        </div>

        <div class="input-group mb-4">
          <label class="input-group-text" for="SelectMode">Payment Mode</label>
          <select class="form-select" id="SelectMode" name="SelectMode" required>
            <option value="" disabled selected>Select payment mode</option>
            <option value="Online">online</option>
            <option value="Cash">cash</option>
          </select>
        </div>

        <div class="input-group mb-3">
          <span class="input-group-text" id="AddRemark">Remark</span>
          <input type="text" class="form-control" placeholder="Remark" name="AddRemark" required />
        </div>

        <hr class="mt-4" />

        <div class="col-lg-12 text-center mt-4">
          <button class="btn btn-primary col-md-2" type="submit">
            Submit form
          </button>
        </div>
      </form>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>

<?php
require "connection.php";


?>