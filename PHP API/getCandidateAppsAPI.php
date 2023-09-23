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
$userID = $_SESSION['userID'];

// Check if the connection was successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Query to fetch data from jobs and applications table
$sqlStatus = "SELECT j.UnivName, j.JobID, a.Status, a.ApplicationID
              FROM Jobs j JOIN Applications a ON j.JobID = a.JobID
              WHERE a.CandidateID='$userID'";

$result = mysqli_query($conn, $sqlStatus);

// Check if the query was successful
if (!$result) {
    echo "Error fetching data: " . mysqli_error($conn);
} else {
    // Store the fetched data in an array
    $applicationData = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $applicationData[] = array(
            'UnivName' => $row['UnivName'],
            'JobID' => $row['JobID'],
            'ApplicationID' => $row['ApplicationID'],
            'Status' => $row['Status']
        );
    }

    // Encode the data as JSON
    $jsonData = json_encode($applicationData);

    // Set appropriate response headers for JSON data
    header('Content-Type: application/json');
    echo $jsonData;
}

// Close the database connection
mysqli_close($conn);
