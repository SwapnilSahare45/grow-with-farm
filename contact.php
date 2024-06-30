
<div class="row justify-content-evenly mb-5" id="contact">
    <div class="col-lg-10 shadow-lg rounded my-3 col-11 px-5 py-4">
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <div class="col-lg-12">
                <h1 class="text-center fw-bold mt-3 mb-4 fs-1" >Contact Us</h1>
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
            <div class="col-auto mt-4 mb-2">
                <button type="submit" class="btn btn-primary">Send</button>
            </div>
        </form>
    </div>
</div>

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
