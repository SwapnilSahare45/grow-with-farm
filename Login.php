<?php
session_start();

// Check if the user is already logged in
if (isset($_SESSION['username'])) {
  header("Location: index.php"); // Redirect to home page or another page
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Grow With Farm - Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
  <link rel="stylesheet" href="style/style.css" />
</head>

<body>
  <div class="container-fluid">
    <div class="row justify-content-evenly align-items-center" style="height: 100vh">
      <div class="col-lg-4"><img src="LOGO/LOGO.JPG" width="100%" /></div>

      <div class="col-lg-4 col-11 shadow-lg rounded">
        <form class="px-3 py-4 px-md-5 py-md-4" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
          <h1 class="text-center">Login</h1>
          <hr class="mt-4">
          <div class="mb-3">
            <label for="username" class="form-label fs-5">User Name</label>
            <input type="text" class="form-control" id="username" name="username" placeholder="Enter your addhar number" required />
          </div>
          <div class="mb-3">
            <label for="userpassword" class="form-label fs-5">Password</label>
            <input type="password" class="form-control" id="userpassword" name="userpassword" placeholder="Enter your password" required />
          </div>
          <hr class="mt-4">
          <button type="submit" class="btn btn-primary mt-2">Login</button>
          <div class="text-center my-3">Don't have an account? <a href="Register.php" style="text-decoration: none;">Register</a></div>
        </form>
      </div>
    </div>
  </div>
  <?php
  session_start();
  require 'connection.php';
  include 'msg.php';

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userName = $_POST['username'];
    $password = $_POST['userpassword'];


    $sql = "SELECT * FROM users WHERE adharno = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $userName);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      if (password_verify($password, $row['userpassword'])) {
        $_SESSION['username'] = $userName;
        msg("Login successful!");
        echo "<script>setTimeout(function(){ window.location.href = 'index.php'; }, 2000);</script>";
        exit();
      } else {
        msg("Invalid Password");
        echo "<script>document.addEventListener('DOMContentLoaded', function() {document.getElementById('username').focus();});</script>";
      }
    } else {
      msg("User not found");
      echo "<script>document.addEventListener('DOMContentLoaded', function() {document.getElementById('username').focus();});</script>";
    }

    $stmt->close();
  }

  $conn->close();
  ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>