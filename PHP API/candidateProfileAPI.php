<?php
session_start();

if (!isset($_SESSION['isLoggedIn']) || $_SESSION['isLoggedIn'] !== true) {
    header("Location: login.php");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "Naruto@123";
$dbname = "UrmApp";

// Create a database connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// echo'conn:'.$dbname;
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$userID = $_SESSION['userID'];
$sqlProfile = "SELECT * FROM URM_Candidate where CandidateID='$userID'";
$resultProfile = mysqli_query($conn, $sqlProfile);
$candidate = mysqli_fetch_assoc($resultProfile);
