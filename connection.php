<?php
$servername = "localhost";
$username = "root";
$pass = "";
$database = "growwithfarm";

$conn = new mysqli($servername, $username, $pass, $database);
if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}
?>