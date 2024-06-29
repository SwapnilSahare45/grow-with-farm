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
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" class="px-3 py-2 px-md-5 py-md-3 needs-validation was-validated" novalidate>
                    <h1 class="text-center">Register</h1>
                    <hr class="mt-2 mb-2">
                    <div class="mb-1">
                        <label for="firstname" class="form-label ">First Name</label>
                        <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Enter your first name" pattern="^[a-zA-Z]{1,20}$" required />
                        <div class="invalid-feedback">
                            Please enter a valid first name.
                        </div>
                    </div>
                    <div class="mb-1">
                        <label for="lastname" class="form-label ">Last Name</label>
                        <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Enter your last name" pattern="^[a-zA-Z]{1,20}$" required />
                        <div class="invalid-feedback">
                            Please enter a valid last name.
                        </div>
                    </div>
                    <div class="mb-1">
                        <label for="adharno" class="form-label ">Adhar No</label>
                        <input type="text" class="form-control" id="adharno" name="adharno" placeholder="Enter your Adhar number" pattern="^\d{12}$" required />
                        <div class="invalid-feedback">
                            Please enter a valid Aadhar number.
                        </div>
                    </div>
                    <div class="mb-1">
                        <label for="mobileno" class="form-label ">Mobile No</label>
                        <input type="text" class="form-control" id="mobileno" name="mobileno" placeholder="Enter your Mobile no" pattern="^\d{10}$" required />
                        <div class="invalid-feedback">
                            Please enter a valid mobile number.
                        </div>
                    </div>
                    <label for="gender mb-1">Gender</label>
                    <br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" value="M" id="inlineRadio1" required>
                        <label class="form-check-label " for="inlineRadio1">Male</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" value="F" id="inlineRadio2" required>
                        <label class="form-check-label" for="inlineRadio2">Female</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" value="O" id="inlineRadio3" required>
                        <label class="form-check-label" for="inlineRadio3">Other</label>
                    </div>

                    <div class="mb-1">
                        <label for="userpassword" class="form-label">Password</label>
                        <input type="password" class="form-control" id="userpassword" name="userpassword" minlength="6" placeholder="Enter your password" required />
                        <div class="invalid-feedback">
                            Password must be at least 6 characters long.
                        </div>
                    </div>
                    <div class="mb-1">
                        <label for="confirmpass" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="confirmpass" placeholder="Enter your password" required />
                        <div class="invalid-feedback">
                            Passwords must match.
                        </div>
                    </div>
                    <hr class="mt-3 mb-2">
                    <button type="submit" class="btn btn-primary mt-2">Register</button>
                    <div class="text-center my-2 ">Already have an account? <a href="Login.php" style="text-decoration: none;">Log In</a></div>
                </form>
            </div>
        </div>
    </div>


    <script>
        (() => {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            const forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    const password = document.getElementById("userpassword").value
                    const confirmPassword = document.getElementById("confirmpass").value

                    if (!form.checkValidity() || password != confirmPassword) {
                        event.preventDefault()
                        event.stopPropagation()

                        if (password != confirmPassword) {
                            document.getElementById('confirmpass').setCustomValidity("Passwords do not match")
                        } else {
                            document.getElementById('confirmpass').setCustomValidity("")
                        }


                        form.classList.add('was-validated')
                    }
                }, false)
            })
        })()
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>

<?php
require 'connection.php';
include 'msg.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $adharno = $_POST['adharno'];
    $mobileno = $_POST['mobileno'];
    $gender = $_POST['gender'];
    $userpassword = $_POST['userpassword'];

    $checkQuery = "SELECT * FROM users WHERE adharno = '$adharno'";
    $result = $conn->query($checkQuery);

    if ($result->num_rows > 0) {
       msg("User already exists with this Aadhar number!");
    } else {
        $hashedPassword = password_hash($userpassword, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (firstname, lastname, adharno, mobileno, gender, userpassword) VALUES(?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssss", $firstname, $lastname, $adharno, $mobileno, $gender, $hashedPassword);

        if ($stmt->execute() === TRUE) {
            msg("Registration successful!");
            echo "<script>setTimeout(function(){ window.location.href = 'Login.php'; }, 3000);</script>";
        } else {
            echo "Error: " . $stmt->error;
        }
    }
    $stmt->close();
}
$conn->close();

?>