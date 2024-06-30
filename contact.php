<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Contact US</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style/style.css">
</head>

<body>
    <div class="row justify-content-evenly mb-5 " id="contact">

        <div class="col-lg-10 shadow-lg rounded my-3 px-5 py-4">
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                <div class="col-lg-12">
                    <h1 class="text-center fw-bold mt-2 mb-4" style="font-size: 4.6rem;">Contact Us</h1>
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Name</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Enter your full name">
                </div>
                <div class="mb-3">
                    <label for="useremail" class="form-label">Email</label>
                    <input type="text" class="form-control" id="useremail" name="useremail" placeholder="Enter your email">
                </div>
                <div class="mb-3">
                    <label for="usermsg" class="form-label">Message</label>
                    <textarea class="form-control" id="usermsg" rows="3" name="usermsg" placeholder="Enter your message"></textarea>
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary">Send</button>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    require "connection.php";
    include "msg.php";
    $username = $_POST['username'];
    $useremail = $_POST['useremail'];
    $usermsg = $_POST['usermsg'];

    $sql = "INSERT INTO contact_us (name, email, message) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $username, $useremail, $usermsg);

    if ($stmt->execute() === TRUE) {
        msg("Message sent successfully!");
    } else {
        echo "<div class='alert alert-danger' role='alert'>Error: " . $stmt->error . "</div>";
    }
    $stmt->close();
    $conn->close();
}
?>